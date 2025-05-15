<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Enums\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view and vizualize users.
     *
     */
    public function index(): View
    {
        $entities = User::query()->where('profile', Profile::USER_FUNCIONARIO )->get();
        return view('auth.register')->with('entities', $entities);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile' => Profile::USER_FUNCIONARIO
            ]);

            event(new Registered($user));
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('register.index')->with('error', 'Erro ao criar um usuário!');
        }
        return redirect()->route('register.index')->with('success', 'Novo usuário criado com sucesso!');
    }
}
