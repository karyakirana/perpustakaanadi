<div>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">Buku Stock</div>
                <div class="card-toolbar">
                    <div class="card-toolbar">
                        <a href="{{ route('stockperubahan.index') }}" class="btn btn-primary" type="button">New Add</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table-bordered table row-col-divider table-responsive-lg">
                            <tr>
                                <thead class="thead-light">
                                <th class="text-center italic" >Jenis</th>
                                <th class="text-center italic" >Tanggal Perubahan</th>
                                <th class="text-center italic" >Pembuat</th>
                                <th class="text-center italic" >Keterangan</th>
                                <th class="text-center"></th>
                                </thead>
                            </tr>
                            @forelse($datastock_perubahan as $row)
                                <tr>
                                    <td class="text-center italic" >{{$row->jenis}}</td>
                                    <td class="text-center italic" >{{tanggalan_format($row->tgl_perubahan)}}</td>
                                    <td class="text-center italic" >{{$row->pembuat}}</td>
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
                        {{$datastock_perubahan->links()}}
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

</div>
