<?php

namespace App\Providers;

use App\Area;
use App\Bankbook;
use App\Banks;
use App\Billing;
use App\BillMonth;
use App\Cashbook;
use App\ComplainBox;
use App\CustomerCategory;
use App\Customers;
use App\CustomerTransaction;
use App\Employee;
use App\EmployeeTransaction;
use App\InOutCategory;
use App\InOutTransaction;
use App\Package;
use App\Salary;
use App\SalaryMonth;
use App\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //###################------###########################
        Area::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        Area::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        Bankbook::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        Bankbook::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        Banks::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        Banks::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        Billing::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        Billing::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        BillMonth::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        BillMonth::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        Cashbook::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        Cashbook::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        CustomerCategory::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        CustomerCategory::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        Customers::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        Customers::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        CustomerTransaction::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        CustomerTransaction::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        Employee::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        Employee::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        EmployeeTransaction::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        EmployeeTransaction::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        InOutCategory::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        InOutCategory::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        InOutTransaction::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        InOutTransaction::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        Package::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        Package::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        Salary::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        Salary::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        SalaryMonth::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        SalaryMonth::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################

        //###################------###########################
        Services::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });

        Services::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
			$model->sector = 'Generator';
        });
        //###################################################


        //###################------###########################
        ComplainBox::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
            $model->sector = 'Generator';
        });

        ComplainBox::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
            $model->sector = 'Generator';
        });
        //###################################################

    }
}
