<<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Hadiah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 p-6">
                <h3 class="text-gray-500 text-sm uppercase font-bold">Saldo Tersedia Kamu</h3>
                <p class="text-3xl font-extrabold text-green-600">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white p-6 rounded-lg shadow border">
                    <h4 class="text-xl font-bold mb-2">Pulsa 10rb</h4>
                    <p class="text-gray-600 mb-4">Harga: Rp 11.000</p>
                    <form action="{{ route('katalog.tukar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama_hadiah" value="Pulsa 10rb">
                        <input type="hidden" name="harga" value="11000">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tukar Sekarang
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border">
                    <h4 class="text-xl font-bold mb-2">Token Listrik 20rb</h4>
                    <p class="text-gray-600 mb-4">Harga: Rp 22.000</p>
                    <form action="{{ route('katalog.tukar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama_hadiah" value="Token Listrik 20rb">
                        <input type="hidden" name="harga" value="22000">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tukar Sekarang
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border">
                    <h4 class="text-xl font-bold mb-2">Paket Sembako</h4>
                    <p class="text-gray-600 mb-4">Harga: Rp 90.000</p>
                    <form action="{{ route('katalog.tukar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama_hadiah" value="Paket Sembako">
                        <input type="hidden" name="harga" value="90000">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tukar Sekarang
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
