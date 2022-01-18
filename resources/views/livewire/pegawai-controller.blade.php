<div>
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">Pegawai</div>
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
                            <th class="text-center italic" >Nama</th>
                            <th class="text-center italic" >Gender</th>
                            <th class="text-center italic" >Jenis Pengenal</th>
                            <th class="text-center italic" >Pengenal ID</th>
                            <th class="text-center italic" >Telepon</th>
                            <th class="text-center italic" >Alamat</th>
                            <th class="text-center" width="10%"></th>
                            </thead>
                        </tr>
                        @forelse($dataPegawai as $row)
                            <tr>
                                <td class="text-center italic" >{{$row->kode}}</td>
                                <td class="text-center italic" >{{$row->nama}}</td>
                                <td class="text-center italic" >{{$row->gender}}</td>
                                <td class="text-center italic" >{{$row->jenis_pengenal}}</td>
                                <td class="text-center italic" >{{$row->pengenal_id}}</td>
                                <td class="text-center italic" >{{$row->telepon}}</td>
                                <td class="text-center italic" >{{$row->alamat}}</td>
                                <td class="text-center">
                                    <a href="#" wire:click="edit({{$row->id}})" class="btn btn-sm btn-text-primary btn-hover-primary btn-icon flaticon2-pen" title="edit">
                                    </a>
                                    <a href="#" wire:click="removeData({{$row->id}})" class="btn btn-sm btn-text-danger btn-icon btn-hover-danger ki ki-solid-minus">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="8">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </table>
                    {{$dataPegawai->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalForForm" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form>
                            <input type="text" hidden wire:model="idPegawai">
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Enter Name" name="nama" id="nama" wire:model="nama">
                                @error('nama')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Gender</label>
                                <input type="text" class="form-control" placeholder="Enter Gender" name="gender" id="gender" wire:model="gender">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Jenis Pengenal</label>
                                <input type="text" class="form-control @error('jenis_pengenal') is-invalid @enderror" placeholder="Enter Type" name="jenis_pengenal" id="jenis_pengenal" wire:model="jenis_pengenal">
                                @error('jenis_pengenal')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Pengenal ID</label>
                                <input type="text" class="form-control @error('pengenal_id') is-invalid @enderror" placeholder="Enter ID" name="pengenal_id" id="pengenal_id" wire:model="pengenal_id">
                                @error('pengenal_id')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" placeholder="Enter Place of Birth" name="tempat_lahir" id="tempat_lahir" wire:model="tempat_lahir">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control" placeholder="Enter Date of Birth" name="tgl_lahir" id="tgl_lahir" wire:model="tgl_lahir">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Telepon</label>
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror" placeholder="Enter Telephone" name="telepon" id="telepon" wire:model="telepon">
                                @error('telepon')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Email</label>
                                <input type="text" class="form-control" placeholder="Enter Email" name="email" id="email" wire:model="email">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="Enter Address" name="alamat" id="alamat" wire:model="alamat">
                                @error('alamat')
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
        </script>
    @endpush

</div>
