<?php

namespace App\DataTables;

use App\Models\Count;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CountDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $editBtn = '<a href="'.route('admin.count.edit', $query->id).'" class="btn btn-success">'.__('admin/common.edit').' <i class="fas fa-pen"></i></a>';
                $deleteBtn = '<a href="'.route('admin.count.destroy', $query->id).'" class="btn btn-danger delete-btn ml-2">'.__('admin/common.delete').' <i class="fas fa-trash"></i></a>';
                return $editBtn.$deleteBtn;
            })
            ->addColumn('status', function($query){
                if($query->status == 1)
                {
                    $button = '<div class="form-check form-switch">
                                <input class="form-check-input change-status" checked data-id="'.$query->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                </div>';
                }
                else
                {
                    $button = '<div class="form-check form-switch">
                                <input class="form-check-input change-status" data-id="'.$query->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                </div>';
                }
                return $button;
            })
            ->addColumn('icon', function($query){
                $icon = '<i class="'.$query->icon.' fa-2x" style="color: '.$query->icon_color.'"></i>';
                return $icon;
            })
            ->rawColumns(['action', 'status', 'icon'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Count $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('count-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title')->title(__('admin/count/count.title')),
            Column::make('quantity')->title(__('admin/count/count.quantity')),
            Column::make('icon')->title(__('admin/common.icon')),
            Column::make('status')->title(__('admin/common.status')),
            // Column::make('add your columns'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                  ->title(__('admin/common.action'))
                  ->exportable(false)
                  ->printable(false)
                  ->width(170)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Count_' . date('YmdHis');
    }
}
