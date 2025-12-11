<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
	use SoftDeletes;
	
    protected $table = 'services';
    protected $primaryKey = 'servicesID';
    protected $fillable = [
        'dishType', 'dishCard', 'dishBox', 'dishP', 'ispPackage', 'light', 'fan', 'printer', 'computer', 'stabilizer', 'other', 'packageID', 'customerID', 'billingAmount', 'status', 'sector', 'userID'
    ];

    public function customers(){
        return $this->belongsTo('App\Customers', 'customerID');
    }

    public function package(){
        return $this->belongsTo('App\Package', 'packageID');
    }

    public function billing(){
        return $this->hasMany('App\Billing', 'servicesID');
    }

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************

}
