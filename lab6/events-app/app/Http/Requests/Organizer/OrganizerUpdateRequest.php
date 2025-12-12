<?php

namespace App\Http\Requests\Organizer;

use Illuminate\Foundation\Http\FormRequest;

class OrganizerUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // За update мораме да игнорираме тековниот запис при уникатност
        $organizerId = $this->route('organizer')->id;

        return [
            'full_name' => 'required|string|max:255',
            'email' => "required|email|unique:organizers,email,$organizerId",
            'phone' => "required|string|max:20|unique:organizers,phone,$organizerId",
        ];
    }
}
