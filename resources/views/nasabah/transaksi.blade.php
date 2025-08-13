<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Riwayat Transaksi</h2>
    </x-slot>

    <div class="w-full h-full flex justify-center">
        <div class="flex flex-col max-w-7xl w-full h-full px-6 py-6 items-center">
            @forelse ($transaksis as $transaksi)
                <div class="w-full flex p-4 rounded-lg bg-white shadow-md">
                    <div class="mr-10">
                        {{ $transaksi->jenis_transaksi }}
                    </div>
                    <div>
                        {{ $transaksi->nominal }}
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</x-app-layout>
