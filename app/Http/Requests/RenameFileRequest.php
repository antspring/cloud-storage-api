<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RenameFileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'folder_name' => 'nullable|alpha_dash',
            'file_name' => 'required|exists:files,name',
            'new_file_name' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
