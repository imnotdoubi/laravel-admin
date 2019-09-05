<?php

namespace App\Helpers\Web;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;

class Paginator extends LengthAwarePaginator {

    private $cid;

    public function __construct($cid,$items, $total, $perPage, $currentPage, array $options)
    {
        $this->cid = $cid;

        parent::__construct($items, $total, $perPage, $currentPage, $options);

        static::$currentPageResolver = function ($q){
            dd($q);
        };
    }


    public static function transfer($cid,LengthAwarePaginator $lengthAwarePaginator){
        return new static(
            $cid,
            collect($lengthAwarePaginator->items()),
            $lengthAwarePaginator->total(),
            $lengthAwarePaginator->perPage(),
            $lengthAwarePaginator->currentPage(),
            []
        );
    }

    public function url($page)
    {
        $routename=Route::currentRouteName();
        return route($routename,array_merge(
            $this->query,[
                'cid'=>$this->cid,
                'page'=>$page
            ]
        ));
    }
}
