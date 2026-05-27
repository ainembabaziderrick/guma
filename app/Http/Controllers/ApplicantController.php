<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;

class ApplicantController extends Controller
{
    // Show profile
    public function profile()
    {
        $user = auth()->user();
        
        // Get candidate record if exists, otherwise create empty instance
        $candidate = Candidate::where('user_id', $user->id)->first();
        
        return view('applicant.profile', compact('user', 'candidate'));
    }

    // Update profile
    public function updateProfile(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'region' => 'nullable|string|max:100',
        'district' => 'nullable|string|max:100',
        'county' => 'nullable|string|max:100',
        'subcounty' => 'nullable|string|max:100',
        'village' => 'nullable|string|max:100',
        'dob' => 'nullable|date',
    ]);

    // Only update/insert into candidates table
    Candidate::updateOrCreate(
        ['user_id' => $user->id],
        [
            'user_id'   => $user->id,
            'full_name'      => $validated['name'],   // from form, but originally from users
            'email'     => $user->email,         // pick from users table
            'phone'     => $validated['phone'],
            'region'    => $validated['region'],
            'district'  => $validated['district'],
            'county'    => $validated['county'],
            'subcounty' => $validated['subcounty'],
            'village'   => $validated['village'],
            'dob'       => $validated['dob'],
        ]
    );

    return back()->with('success', 'Profile updated successfully');
}

    public function availableJobs()
    {
        $jobs = \App\Models\JobOrder::where('status', 'open')->latest()->get();
        return view('applicant.jobs', compact('jobs'));
    }    

public function documents()
{
    $candidate = Candidate::where('user_id', auth()->id())->first();

    if (!$candidate) {
        return redirect()->route('applicant.profile')
            ->with('info', 'Complete your profile first before uploading documents');
    }

    $documents = Document::where('candidate_id', $candidate->id)->latest()->get();

    return view('applicant.documents', compact('candidate', 'documents'));
}

public function uploadDocument(Request $request)
{
    $candidate = Candidate::where('user_id', auth()->id())->firstOrFail();

    $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|in:passport,cv,certificate,police_clearance,visa,medical_exam,other',
        'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
    ]);

    $path = $request->file('document')->store('documents/' . $candidate->id, 'public');

    // Save to documents table
    Document::create([
        'candidate_id' => $candidate->id,
        'title' => $request->title,
        'type' => $request->type,
        'file_path' => $path,
    ]);

    // If it's a medical exam, update the candidate record so it reflects in MedicalController
    if ($request->type === 'medical_exam') {
        $candidate->update([
            'medical_status' => $candidate->medical_status === 'passed' || $candidate->medical_status === 'failed' 
                                ? $candidate->medical_status 
                                : 'scheduled',
            'medical_date' => $candidate->medical_date ?? now()->toDateString(),
        ]);
    }

    // Do same for police and visa if you want
    if ($request->type === 'police_clearance') {
        $candidate->update(['police_status' => $candidate->police_status ?? 'submitted']);
    }

    if ($request->type === 'visa') {
        $candidate->update(['visa_status' => $candidate->visa_status ?? 'submitted']);
    }

    return back()->with('success', 'Document uploaded successfully');
}

public function downloadDocument($id)
{
    $document = Document::where('candidate_id', Candidate::where('user_id', auth()->id())->value('id'))
                        ->findOrFail($id);

    return Storage::download('public/' . $document->file_path);
}
}