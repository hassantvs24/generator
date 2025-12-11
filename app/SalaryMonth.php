<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryMonth extends Model
{
    use SoftDeletes;

    protected $table = 'salary_month';
    protected $primaryKey = 'salaryMonthID';
    protected $fillable = [
        'monthName', 'sector', 'userID'
    ];

    public function salary(){
        return $this->hasMany('App\salary', 'salaryMonthID');
    }


    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
