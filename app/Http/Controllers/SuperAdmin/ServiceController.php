<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\Service;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::where('is_additional',0)->get();

        $additionalServices = Service::where('is_additional',1)->get();

        return view(
            'pages.superadmin.services.index',
            compact('services','additionalServices')
        );
    }


    public function store(Request $request)
    {

        $request->validate([

            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'duration'    => 'nullable|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_additional' => 'required|boolean'

        ]);


        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store(
                'services',
                'public'
            );

        }


        Service::create([

            'name'        => $request->name,
            'price'       => $request->price,
            'duration'    => $request->duration ?? 0,
            'description' => $request->description,
            'image'       => $imagePath,
            'is_additional' => $request->is_additional,
            'is_active'   => 1

        ]);


        return back()->with(
            'success',
            'Layanan berhasil ditambahkan'
        );
    }


    public function update(Request $request, $id)
    {

        $service = Service::findOrFail($id);


        $data = $request->validate([

            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'duration'    => 'nullable|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);


        if ($request->hasFile('image')) {

            $data['image'] = $request->file('image')->store(
                'services',
                'public'
            );

        }


        $service->update($data);


        return back()->with(
            'success',
            'Layanan berhasil diperbarui'
        );
    }


    public function destroy($id)
    {

        $service = Service::findOrFail($id);

        $service->delete();

        return back()->with(
            'success',
            'Layanan berhasil dihapus'
        );
    }

}