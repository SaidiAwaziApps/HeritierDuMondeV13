<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\NavigationService;
use App\Services\ImageService;
use App\Models\Identite;
use App\Models\Sociaux;
use App\Models\User;

class IdentiteController extends Controller
{
    public function register(): View
    {
        return view('pages.identite.register');
    }

    public function update_page(int $id): View
    {
        return view('pages.identite.update', [
            'admin'    => User::findOrFail(1),
            'identite' => Identite::findOrFail($id),
        ]);
    }

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

        $this->handleImages($request, $identite);

        return redirect()->route('user.list')
            ->with('success', 'Identité créée avec succès');
    }

    public function update(int $id, Request $request): RedirectResponse
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

        $this->handleImages($request, $identite);

        // Géocodage sécurisé
        try {
            $response = Http::retry(3, 300)
                ->timeout(10)
                ->get('https://photon.komoot.io/api/', [
                    'q' => $identite->adresse
                ]);

            if ($response->successful()) {
                $data = $response->json();

                if (!empty($data['features'])) {
                    $coords = $data['features'][0]['geometry']['coordinates'];

                    $identite->update([
                        'coord_lat'  => $coords[1],
                        'coord_long' => $coords[0],
                    ]);
                } else {
                    Log::warning("Adresse introuvable : {$identite->adresse}");
                }
            }
        } catch (\Exception $e) {
            Log::error('Erreur API géocodage : ' . $e->getMessage());
        }

        return redirect(NavigationService::getBackPageURL())
            ->with('success', 'Identité mise à jour');
    }

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