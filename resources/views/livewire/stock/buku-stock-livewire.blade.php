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
                    <table class="table-bordered table row-col-divider">
                        <tr>
                            <thead class="thead-dark">
                            <th class="text-center italic" >Buku ID</th>
                            <th class="text-center italic" >Jumlah</th>
                            <th width="20"></th>
                            </thead>
                        </tr>
                        @forelse($dataBukuStock as $row)
                            <tr>
                                <td class="text-center italic" >{{$row->jenis}}</td>
                                <td class="text-center italic" >{{$row->jumlah}}</td>
                                <td>
                                    <div class="dropdown dropdown-inline mr-4 dropdown-menu-sm">
                                        <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="btn btn-sm btn-text-primary btn-hover-primary btn-icon mr-2 flaticon2-pen" wire:click="edit({{$row->id}})" title="edit">
                                            </button>
                                            <a href="#" wire:click="removeData({{$row->id}})" class="btn btn-sm btn-text-danger btn-icon btn-hover-danger ki ki-solid-minus">
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="3">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </table>
                    {{$dataBukuStock->links()}}
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function adddata()
            {
                $('#modalForForm').modal('show');
            }

            window.livewire.on('storeData', ()=>{
                $('#modalForForm').modal('hide');
            });
        </script>
    @endpush
</div>



