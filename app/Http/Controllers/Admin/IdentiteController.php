<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Jobs\GeolocateIdentityAdresseJob;

use App\Services\NavigationService;
use App\Services\ImageService;

use App\Models\Identite;
use App\Models\Sociaux;
use App\Models\User;

class IdentiteController extends Controller
{
    /* *******************************************************************
     * RENVOIE A LA PAGE ENREGISTREMENT (REGISTER)
     * *******************************************************************/
    public function register_page(): View
    {
        return view('pages.admin.identite.register');
    }

    /* *******************************************************************
     * RENVOIE A LA PAGE MODIFICATION (UPDATE)
     * *******************************************************************/
    public function update_page(int $id): View
    {
        return view('pages.admin.identite.update');
    }


    /* *******************************************************************
     * ENREGISTRE UNE INSTANCE DANS LA B.D (SAVE)
     * *******************************************************************/
    public function save(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom'     => ['required', 'string'],
            'slogant' => ['nullable', 'string'],
            'tel'     => ['nullable', 'string'],
            'email'   => ['nullable', 'email'],
            'logo'    => ['nullable', 'image'],
        ]);

        $logo = 'logo/default_logo.png';

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('logo', 'public');
        }

        $identite = Identite::create([
            ...$validated,
            'logo' => $logo,
        ]);

        $identite->sociaux()->create([
            'facebook'  => $request->facebook,
            'twitter'   => $request->twitter,
            'google'    => $request->google,
            'instagram' => $request->instagram,
        ]);

        // Gestion images
        $this->handleImages($request, $identite);

        // Geolocalisation
        GeolocateIdentityAdresseJob::dispatch($identite);

        return redirect()->route('admin.user.list')
            ->with('success', 'Identité créée avec succès');
    }

    /* *******************************************************************
     * MODIFIE UNE INSTANCE DE LA B.D (UPDATE)
     * *******************************************************************/
    public function update_handler(int $id, Request $request)
    {
        $identite = Identite::findOrFail($id);

        $validated = $request->validate([
            'nom'         => ['required', 'string'],
            'slogant'     => ['required', 'string'],
            'tel'         => ['required', 'string'],
            'email'       => ['required', 'email'],
            'adresse'     => ['required', 'string'],
            'description' => ['required', 'string'],
            'logo'        => ['nullable', 'image'],
        ]);

        $logo = $identite->logo ?? 'logo/default_logo.png';

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('logo', 'public');
        }

        $identite->update([
            ...$validated,
            'logo' => $logo,
        ]);

        if ($identite->sociaux) {
            $identite->sociaux->update([
                'facebook'  => $request->facebook,
                'twitter'   => $request->twitter,
                'google'    => $request->google,
                'instagram' => $request->instagram,
            ]);
        }

        // Gesion Images
        $this->handleImages($request, $identite);
        
        // Geolocalisation
        GeolocateIdentityAdresseJob::dispatch($identite);

        // Retour a la page de provenance
        return redirect(NavigationService::getBackPageURL())
            ->with('success', 'Identité mise à jour');
    }

    /* *******************************************************************
     * GESTION IMAGES (TRAITE LES CAS IMAGES)
     * *******************************************************************/
    private function handleImages(Request $request, Identite $identite): void
    {
        $imageService = app(ImageService::class);

        if (
            ($request->hasFile('images') && count($request->file('images')) > 0) ||
            (!empty($request->iframes) && count($request->iframes) > 0)
        ) {
            $imageService->saveMany($request, $identite, 'identite');
        }

        if (
            (!empty($request->remove_uploads_id) && count($request->remove_uploads_id) > 0) ||
            (!empty($request->remove_vgns_id) && count($request->remove_vgns_id) > 0)
        ) {
            $imageService->deleteMany($request, $identite);
        }
    }
}