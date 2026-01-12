<?php

namespace App\Http\Requests;

use App\Enums\YachtType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class YachtRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::enum(YachtType::class)],
            'capacity' => ['required', 'integer', 'min:1'],
            'hourly_rate' => ['required', 'integer', 'min:1'],
        ];
    }
}
