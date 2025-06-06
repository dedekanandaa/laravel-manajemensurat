@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('route')
<span class="font-semibold">/</span>
<a class="font-semibold" href="/suratkeluar">
    Surat Keluar
</a>
<span class="font-semibold">/</span>
<a class="font-semibold" href="#">
    Registrasi
</a>
@endsection

@section('content')
<main class="w-full bg-white rounded-md p-5">

    <h1 class="text-2xl mb-4">Registrasi Surat Baru</h1>
    @if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <form action="./suratbaru" method="POST" class="space-y-4">
        @csrf
        <div class="grid lg:grid-cols-2 gap-4">
            <div>
                <label for="tujuan" class="block mb-2 text-sm font-medium">
                    Tujuan Utama
                    <span class="text-red-600">*</span>
                </label>
                <select id="tujuan" name="tujuan_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">Pilih</option>
                    @foreach ($penerima as $option)
                    <option value="{{ $option->id }}" {{ old('tujuan_surat')==$option->id ? 'selected' : '' }} >{{
                        $option->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="gruptujuan_id" class="block mb-2 text-sm font-medium">
                    Grup Tujuan
                </label>
                <select id="gruptujuan_id" name="gruptujuan_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">Pilih</option>
                    @foreach ($grupTujuan as $option)
                    <option value="{{ $option->id }}" {{ old('grup')==$option->id ? 'selected' : '' }} >{{
                        $option->nama_grup }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="penandatangan" class="block mb-2 text-sm font-medium">
                    Penandatangan
                    <span class="text-red-600">*</span>
                </label>
                <select id="penandatangan" name="penandatangan_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">Pilih</option>
                    @foreach ($penandatangan as $option)
                    <option value="{{ $option->id }}" {{ old('penandatangan_id')==$option->id ? 'selected' : '' }} >{{
                        $option->user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="verifikator_id" class="block mb-2 text-sm font-medium">
                    Verifikator
                    <span class="text-red-600">*</span>
                </label>
                <select id="verifikator_id" name="verifikator_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">Pilih</option>
                    @foreach ($verifikator as $option)
                    <option value="{{ $option->id }}" {{ old('verifikator_id')==$option->id ? 'selected' : '' }} >{{
                        $option->user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>
        <div class="grid lg:grid-cols-2 gap-4">
            <div class="space-y-3">
                <span class="block mb-2 text-sm font-medium text-center">Informasi Surat</span>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="nomorsurat">
                        Nomor Surat
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="nomorsurat" id="nomorsurat"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nomor Surat" value="{{ old('nomorsurat') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="tanggalsurat">
                        Tanggal Surat
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="date" name="tanggalsurat" id="tanggalsurat"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tanggal Surat" value="{{ old('tanggalsurat') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="sifatsurat">
                        Sifat Surat
                        <span class="text-red-600">*</span>
                    </label>
                    <select name="sifatsurat" id="sifatsurat" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="" selected disabled>Pilih Sifat</option>
                        @foreach (['biasa', 'penting', 'rahasia', 'sangat rahasia'] as $sifat)
                        <option value="{{ $sifat }}" {{ old('sifatsurat')===$sifat ? 'selected' : '' }}>{{
                            ucfirst($sifat)
                            }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="jenis_surat">
                        Jenis Surat
                        <span class="text-red-600">*</span>
                    </label>
                    <select name="jenis_surat" id="jenis_surat" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="" selected disabled>Pilih Jenis</option>
                        @foreach (['NOTA DINAS', 'SURAT PERINTAH'] as $jenis)
                        <option value="{{ $jenis }}" {{ old('jenis_surat')===$jenis ? 'selected' : '' }}>{{
                            ucfirst($jenis)
                            }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium" required>
                        Keterangan
                        <span class="text-red-600">*</span>
                    </label>
                    <textarea id="message" rows="4" name="keterangan"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tuliskan keterangan surat">{{ old('keterangan') }}</textarea>
                </div>
            </div>
            <div class="space-y-3">
                <span class="block mb-2 text-sm font-medium text-center">Isi Surat</span>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="perihal">
                        Perihal Surat
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="perihal" id="perihal"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Perihal Surat" value="{{ old('perihal') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="isisurat">
                        Isi Surat
                        <span class="text-red-600">*</span>
                    </label>
                    <textarea type="text" name="isisurat" id="isisurat"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Isi Surat" rows="10" required>{{ old('isisurat') }}</textarea>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="acara">
                        Acara
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="acara" id="acara"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Acara" value="{{ old('acara') }}" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="tempat">
                        Tempat
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="tempat" id="tempat"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tempat" value="{{ old('tempat') }}" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium" for="haritanggal_mulai">
                            Waktu Mulai Acara
                            <span class="text-red-600">*</span>
                        </label>
                        <input type="datetime-local" name="haritanggal_mulai" id="haritanggal_mulai"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Hari, Tanggal Acara" value="{{ old('haritanggal_mulai') }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium" for="haritanggal_selesai">
                            Waktu Selesai Acara
                            <span class="text-red-600">*</span></label>
                        <input type="datetime-local" name="haritanggal_selesai" id="haritanggal_selesai"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Hari, Tanggal Acara" value="{{ old('haritanggal_selesai') }}" required>
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium" for="undangan">Undangan
                        <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="undangan[]" id="undangan"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Undangan" value="{{ old('undangan.0') }}" required>
                    @if (old('undangan'))
                    @foreach (old('undangan') as $key => $value)
                    @if ($key > 0)
                    <input type="text" name="undangan[]" id="undangan"
                        class="block p-2.5 mt-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Undangan" value="{{ $value }}" required>
                    @endif
                    @endforeach
                    @endif
                </div>
                <button type="button"
                    class="bg-gray-200 text-xs px-4 py-2 cursor-pointer hover:bg-gray-300 rounded-full"
                    onclick="addUndangan()">Tambah Undangan</button>
                <br>
                <button type="submit"
                    class="text-white block bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">
                    Buat Surat
                </button>
            </div>

        </div>
    </form>

</main>

<script>
    function addUndangan() {
        const undanganDiv = document.getElementById("undangan");
        
            // Clone the existing select element
            const clone = undanganDiv.cloneNode(true);
            // Reset the selected value in the clone
            clone.value = "";
            // Create a container div for the new select
            const container = document.createElement('div');
            container.className = 'mt-1 flex items-center gap-2';
            container.appendChild(clone);

            // Add remove button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'bg-red-200 text-xs px-2 py-1 cursor-pointer hover:bg-red-300 rounded-full';
            removeBtn.textContent = 'Hapus';
            removeBtn.onclick = function() { container.remove(); };
            container.appendChild(removeBtn);

            // Insert the new select after the original one
            undanganDiv.parentNode.appendChild(container);
    }
</script>

@endsection