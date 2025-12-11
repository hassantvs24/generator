<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use SoftDeletes;

    protected $table = 'customer';
    protected $primaryKey = 'customerID';
    protected $fillable = [
        'name', 'fatherName', 'motherName', 'contact', 'dob', 'nid', 'wordNo', 'address', 'primaryPhoto', 'balance', 'areaID', 'customerCatID', 'sector', 'userID'
    ];

    public function area(){
        return $this->belongsTo('App\Area', 'areaID');
    }

    public function category(){
        return $this->belongsTo('App\CustomerCategory', 'customerCatID');
    }

    public function service(){
        return $this->hasMany('App\Services', 'customerID');
    }

    public function transaction(){
        return $this->hasMany('App\CustomerTransaction', 'customerID');
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = db_date($value);
    }

    public function complain(){
        return $this->hasMany('App\ComplainBox', 'customerID');
    }


    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
