<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Business;

class BusinessesTable extends DataTableComponent
{
    protected $model = Business::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Business::find($id)->delete();
        Flash::success('Business deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre empresa", "business_name")
                ->sortable()
                ->searchable(),
            Column::make("Direccion", "address")
                ->sortable()
                ->searchable(),
            Column::make("Ciudad", "city")
                ->sortable()
                ->searchable(),
            Column::make("Código Postal", "postal_code")
                ->sortable()
                ->searchable(),
            Column::make("País", "country")
                ->sortable()
                ->searchable(),
            Column::make("Teléfono físico", "phone")
                ->sortable()
                ->searchable(),
            Column::make("E-mail", "email")
                ->sortable()
                ->searchable(),
            Column::make("Website", "website")
                ->sortable()
                ->searchable(),
            Column::make("Logo", "logo")
                ->sortable()
                ->searchable(),

            Column::make("Acciones", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('businesses.show', $row->id),
                        'editUrl' => route('businesses.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
