<?php

namespace James\Admin;

use Encore\Admin\Grid as Grids;

class Grid extends Grids
{
    /**
     * Add `actions` column for grid.
     *
     * @return void
     */
    protected function appendActionsColumn()
    {
        if (!$this->option('show_actions')) {
            return;
        }

        $this->addColumn('__actions__', trans('admin.action'))
            ->displayUsing(Actions::class, [$this->actionsCallback]);
    }
}
