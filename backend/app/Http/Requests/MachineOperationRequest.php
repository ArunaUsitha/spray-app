<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed $operation_date
 */
class MachineOperationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'machine_id' => 'required|exists:machines,id',
            'user_id' => 'required|exists:users,id',
            'operation_hours' => [
                'required',
                'numeric',
                Rule::unique('machine_operations')->where(function ($query) {
                    return $query->where('operation_hours', request('operation_hours'))->where(
                        'machine_id', request('machine_id')
                    );
                }),
            ],
            'operation_date' => 'required|date_format:Y-m-d H:i:s',
        ];
    }

    /**
     * Parse data format for validation
     * @return void
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('operation_date')) {
            $this->merge([
                'operation_date' => Carbon::parse($this->operation_date)->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
