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
                    <x-splade-form action="{{ route('data.update',$data)}}" :default="$data" method="put">
                        <x-splade-input              name="nama_lembaga" label="Nama "/>
                        <x-splade-input class="py-1" name="jenis_lembaga" label="Jenis Lemabaga " />
                        <x-splade-input class="py-1" name="tahun_berdiri" type="date" label="Tahun Berdiri" />
                        <x-splade-input class="py-1" name="no_oprasional" type="tel" placeholder="Masukan Nomor Izin Oprasional" label="Nomer Izin Oprasional" />
                        <x-splade-input class="py-1" name="no_wa" type="number" placeholder="Masukan Nomor WhatApp" label="Nomer WhatApp" />
                        <x-splade-input class="py-1" name="dikeluarkan_oleh" label="Di Keluarkan Oleh " />
                        <x-splade-textarea name="alamat" autosize label="Alamat Langkap"/>
                        
                        <x-splade-select name="status" label="Status"> 
                            <option class="text-red-500" value="Belum Tervalidasi">Belum Tervalidasi</option>
                            <option class="text-green-500" value="Tervalidasi">Tervalidasi</option>
                        </x-splade-select>

                        <x-splade-submit class="my-3" label="Apply settings" :spinner="false" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
