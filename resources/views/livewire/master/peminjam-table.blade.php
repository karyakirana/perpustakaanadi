<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <x-atom.th-center>ID</x-atom.th-center>
                <x-atom.th-center>Nama</x-atom.th-center>
                <x-atom.th-center>Telepon</x-atom.th-center>
                <x-atom.th-center>Email</x-atom.th-center>
                <x-atom.th-center>Action</x-atom.th-center>
            </tr>
        </thead>
        <tbody>
            @forelse($datapeminjam as $row)
                <tr>
                    <td class="text-center">{{$row->kode_peminjam}}</td>
                    <td class="text-center">{{$row->nama}}</td>
                    <td class="text-center">{{$row->telepon}}</td>
                    <td class="text-center">{{$row->email}}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-clean btn-icon" wire:click="{{$row->id}}">show</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak Ada Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <x-mikro.modal-large id="exampleModal" :title="'Form Peminjam'" wire:ignore.self>

        <form>
            <input type="text" hidden wire:model.defer="formPeminjam.id">
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label">Nama</label>
                <div class="col-md-8">
                    <input type="text" class="form-control @error('formPeminjam.nama') is-invalid @enderror " name="nama"
                           wire:model.defer="formPeminjam.nama">
                    @error('formPeminjam.nama')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label">Jenis Pengenal</label>
                <div class="col-md-8">
                    <input type="text" class="form-control @error('formPeminjam.jenis') is-invalid @enderror" name="nama"
                           wire:model.defer="formPeminjam.jenis">
                    @error('formPeminjam.jenis')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label">Nomor Pengenal</label>
                <div class="col-md-8">
                    <input type="text" class="form-control @error('formPeminjam.pengenal') is-invalid @enderror" name="nama"
                           wire:model.defer="formPeminjam.pengenal">
                    @error('formPeminjam.pengenal')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label">Gender</label>
                <div class="col-md-8">
                    <input type="text" class="form-control @error('formPeminjam.gender') is-invalid @enderror" name="nama"
                           wire:model.defer="formPeminjam.gender">
                    @error('formPeminjam.gender')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label">Tempat Lahir</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="nama"
                           wire:model.defer="formPeminjam.tempatLahir">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label">Tanggal Lahir</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" wire:model.defer="formPeminjam.tglLahir">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label">Telepon</label>
                <div class="col-md-8">
                    <input type="text" class="form-control @error('formPeminjam.telepon') is-invalid @enderror" name="nama"
                           wire:model.defer="formPeminjam.telepon">
                    @error('formPeminjam.telepon')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label">Email</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" wire:model.defer="formPeminjam.email">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label">Alamat</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" wire:model.defer="formPeminjam.alamat">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label">Keterangan</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" wire:model.defer="formPeminjam.keterangan">
                </div>
            </div>
        </form>

        <x-slot name="footer">
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            @if(isset($formPeminjam['id']))
                <button type="button" class="btn btn-primary font-weight-bold" wire:click="update">Save changes</button>
            @else
                <button type="button" class="btn btn-primary font-weight-bold" wire:click="store">Save changes</button>
            @endif
        </x-slot>
    </x-mikro.modal-large>

    @push('scripts')
        <script>
            window.livewire.on('modalHide', ()=>{
                $('#exampleModal').modal('hide');
            });
        </script>
    @endpush
</div>
