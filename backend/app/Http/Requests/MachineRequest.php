<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MachineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $method = $this->method();

        return match ($method) {
            'PUT' => [
                'name' => 'string',
                'model' => 'string',
                'brand' => 'string',
                'purchase_date' => 'date',
                'purchase_price' => 'numeric',
            ],
            default => [
                'name' => 'required|string',
                'model' => 'required|string',
                'brand' => 'required|string',
                'purchase_date' => 'required|date',
                'purchase_price' => 'required|numeric',],
        };

    }
}
