<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;

class ComplainBox extends Model
{
    protected $table = 'complain_box';
    protected $primaryKey = 'complainID';
    protected $fillable = [
        'customerID', 'descriptions', 'status', 'sector', 'userID'
    ];

    public function customers(){
        return $this->belongsTo('App\Customers', 'customerID');
    }

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
