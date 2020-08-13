<?php

namespace App\Domain\Users\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class Recaptcha implements Rule
{
    const URL = 'https://www.google.com/recaptcha/api/siteverify';

    private $client;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client();
    }

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
        $options  = [
            'form_params' => [
                'secret'   => config('services.recaptcha.secret'),
                'response' => $value,
                'remoteip' => request()->ip()
            ]
        ];
        $response = $this->client->post(static::URL, $options);
        return $response->getBody()['success'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'داده های ارسالی اشتباه است. لطفا دوباره تلاش کنید';
    }

    /**
     * Determine if Recaptcha's keys are set to test mode.
     *
     * @return bool
     */
    public static function isInTestMode()
    {
        $client = new Client();
        $options  = [
            'form_params' => [
                'secret'   => config('services.recaptcha.secret'),
                'response' => 'test',
                'remoteip' => request()->ip()
            ]
        ];
        $response = $client->post(static::URL, $options);
        return $response->getBody()['success'];
    }
}
