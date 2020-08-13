<?php

namespace App\Domain\Users\Rules;

use Illuminate\Contracts\Validation\Rule;

class IranMobile implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (
            (bool)preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $value) ||
            (bool)preg_match('/^(09){1}[0-9]{9}+$/', $value)
        )
            return true;

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.iran_mobile');
    }
}
