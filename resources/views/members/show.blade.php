@extends('layouts.app')
@section('title', 'Detail Anggota')
<p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar member</a></p>

@section('content')
<h1>Detail Member</h1>

<table>
    <tr>
        <th>Nama</th>
        <td>{{ $member['nama'] }}</td>
    </tr>
    <tr>
        <th>NIM</th>
        <td>{{ $member['nim'] }}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{ $member['alamat'] }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $member['email'] }}</td>
    </tr>
    <tr>
        <th>nomor_telepon</th>
        <td>{{ $member['nomor_telepon'] ?? '-' }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{ $member['status'] }}</td>
    </tr>
</table>
<h2>Riwayat Peminjaman</h2>
<p><em>Diambil lewat relasi <code>$member->loans</code> - satu anggota bisa punya banyak transaksi peminjaman.</em></p>

<table>
    <thead>
        <tr>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Petugas</th>
            <th>Buku</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($member['loans'] as $loan)
        <tr>
            <td>{{ $loan['tanggal_pinjam'] }}</td>
            <td>{{ $loan['tanggal_kembali'] }}</td>
            <td>{{ $loan['user']['name'] }}</td>
            <td>
                @foreach ($loan['loanItems'] as $item)
                {{ $item['book']['judul'] }}@if (!$loop->last), @endif
                @endforeach
            </td>
            <td>{{ ucfirst($loan['status']) }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">Anggota ini belum pernah meminjam buku.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection