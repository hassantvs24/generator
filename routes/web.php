<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//*********************************************************************************

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'MainController@index')->middleware('admin');

    //******************Billing*************************
    Route::get('bill', 'BillGenerateController@index')->middleware('admin');
    Route::post('bill/month/save', 'BillGenerateController@month_save');
    Route::get('bill/month/details/{id}', 'BillGenerateController@details');
    Route::get('bill/month/del/{id}', 'BillGenerateController@del_month');
    Route::post('bill/generate', 'BillGenerateController@generate');
    Route::post('bill/generate/edit', 'BillGenerateController@generate_edi');
    Route::get('bill/generate/del/{id}', 'BillGenerateController@generate_del');
    Route::get('bill/generate/print/{id}', 'BillGenerateController@generate_print');
    //******************/Billing*************************

    //******************Collection*************************
    Route::get('collection/new', 'Collection\NewCollectionController@index')->middleware('admin');
    Route::get('collection/payment/details/{id}', 'Collection\NewCollectionController@payment_details');
    Route::post('collection/payment', 'Collection\NewCollectionController@payment');
    Route::post('collection/payment/edit', 'Collection\NewCollectionController@payment_edit');
    Route::get('collection/payment/del/{id}', 'Collection\NewCollectionController@payment_del');
    Route::get('collection/due', 'Collection\DueCollectionController@index');
    Route::get('collection/due/details/{id}', 'Collection\DueCollectionController@payment_details');
    Route::get('collection/all', 'Collection\AllCollectionController@index');
    //******************/Collection*************************

    //******************SMS*************************
    Route::get('sms', 'SmsController@index')->middleware('admin');
    Route::post('sms', 'SmsController@sms_send')->middleware('admin');
    //******************/SMS*************************

    //******************Customer*************************
    Route::get('customer/new', 'Customer\CustomerController@index')->middleware('admin');
    Route::post('customer/save', 'Customer\CustomerController@save');
    Route::post('customer/edi', 'Customer\CustomerController@edit');
    Route::get('customer/del/{id}', 'Customer\CustomerController@del');
    Route::get('customer/details/{id}', 'Customer\CustomerController@details')->middleware('admin');
    Route::post('customer/service/save', 'Customer\CustomerController@service_save');
    Route::post('customer/service/edi', 'Customer\CustomerController@service_edi');
    Route::get('customer/service/del/{id}', 'Customer\CustomerController@service_del');
    Route::get('customer/service/activate/{id}', 'Customer\CustomerController@service_activate')->middleware('admin');
    Route::post('customer/balance/adjust', 'Customer\CustomerController@balance_adjust');
    Route::post('customer/balance/edi_adjust', 'Customer\CustomerController@balance_edi_adjust');
    Route::get('customer/balance/del/{id}', 'Customer\CustomerController@balance_del');
    Route::get('customer/complain-list', 'Customer\CustomerController@complain_list')->middleware('admin');
    Route::post('customer/complain', 'Customer\CustomerController@complain');
    Route::get('customer/complain/status/{id}', 'Customer\CustomerController@complain_status');
    Route::get('customer/complain/del/{id}', 'Customer\CustomerController@complain_del');

    Route::get('customer/category', 'Customer\CategoryController@index')->middleware('admin');
    Route::post('customer/category/save', 'Customer\CategoryController@save');
    Route::post('customer/category/edi', 'Customer\CategoryController@edit');
    Route::get('customer/category/del/{id}', 'Customer\CategoryController@del');
    //******************Customer*************************

    //******************Area*************************
    Route::get('area', 'AreaController@index')->middleware('admin');
    Route::post('area/save', 'AreaController@save');
    Route::post('area/edi', 'AreaController@edit');
    Route::get('area/del/{id}', 'AreaController@del');
    //******************/Area*************************

    //******************Package*************************
    Route::get('package', 'PackageController@index')->middleware('admin');
    Route::post('package/save', 'PackageController@save');
    Route::post('package/edi', 'PackageController@edit');
    Route::get('package/del/{id}', 'PackageController@del');
    //******************/Package*************************

    //******************Employee*************************
    Route::get('employee', 'EmployeeController@index')->middleware('admin');
    Route::post('employee/save', 'EmployeeController@save');
    Route::post('employee/edi', 'EmployeeController@edit');
    Route::get('employee/del/{id}', 'EmployeeController@del');
    //******************/Employee*************************

    //******************Salary*************************
    Route::get('salary/new', 'Salary\SalaryController@index')->middleware('admin');
    Route::post('salary/month', 'Salary\SalaryController@month_save');
    Route::get('salary/month/details/{id}', 'Salary\SalaryController@details');
    Route::get('salary/month/del/{id}', 'Salary\SalaryController@del_month');
    Route::post('salary/generate', 'Salary\SalaryController@generate');
    Route::post('salary/generate/edit', 'Salary\SalaryController@generate_edi');
    Route::get('salary/generate/del/{id}', 'Salary\SalaryController@generate_del');
    Route::get('salary/generate/print/{id}', 'Salary\SalaryController@generate_print');

    Route::get('salary/sheet', 'Salary\SheetController@index')->middleware('admin');
    Route::get('salary/payment/details/{id}', 'Salary\SheetController@payment_details');
    Route::post('salary/payment', 'Salary\SheetController@payment');
    Route::post('salary/payment/edit', 'Salary\SheetController@payment_edit');
    Route::get('salary/payment/del/{id}', 'Salary\SheetController@payment_del');

    Route::get('salary/details', 'Salary\DetailsController@index');
    Route::get('salary/details/single/{id}', 'Salary\DetailsController@payment_details');

    Route::get('salary/ledger', 'Salary\LedgerController@index');
    //******************/Salary*************************

    //******************Income*************************
    Route::get('income/new', 'Income\IncomeController@index')->middleware('admin');
    Route::post('income/save', 'Income\IncomeController@save');
    Route::post('income/edi', 'Income\IncomeController@edit');
    Route::get('income/del/{id}', 'Income\IncomeController@del');

    Route::get('income/category', 'Income\CategoryController@index')->middleware('admin');
    Route::post('income/category/save', 'Income\CategoryController@save');
    Route::post('income/category/edi', 'Income\CategoryController@edit');
    Route::get('income/category/del/{id}', 'Income\CategoryController@del');
    //******************/Income*************************

    //******************Expense*************************
    Route::get('expanse/new', 'Expense\ExpenseController@index')->middleware('admin');
    Route::post('expanse/save', 'Expense\ExpenseController@save');
    Route::post('expanse/edi', 'Expense\ExpenseController@edit');
    Route::get('expanse/del/{id}', 'Expense\ExpenseController@del');

    Route::get('expanse/category', 'Expense\CategoryController@index')->middleware('admin');
    Route::post('expanse/category/save', 'Expense\CategoryController@save');
    Route::post('expanse/category/edi', 'Expense\CategoryController@edit');
    Route::get('expanse/category/del/{id}', 'Expense\CategoryController@del');
    //******************/Expense*************************

    //******************Bank Book*************************
    Route::get('cashbook', 'CashbookController@index')->middleware('admin');
    Route::post('cashbook/in', 'CashbookController@cash_in');
    Route::post('cashbook/out', 'CashbookController@cash_out');

    Route::get('bank/book', 'Bank\BankbookController@index')->middleware('admin');
    Route::post('bank/book/in', 'Bank\BankbookController@deposit');
    Route::post('bank/book/out', 'Bank\BankbookController@withdraw');
    Route::post('bank/book/edi/in', 'Bank\BankbookController@deposit_edi');
    Route::post('bank/book/edi/out', 'Bank\BankbookController@withdraw_edi');
    Route::get('bank/book/del/{id}', 'Bank\BankbookController@del');

    Route::get('bank/info', 'Bank\BankInfoController@index')->middleware('admin');
    Route::post('bank/info/save', 'Bank\BankInfoController@save');
    Route::post('bank/info/edi', 'Bank\BankInfoController@edit');
    Route::get('bank/info/del/{id}', 'Bank\BankInfoController@del');
    //******************/Bank Book**************************


    //******************Reports*************************
    Route::get('reports/billing', 'Reports\BillingController@index')->middleware('admin');
    Route::post('reports/billing/customer_ledger', 'Reports\BillingController@customer_ledger');
    Route::post('reports/billing/all_customer_ledger', 'Reports\BillingController@all_customer_ledger');
    Route::post('reports/billing/due', 'Reports\BillingController@due');
    Route::post('reports/billing/collection', 'Reports\BillingController@collection');

    Route::get('reports/salary', 'Reports\SalaryController@index')->middleware('admin');
    Route::post('reports/salary/employee_ledger', 'Reports\SalaryController@employee_ledger');

    Route::get('reports/income', 'Reports\IncomeController@index')->middleware('admin');
    Route::post('reports/income/show', 'Reports\IncomeController@show');

    Route::get('reports/expanse', 'Reports\ExpanseController@index')->middleware('admin');
    Route::post('reports/expanse/show', 'Reports\ExpanseController@show');

    Route::get('reports/cashbook', 'Reports\CashbookController@index')->middleware('admin');
    Route::post('reports/cashbook/show', 'Reports\CashbookController@show');

    Route::get('reports/bankbook', 'Reports\BankbookController@index')->middleware('admin');
    Route::post('reports/bankbook/show', 'Reports\BankbookController@show');
    Route::post('reports/bankbook/bank_show', 'Reports\BankbookController@bank_show');

    Route::get('reports/profit-and-lose', 'Reports\ReportController@index')->middleware('admin');
    Route::post('reports/profit-and-lose', 'Reports\ReportController@profit_lose');
	
	Route::get('reports/customer', 'Reports\CustomerController@index')->middleware('admin');
    Route::post('reports/customer/show', 'Reports\CustomerController@show');
    //******************/Reports*************************


    //******************User*************************
    Route::get('users', 'Users\UsersController@index')->middleware('admin');
    Route::post('users/save', 'Users\UsersController@save');
    Route::post('users/edi', 'Users\UsersController@edit');
    Route::get('users/del/{id}', 'Users\UsersController@del');
    //******************/User*************************
	
	//******************Collector*************************
    Route::get('collector', 'CollectorController@index');
    Route::get('collector/payment/details/{id}', 'CollectorController@payment_details');
    //******************/Collector*************************

    Route::get('slip', 'SlipController@index');

//*********************************************************************************
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*############################### Start: Toggle Sidebar ###############################*/
Route::get('savestate', 'CommonController@saveState');
/*############################### End: Toggle Sidebar ###############################*/

Route::get('/catch', function () {
    Artisan::call('config:cache');
    Artisan::call('view:clear');
});
