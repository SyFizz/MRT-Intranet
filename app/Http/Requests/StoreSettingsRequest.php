<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingsRequest extends FormRequest
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
        return [
            'app_name' => 'required|string|max:255',
            'maps_api_key' => 'nullable|string|min:39|max:39|regex:/^[A-Za-z0-9_-]+$/',
        ];
    }

    public function messages()
    {
        return [
            'app_name.required' => 'Le nom de l\'application est requis',
            'app_name.string' => 'Le nom de l\'application doit être une chaîne de caractères',
            'app_name.max' => 'Le nom de l\'application ne doit pas dépasser 255 caractères',
            'maps_api_key.string' => 'La clé API Google Maps doit faire 39 caractères alpha-numériques',
            'maps_api_key.min' => 'La clé API Google Maps doit faire 39 caractères alpha-numériques',
            'maps_api_key.max' => 'La clé API Google Maps doit faire 39 caractères alpha-numériques',
            'maps_api_key.regex' => 'La clé API Google Maps doit faire 39 caractères alpha-numériques',
        ];
    }
}
