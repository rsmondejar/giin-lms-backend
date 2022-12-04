<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Department;

class DepartmentsTable extends DataTableComponent
{
    protected $model = Department::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Department::find($id)->delete();
        Flash::success('Department deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre del Departamento", "department_name")
                ->sortable()
                ->searchable(),
            Column::make("Acciones", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('departments.show', $row->id),
                        'editUrl' => route('departments.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
