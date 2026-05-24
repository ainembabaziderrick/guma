<?php

namespace App\Http\ViewComposers;

class VisaComposer
{
    public function compose($view)  // no type hint
    {
        $visaStatuses = ['pending', 'processing', 'approved', 'rejected'];
        $view->with('visaStatuses', $visaStatuses);
    }
}