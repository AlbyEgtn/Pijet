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
        // layanan utama (paginate 9)
        $services = Service::where('is_additional', 0)
            ->latest()
            ->paginate(9);

        // layanan tambahan (tetap biasa)
        $additionalServices = Service::where('is_additional', 1)
            ->latest()
            ->get();

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
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_additional' => 'required|boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request->file('image'));
        }

        Service::create($validated);

        return back()->with('success', 'Layanan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'duration'    => 'nullable|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // hapus gambar lama
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }

            $validated['image'] = $this->storeImage($request->file('image'));
        }

        $service->update($validated);

        return back()->with('success', 'Layanan berhasil diperbarui');
    }

    // ===== PRIVATE HELPER =====
    private function storeImage($file): string
    {
        $directory = storage_path('app/public/services');

        // buat folder jika belum ada
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = time() . '_' . uniqid() . '.webp';

        $manager = new ImageManager(new Driver());

        $manager->read($file)
            ->scale(width: 800)
            ->toWebp(80)
            ->save($directory . '/' . $filename);

        return 'services/' . $filename;
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