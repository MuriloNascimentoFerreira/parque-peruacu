<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\MagicLoginRequest;
use App\Mail\MagicLoginLink;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class MagicAuthenticatedSessionController extends Controller
{
    /**
     * Retorna view de login para visitante.
     */
    public function create(): View
    {
        return view('auth.magic-login');
    }

    /**
     * Enviar link de autenticação por email
     */
    public function store(MagicLoginRequest $request): RedirectResponse
    {
        Mail::to(
            $request->email
        )->send(
            new MagicLoginLink(
                url: URL::temporarySignedRoute(
                    name: 'magic-login-auth',
                    expiration: '3600',
                    parameters: [
                        'email' => $request->email
                    ]
                )
            )
        );

        return redirect()->back()->with('success','Link de autenticação enviado!');
    }

    /**
     * Rota que faz altenticação do link enviado por email e da acesso ao usuário.
     *
     * @param Request $request
     * @param string $email
     * @return void
     */
    public function authenticate(Request $request, string $email){
        if (! $request->hasValidSignature()){
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $user = User::query()->where('email', $email)->firstOrFail();

        Auth::login($user);

        return new RedirectResponse(
            url: route('dashboard')
        );

    }

}
