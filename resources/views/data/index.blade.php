<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Domisili Lembaga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$data"  >
                <x-splade-cell status as=$Status>
                @if($Status->status ==='Tervalidasi' )
                <p style="color:green"class="font-bold">{{$Status->status}}</p>
                @else
                <p style="color:red" class="font-bold ">{{$Status->status}}</p>
                @endif

                </x-splade-cell>
                <x-splade-cell action as="$Data"  >
                        <x-splade-button >
                            <Link href="/data/{{ $Data->id }}/edit"> Edit </Link>
                        </x-splade-button>
                            <x-splade-form 
                                    action="{{ route ('data.destroy',$Data)}}"
                                    method="delete"
                                    confirm="Hapus Data"
                                    confirm-text="Apakah Anda Yakin Untuk Menghapus?"
                                    confirm-splade-button="Hapus!"
                                    cancel-splade-button="Kembali!">
                                <x-splade-button class="bg-red-500 text-white">
                                    Hapus
                                </x-splade-button>
                            </x-splade-form>
                </x-splade-cell>
            </x-splade-table>
            
        </div>
    </div>
</x-app-layout>