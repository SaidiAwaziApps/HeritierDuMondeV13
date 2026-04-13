<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

use App\Jobs\SendResetCodeEmailJob;

use App\Models\Payment;
use App\Models\User;
use App\Models\Evenement;
use App\Models\Don;
use App\Models\OffreEmploie;


class AuthenticationController extends Controller
{
    private function credibleToDashboard(): bool
    {
        return Evenement::where('status', true)->exists()
            && Don::where('status', true)->exists()
            && OffreEmploie::where('status', true)->exists();
    }

    public function login_page()
    {
        return view('pages.auth.login');
    }

    public function reset_email_page()
    {
        return view('pages.auth.reset_email');
    }

    public function reset_code_page($reset_email, $send_code)
    {
        return view('pages.auth.reset_code', [
            'reset_email' => $reset_email,
            'send_code' => $send_code
        ]);
    }

    public function reset_password_page($reset_email)
    {
        return view('pages.auth.reset_password', [
            'reset_email' => $reset_email
        ]);
    }

    public function admin_profil_page()
    {
        return view('pages.auth.admin_profil');
    }

    public function update_password_page()
    {
        return view('pages.auth.update_password');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required', 'min:4', 'max:20']
        ]);

        $user = User::where('username', $request->username) 
                    ->where('status', true)
                    ->first();


        try {
            if (!$user || !(crypt::decryptString($user->password) == $request->password)) {
                return redirect()->back()->withErrors([
                    'failed_connection' => 'Username ou Password incorrect !!!'
                ])->withInput();
            }
        }                 
        catch(DecryptException $e) {
            die($e->getMessage());
        }

        

        Auth::login($user);

        return $user->hasRole('admin') && $this->credibleToDashboard()
            ? redirect()->route('dashboard.admin')
            : redirect()->route('home.admin');
    }


    public function reset_email(Request $request)
    {
        // $request->validate(['email' => ['required', 'email']]);

        $user = User::where('email', $request->email)
                    ->where('status', true)
                    ->first();

        if (!$user) {
            return redirect()->back()->withErrors(['bad_email' => 'Email incorrect !!!'])->withInput();
        }

        $reset_code = rand(100000, 999999);
        SendResetCodeEmailJob::dispatch($user->email, $reset_code);

        return redirect()->route('auth.reset_code_page', [
            'reset_email' => encrypt($user->email),
            'send_code' => encrypt($reset_code)
        ]);
    }

    public function reset_code(Request $request)
    {
        $request->validate([
            'reset_email' => ['required'],
            'send_code' => ['required'],
            'reset_code' => ['required']
        ]);

        $send_code = decrypt($request->send_code);

        if ($send_code != $request->reset_code) {
            return redirect()->back()->withErrors([
                'bad_reset_code' => 'Code reinitialization incorrect !!!'
            ]);
        }

        return redirect()->route('auth.reset_password_page', [
            'reset_email' => $request->reset_email
        ]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'min:4', 'max:20'],
            'confirm_password' => ['required', 'min:4', 'max:20']
        ]);

        if ($request->new_password != $request->confirm_password) {
            return redirect()->back()->withErrors([
                'non_equivaut_passwords' => 'Les deux mots de passe ne sont pas identiques !!!'
            ])->withInput();
        }

        $user = User::where('email', decrypt($request->reset_email))
                    ->where('status', true)
                    ->firstOrFail();

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        Auth::login($user);

        return $user->hasRole('admin') && $this->credibleToDashboard()
            ? redirect()->route('dashboard.admin')
            : redirect()->route('home.admin');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'min:4', 'max:20'],
            'new_password' => ['required', 'min:4', 'max:20'],
            'confirm_password' => ['required', 'min:4', 'max:20']
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors([
                'wrong_old_password' => 'Ancien mot de passe incorrect !!!'
            ])->withInput();
        }

        if ($request->new_password != $request->confirm_password) {
            return redirect()->back()->withErrors([
                'not_confirmed_password' => 'Les deux mots de passe(nouveau & confirm) non identiques !!!'
            ])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès !');
    }
}