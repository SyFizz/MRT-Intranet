<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'passwordConfirm' => 'required|string|same:password',
            'isAdmin' => 'required|max:3|min:3|in:Oui,Non',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom est requis',
            'name.string' => 'Le nom doit être composé de caractères alphanumériques',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'email.required' => 'L\'adresse email est requise',
            'email.string' => 'L\'adresse email doit être composée de caractères alphanumériques',
            'email.email' => 'L\'adresse email doit être une adresse e-mail valide',
            'email.max' => 'L\'adresse email ne doit pas dépasser 255 caractères',
            'email.unique' => 'L\'adresse email est déjà utilisée',
            'password.required' => 'Le mot de passe est requis',
            'password.string' => 'Le mot de passe doit être composé de caractères alphanumériques',
            'password.min' => 'Le mot de passe doit faire au moins 8 caractères',
            'passwordConfirm.required' => 'La confirmation du mot de passe est requise',
            'passwordConfirm.string' => 'Le mot de passe doit être composé de caratères alphanumériques',
            'passwordConfirm.same' => 'Les mots de passe doivent être identiques',
            'isAdmin.required' => 'Vous devez préciser si l\'utilisateur est administrateur ou non',
            'isAdmin.max' => 'Vous devez préciser si l\'utilisateur est administrateur ou non',
            'isAdmin.min' => 'Vous devez préciser si l\'utilisateur est administrateur ou non',
            'isAdmin.in' => 'Vous devez préciser si l\'utilisateur est administrateur ou non',
        ];
    }
}
