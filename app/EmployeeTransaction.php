<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;

class EmployeeTransaction extends Model
{
    protected $table = 'employee_transaction';
    protected $primaryKey = 'empTransactionID';
    protected $fillable = [
        'employeeID', 'amountIN', 'amountOut', 'transactionType', 'descriptions', 'sector', 'userID'
    ];

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
