<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DonationSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO We can use this to setup user permissions
        return true;
    }

    /**
     * Prepare incoming data for validation
     */
    protected function prepareForValidation(): void
    {
        // Standardize casing for currency usd => USD
        if ($this->has('currency')) {
            $this->merge([
                'currency' => strtoupper($this->currency)
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'min:7', 'max:20'],
            // TODO: Will support more currencies in the future USD for now. 
            'currency' => ['required', 'string', 'uppercase', 'size:3', Rule::in(['USD'])]
        ];
    }
}
