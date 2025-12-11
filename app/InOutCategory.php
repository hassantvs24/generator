<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InOutCategory extends Model
{
    use SoftDeletes;

    protected $table = 'inoutcatergory';
    protected $primaryKey = 'inoutcatergoryID';
    protected $fillable = [
        'name', 'inOutType', 'sector', 'userID'
    ];


    public function scopeIncome($query)
    {
        return $query->where('inOutType', 'IN');
    }

    public function scopeExpanse($query)
    {
        return $query->where('inOutType', 'OUT');
    }

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
