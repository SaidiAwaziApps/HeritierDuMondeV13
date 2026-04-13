<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\NavigationService;
use App\Models\PaymentSetting;
use App\Models\Identite;

class PaymentSettingController extends Controller
{
    /* ********************************************
     * RENVOIE LA PAGE ENREGISTREMENT
     * ****************************************/
    public function register(): View {
        return view('pages.payment_setting.register');
    }

    /* *********************************************
    *  RENVOIE LA PAGE DE MODIFICATION (UPDATE)
    *  *********************************************/
    public function updatePage($id): View {
        // Instance a modifier
        $paymentSetting = PaymentSetting::where('id','=',$id)
                                        ->where('status','=',true)
                                        ->firstOrFail();        
  
        return view('pages.payment_setting.update',[
            'paymentSetting' => $paymentSetting
        ]);
    }

    /* ****************************************
     * ENREGISTRE UNE INSTANCE DANS LA BASE
     * ****************************************/
    public function save(Request $request): RedirectResponse {
        // Validation du formulaire
        $request->validate([
            'token' => ['required','string'],
            'currency' => ['required','string']
        ]);

        // Sécurité : vérifie existence identite
        $identite = Identite::getOne(1);

        if(!$identite) {
            return redirect(NavigationService::getBackPageURL());
        }

        // Creer une instance (enregistrement)
        PaymentSetting::create([
            'identite_id' => $identite->id,
            'token' => $request->token,
            'currency' => $request->currency
        ]);

        // Redirection vers la page d' origine
        return redirect(NavigationService::getBackPageURL());
        
    }

    /* ************************************************
    *  MODIFIE UNE INSTANCE DE LA BASE DE DONNEES
    *  ************************************************/
    public function update($id,Request $request): RedirectResponse {
        // Validation  du formualaire
        $request->validate([
            'token' => ['required','string'],
            'currency' => ['required','string']
        ]);

        // Instance a modifier
        $paymentSetting = PaymentSetting::where('id','=',$id)
                                        ->where('status','=',true)
                                        ->firstOrFail();

        // Applique la modification
        $paymentSetting->update([
            'token' => $request->token,
            'currency' => $request->currency
        ]);                               
        
        // Redirection vers la page d' origine
        return redirect(NavigationService::getBackPageURL());
    }
}