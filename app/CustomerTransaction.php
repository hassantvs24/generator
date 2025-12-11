<?php

namespace App;

use App\Scopes\SectorScope;
use Illuminate\Database\Eloquent\Model;

class CustomerTransaction extends Model
{
    protected $table = 'customer_transaction';
    protected $primaryKey = 'cusTransactionID';
    protected $fillable = [
        'customerID', 'amountIN', 'amountOut', 'transactionType', 'descriptions', 'sector', 'userID'
    ];

    public function customer(){
        return $this->belongsTo('App\Customers', 'customerID');
    }
	
	public function user(){
        return $this->belongsTo('App\User', 'userID');
    }
    
    public function month_name($id){
        $table = Billing::find($id);
        
        return  date('M y',strtotime($table->billMonth['monthName']));
    }

    //***************Sector Scope******************
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SectorScope);
    }
    //***************/Sector Scope******************
}
