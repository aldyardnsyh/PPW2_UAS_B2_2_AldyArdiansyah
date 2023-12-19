<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-gray-200 leading-tight">
            {{ __('Buku Populer') }}
        </h2>
    </x-slot>

    <div class="container" style="margin-top: 5%">
        @if(Session::has('pesan'))
            <div class="alert alert-success fade show" id="success-alert" role="alert">{{ Session::get('pesan') }}</div>
        @endif

        @if(count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li style="list-style: none;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <ul>
            @forelse ($popularBooks->sortByDesc(function ($buku) {
                return $buku->ratings->avg('rating');
            }) as $buku)
                <li class="text-white">{{ $buku->judul }} - {{ $buku->ratings->avg('rating') }}</li>
            @empty
                <p class="text-white">Tidak ada buku populer saat ini.</p>
            @endforelse
        </ul>

        {{ $popularBooks->links('vendor.pagination.bootstrap-5') }}

    </div>

</x-app-layout>
