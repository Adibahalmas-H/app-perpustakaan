<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::when(request('search'), fn ($query, $search) => 
            $query->where('nama', 'like', "%{$search}%")
        )->paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        Member::create($validated);
        return redirect()->route('members.index')
            ->with('success', "Members \"{$validated['nama']}\" berhasil ditambahkan.");
    }

    public function show(string $id)
    {
        $member = Member::with(['loans.loanItems.book', 'loans.user'])->findOrFail($id);

        return view('members.show', compact('member'));
    }

    public function edit(string $nim)
    {
        $member = Member::findOrFail($nim);

        return view('members.edit', compact('member'));
    }

    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:10|unique:members,nim,'.$member->id,
            'email' => 'required|string|max:100|unique:members,email,'.$member->id,
            'nomor_telepon' => 'required|string|max:100',
            'alamat' => 'required|string|max:200',
            'status' => 'required|string|max:100',
        ]);

        return redirect()->route('members.index')
            ->with('success', "Members \"{$validated['nama']}\" berhasil diperbarui.");
    }

    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect()->route('members.index')
            ->with('success', "Member dengan id {$id} berhasil dihapus.");
    }
}
