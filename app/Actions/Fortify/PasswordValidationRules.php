<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return ['required', 'string', new Password, 'min:8',
        'regex:/^.*(?=.{1,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/','confirmed'];
    }
}
