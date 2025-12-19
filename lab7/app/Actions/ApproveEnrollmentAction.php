<?php

namespace App\Actions;

use App\Models\Enrollment;

class ApproveEnrollmentAction
{
    /**
     * Create a new class instance.
     */
    public function execute(Enrollment $enrollment)
    {
        abort_if($enrollment->status !== 'pending', 400);

        $enrollment->course->decrement(
            'seats',
            $enrollment->seats_requested
        );

        $enrollment->update(['status' => 'approved']);
    }
}
