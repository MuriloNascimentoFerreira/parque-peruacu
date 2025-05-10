<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Enums\Profile;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->profile === Profile::USER_ADMINISTRADOR ? true : false;
        });

        Gate::define('funcionario', function ($user) {
            return $user->profile === Profile::USER_FUNCIONARIO ? true : false;
        });

        Gate::define('visitante', function ($user) {
            return $user->profile === Profile::USER_VISITANTE ? true : false;
        });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                ->subject('Verificação de e-mail')
                ->line('Click no botão abaixo para verificar seu endereço de e-mail.')
                ->action('Verificar e-mail', $url)
                ->salutation(__('messages.salutation'));
        });
    }
}
