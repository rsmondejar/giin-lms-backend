<?php

namespace App\DataTables;

use App\Models\Business;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;

class BusinessDataTable extends BaseDataTable
{
    protected string $orderDirection = 'asc';

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('action', 'businesses.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Business $model
     * @return Builder
     */
    public function query(Business $model): Builder
    {
        return $model->newQuery();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            'business_name' => [
                'data' => 'business_name',
                'name' => 'business_name',
                'title' => 'Nombre empresa',
                'visible' => true,
                'orderable' => true,
                'render' => null
            ],
            'address' => [
                'data' => 'address',
                'name' => 'address',
                'title' => 'Dirección',
                'visible' => false,
                'orderable' => true,
                'render' => null
            ],
            'city' => [
                'data' => 'city',
                'name' => 'city',
                'title' => 'Ciudad',
                'visible' => true,
                'orderable' => true,
                'render' => null
            ],
            'postal_code' => [
                'data' => 'postal_code',
                'name' => 'postal_code',
                'title' => 'Código Postal',
                'visible' => false,
                'orderable' => true,
                'render' => null
            ],
            'country' => [
                'data' => 'country',
                'name' => 'country',
                'title' => 'País',
                'visible' => true,
                'orderable' => true,
                'render' => null
            ],
            'phone' => [
                'data' => 'phone',
                'name' => 'phone',
                'title' => 'Teléfono físico',
                'visible' => false,
                'orderable' => true,
                'render' => null
            ],
            'email' => [
                'data' => 'email',
                'name' => 'email',
                'title' => 'E-mail',
                'visible' => false,
                'orderable' => true,
                'render' => null
            ],
            'website' => [
                'data' => 'website',
                'name' => 'website',
                'title' => 'Website',
                'visible' => false,
                'orderable' => true,
                'render' => null
            ],
            'logo' => [
                'data' => 'logo_path',
                'name' => 'logo_path',
                'title' => 'Logo',
                'visible' => true,
                'orderable' => false,
                'searchable' => false,
                'render' => self::renderImage()
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'businesses_datatable_' . time();
    }
}
