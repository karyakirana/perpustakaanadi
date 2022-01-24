<x-metronics-layout>
    <div class="row mt-5">
        <div class="col-6">
            <x-mikro.card-custom :title="__('Peminjaman Buku')">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Peminjam</th>
                            <th class="text-center">Tgl Pinjam</th>
                            <th class="text-center">Tgl Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman as $item)
                            <tr>
                                <td class="text-center">{{$item->kode_peminjaman}}</td>
                                <td class="text-center">{{$item->peminjamPerson->nama}}</td>
                                <td class="text-center">{{tanggalan_format($item->tgl_pinjam)}}</td>
                                <td class="text-center">{{tanggalan_format($item->tgl_kembali)}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </x-mikro.card-custom>
        </div>
        <div class="col-6">
            <x-mikro.card-custom :title="__('Pengembalian Buku')">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Peminjam</th>
                        <th class="text-center">Tgl Pinjam</th>
                        <th class="text-center">Tgl Kembali</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($pengembalian as $item)
                        <tr>
                            <td class="text-center">{{$item->kode_pengembalian}}</td>
                            <td class="text-center">{{$item->peminjamPerson->nama}}</td>
                            <td class="text-center">{{tanggalan_format($item->tgl_pinjam)}}</td>
                            <td class="text-center">{{tanggalan_format($item->tgl_kembali)}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </x-mikro.card-custom>
        </div>
    </div>

</x-metronics-layout>
