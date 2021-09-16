<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Alpha_spaces implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // This will only accept alpha and spaces.
        // If you want to accept hyphens use: /^[\pL\s-]+$/u.
        return preg_match('/^[\pL\s]+$/u', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute can only contain alphabet and spaces.';
    }
}
