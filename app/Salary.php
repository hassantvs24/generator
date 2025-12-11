<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salary';
    protected $primaryKey = 'salaryID';
    protected $fillable = [
        'salaryMonthID', 'employeeID', 'amount', 'sector', 'userID'
    ];

    public function salaryMonth(){
        return $this->belongsTo('App\SalaryMonth', 'salaryMonthID');
    }

    public function employee(){
        return $this->belongsTo('App\Employee', 'employeeID');
    }

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
