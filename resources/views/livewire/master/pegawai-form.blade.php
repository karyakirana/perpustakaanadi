<div>
    <x-mikro.card-custom :title="__('Data Pegawai')" >
        <x-slot name="toolbar">
            <button class="btn btn-primary" wire:click="addData">Tambah Data</button>
        </x-slot>
        <livewire:table.daftar-pegawai-table />
    </x-mikro.card-custom>

    <x-mikro.modal-large id="pegawaiModal" :title="__('Pegawai Form')" wire:ignore.self>
        <form id="formPegawai">
            <div class="form-group row">
                <label class="col-form-label col-3">Nama</label>
                <div class="col-8">
                    <x-atom.input :name="__('nama')"  wire:model.defer="nama" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Gender</label>
                <div class="col-8">
                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror " wire:model.defer="gender">
                        <option>Dipilih</option>
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                    </select>
                    @error('gender') <span class="invalid-feedback">{{$message}}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Jenis Pengenal</label>
                <div class="col-3">
                    <x-atom.input :name="__('jenis_pengenal')"  wire:model.defer="jenis_pengenal" />
                </div>
                <label class="col-form-label col-2">ID Pengenal</label>
                <div class="col-3">
                    <x-atom.input :name="__('pengenal_id')"  wire:model.defer="pengenal_id" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Telepon</label>
                <div class="col-3">
                    <x-atom.input :name="__('telepon')"  wire:model.defer="telepon" />
                </div>
                <label class="col-form-label col-2">Email</label>
                <div class="col-3">
                    <x-atom.input :name="__('email')"  wire:model.defer="email" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Alamat</label>
                <div class="col-8">
                    <x-atom.input :name="__('alamat')"  wire:model.defer="alamat" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Keterangan</label>
                <div class="col-8">
                    <x-atom.input :name="__('keterangan')"  wire:model.defer="keterangan" />
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <button class="btn btn-warning " data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" wire:click="store">Simpan</button>
        </x-slot>
    </x-mikro.modal-large>

    <x-mikro.modal-large id="usersModal" :title="__('Password and Role')">
        <form id="formUsers">
            <div class="form-group row">
                <label class="col-form-label col-3">Username</label>
                <div class="col-8">
                    <x-atom.input :name="__('password')"  wire:model.defer="username" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Role</label>
                <div class="col-8">
                    <select id="role" class="form-control @error('role') is-invalid @enderror">
                        <option>Dipilih</option>
                        <option value="guest">Tamu</option>
                        <option value="pegawai">Pegawai</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Password</label>
                <div class="col-8">
                    <x-atom.input :name="__('password')" type="password"  wire:model.defer="password" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Password Confirmation</label>
                <div class="col-8">
                    <x-atom.input :name="__('password_confirmation')" type="password"  wire:model.defer="password_confirmation" />
                </div>
            </div>
        </form>
    </x-mikro.modal-large>

    @push('scripts')
        <script>
            Livewire.on('showPegawaiModal', ()=>{
                $("#pegawaiModal").modal('show')
            })

            Livewire.on('hidePegawaiModal', ()=>(
                $("#pegawaiModal").modal('hide')
            ))

            $('#pegawaiModal').on('hidden.bs.modal', function (e){
                Livewire.emit('resetForm')
            })
        </script>
    @endpush
</div>
