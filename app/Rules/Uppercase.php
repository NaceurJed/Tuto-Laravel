<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
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
        return strtoupper($value) === $value; // on veut que ça soit strictement egale (donc en majuscule) pour retourné true
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'le champ :attribute doit être en MAJUSCULE';
    }
}
