<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;

    protected $table = 'area';
    protected $primaryKey = 'areaID';
    protected $fillable = [
        'name', 'sector', 'userID'
    ];

    public function customer(){
        return $this->belongsTo('App\Customers', 'areaID');
    }

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
