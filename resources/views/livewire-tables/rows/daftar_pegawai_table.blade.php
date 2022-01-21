<x-livewire-tables::bs4.table.cell>
    {{$row->kode}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->nama}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->gender}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->email}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->telepon}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell width="20%">
    <button type="button" class="btn btn-success btn-sm" wire:click="$emit('setUsers', '{{$row->id}}')">password</button>
    <button type="button" class="btn btn-sm btn-info" wire:click="$emit('edit', '{{$row->id}}')">edit</button>
    <button type="button" class="btn btn-sm btn-warning" wire:click="$emit('destroy', '{{$row->id}}')">Delete</button>
</x-livewire-tables::bs4.table.cell>
