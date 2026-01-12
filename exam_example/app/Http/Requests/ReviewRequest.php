<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reviewer_name' => ['required', 'string', 'max:255'],
            'text' => ['nullable', 'string'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'reservation_id' => ['required', 'exists:reservations,id,status,confirmed'],
        ];
    }
}
