<?php

namespace App\Models;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;

class CompanyData extends Model
{
    protected $table = 'wbsdb_company_datas';
    //
    public $timestamps = false;

    public function company()
    {
        return $this->hasOne(Company::class,'id','id');
    }
//删除关联数据方法 控制器中使用example：Company::where('id', $id)->first()->delete();
    //可以用 Eloquent 的 deleting 事件来实现

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($company){
            $company->company()->delete();
        });
    }
}
