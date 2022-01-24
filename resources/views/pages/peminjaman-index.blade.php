<x-metronics-layout>
    <x-mikro.card-custom :title="__('Daftar Peminjaman Buku')">
        <x-slot name="toolbar">
            @can('peminjam')
            <a href="{{route('peminjamannew.index')}}" class="btn btn-primary" type="button">New Add</a>
            @endcan
        </x-slot>
        <livewire:table.daftar-peminjaman-buku />
    </x-mikro.card-custom>

    @push('scripts')
        <script></script>
    @endpush
</x-metronics-layout>
