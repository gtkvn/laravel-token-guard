<?php

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Gtk\LaravelTokenGuard\TokenGuard;

class TokenGuardTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function test_users_may_be_retrieved_from_cookies()
    {
        $userProvider = Mockery::mock('Illuminate\Contracts\Auth\UserProvider');
        $encrypter = new Illuminate\Encryption\Encrypter(str_repeat('a', 16));
        $request = Request::create('/');
        $request->headers->set('X-CSRF-TOKEN', 'token');
        $request->cookies->set('api_token',
            $encrypter->encrypt('api-token', str_repeat('a', 16))
        );
        $guard = new TokenGuard($userProvider, $request, $encrypter);
        $userProvider->shouldReceive('retrieveByCredentials')->andReturn($expectedUser = new TokenGuardTestUser);
        $user = $guard->user($request);
        $this->assertEquals($expectedUser, $user);
    }
}

class TokenGuardTestUser
{
    //
}
