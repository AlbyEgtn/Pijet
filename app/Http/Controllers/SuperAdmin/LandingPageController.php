<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\Service;
use App\Models\LandingPage;
use App\Models\LandingStatistic;
use App\Models\LandingBenefit;
use App\Models\LandingService;

class LandingPageController extends Controller
{
    public function index()
    {
        $page = LandingPage::first();

        $statistics = LandingStatistic::all();

        $benefits = LandingBenefit::all();

        $services = Service::where('is_active', 1)
            ->where('is_additional', 0)
            ->get();

        return view(
            'pages.superadmin.landing.index',
            compact(
                'page',
                'statistics',
                'benefits',
                'services'
            )
        );
    }

    public function showLanding()
    {
        $page = LandingPage::first();

        $statistics = LandingStatistic::all();

        $benefits = LandingBenefit::all();

        $services = Service::where('is_active', 1)
            ->where('is_additional', 0)
            ->get();

        return view(
            'welcome',
            compact(
                'page',
                'statistics',
                'benefits',
                'services'
            )
        );
    }

    public function update(Request $request)
    {
        $page = LandingPage::firstOrCreate([]);

        $data = $request->only([
            'hero_title',
            'hero_subtitle',
            'hero_button_text',
            'hero_button_link',

            'app_button_text',
            'app_button_link',

            'about_title',
            'about_description',

            'service_title',
            'service_description',

            'therapist_title',
            'therapist_description',

            'join_title',
            'join_description',

            'download_title',
            'download_description'
        ]);

        /*
        |--------------------------------------------------------------------------
        | IMAGE UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('hero_image')) {

            $file = $request->file('hero_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $filename);

            $data['hero_image'] = $filename;
        }

        if ($request->hasFile('about_image')) {

            $file = $request->file('about_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $filename);

            $data['about_image'] = $filename;
        }

        if ($request->hasFile('join_image')) {

            $file = $request->file('join_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $filename);

            $data['join_image'] = $filename;
        }

        if ($request->hasFile('download_image')) {

            $file = $request->file('download_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $filename);

            $data['download_image'] = $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE LANDING PAGE
        |--------------------------------------------------------------------------
        */

        $page->fill($data);
        $page->save();

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATISTICS
        |--------------------------------------------------------------------------
        */

        if ($request->statistics) {

            foreach ($request->statistics as $id => $stat) {

                LandingStatistic::where('id', $id)->update([
                    'title' => $stat['title'],
                    'value' => $stat['value']
                ]);

            }

        }

        return back()->with('success', 'Landing page updated successfully');
    }

    public function createBenefit()
    {
        return view('pages.superadmin.landing.create-benefit');
    }

    public function storeBenefit(Request $request)
    {
        $data = $request->only([
            'title',
            'description'
        ]);

        if ($request->hasFile('icon')) {

            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $filename);

            $data['icon'] = $filename;
        }

        LandingBenefit::create($data);

        return redirect()
            ->route('superadmin.landing')
            ->with('success', 'Benefit berhasil ditambahkan');
    }

    public function editBenefit($id)
    {
        $benefit = LandingBenefit::findOrFail($id);

        return view(
            'pages.superadmin.landing.edit-benefit',
            compact('benefit')
        );
    }

    public function updateBenefit(Request $request, $id)
    {
        $benefit = LandingBenefit::findOrFail($id);

        $data = $request->only([
            'title',
            'description'
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE ICON
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('icon')) {

            if ($benefit->icon && file_exists(public_path('images/' . $benefit->icon))) {

                unlink(public_path('images/' . $benefit->icon));

            }

            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $filename);

            $data['icon'] = $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $benefit->update($data);

        return redirect()
            ->route('superadmin.landing')
            ->with('success', 'Benefit berhasil diperbarui');
    }

    public function destroyBenefit($id)
    {
        $benefit = LandingBenefit::findOrFail($id);

        if ($benefit->icon && file_exists(public_path('images/' . $benefit->icon))) {

            unlink(public_path('images/' . $benefit->icon));

        }

        $benefit->delete();

        return back()
            ->with('success', 'Benefit berhasil dihapus');
    }
}
