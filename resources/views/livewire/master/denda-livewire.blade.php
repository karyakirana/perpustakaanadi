<div>
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">Denda</div>
            <div class="card-toolbar">
                <div class="card-toolbar">
                    <button class="btn btn-primary" type="button" onclick="adddata()">New Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table-bordered table row-col-divider table-responsive-lg">
                        <tr>
                            <thead class="thead-light">
                            <th class="text-center italic" >Kode Denda</th>
                            <th class="text-center italic" >Deskripsi</th>
                            <th class="text-center italic" >Nominal</th>
                            <th class="text-center italic" >Keterangan</th>
                            <th class="text-center" width="10%"></th>
                            </thead>
                        </tr>
                        @forelse($dataDenda as $row)
                            <tr>
                                <td class="text-center italic" >{{$row->kode_denda}}</td>
                                <td class="text-center italic" >{{$row->deskripsi}}</td>
                                <td class="text-center italic" >{{$row->nominal}}</td>
                                <td class="text-center italic" >{{$row->keterangan}}</td>
                                <td class="text-center mr-1">
                                        <a href="#" class="btn btn-sm btn-text-primary btn-hover-primary btn-icon flaticon2-pen" wire:click="edit({{$row->id}})" title="edit">
                                        </a>
                                        <a href="#" wire:click="removeData({{$row->id}})" class="btn btn-sm btn-text-danger btn-icon btn-hover-danger ki ki-solid-minus">
                                        </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </table>
                    {{$dataDenda->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalForForm" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Denda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form>
                            <input type="text" hidden wire:model="idDenda">
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Deskripsi</label>
                                <input type="text" class="form-control" placeholder="Enter Description" name="deskripsi" id="deskripsi" wire:model="deskripsi">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Nominal</label>
                                <input type="text" class="form-control" placeholder="Enter Nominal" name="nominal" id="nominal" wire:model="nominal">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Keterangan</label>
                                <input type="text" class="form-control" placeholder="Enter Explanation" name="keterangan" id="keterangan" wire:model="keterangan">
                            </div>

                            <div class="form-group">
                                <a href="#" wire:click="simpan" class="btn btn-sm btn-text-primary btn-light-primary font-weight-bold mr-2">
                                    <i class="fa fa-envelope-open-text mr-2"></i>Save Change
                                </a>
                            </div>
                        </form>
                    </div>
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
