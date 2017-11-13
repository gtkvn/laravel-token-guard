# Laravel Token Guard

Extends default Laravel token guard to retrieve users from cookies and consume your own API from your JavaScript application.

## Installation

To get started, you should add the gtk/laravel-token-guard Composer dependency to your project:

    composer require gtk/laravel-token-guard

Once Laravel Token Guard is installed, you should register the `Gtk\LaravelTokenGuard\ServiceProvider` service provider. Typically, this will be done automatically via Laravel's automatic service provider registration.

## Getting Started

Typically, if you want to consume your API from your JavaScript application, you would need to manually send an access token to the application and pass it with each request to your application. However, Laravel Token Guard includes a middleware that can handle this for you like the way [Laravel Passport](https://github.com/laravel/passport) do. All you need to do is add the `CreateFreshApiToken` middleware to your web middleware group:

    'web' => [
        // Other middleware...
        \Gtk\LaravelTokenGuard\CreateFreshApiToken::class,
    ],

This middleware will attach a `api_token` cookie to your outgoing responses. This cookie contains a token will use to authenticate API requests from your JavaScript application like the default Laravel Token Guard. Now, you may make requests to your application's API without explicitly passing an access token:

    axios.get('/api/user')
        .then(response => {
            console.log(response.data);
        });

## License

Laravel Token Guard is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
