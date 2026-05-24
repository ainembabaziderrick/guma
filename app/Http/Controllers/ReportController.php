<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function deployment()
    {
        return view('report.deployment');
    }

    public function deploymentData(Request $request)
    {
        $query = Candidate::where('deployment_status', '!=', 'not_scheduled')
            ->when($request->status, fn($q) => $q->where('deployment_status', $request->status))
            ->when($request->from, fn($q) => $q->whereDate('departure_date', '>=', $request->from))
            ->when($request->to, fn($q) => $q->whereDate('departure_date', '<=', $request->to))
            ->when($request->destination, fn($q) => $q->where('destination', 'like', "%{$request->destination}%"));

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('deployment_status', function($c){
                $labels = [
                    'scheduled' => 'warning',
                    'departed' => 'info',
                    'arrived' => 'success',
                    'cancelled' => 'danger'
                ];
                $label = $labels[$c->deployment_status]?? 'default';
                return '<span class="label label-'.$label.'">'.str_replace('_', ' ', $c->deployment_status).'</span>';
            })
            ->editColumn('departure_date', fn($c) => $c->departure_date? $c->departure_date->format('Y-m-d') : '-')
            ->editColumn('arrival_date', fn($c) => $c->arrival_date? $c->arrival_date->format('Y-m-d') : '-')
            ->rawColumns(['deployment_status'])
            ->make(true);
    }

    public function deploymentSummary(Request $request)
    {
        $query = Candidate::query()
            ->when($request->from, fn($q) => $q->whereDate('departure_date', '>=', $request->from))
            ->when($request->to, fn($q) => $q->whereDate('departure_date', '<=', $request->to));

        $summary = [
            'total' => $query->where('deployment_status', '!=', 'not_scheduled')->count(),
            'scheduled' => $query->where('deployment_status', 'scheduled')->count(),
            'departed' => $query->where('deployment_status', 'departed')->count(),
            'arrived' => $query->where('deployment_status', 'arrived')->count(),
            'cancelled' => $query->where('deployment_status', 'cancelled')->count(),
        ];

        // Group by destination for chart
        $byDestination = $query->where('deployment_status', '!=', 'not_scheduled')
            ->select('destination', DB::raw('count(*) as total'))
            ->groupBy('destination')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Group by month for trend chart
        $byMonth = $query->where('deployment_status', 'arrived')
            ->select(DB::raw('DATE_FORMAT(arrival_date, "%Y-%m") as month'), DB::raw('count(*) as total'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return response()->json([
            'summary' => $summary,
            'by_destination' => $byDestination,
            'by_month' => $byMonth
        ]);
    }
    
    public function revenue()
{
    return view('report.revenue');
}

public function revenueData(Request $request)
{
    $query = \App\Models\Payment::with('candidate')
        ->when($request->status, fn($q) => $q->where('status', $request->status))
        ->when($request->type, fn($q) => $q->where('type', $request->type))
        ->when($request->from, fn($q) => $q->whereDate('payment_date', '>=', $request->from))
        ->when($request->to, fn($q) => $q->whereDate('payment_date', '<=', $request->to));

    return datatables()
        ->of($query)
        ->addIndexColumn()
        ->addColumn('candidate_name', fn($p) => $p->candidate->full_name?? '-')
        ->addColumn('status', function($p){
            $labels = ['pending'=>'warning', 'paid'=>'success', 'failed'=>'danger', 'refunded'=>'info'];
            return '<span class="label label-'.$labels[$p->status].'">'.$p->status.'</span>';
        })
        ->editColumn('amount', fn($p) => '$'.number_format($p->amount, 2))
        ->editColumn('payment_date', fn($p) => $p->payment_date? $p->payment_date->format('Y-m-d') : '-')
        ->rawColumns(['status'])
        ->make(true);
}

public function revenueSummary(Request $request)
{
    $query = \App\Models\Payment::query()
        ->when($request->from, fn($q) => $q->whereDate('payment_date', '>=', $request->from))
        ->when($request->to, fn($q) => $q->whereDate('payment_date', '<=', $request->to));

    $paid = $query->where('status', 'paid')->sum('amount');
    $pending = $query->where('status', 'pending')->sum('amount');
    $refunded = $query->where('status', 'refunded')->sum('amount');

    // Invoiced total
    $invoiced = \App\Models\Invoice::query()
        ->when($request->from, fn($q) => $q->whereDate('invoice_date', '>=', $request->from))
        ->when($request->to, fn($q) => $q->whereDate('invoice_date', '<=', $request->to))
        ->sum('total');

    // By payment type for chart
    $byType = $query->where('status', 'paid')
        ->select('type', DB::raw('sum(amount) as total'))
        ->groupBy('type')
        ->get();

    // Monthly trend for chart
    $byMonth = $query->where('status', 'paid')
        ->select(DB::raw('DATE_FORMAT(payment_date, "%Y-%m") as month'), DB::raw('sum(amount) as total'))
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

    return response()->json([
        'summary' => [
            'invoiced' => round($invoiced, 2),
            'collected' => round($paid, 2),
            'pending' => round($pending, 2),
            'refunded' => round($refunded, 2),
            'collection_rate' => $invoiced > 0? round(($paid / $invoiced) * 100, 1) : 0
        ],
        'by_type' => $byType,
        'by_month' => $byMonth
    ]);
}

}