<?php

namespace App\Http\Livewire\Table;

use App\Models\Master\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DaftarPegawaiTable extends DataTableComponent
{

    protected $listeners = ['refreshPegawaiTable'=>'$refresh'];

    public function columns(): array
    {
        return [
            Column::make('ID')
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
        return Pegawai::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.daftar_pegawai_table';
    }
}
