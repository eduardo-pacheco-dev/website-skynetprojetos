<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:30'],
            'service_interest' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'website' => ['prohibited'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Informe seu nome.',
            'email.required' => 'Informe seu e-mail corporativo.',
            'email.email' => 'Informe um e-mail válido.',
            'service_interest.required' => 'Selecione o serviço de interesse.',
            'message.required' => 'Descreva sua demanda.',
            'message.min' => 'A descrição deve ter pelo menos :min caracteres.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'company' => 'empresa',
            'email' => 'e-mail',
            'phone' => 'telefone',
            'service_interest' => 'serviço de interesse',
            'message' => 'descrição da demanda',
        ];
    }
}
