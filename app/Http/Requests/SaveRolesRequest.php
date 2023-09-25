<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRolesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
                'display_name' => 'required',
        ];

        if($this->method() !== 'PUT')
        {
            $rules['name'] = 'required|unique:roles';
        }
        return $rules;
    }
    public function messages(): array
    {
        return [
            'display_name.required' => 'El nombre del role es obligatorio',
            'name.unique' => 'Este Identificador ya ha sido registrado',
            'name.required' => 'El identificador del role es obligatorio'
        ];
    }
}
