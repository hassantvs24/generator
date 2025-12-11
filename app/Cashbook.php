<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;

class Cashbook extends Model
{

    protected $table = 'cashbook';
    protected $primaryKey = 'cashbookID';
    protected $fillable = [
        'amountIN', 'amountOut', 'transactionType', 'descriptions', 'sector', 'userID'
    ];

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
