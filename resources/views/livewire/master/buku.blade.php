<div>
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">Buku</div>
            <div class="card-toolbar">
                <div class="card-toolbar">
                    @can('pegawai')
                    <button class="btn btn-primary" type="button" onclick="adddata()">New Add</button>
                    @endcan
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
                            <th class="text-center italic" >Kategori</th>
                            <th class="text-center italic" >Penerbit</th>
                            <th class="text-center italic" >Penulis</th>
                            <th class="text-center italic" >ISBN</th>
                            <th class="text-center italic" >Judul</th>
                            <th class="text-center italic" >Keterangan</th>
                            <th class="text-center"></th>
                            </thead>
                        </tr>
                        @forelse($databuku as $row)
                            <tr>
                                <td class="text-center italic" >{{$row->kode_buku}}</td>
                                <td class="text-center italic" >{{$row->kategori->deskripsi ?? ''}}</td>
                                <td class="text-center italic" >{{$row->penerbit}}</td>
                                <td class="text-center italic" >{{$row->penulis}}</td>
                                <td class="text-center italic" >{{$row->isbn}}</td>
                                <td class="text-center italic" >{{$row->judul}}</td>
                                <td class="text-center italic" >{{$row->keterangan}}</td>
                                <td class="text-center">
                                    @can('pegawai')
                                    <a href="#" wire:click="edit({{$row->id}})" class="btn btn-sm btn-text-primary btn-hover-primary btn-icon flaticon2-pen" title="edit">
                                    </a>
                                    <a href="#" wire:click="removeData({{$row->id}})" class="btn btn-sm btn-text-danger btn-icon btn-hover-danger ki ki-solid-minus">
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </table>
                    {{$databuku->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalForForm" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form>
                            <input type="text" hidden wire:model="idBuku">
                            <div class="form-group" data-select2-id="1">
                                <label class="col-md-4 col-form-label">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control" wire:model="kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($databuku_kategori as $row )
                                        <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Penerbit</label>
                                <input type="text" class="form-control" placeholder="Enter Name of Publisher" name="penerbit" id="penerbit" wire:model="penerbit">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Penulis</label>
                                <input type="text" class="form-control" placeholder="Enter Name of Writer" name="penulis" id="penulis" wire:model="penulis">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">ISBN</label>
                                <input type="text" class="form-control @error('isbn') is-invalid @enderror" placeholder="Enter ISBN" name="isbn" id="isbn" wire:model="isbn">
                                @error('isbn')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" placeholder="Enter Title" name="judul" id="judul" wire:model="judul">
                                @error('judul')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Harga Sewa</label>
                                <input type="text" class="form-control" placeholder="Enter Price" name="harga_sewa" id="harga_sewa" wire:model="harga_sewa">
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



</div>
@prepend('scripts')
    <script>
        function adddata()
        {
            $('#modalForForm').modal('show');
        }

        window.livewire.on('storeData', ()=>{
            $('#modalForForm').modal('hide');
        });
    </script>
@endprepend
