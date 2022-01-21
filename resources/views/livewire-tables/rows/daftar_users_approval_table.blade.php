<x-livewire-tables::bs4.table.cell class="text-center">
    {{$loop->iteration}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ucfirst($row->name)}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->username}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell class="text-center">
    {{$row->role}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell class="text-center">
    {{tanggalan_format($row->created_at)}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell class="text-center" width="20%">
    <button type="button" class="btn btn-success btn-sm" wire:click="$emit('setApproved', '{{$row->id}}')">Approved</button>
    <button type="button" class="btn btn-info btn-sm" wire:click="$emit('setPegawai', '{{$row->id}}')">Pegawai</button>
    <button type="button" class="btn btn-warning btn-sm" wire:click="$emit('destroy', '{{$row->id}}')">Delete</button>
</x-livewire-tables::bs4.table.cell>
