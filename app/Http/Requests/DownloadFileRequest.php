<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DownloadFileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'folder_name' => 'nullable|alpha_dash',
            'file_name' => 'required|exists:files,name'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
