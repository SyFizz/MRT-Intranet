<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255|regex:/^[a-zA-ZéèêëàâäôöûüïîçÉÈÊËÀÂÄÔÖÛÜÏÎÇ\s]+$/',
            'email' => 'required|email',
            'address' => 'required|min:3|max:255|regex:/^[a-zA-Z0-9éèêëàâäôöûüïîçÉÈÊËÀÂÄÔÖÛÜÏÎÇ\'\-,\s]+$/',
            'phone' => 'required|phone:FR,INTERNATIONAL',
            'vat_number' => 'nullable|min:13|max:13|regex:/^[a-zA-Z]{2}[0-9]{11}$/',
            'siret' => 'nullable|min:14|max:14|regex:/^[0-9]{14}$/',
            'legal_status' => 'required|min:2|max:255|regex:/^[a-zA-ZéèêëàâäôöûüïîçÉÈÊËÀÂÄÔÖÛÜÏÎÇ\s]+$/',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Le nom est requis',
            'name.min' => 'Le nom doit contenir au moins 3 caractères',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'name.regex' => 'Le nom ne doit contenir que des caractères alphanumériques',
            'email.required' => 'L\'adresse email est requise',
            'email.email' => 'L\'adresse email doit être une adresse e-mail valide',
            'address.required' => 'L\'adresse est requise',
            'address.min' => 'L\'adresse doit contenir au moins 3 caractères',
            'address.max' => 'L\'adresse ne doit pas dépasser 255 caractères',
            'address.regex' => 'L\'adresse ne doit contenir que des caractères alphanumériques',
            'phone.required' => 'Le numéro de téléphone est requis',
            'phone.phone' => 'Le numéro de téléphone doit être un numéro de téléphone valide',
            'vat_number.min' => 'Le numéro de TVA doit contenir 13 caractères',
            'vat_number.max' => 'Le numéro de TVA doit contenir 13 caractères',
            'vat_number.regex' => 'Le numéro de TVA doit être composé de 2 lettres et 11 chiffres',
            'siret.min' => 'Le numéro de SIRET doit contenir 14 caractères',
            'siret.max' => 'Le numéro de SIRET doit contenir 14 caractères',
            'siret.regex' => 'Le numéro de SIRET doit être composé de 14 chiffres',
            'legal_status.required' => 'Le statut juridique est requis',
            'legal_status.min' => 'Le statut juridique doit contenir au moins 2 caractères',
            'legal_status.max' => 'Le statut juridique ne doit pas dépasser 255 caractères',
            'legal_status.regex' => 'Le statut juridique ne doit contenir que des caractères alphanumériques',
        ];
    }
}
