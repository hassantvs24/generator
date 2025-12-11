<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banks extends Model
{
    use SoftDeletes;

    protected $table = 'banks';
    protected $primaryKey = 'bankID';
    protected $fillable = [
        'name', 'accountNo', 'branch', 'contactPerson', 'contact', 'openingBalance', 'balance', 'userID'
    ];

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
