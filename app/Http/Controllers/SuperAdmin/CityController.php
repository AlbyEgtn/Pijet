<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * List Kota
     */
    public function index(Request $request)
    {
        $query = City::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'province_name',
                    'like',
                    '%' . $request->search . '%'
                );

            });
        }

        $cities = $query
            ->orderBy('province_name')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view(
            'pages.superadmin.cities.index',
            compact('cities')
        );
    }

    /**
     * Simpan Kota
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:100',
                'unique:cities,name'
            ],

            'province_name' => [
                'required',
                'string',
                'max:100'
            ]

        ]);

        City::create([

            'name' => trim($validated['name']),
            'province_name' => trim($validated['province_name'])

        ]);

        return back()->with(
            'success',
            'Kota berhasil ditambahkan.'
        );
    }

    /**
     * Detail Kota (API / Modal)
     */
    public function show(City $city)
    {
        return response()->json($city);
    }

    /**
     * Update Kota
     */
    public function update(
        Request $request,
        City $city
    )
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:100',
                'unique:cities,name,' . $city->id
            ],

            'province_name' => [
                'required',
                'string',
                'max:100'
            ]

        ]);

        $city->update([

            'name' => trim($validated['name']),
            'province_name' => trim($validated['province_name'])

        ]);

        return back()->with(
            'success',
            'Kota berhasil diperbarui.'
        );
    }

    /**
     * Hapus Kota
     */
    public function destroy(City $city)
    {
        try {

            $city->delete();

            return back()->with(
                'success',
                'Kota berhasil dihapus.'
            );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Kota gagal dihapus.'
            );

        }
    }
}