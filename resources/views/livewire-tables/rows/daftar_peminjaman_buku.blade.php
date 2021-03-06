<x-livewire-tables::bs4.table.cell>
    {{$row->kode_peminjaman}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ucfirst($row->peminjamPerson->nama)}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{tanggalan_format($row->tgl_pinjam)}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{tanggalan_format($row->tgl_kembali)}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ucfirst($row->status)}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell class="text-center">
    @can('pegawai')
    <a href="#" wire:click="updateStatus({{$row->id}})" class="btn btn-sm btn-text-warning btn-hover-primary " title="edit">
        Approved
    </a>
    @endcan
    @can('peminjam')
    <a href="#" wire:click="pengembalian()" class="btn btn-sm btn-text-danger btn-icon btn-hover-danger ki ki-solid-minus">
    </a>
    @endcan
</x-livewire-tables::bs4.table.cell>
