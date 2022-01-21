<?php

namespace App\Http\Livewire\Table;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DaftarUsersApprovalTable extends DataTableComponent
{
    protected $listeners = ['refreshUsersTable'=>'$refresh'];

    public function columns(): array
    {
        return [
            Column::make(),
            Column::make('Nama', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Username'),
            Column::make('Role')
                ->sortable()
                ->searchable(),
            Column::make('Created At')
                ->sortable(),
            Column::make()
        ];
    }

    public function query(): Builder
    {
        return User::query()
            ->whereNull('userable_type');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.daftar_users_approval_table';
    }
}
