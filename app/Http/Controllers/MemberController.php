<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberReques;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private array $members = [
        ['nama' => 'Raka Pratama' ,'nim' => '3125500011' ,'email' => 'rakaprtma@gmail.com', 'nomor_telepon' => '081234567890', 'alamat' => 'Surabaya','status' => 'Aktif'],
        ['nama' => 'Aulia Safitri' ,'nim' => '4426500011' ,'email' => 'auliasafitri56@gmail.com', 'nomor_telepon' => '081238765890', 'alamat' => 'Semarang','status' => 'Cuti'],
        ['nama' => 'Rafatar Malik' ,'nim' => '2224100016' ,'email' => 'rafatarmalik@gmail.com', 'nomor_telepon' => '081276435890', 'alamat' => 'Yogyakarta','status' => 'Aktif'],
    ];

    public function index()
    {
        $members = $this->members;
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberReques $request)
    {
        $validated = $request->validated();

        return redirect()->route('members.index')
            ->with('success', "Members \"{$validated['nama']}\" berhasil ditambahkan (data dummy, belum tersimpan ke database).");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nim)
    {
        $member = collect($this->members)->firstWhere('nim' , (string) $nim);

        abort_if(! $member, 404);

        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nim)
    {
        $member = collect($this->members)->firstWhere('nim' , (string) $nim);

        abort_if(! $member, 404);

        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nim)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:10',
            'email' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:100',
            'alamat' => 'required|string|max:200',
            'status' => 'required|string|max:100',
        ]);

        return redirect()->route('members.index')
            ->with('success', "Members \"{$validated['nama']}\" berhasil diperbarui (data dummy, belum tersimpan ke database).");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nim)
    {
        return redirect()->route('members.index')
            ->with('success', "Member dengan id {$nim} berhasil dihapus (data dummy, belum tersimpan ke database).");
    }
}
