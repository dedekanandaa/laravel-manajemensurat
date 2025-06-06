@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Surat Keluar
</a>
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Ditolak
</a>
@endsection

@section('content')

<main class="w-full bg-white rounded-md p-5">
    <div class="col-span-2 p-5 space-y-4 bg-white rounded">
        @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
        @endif
        <h1 class="font-semibold text-lg">Surat Keluar Ditolak</h1>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Dibuat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Informasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            File Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($surat) == 0)
                    <tr class="bg-white border-b border-gray-200">
                        <td colspan="6" class="px-6 py-4 text-center">
                            Tidak ada surat keluar yang ditolak.
                        </td>
                    </tr>
                    @else
                    @foreach($surat as $item)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            {{ $item->created_at->locale('id')->isoFormat('dddd, D MMMM Y')}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->nomor_surat }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->judul_surat }}
                        </td>
                        <td class="px-6 py-4">
                            <table class="text-sm min-w-full">
                                <tbody>
                                    <tr>
                                        <td class="font-medium">Pengirim</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->pengirim->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Tujuan</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->tujuan->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Sifat</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->sifat_surat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Jenis</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->jenis_surat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">Verif</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->verifikator->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-medium">TTD</td>
                                        <td class="text-gray-600 px-2">:</td>
                                        <td>{{ $item->penandatangan->user->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="px-6 py-4">
                            <a href="/surat/download/{{ $item->id }}" class="text-blue-500 hover:underline">
                                Lihat
                            </a>
                        </td>
                        <td class="flex px-6 py-4">
                            @if (Auth::user()->role === 'admin')
                            <form action="/suratkeluar/verifikasi" method="POST">
                                @csrf
                                <button type="submit" name="id" value="{{ $item->id }}"
                                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm hover:cursor-pointer hover:bg-blue-200">
                                    Batal Tolak
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @if ($item->verifikasi === 'ditolak')
                    <tr class="bg-white border-b border-gray-200">
                        <td colspan="7" class="px-6 py-4">
                            <div>
                                <strong>Alasan Penolakan:</strong> {{ $item->keterangan }}
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection