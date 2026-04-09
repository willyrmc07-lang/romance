<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class BranchController extends Controller
{
    /**
     * Tampilkan Daftar Cabang
     */
    public function index()
    {
        return Inertia::render('Branches/Index', [
            // Gunakan withCount agar field 'users_count' terisi otomatis
            'branches' => Branch::withCount('users')->get()
        ]);
    }

    /**
     * Form Tambah Cabang
     */
    public function create()
    {
        return Inertia::render('Branches/Create');
    }

    /**
     * Simpan Cabang Baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'code'    => 'required|string|max:10|unique:branches,code',
            'address' => 'nullable|string',
        ]);

        Branch::create($validated);

        return Redirect::route('branches.index')->with('success', 'Cabang berhasil dibuat.');
    }

    /**
     * Form Edit Cabang
     */
    public function edit(Branch $branch)
    {
        return Inertia::render('Branches/Edit', [
            'branch' => $branch
        ]);
    }

    /**
     * Update Data Cabang
     */
    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'code'    => 'required|string|max:10|unique:branches,code,' . $branch->id,
            'address' => 'nullable|string',
        ]);

        $branch->update($validated);

        return Redirect::route('branches.index')->with('success', 'Cabang berhasil diperbarui.');
    }

    /**
     * Hapus Cabang
     */
    public function destroy(Branch $branch)
    {
        // Opsional: Cek jika masih ada user di cabang ini sebelum dihapus
        if ($branch->users()->count() > 0) {
            return Redirect::back()->with('error', 'Cabang tidak bisa dihapus karena masih memiliki user.');
        }

        $branch->delete();

        return Redirect::route('branches.index')->with('success', 'Cabang berhasil dihapus.');
    }
}