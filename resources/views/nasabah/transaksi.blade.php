<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Riwayat Transaksi</h2>
    </x-slot>

    @php $number = 1; @endphp

    <div class="w-full h-full flex justify-center">
        <div class="flex flex-col max-w-7xl w-full h-full px-6 py-6 items-center">
            <ol class="w-full">
                @forelse ($arrayriwayat as $riwayat)
                    <li class="w-full grid grid-cols-5 p-4 rounded-lg bg-white shadow-md mb-2 items-center">
                        {{-- No --}}
                        <div class="px-4 border-r border-gray-300">
                            {{ $number++ }}
                        </div>

                        {{-- Tanggal & Jam --}}
                        <div class="text-gray-600 text-sm">
                            {{ $riwayat->tanggal }}
                        </div>

                        {{-- Jenis Transaksi --}}
                        <div class="capitalize font-semibold">
                            {{ $riwayat->tipe === 'transfer' ? 'Transfer' : $riwayat->jenis_transaksi }}
                        </div>

                        {{-- Dari / Ke --}}
                        <div>
                            @if ($riwayat->tipe === 'transfer')
                                <span class="font-semibold">{{ $riwayat->dari }}</span> 
                                <span class="text-gray-800">Tujuan Ke</span> 
                                <span class="font-semibold text-blue-600">{{ $riwayat->ke }}</span>
                            @else
                                <span class="font-semibold">{{ $riwayat->dari }}</span>
                            @endif
                        </div>

                        {{-- Nominal --}}
                        <div class="font-bold {{ $riwayat->tipe === 'transfer' && $riwayat->dari == Auth::user()->name ? 'text-red-500' : 'text-green-600' }}">
                            {{ $riwayat->nominal_formatted }}
                        </div>
                    </li>
                @empty
                    <li class="text-center text-gray-500 py-6">
                        Belum ada riwayat transaksi.
                    </li>
                @endforelse
            </ol>
        </div>
    </div>
</x-app-layout>
