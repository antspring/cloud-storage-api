<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'folder_name' => 'required|alpha_dash'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
