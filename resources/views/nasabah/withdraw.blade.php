<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">withdraw</h2>
    </x-slot>

    <div class="w-full h-full flex justify-center">
        <div class="flex flex-col max-w-7xl w-full h-full px-6 py-6 items-center">
            <div class="max-w-3xl w-full flex flex-col items-center border-2 border-gray-400 rounded-lg shadow-lg">
                <form action="{{ route('nasabah.withdrawmoney') }}" method="POST"
                    class="flex flex-col justify-center mt-10">
                    @csrf
                    <label for="saldoinput">Masukan Nominal</label>
                    <input type="number" min="0" max="20000000" name="saldo" id="saldoinput"
                        required="required" placeholder="Rp. xxx xxx xxx" class="w-80 rounded-lg" />
                    <button type="submit" class="mt-5 p-2 w-28 rounded-lg bg-blue-500 text-white ">withdraw</button>
                </form>
                <a href="{{ route('nasabah.dashboard') }}"
                    class="mt-20 mb-10 p-2 w-80 text-center text-blue-500 border-2 rounded-lg border-blue-400">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
