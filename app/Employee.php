<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employee';
    protected $primaryKey = 'employeeID';
    protected $fillable = [
        'name', 'fatherName', 'motherName', 'contact', 'dob', 'nid', 'address', 'primaryPhoto', 'balance', 'salary', 'position', 'status', 'sector', 'userID'
    ];

    public function salary(){
        return $this->hasMany('App\salary', 'employeeID');
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = db_date($value);
    }

    public function transaction(){
        return $this->hasMany('App\EmployeeTransaction', 'employeeID');
    }

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
