<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\SuperAdmin\Cabang;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->get('role', 'admin'); // default admin
        $search = $request->get('search');

        $query = User::query()
            ->whereIn('role', ['admin', 'finance']);

        // filter role tab
        if ($role) {
            $query->where('role', $role);
        }

        // search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('id', 'like', "%$search%");
            });
        }

        $karyawans = $query->latest()->paginate(10);

        return view('pages.superadmin.karyawan.index', compact('karyawans', 'role', 'search'));
    }

    public function create()
    {
        $provinsis = Cabang::where('status', 'Aktif')
            ->select('provinsi')
            ->distinct()
            ->pluck('provinsi');

        return view('pages.superadmin.karyawan.create', compact('provinsis'));
    }

    public function getCabangByProvinsi($provinsi)
    {

        $provinsi = urldecode($provinsi);

        $cabangs = Cabang::where('provinsi', $provinsi)
            ->where('status', 'Aktif')
            ->get();

        return response()->json($cabangs);
}


    public function store(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:admin,finance',
            'cabang_id' => 'required|exists:cabangs,id',

            'phone' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('karyawan', 'public');
            }

            User::create([
                'name' => $request->nama_depan . ' ' . $request->nama_belakang,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'phone' => $request->phone,
                'cabang_id' => $request->cabang_id,
                'foto' => $fotoPath,

                // 🔥 IDENTITAS
                'gender' => $request->jenis_kelamin,
                'birth_date' => $request->tanggal_lahir,
                'address' => $request->alamat,
                'city' => $request->tempat_lahir,
            ]);

            DB::commit();

            return redirect()
                ->route('superadmin.karyawan.index')
                ->with('success', 'Akun berhasil dibuat');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $karyawan = User::with('cabang')->findOrFail($id);

        return view('pages.superadmin.karyawan.show', compact('karyawan'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus');
    }

}