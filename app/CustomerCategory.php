<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerCategory extends Model
{
    use SoftDeletes;

    protected $table = 'customer_category';
    protected $primaryKey = 'customerCatID';
    protected $fillable = [
        'name', 'sector', 'userID'
    ];

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
