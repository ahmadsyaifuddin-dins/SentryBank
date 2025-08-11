{{-- admin/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Dashboard Nasabah</h2>
    </x-slot>

    <div class="w-full h-full flex justify-center">
        <div class="flex flex-col max-w-7xl w-full h-full px-6 py-6">
            <div class="font-semibold text-5xl mb-10 mt-3">
                Rp. {{ $nasabahs->saldo }}
            </div>
            <div class="max-w-7xl w-full grid grid-cols-3 gap-4">
                <a href="{{ route('nasabah.deposit') }}"
                    class="bg-blue-300 h-32 rounded-lg hover:bg-blue-400 flex items-center justify-start">
                    <img src="https://img.icons8.com/?size=70&id=89866&format=png&color=ffffff" alt="Deposit"
                        class="mx-6">
                    <div class="text-2xl text-white font-medium">
                        Deposit
                    </div>
                </a>
                <a href="{{ route('nasabah.withdraw') }}"
                    class="bg-yellow-300 h-32 rounded-lg hover:bg-yellow-500 flex items-center justify-start">
                    <img src="https://img.icons8.com/?size=70&id=cykpAzfWRTrY&format=png&color=ffffff" alt="Deposit"
                        class="mx-6">
                    <div class="text-2xl text-white font-medium">
                        Tarik Tabungan
                    </div>
                </a>
                <a href="{{ route('nasabah.transfer') }}"
                    class="bg-green-300 h-32 rounded-lg hover:bg-green-500 flex items-center justify-start">
                    <img src="https://img.icons8.com/?size=70&id=9917&format=png&color=ffffff" alt="Deposit"
                        class="mx-6">
                    <div class="text-2xl text-white font-medium">
                        Transfer
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
