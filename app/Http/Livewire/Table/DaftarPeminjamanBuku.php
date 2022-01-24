<?php

namespace App\Http\Livewire\Table;

use App\Models\Transaksi\Peminjaman;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DaftarPeminjamanBuku extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Kode', 'kode_peminjaman')
                ->searchable()
                ->sortable(),
            Column::make('Peminjam', 'user.peminjam')
                ->searchable()
                ->sortable(),
            Column::make('Tgl Pinjam', 'tgl_pinjam')
                ->searchable()
                ->sortable(),
            Column::make('Tgl Kembali', 'tgl_kembali')
                ->searchable()
                ->sortable(),
            Column::make('Status')
                ->searchable()
                ->sortable(),
            Column::make(),
        ];
    }

    public function query(): Builder
    {
        return Peminjaman::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.daftar_peminjaman_buku';
    }

    public function edit($id)
    {
        return redirect()->to('/transaksi/peminjaman/edit/'.$id);
    }

    public function updateStatus(Peminjaman $peminjaman)
    {
        $peminjaman->update([
            'status'=>'approved'
        ]);
    }
}
