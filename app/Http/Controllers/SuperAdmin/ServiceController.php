<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\Service;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::where('is_additional', 0)->latest()->get();

        $additionalServices = Service::where('is_additional', 1)->latest()->get();

        return view(
            'pages.superadmin.services.index',
            compact('services', 'additionalServices')
        );
    }


    public function store(Request $request)
    {
    $validated = $request->validate([
        'name'          => 'required|string|max:255',
        'price'         => 'required|numeric',
        'duration'      => 'nullable|numeric',
        'description'   => 'nullable|string',
        'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'is_additional' => 'required|boolean'
    ]);

    if ($request->hasFile('image')) {

        $file = $request->file('image');

        $filename = time().'.webp';

        $path = storage_path('app/public/services/'.$filename);

        $manager = new ImageManager(new Driver());

        $image = $manager->read($file)
            ->scale(width: 800)
            ->toWebp(80);

        $image->save($path);

        $validated['image'] = 'services/'.$filename;
    }

    Service::create($validated);

    return back()->with('success','Layanan berhasil ditambahkan');
}

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'duration'    => 'nullable|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }

            $validated['image'] = $request->file('image')->store(
                'services',
                'public'
            );
        }

        $service->update($validated);

        return back()->with('success', 'Layanan berhasil diperbarui');
    }


    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // hapus gambar dari storage
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return back()->with('success', 'Layanan berhasil dihapus');
    }
}