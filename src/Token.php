<?php

namespace Gtk\LaravelTokenGuard;

class Token
{
    /**
     * The name for API token cookies.
     *
     * @var string
     */
    public static $cookieName = 'api_token';

    /**
     * The name of the token "column" in persistent storage.
     *
     * @var string
     */
    public static $storageKey = 'api_token';
}
