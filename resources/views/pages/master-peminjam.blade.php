<x-metronics-layout>

    <x-mikro.card-custom :title="'Data Peminjam'">
        <x-slot name="toolbar">
            <button type="button" class="btn btn-sm btn-success font-weight-bold" data-toggle="modal" data-target="#exampleModal">
                <i class="flaticon2-cube"></i> Reports
            </button>
        </x-slot>

        <livewire:master.peminjam-table />

        <x-slot name="footer">
            <a href="#" class="btn btn-light-primary font-weight-bold">Manage</a>
            <a href="#" class="btn btn-outline-secondary font-weight-bold">Learn more</a>
        </x-slot>
    </x-mikro.card-custom>

</x-metronics-layout>
