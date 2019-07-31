<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class ReleasePost extends BatchAction
{
    protected $action;

    public function __construct($status = 1)
    {
        $this->status = $status;
    }

    public function script()
    {
        $trans = [
            'delete_confirm' => trans('admin.delete_confirm'),
            'confirm'        => trans('admin.confirm'),
            'cancel'         => trans('admin.cancel'),
        ];

        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {

    swal({
        title: "确定操作?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "{$trans['confirm']}",
        showLoaderOnConfirm: true,
        cancelButtonText: "{$trans['cancel']}",
        preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    method: 'post',
                    url: '{$this->resource}/release',
                    data: {
                        ids:$.admin.grid.selected().join(),
                        status: {$this->status},
                        _token:'{$this->getToken()}'
                    },
                    success: function (data) {
                        $.pjax.reload('#pjax-container');

                        resolve(data);
                    }
                });
            });
        }
    }).then(function(result) {
        var data = result.value;
        if (typeof data === 'object') {
            if (data.status) {
                swal(data.message, '', 'success');
            } else {
                swal(data.message, '', 'error');
            }
        }
    });
});

EOT;
    }
    
//     public function script()
//     {
//         return <<<EOT
        
// $('{$this->getElementClass()}').on('click', function() {

//     $.ajax({
//         method: 'get',
//         url: '/admin/articles/release',
//         data: {
//             ids: $.admin.grid.selected().join(),
//             status: {$this->status},
//             _token:'{$this->getToken()}'
           
//         },
//         success: function () {
//             $.pjax.reload('#pjax-container');
//             toastr.success('操作成功');
//         }
//     });
// });

// EOT;

//     }
}
