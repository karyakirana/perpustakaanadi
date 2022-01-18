<div>
    <x-mikro.modal-large :title="'Daftar Buku'" id="modalBuku" wire:ignore.self>

        <table class="table table-bordered">
            <thead>
            <tr>
                <x-atom.th-center>ID</x-atom.th-center>
                <x-atom.th-center>Judul</x-atom.th-center>
                <x-atom.th-center>ISBN</x-atom.th-center>
                <x-atom.th-center>Action</x-atom.th-center>
            </tr>
            </thead>
            <tbody>
            @forelse($dataBuku as $row)
                <tr>
                    <td class="text-center align-middle">{{$row->kode_buku}}</td>
                    <td class="align-middle">{{$row->judul}}</td>
                    <td class="text-center align-middle">{{$row->isbn}}</td>
                    <td class="text-center">
                        <button class="btn btn-clean btn-xs btn-default btn-text-primary btn-hover-primary"
                            wire:click="setItemToForm({{$row->id}})"
                        >set</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak Ada data</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <x-slot name="footer"></x-slot>
    </x-mikro.modal-large>
    @push('scripts')
        <script>
            function showModalBuku()
            {
                $('#modalBuku').modal('show');
            }

            window.livewire.on('getItemToForm', ()=>{
                $('#modalBuku').modal('hide');
            })
        </script>
    @endpush
</div>
