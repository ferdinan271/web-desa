<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <x-splade-form action="{{route('data.store')}}">
                        <x-splade-input              name="nama_lembaga" label="Nama Lembaga " required/>
                        <x-splade-input class="py-1" name="jenis_lembaga" label="Jenis Lemabaga " required/>
                        <x-splade-input class="py-1" name="tahun_berdiri" type="date" label="Tahun Berdiri" required/>
                        <x-splade-input class="py-1" name="no_oprasional" type="number" placeholder="Masukan Nomor Izin Oprasional" label="Nomer Izin Oprasional" required/>
                        <x-splade-input class="py-1" name="no_wa" type="tel" placeholder="Masukan WhatApp Anda" label="Nomer WhatApp" required />
                        <x-splade-input class="py-1" name="dikeluarkan_oleh" label="Di Keluarkan Oleh " required/>
                        <x-splade-textarea name="alamat" autosize label="Alamat Langkap" required/>
                        <x-splade-submit class="my-3" label="Apply settings" :spinner="false" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
