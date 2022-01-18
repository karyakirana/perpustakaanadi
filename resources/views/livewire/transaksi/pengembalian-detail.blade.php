<div>
    <div>
        @if(session()->has('message'))
            <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                <div class="alert-text">{{ session('message') }}</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                    </button>
                </div>
            </div>
        @endif

        <x-mikro.card-custom :title="'Pengembalian Buku'">
            <x-slot name="toolbar">
                <button class="btn btn-success" wire:click="storeAll">SIMPAN</button>
            </x-slot>

            <div class="row">
                <div class="col-md-8">
                    <form class="form">
                        <input type="text" hidden wire:model.defer="customerId">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label ml-3">Peminjam</label>
                                    <div class="col-7">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('customerId') is-invalid @enderror" wire:model.defer="customer" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" onclick="showPeminjam()">Pilih</button>
                                            </div>
                                            @error('customerId')
                                            <span class="invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-4 col-form-label ml-3">Tgl Pinjam</label>
                                    <div class="col-7">
                                        <x-nano.input-datepicker
                                            :hasError="$errors->has('tglKembali')"
                                            wire:model.defer="tglPinjam" id="tglPinjam"/>
                                        @error('tglPinjam')
                                        <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-4 col-form-label ml-3">Keterangan</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control" wire:model.defer="keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label ml-3">Pembuat</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control" value="{{auth()->user()->name}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-4 col-form-label ml-3">Tgl Kembali</label>
                                    <div class="col-7">
                                        <x-nano.input-datepicker :hasError="$errors->has('tglKembali')"
                                                                 wire:model.defer="tglKembali"
                                                                 id="tglKembali"/>
                                        @error('tglKembali')
                                        <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <x-atom.th-center :width="'10%'">NO</x-atom.th-center>
                            <x-atom.th-center :width="'30%'">Item</x-atom.th-center>
                            <x-atom.th-center :width="'10%'">Jumlah</x-atom.th-center>
                            <x-atom.th-center :width="'15%'">Action</x-atom.th-center>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($detailPengembalian as $index => $item)
                            <tr>
                                <x-atom.td-format :align="'center'">{{ $loop->iteration }}</x-atom.td-format>
                                <x-atom.td-format>{{ $item['judulBuku'] }}</x-atom.td-format>
                                <x-atom.td-format :align="'center'">{{ $item['jumlah'] }}</x-atom.td-format>
                                <x-atom.td-format :align="'center'">
                                    <button class="btn btn-clean" wire:click="editItemTable({{$index}})">Edit</button>
                                    <button class="btn btn-clean" wire:click="deleteItem({{$index}})">Delete</button>
                                </x-atom.td-format>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="4">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="border border-1">
                        <form>
                            <input type="text" hidden wire:model.defer="idBuku">
                            <div class="form-group row mt-4">
                                <label class="col-4 col-form-label ml-3">ID</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" wire:model.defer="kodeBuku" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-4 col-form-label ml-3">Item</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" wire:model.defer="deskripsiBuku" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-4 col-form-label ml-3">Jumlah</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" wire:model.defer="jumlahBuku">
                                </div>
                            </div>
                            <div class="form-group text-center mt-5">
                                <button type="button" class="btn btn-primary" onclick="showModalBuku()">Add Produk</button>
                                @if($update)
                                    <button class="btn btn-success" type="button" wire:click="updateItem">Update</button>
                                @else
                                    <button class="btn btn-success" type="button" wire:click="setItemToTable">Save</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </x-mikro.card-custom>
        @push('scripts')
            <script>
                $('#tglPinjam').on('change', (e)=>{
                    let date = $(this).data('#tglPinjam')
                @this.tglPinjam = e.target.value;
                })
                $('#tglKembali').on('change', (e)=>{
                    let date = $(this).data('#tglKembali')
                @this.tglKembali = e.target.value;
                })
            </script>
        @endpush
    </div>

</div>
