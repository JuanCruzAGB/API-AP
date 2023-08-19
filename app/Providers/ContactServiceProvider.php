<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * * Register services.
     * @return void
     */
    public function register(): void
    {
        $this->app
            ->singleton(ContactServiceProvider::class, function ($app) {
                return new ContactServiceProvider($app);
            });

        $contactService = $this->app
            ->make(ContactServiceProvider::class);

        view()
            ->share('contact', $contactService->getData());
    }

    /**
     * * Returns the Contact data.
     * @return array
     */
    public function getData(): array
    {
        return [
            'address' => "Pedro N. Carrera 961",
            'email' => "jmarmentia2010@hotmail.com",
            'developer' => "juan.cruz.armentia@gmail.com",
            'phone' => "5492983649476",
        ];
    }
}