<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'type' => 'required|in:seminar,workshop,lecture',
            'organizer_id' => 'required|exists:organizers,id',
            'date' => 'required|date|after_or_equal:today',
        ];
    }
}

