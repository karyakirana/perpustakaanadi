<x-livewire-tables::table.cell class="text-center">
    {{$row->kode_peminjam}}
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    {{$row->nama}}
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell class="text-center">
    {{$row->gender}}
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    {{$row->email}}
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    {{$row->telepon}}
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell class="text-center" width="15%">
    <button type="button" class="btn btn-sm btn-info" wire:click="$emit('edit', '{{$row->id}}')">edit</button>
    <button type="button" class="btn btn-sm btn-warning" wire:click="$emit('destroy', '{{$row->id}}')">Delete</button>
</x-livewire-tables::table.cell>
