<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    /**
     * Tampilkan daftar role.
     */
    public function index()
    {
        return Inertia::render('Roles/Index', [
            'roles' => Role::withCount('users')->get() // Menghitung berapa user di tiap role
        ]);
    }

    /**
     * Tampilkan form untuk membuat role baru.
     */
    public function create()
    {
        return Inertia::render('Roles/Create');
    }

    /**
     * Simpan role baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
            'display_name' => 'required|string|max:100',
        ]);

        Role::create($validated);

        return Redirect::route('roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit role.
     */
    public function edit(Role $role)
    {
        return Inertia::render('Roles/Edit', [
            'role' => $role
        ]);
    }

    /**
     * Perbarui data role di database.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:roles,name,' . $role->id,
            'display_name' => 'required|string|max:100',
        ]);

        $role->update($validated);

        return Redirect::route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    /**
     * Hapus role dari database.
     */
    public function destroy(Role $role)
    {
        // Opsional: Cek jika role masih digunakan oleh user sebelum dihapus
        if ($role->users()->count() > 0) {
            return Redirect::back()->with('error', 'Role tidak bisa dihapus karena masih digunakan oleh user.');
        }

        $role->delete();

        return Redirect::route('roles.index')->with('success', 'Role berhasil dihapus.');
    }
}