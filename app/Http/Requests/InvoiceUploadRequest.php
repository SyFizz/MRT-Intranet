<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUploadRequest extends FormRequest
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
            'file' => 'required|file|mimes:pdf|max:2048',
            'filename' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Le fichier est requis',
            'file.file' => 'Le fichier doit être un fichier',
            'file.mimes' => 'Le fichier doit être un fichier PDF',
            'file.max' => 'Le fichier ne doit pas dépasser 2Mo',
            'filename.required' => 'Le nom du fichier est requis',
            'filename.string' => 'Le nom du fichier doit être composé de caractères alphanumériques',
            'filename.max' => 'Le nom du fichier ne doit pas dépasser 255 caractères',
        ];
    }
}
