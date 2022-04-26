<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class dateDebFinRule implements Rule
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
     * @param  mixed  $date_deb
     
     * @return bool
     */
    public function passes($attribute, $date_deb)
    {
        return($_REQUEST[$attribute] > $date_deb);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La date de fin doit être ultérieure à la date de début ';
    }
}