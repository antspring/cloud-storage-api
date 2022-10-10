<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ExtensionFileRule implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value): bool
    {
        return $value->getMimeType() !== 'text/x-php';
    }

    public function message(): string
    {
        return 'The :attribute extension must not be .php';
    }
}
