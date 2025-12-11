<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $table = 'package';
    protected $primaryKey = 'packageID';
    protected $fillable = [
        'name', 'packageAmount', 'sector', 'userID'
    ];



    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }


    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
