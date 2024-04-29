<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;


class TaskCompletionTimeRequest extends FormRequest
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
            'start_datetime' => 'required|date_format:Y-m-d H:i:s',
            'duration_minutes' => 'required|integer|min:1',
            'workday_only' => 'required|boolean',
            'work_start_time' => 'required|date_format:H:i:s',
            'work_end_time' => 'required|date_format:H:i:s',
        ];
    }

    public function messages(): array
    {
        return [
            'start_datetime.required' => 'The start_datetime field is required.',
            'start_datetime.date_format' => 'The start_datetime field must be in the format Y-m-d H:i:s.',
            'duration_minutes.required' => 'The duration field is required.',
            'duration_minutes.integer' => 'The duration field must be an integer.',
            'duration_minutes.min' => 'The duration field must be at least 1.',
            'workday_only.required' => 'The workday_only field is required.',
            'workday_only.boolean' => 'The workday_only field must be a boolean.',
            'work_start_time.required' => 'The work_start_time field is required.',
            'work_start_time.date_format' => 'The work_start_time field must be in the format H:i:s',
            'work_end_time.required' => 'The work_end_time field is required.',
            'work_end_time.date_format' => 'The work_end_time field must be in the format H:i:s',
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
