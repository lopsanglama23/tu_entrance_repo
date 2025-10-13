<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DevText implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_null($value) || trim($value) === '') {
        return;
    }
    if (!preg_match('/^[\p{Devanagari}\s]+$/u', $value)) {
        $fail("The {$attribute} must contain only Devanagari characters.");
    }
    }
}
