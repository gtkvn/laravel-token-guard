<?php

namespace Gtk\LaravelTokenGuard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Auth\TokenGuard as BaseTokenGuard;

class TokenGuard extends BaseTokenGuard
{
    /**
     * The encrypter implementation.
     *
     * @var Encrypter
     */
    protected $encrypter;

    /**
     * Create a new authentication guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Encryption\Encrypter  $encrypter
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request, Encrypter $encrypter)
    {
        parent::__construct($provider, $request);

        $this->encrypter = $encrypter;
    }

    /**
     * Get the token for the current request.
     *
     * @return string
     */
    public function getTokenForRequest()
    {
        $token = $this->getTokenViaCookie();

        return $token ?: parent::getTokenForRequest();
    }

    /**
     * Get token via the incoming request cookie.
     *
     * @return mixed
     */
    protected function getTokenViaCookie()
    {
        // If we need to retrieve the token from the cookie, it'll be encrypted so we must
        // first decrypt the cookie and then attempt to find the token value within the
        // database. If we can't decrypt the value we'll bail out with a null return.
        try {
            $token = $this->encrypter->decrypt(
                $this->request->cookie($this->inputKey)
            );
        } catch (Exception $e) {
            return;
        }

        return $token;
    }
}
