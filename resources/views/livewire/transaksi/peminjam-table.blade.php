<div>
    <x-mikro.modal-large :title="'Daftar Peminjam'" id="modalPeminjam" wire:ignore.self>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <x-atom.th-center>ID</x-atom.th-center>
                    <x-atom.th-center>Nama</x-atom.th-center>
                    <x-atom.th-center>Telepon</x-atom.th-center>
                    <x-atom.th-center>Email</x-atom.th-center>
                    <x-atom.th-center></x-atom.th-center>
                </tr>
            </thead>
            <tbody>
                @forelse($dataPeminjam as $row)
                    <tr>
                        <x-atom.td-format :align="'center'">{{$row->kode_peminjam}}</x-atom.td-format>
                        <x-atom.td-format>{{$row->nama}}</x-atom.td-format>
                        <x-atom.td-format :align="'center'">{{$row->telepon}}</x-atom.td-format>
                        <x-atom.td-format :align="'center'">{{$row->email}}</x-atom.td-format>
                        <x-atom.td-format :align="'center'">
                            <button class="btn btn-clean btn-xs btn-default btn-text-primary btn-hover-primary"
                                    wire:click="setPeminjamToForm({{$row->id}})"
                            >set</button>
                        </x-atom.td-format>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5">Tidak Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-mikro.modal-large>
    @prepend('scripts')
        <script>
            function showPeminjam()
            {
                $('#modalPeminjam').modal('show');
            }

            window.livewire.on('getPeminjamToForm', ()=>{
                $('#modalPeminjam').modal('hide');
            })
        </script>
    @endprepend
</div>
