<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;

class InOutTransaction extends Model
{
    protected $table = 'inouttransaction';
    protected $primaryKey = 'inouttransactionID';
    protected $fillable = [
        'inoutcatergoryID', 'amountIN', 'amountOut', 'transactionType', 'descriptions', 'sector', 'userID'
    ];

    public function category(){
        return $this->belongsTo('App\InOutCategory', 'inoutcatergoryID');
    }

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
