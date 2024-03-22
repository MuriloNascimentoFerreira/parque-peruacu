<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\MagicLoginRequest;
use App\Mail\MagicLoginLink;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class MagicAuthenticatedSessionController extends Controller
{
    /**
     * Retorna tela de login
     */
    public function create(): View
    {
        return view('auth.magic-login');
    }

    /**
     * Retorna tela de login
     */
    public function store(MagicLoginRequest $request): RedirectResponse
    {
        Mail::to(
            $request->email
        )->send(
            new MagicLoginLink(
                url: URL::temporarySignedRoute(
                    name: 'magic-login-auth',
                    expiration: 3600,
                    parameters: [
                        'email' => $request->email
                    ]
                )
            )
        );
        return redirect()->back()->with('success', 'Link sended') ;
    }

    public function authenticate(Request $request, string $email) {
        if( ! $request->hasValidSignature()){
            abort(Response::HTTP_UNAUTHORIZED);
        }


        $user = User::query()->where('email', $email)->firstOrFail();

        Auth::login($user);

        return new RedirectResponse(
            url: route('home')
        );
    }

    /* criar autenticação com laravel breeze primeiro para implementar essa autenticação ?

    por causa do uso do tailwind css tela mais bonitinha

    https://www.youtube.com/watch?v=GEjRXTgmVVo&ab_channel=BeerandCode
    */

}
