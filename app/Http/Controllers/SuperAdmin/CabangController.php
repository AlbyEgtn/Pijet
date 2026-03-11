<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\Cabang;

class CabangController extends Controller
{

    public function index(Request $request)
    {

        $search = $request->search;

        $cabangs = Cabang::when($search, function ($query) use ($search) {

            $query->where('kode_cabang','like',"%$search%")
                  ->orWhere('kota','like',"%$search%")
                  ->orWhere('provinsi','like',"%$search%");

        })
        ->latest()
        ->paginate(10);

        return view('pages.superadmin.cabang.index', compact('cabangs'));

    }

    public function create()
    {
        return view('pages.superadmin.cabang.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'kota' => 'required',
            'provinsi' => 'required',
            'email' => 'required|email'
        ]);


        // ambil kode cabang terakhir
        $lastCabang = Cabang::orderBy('id','desc')->first();

        if ($lastCabang) {

            $lastNumber = intval(substr($lastCabang->kode_cabang, 3));
            $nextNumber = $lastNumber + 1;

        } else {

            $nextNumber = 1;

        }

        $kodeCabang = 'CBS'.str_pad($nextNumber, 5, '0', STR_PAD_LEFT);


        Cabang::create([

            'kode_cabang' => $kodeCabang,

            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'detail_lokasi' => $request->detail_lokasi,
            'email' => $request->email,
            'deskripsi' => $request->deskripsi,
            'tanggal_peresmian' => $request->tanggal_peresmian,
            'status' => 'Aktif'

        ]);


        return redirect()
            ->route('superadmin.cabang.index')
            ->with('success','Cabang berhasil ditambahkan');

    }
    public function edit($id)
    {
        $cabang = Cabang::findOrFail($id);

        return view('pages.superadmin.cabang.edit', compact('cabang'));
    }

    public function update(Request $request, $id)
    {

        $cabang = Cabang::findOrFail($id);

        $request->validate([
            'kode_cabang' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'tanggal_peresmian' => 'required',
            'email' => 'required|email'
            
        ]);

        $cabang->update([
            'kode_cabang' => $request->kode_cabang,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'tanggal_peresmian' => $request->tanggal_peresmian,
            'email' => $request->email,
            'status' => $request->status
        ]);

        return redirect()
            ->route('superadmin.cabang.index')
            ->with('success','Cabang berhasil diperbarui');
    }
    
    public function show($id)
    {
        $cabang = Cabang::findOrFail($id);

        return view('pages.superadmin.cabang.show', compact('cabang'));
    }

    public function destroy($id)
    {

        $cabang = Cabang::findOrFail($id);

        $cabang->delete();

        return redirect()
            ->route('superadmin.cabang.index')
            ->with('success','Cabang berhasil dihapus');

    }
}