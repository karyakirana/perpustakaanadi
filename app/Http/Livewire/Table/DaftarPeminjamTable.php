<?php

namespace App\Http\Livewire\Table;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Master\Peminjam;

class DaftarPeminjamTable extends DataTableComponent
{

    protected $listeners =['refreshPeminjamTable'=>'$refresh'];

    public function columns(): array
    {
        return [
            Column::make('ID', 'kode_peminjam')
                ->searchable()
                ->sortable(),
            Column::make('Nama')
                ->searchable()
                ->sortable(),
            Column::make('Gender')
                ->sortable(),
            Column::make('Email'),
            Column::make('Telepon'),
            Column::make(''),
        ];
    }

    public function query(): Builder
    {
        return Peminjam::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.daftar_peminjam_table';
    }
}
