<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MachineOperationsResetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'machine_id' => 'required|integer|exists:machines,id',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
