<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class DateInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date_format:d-m-Y',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'The date field is required.',
            'date.date_format' => 'The date field must be in the format d-m-Y.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }
}
