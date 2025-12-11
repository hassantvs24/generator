<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class BillMonth extends Model
{
    //use SoftDeletes;

    protected $table = 'bill_month';
    protected $primaryKey = 'billMonthID';
    protected $fillable = [
        'monthName', 'sector', 'userID'
    ];

    public function billing(){
        return $this->hasMany('App\Billing', 'billMonthID');
    }



    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
