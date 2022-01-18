<div>
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">Inventaris</div>
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
                            <th class="text-center italic" >Kode</th>
                            <th class="text-center italic" >Tanggal Perolehan</th>
                            <th class="text-center italic" >Status</th>
                            <th class="text-center italic" >Jenis</th>
                            <th class="text-center italic" >Deskripsi</th>
                            <th class="text-center italic" >Keterangan</th>
                            <th class="text-center">Action</th>
                            </thead>
                        </tr>
                        @forelse($datainventaris as $row)
                            <tr>
                                <td class="text-center italic" >{{$row->kode_inventaris}}</td>
                                <td class="text-center italic" >{{tanggalan_format($row->tgl_perolehan)}}</td>
                                <td class="text-center italic" >{{$row->status}}</td>
                                <td class="text-center italic" >{{$row->jenis}}</td>
                                <td class="text-center italic" >{{$row->deskripsi}}</td>
                                <td class="text-center italic" >{{$row->keterangan}}</td>
                                <td class="text-center">
                                    <a href="#" wire:click="edit({{$row->id}})" class="btn btn-sm btn-text-primary btn-hover-primary btn-icon flaticon2-pen" title="edit">
                                    </a>
                                    <a href="#" wire:click="removeData({{$row->id}})" class="btn btn-sm btn-text-danger btn-icon btn-hover-danger ki ki-solid-minus">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </table>
                    {{$datainventaris->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalForForm" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Inventaris</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form>
                            <input type="text" hidden wire:model="idInventaris">
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Tanggal Perolehan</label>
                                <x-nano.input-datepicker :hasError="$errors->has('tgl_perolehan')"
                                                         wire:model.defer="tgl_perolehan"
                                                         id="tgl_perolehan"/>
                                @error('tglPerubahan')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Status</label>
                                <input type="text" class="form-control" placeholder="Enter Name of Writer" name="status" id="status" wire:model="status">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Jenis</label>
                                <input type="text" class="form-control @error('isbn') is-invalid @enderror" placeholder="Enter ISBN" name="jenis" id="jenis" wire:model="jenis">
                                @error('jenis')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Deskripsi</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" placeholder="Enter Title" name="deskripsi" id="deskripsi" wire:model="deskripsi">
                                @error('deskripsi')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
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
            $('#tgl_perolehan').on('change', (e)=>{
                let date = $(this).data('#tgl_perolehan')
            @this.tgl_perolehan = e.target.value;
            })
        </script>
    @endpush
</div>
