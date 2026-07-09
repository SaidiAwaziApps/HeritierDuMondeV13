<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

use App\Services\NavigationService;

use App\Services\DashboardService;

use App\Jobs\SendResetCodeMailJob;

use App\Models\User;


class AuthenticationController extends Controller
{
    /* *****************************************************************
     * VERIFIE LA CREDIBILITE D' UN DASHBAORD
     * ****************************************************************/
    private function credibleToDashboard(): bool
    {
        return DashboardService::isCredible();        
    }


    /* *****************************************************************
     * DECRYPT UN CARACTERE CRYPTE AVEC Crypt::encryptString
     * ****************************************************************/
    private function decrypt($string) {
        try {
            return Crypt::decryptString($string);
        }
        catch(DecryptException $e) {
            die($e->getMessage());
        }
    }


    /* *****************************************************************
     * RENVOIE LA PAGE (VIEW) LOGIN (CONNEXTION)
     * ****************************************************************/
    public function loginPage()
    {
        return view('pages.auth.login');
    }

    /* *****************************************************************
     * RENVOIE LA PAGE (VIEW) UPDATE PASSWORD
     * ****************************************************************/
    public function resetEmailPage() {
        return view('pages.auth.reset_email');
    }

    /* *****************************************************************
     * RENVOIE LA PAGE (VIEW) CODE DE REINITIALIZATION
     * ****************************************************************/
    public function resetCodePage($reset_email, $send_code) {
        // Renvoie a la page reset_code avec de donnees reset_email && send_code cryptees
        return view('pages.auth.reset_code', [
            'reset_email' => $reset_email,
            'send_code' => $send_code
        ]);
    }

    /* *****************************************************************
     * RENVOIE LA PAGE (VIEW) RESET PASSWORD (MOT DE PASSE OUBLIE)
     * ****************************************************************/
    public function resetPasswordPage($reset_email)
    {
        // Renvoie a la page reset_password avec reset_email crypte
        return view('pages.auth.reset_password', [
            'reset_email' => $reset_email
        ]);
    }

    /* *****************************************************************
     * RENVOIE LA PAGE (VIEW) ADMINPROFILVIEW
     * ****************************************************************/
    public function adminProfilPage()
    {
        return view('pages.auth.admin_profil');
    }

    /* *****************************************************************
     * RENVOIE LA PAGE (VIEW) UPDATE PASSWORD
     * ****************************************************************/
    public function updatePasswordPage()
    {
        return view('pages.auth.update_password');
    }



    /* *****************************************************************
     * TRAITE LE PROCESSUS DE CONNECTION (LOGIN)
     * ****************************************************************/
    public function loginHandler(Request $request)
    {
        // Validation du formualire
        $request->validate([
            'username' => ['required'],
            'password' => ['required', 'min:4', 'max:20']
        ]);

        // Utilisateur a authentifier
        $user = User::where('username', $request->username) 
                    ->where('status', true)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors([
                'failed_connection' => 'Username ou Password incorrect !!!'
            ])->withInput();
        }

        // Authentifie (connecte) l' utilisateur
        Auth::login($user);

        // Redirection page avec restriction
        return $user->hasRole('admin') && $this->credibleToDashboard()
            ? redirect()->route('admin.dashboard.admin')
            : redirect()->route('admin.home.admin');
    }

    /* *****************************************************************
     * TRAITEMENT EMAIL REINITIALIZATION(MOT DE PASSE OUBLIE)
     * ****************************************************************/
    public function resetEmailHandler(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        $user = User::where('email', $request->email)
                    ->where('status', true)
                    ->first();

        // Utilisateur non trouve renvoie page de provenanve avec message d' erreurs            
        if (!$user) {
            return redirect()->back()->withErrors(['bad_email' => 'Email incorrect !!!'])->withInput();
        }

        // Code reinitialization
        $reset_code = rand(100000, 999999);

        // Envoie code reinitialization via email
        SendResetCodeMailJob::dispatch($user->email, $reset_code);

        // Redirection vers la page reset_code
        return redirect()->route('authentication.reset_code_page', [
            'reset_email' => Crypt::encryptString($user->email),
            'send_code' => Crypt::encryptString($reset_code)
        ]);   
       
    }

    /* *****************************************************************
     * TRAITEMENT CODE REINITIALIZATION(MOT DE PASSE OUBLIE)
     * ****************************************************************/
    public function resetCodeHandler(Request $request)
    {
        $request->validate([
            'reset_email' => ['required'],
            'send_code' => ['required'],
            'reset_code' => ['required']
        ]);

        // Decriptage du code
        $send_code = $this->decrypt($request->send_code);

        // Condition d' equivalence entre code renvoye via email a celle contenu dans le corps de la requette
        if ($send_code != $request->reset_code) {
            return redirect()->back()->withErrors([
                'bad_reset_code' => 'Code reinitialization incorrect !!!'
            ]);
        }

        // Redirige vers la page reset_password
        return redirect()->route('authentication.reset_password_page', [
            'reset_email' => $request->reset_email
        ]);
    }


    /* *****************************************************************
     * TRAITEMENT MOT DE PASSE REINITIALIZATION(MOT DE PASSE OUBLIE)
     * ****************************************************************/
    public function resetPasswordHandler(Request $request)
    {
        // Validation du formulaire
        $request->validate([
            'new_password' => ['required', 'min:4', 'max:20'],
            'confirm_password' => ['required', 'min:4', 'max:20']
        ]);

        // Non equivalence entre les deux mot de passe (nouveau && confirmation)
        if ($request->new_password != $request->confirm_password) {
            return redirect()->back()->withErrors([
                'non_equivaut_passwords' => 'Les deux mots de passe ne sont pas identiques !!!'
            ])->withInput();
        }

        // Utilisateur a modifier (mot de passe)
        $user = User::where('email', $this->decrypt($request->reset_email))
                    ->where('status', true)
                    ->firstOrFail();

        // Application de la moditication
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        // Connecte l' utilisateur
        Auth::login($user);

        // Redirection vers la page via une contition
        return $user->hasRole('admin') && $this->credibleToDashboard()
            ? redirect()->route('admin.dashboard.admin')
            : redirect()->route('admin.home.admin');
    }


    /* *****************************************************************
     * TRAITEMENT MODIFICATION MOT DE PASSE (UPDATE PASSWORD)
     * ****************************************************************/
    public function updatePasswordHandler(Request $request)
    {
        // Valitation du formulaire
        $request->validate([
            'old_password' => ['required', 'min:4', 'max:20'],
            'new_password' => ['required', 'min:4', 'max:20'],
            'confirm_password' => ['required', 'min:4', 'max:20']
        ]);

        // Utilisateur a modifier (connecte)
        $user = Auth::user();

        // Decriptage du mot de passe
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors([
                'wrong_old_password' => 'Ancien mot de passe incorrect !!!'
            ])->withInput();
        }

        // Authenticite entre les deux mot de passe (nouveau et confirmation)
        if ($request->new_password != $request->confirm_password) {
            return redirect()->back()->withErrors([
                'not_confirmed_password' => 'Les deux mots de passe(nouveau & confirm) non identiques !!!'
            ])->withInput();
        }

        // Applique la modification
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        // Redirige vers la page de provenance avec message de success
        return redirect()->back(NavigationService::getBackPageURL())->with('success', 'Mot de passe mis à jour avec succès !');
    }
}