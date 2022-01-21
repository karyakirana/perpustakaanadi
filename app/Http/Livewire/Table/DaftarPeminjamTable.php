<?php

namespace App\Http\Livewire\Table;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Master\Peminjam;

class DaftarPeminjamTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Column Name'),
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
