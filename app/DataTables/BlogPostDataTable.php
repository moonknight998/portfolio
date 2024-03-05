<?php

namespace App\DataTables;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogPostDataTable extends DataTable
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
                $editBtn = '<a href="'.route('blog.blog_post.edit', $query->id).'" class="btn btn-success">'.__('admin/common.edit').' <i class="fas fa-pen"></i></a>';
                $deleteBtn = '<a href="'.route('blog.blog_post.destroy', $query->id).'" class="btn btn-danger delete-btn ml-2">'.__('admin/common.delete').' <i class="fas fa-trash"></i></a>';
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
            ->addColumn('thumbnail', function($query){
                $logo = '<div class="container" style="display: flex; justify-content: center; width: 80px">
                            <img class="img-thumbnail" src="'.$query->thumbnail.'" style="object-fit: contain"></img>
                            </div>';
                return $logo;
            })
            ->addIndexColumn()
            ->rawColumns(['action','status', 'thumbnail'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(BlogPost $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('blogpost-table')
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
            // Column::make('id')->width(50),
            Column::make('index')->title(__('admin/common.index'))->data('DT_RowIndex')->width(100)->orderable(false)->searchable(false),
            Column::make('post_title')->width(750)->title(__('admin/blog/blog.post_title'))->orderable(false)->searchable(false),
            // Column::make('work_title')->title(__('admin/team/team.work_title'))->orderable(false)->searchable(false),
            Column::make('thumbnail')->title(__('admin/common.thumbnail'))->orderable(false)->searchable(false),
            Column::make('status')->title(__('admin/common.status'))->width(170)->orderable(false)->searchable(false)->addClass('text-center'),
            // Column::make('created_at')->title(__('admin/common.created_at')),
            // Column::make('updated_at')->title(__('admin/common.updated_at')),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(170)
                  ->addClass('text-center')
                  ->title(__('admin/common.action')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BlogPost_' . date('YmdHis');
    }
}
