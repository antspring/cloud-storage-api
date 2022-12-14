<?php

namespace App\Http\Requests;

use App\Rules\ExtensionFileRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateFileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'folder_name' => 'nullable|alpha_dash',
            'file' => ['required', 'max:20480', new ExtensionFileRule],
            'expiration_date' => 'nullable|date_format:Y-m-d'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
