<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;

class Bankbook extends Model
{
    protected $table = 'bankbook';
    protected $primaryKey = 'bankbookID';
    protected $fillable = [
        'bankID', 'amountIN', 'amountOut', 'transactionType', 'descriptions', 'sector', 'userID'
    ];

    public function bank(){
        return $this->belongsTo('App\Banks', 'bankID');
    }

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
