<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Riwayat Transaksi</h2>
    </x-slot>
    @php
        $number = 1;
    @endphp
    <div class="w-full h-full flex justify-center">
        <div class="flex flex-col max-w-7xl w-full h-full px-6 py-6 items-center">
            <ol class="w-full">
                @forelse ($arrayriwayat as $riwayat)
                    <li class="w-full grid grid-cols-4 p-4 rounded-lg bg-white shadow-md mb-2">
                        <div class="mr-10 px-6 border-r-2 border-gray-300 col-span-1">
                            {{ $number++ }}
                        </div>
                        @if ($riwayat->jenis_transaksi != null)
                            <div class="mr-20">
                                {{ $riwayat->jenis_transaksi }}
                            </div>
                        @else
                            <div class="mr-20">
                                transfer
                            </div>
                        @endif
                        <div>
                            {{ $riwayat->nominal }}
                        </div>
                        <div>
                            @if ($riwayat->tanggal_transaksi)
                                {{ $riwayat->tanggal_transaksi }}
                            @else
                                {{ $riwayat->waktu_transfer }}
                            @endif
                        </div>
                    </li>
                @empty
                @endforelse
            </ol>
        </div>
    </div>
</x-app-layout>
