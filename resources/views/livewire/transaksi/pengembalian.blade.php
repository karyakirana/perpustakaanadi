<div>
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">Pengembalian Buku</div>
            <div class="card-toolbar">
                <div class="card-toolbar">
                    <a href="{{ route('pengembaliannew.index') }}" class="btn btn-primary" type="button">New Add</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table-bordered table row-col-divider table-responsive-lg">
                        <tr>
                            <thead class="thead-light">
                            <th class="text-center italic" >Kode Pengembalian</th>
                            <th class="text-center italic" >Peminjam</th>
                            <th class="text-center italic" >Tanggal Pinjam</th>
                            <th class="text-center italic" >Tanggal Kembali</th>
                            <th class="text-center italic" >Keterangan</th>
                            <th class="text-center"></th>
                            </thead>
                        </tr>
                        @forelse($datapengembalian_buku as $row)
                            <tr>
                                <td class="text-center italic" >{{$row->kode_pengembalian}}</td>
                                <td class="text-center italic" >{{ucfirst($row->peminjamPerson->nama)}}</td>
                                <td class="text-center italic" >{{tanggalan_format($row->tgl_pinjam)}}</td>
                                <td class="text-center italic" >{{tanggalan_format($row->tgl_kembali)}}</td>
                                <td class="text-center italic" >{{$row->keterangan}}</td>
                                <td class="text-center table-responsive">
                                    <a href="#" wire:click="edit({{$row->id}})" class="btn btn-sm btn-text-primary btn-hover-primary btn-icon flaticon2-pen" title="edit">
                                    </a>
                                    <a href="#" wire:click="removeData({{$row->id}})" class="btn btn-sm btn-text-danger btn-icon btn-hover-danger ki ki-solid-minus">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="6">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </table>
                    {{$datapengembalian_buku->links()}}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>

            window.livewire.on('storeData', ()=>{
                $('#modalForForm').modal('hide');
            });
        </script>
    @endpush
</div>
