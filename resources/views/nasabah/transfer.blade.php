<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Transfer</h2>
    </x-slot>

    <div class="w-full h-full flex justify-center">
        <div class="flex flex-col max-w-7xl w-full h-full px-6 py-6 items-center">
            <div class="max-w-3xl w-full flex flex-col items-center border-2 border-gray-400 rounded-lg shadow-lg">
                @if ($errors->any())
                    <div class="bg-red-100 text-red-600 p-3 rounded w-80 mb-1 mt-3">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 text-green-600 p-3 rounded w-80 mb-1 mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('nasabah.transfermoney') }}" method="POST" class="flex flex-col justify-center mt-10">
                    @csrf
                    <label for="norekening">Masukan Nomor Rekening Tujuan</label>
                    <input type="text" name="norekening" id="norekening" required
                        placeholder="Contoh: 100000003" class="w-80 rounded-lg" />

                    <label for="saldoinput" class="mt-2">Masukan Nominal</label>
                    <input type="number" min="1000" max="20000000" name="saldo" id="saldoinput"
                        required placeholder="Rp. xxx xxx xxx" class="w-80 rounded-lg" />

                    <label for="keterangan" class="mt-2">Keterangan (Opsional)</label>
                    <textarea name="keterangan" id="keterangan" class="w-80 rounded-lg"></textarea>

                    <button type="submit" class="mt-5 p-2 w-28 rounded-lg bg-blue-500 text-white">Transfer</button>
                </form>

                <a href="{{ route('nasabah.dashboard') }}"
                    class="mt-10 mb-10 p-2 w-80 text-center text-blue-500 border-2 rounded-lg border-blue-400">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
