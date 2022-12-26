<?php

namespace App\DataTables;

use App\Traits\DataTableButtons;
use App\Traits\DataTableRender;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

/**
 * Class BaseDataTable
 * @package App\DataTables
 */
class BaseDataTable extends DataTable
{
    use DataTableRender;
    use DataTableButtons;

    /** @var string Date Format d/m/Y */
    protected const DATE_FORMAT_DMY_SLASH = 'd/m/Y';

    /** @var bool Show Action Column? */
    protected bool $showActionColumn = true;

    /** @var int Order by Column */
    protected int $orderByColumn = 0;

    /** @var string Order direcction: "asc" or "desc" */
    protected string $orderDirection = 'desc';

    /** @var bool State Save */
    protected bool $stateSave = true;

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        $builder = $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Bfrtlip',
                'order' => [[$this->orderByColumn, $this->orderDirection]],
                'pageLength' => 25,
                "lengthMenu" => [[15, 25, 50, 100], [15, 25, 50, 100]],
                'scrollX' => true,
                'buttons' => self::defaultButtons(),
                'stateSave' => $this->stateSave,
                "language" => [
                    "url" => "/vendor/datatables/plug-ins/1.10.16/i18n/Spanish.json"
                ]
            ]);

        if ($this->showActionColumn) {
            $builder->addAction(['width' => '120px', 'printable' => false, 'title' => 'Acciones']);
        }

        return $builder;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return BaseDataTable::class . '_' . time();
    }
}
