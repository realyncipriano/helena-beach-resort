<?php

namespace App\Http\Requests\Portal;

use Illuminate\Foundation\Http\FormRequest;

class BookingLookupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Trim both identifiers before validation so pasted values with stray
     * whitespace still match. Case normalization happens in the lookup query;
     * emails are stored exactly as the guest typed them at booking time.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => is_string($this->email) ? trim($this->email) : $this->email,
            'reference_code' => is_string($this->reference_code) ? trim($this->reference_code) : $this->reference_code,
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'reference_code' => 'required|string',
        ];
    }
}
