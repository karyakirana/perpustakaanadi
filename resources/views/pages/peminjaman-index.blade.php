<x-metronics-layout>
    <x-mikro.card-custom :title="__('Daftar Peminjaman Buku')">
        <livewire:table.daftar-peminjaman-buku />
    </x-mikro.card-custom>

    @push('scripts')
        <script></script>
    @endpush
</x-metronics-layout>
