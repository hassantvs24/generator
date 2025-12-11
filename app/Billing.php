<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billing';
    protected $primaryKey = 'billingID';
    protected $fillable = [
        'billMonthID', 'servicesID', 'amount', 'payment', 'status', 'serviceCharge', 'sector', 'userID'
    ];

    public function billMonth(){
        return $this->belongsTo('App\BillMonth', 'billMonthID');
    }

    public function services(){
        return $this->belongsTo('App\Services', 'servicesID');
    }



    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
