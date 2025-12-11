<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->

                    <li class="{{ (Request::is('/') ? 'active' : '') }}"><a href="{{action('MainController@index')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

                    <li class="navigation-divider"></li>

                    <li class="{{ (Request::is('bill') ? 'active' : '') }}"><a href="{{action('BillGenerateController@index')}}"><i class="icon-calculator2"></i> <span>Bill Generate</span></a></li>
                    <li class="{{ (Request::is('collection/*', 'collection') ? 'active' : '') }}"><a href="#"><i class="icon-folder-download"></i> <span>Collection</span></a>
                        <ul>
                            <li class="{{ (Request::is('collection/new') ? 'active' : '') }}"><a href="{{action('Collection\NewCollectionController@index')}}"><i class="icon-diamond3"></i> <span>Bill Collection</span></a></li>
                            <li class="{{ (Request::is('collection/due') ? 'active' : '') }}"><a href="{{action('Collection\DueCollectionController@index')}}"><i class="icon-diamond3"></i> <span>Collection Details</span></a></li>
                            <li class="{{ (Request::is('collection/all') ? 'active' : '') }}"><a href="{{action('Collection\AllCollectionController@index')}}"><i class="icon-diamond3"></i> <span>Collection Ledger</span></a></li>
                        </ul>
                    </li>
                    <li class="{{ (Request::is('sms') ? 'active' : '') }}"><a href="{{action('SmsController@index')}}"><i class="icon-mobile"></i> <span>SMS</span></a></li>

                    <li class="navigation-divider"></li>

                    <li class="{{ (Request::is('customer/*', 'customer') ? 'active' : '') }}">
                        <a href="#"><i class="icon-users4"></i> <span>All Customer</span></a>
                        <ul>
                            <li class="{{ (Request::is('customer/new') ? 'active' : '') }}"><a href="{{action('Customer\CustomerController@index')}}"><i class="icon-diamond3"></i> <span>Customer List</span></a></li>
                            <li class="{{ (Request::is('customer/category') ? 'active' : '') }}"><a href="{{action('Customer\CategoryController@index')}}"><i class="icon-diamond3"></i> <span>Customer Category</span></a></li>
                            <li class="{{ (Request::is('customer/complain-list') ? 'active' : '') }}"><a href="{{action('Customer\CustomerController@complain_list')}}"><i class="icon-diamond3"></i> <span>Customer Complain</span></a></li>
                        </ul>
                    </li>
                    <li class="{{ (Request::is('area') ? 'active' : '') }}"><a href="{{action('AreaController@index')}}"><i class="icon-pin"></i> <span>All Areas</span></a></li>
                    <li class="{{ (Request::is('package') ? 'active' : '') }}"><a href="{{action('PackageController@index')}}"><i class="icon-gift"></i> <span>All Package</span></a></li>

                    <li class="navigation-divider"></li>

                    <li class="{{ (Request::is('employee') ? 'active' : '') }}"><a href="{{action('EmployeeController@index')}}"><i class="icon-user-tie"></i> <span>All Employee</span></a></li>
                    <li class="{{ (Request::is('salary/*', 'salary') ? 'active' : '') }}"><a href="#"><i class="icon-vcard"></i> <span>Salary</span></a>
                        <ul>
                            <li class="{{ (Request::is('salary/new') ? 'active' : '') }}"><a href="{{action('Salary\SalaryController@index')}}"><i class="icon-diamond3"></i> <span>Generate Salary</span></a></li>
                            <li class="{{ (Request::is('salary/sheet') ? 'active' : '') }}"><a href="{{action('Salary\SheetController@index')}}"><i class="icon-diamond3"></i> <span>Salary Pay</span></a></li>
                            <li class="{{ (Request::is('salary/details') ? 'active' : '') }}"><a href="{{action('Salary\DetailsController@index')}}"><i class="icon-diamond3"></i> <span>Salary Details</span></a></li>
                            <li class="{{ (Request::is('salary/ledger') ? 'active' : '') }}"><a href="{{action('Salary\LedgerController@index')}}"><i class="icon-diamond3"></i> <span>Salary Ledger</span></a></li>
                        </ul>
                    </li>

                    <li class="navigation-divider"></li>

                    <li class="{{ (Request::is('income/*', 'income') ? 'active' : '') }}"><a href="#"><i class="icon-database-insert"></i> <span>Other Income</span></a>
                        <ul>
                            <li class="{{ (Request::is('income/new') ? 'active' : '') }}"><a href="{{action('Income\IncomeController@index')}}"><i class="icon-diamond3"></i> <span>New Income</span></a></li>
                            <li class="{{ (Request::is('income/category') ? 'active' : '') }}"><a href="{{action('Income\CategoryController@index')}}"><i class="icon-diamond3"></i> <span>Income Category</span></a></li>
                        </ul>
                    </li>
                    <li class="{{ (Request::is('expanse/*', 'expanse') ? 'active' : '') }}"><a href="#"><i class="icon-database-export"></i> <span>Other Expense</span></a>
                        <ul>
                            <ul>
                                <li class="{{ (Request::is('expanse/new') ? 'active' : '') }}"><a href="{{action('Expense\ExpenseController@index')}}"><i class="icon-diamond3"></i> <span>New Expense</span></a></li>
                                <li class="{{ (Request::is('expanse/category') ? 'active' : '') }}"><a href="{{action('Expense\CategoryController@index')}}"><i class="icon-diamond3"></i> <span>Expense Category</span></a></li>
                            </ul>
                        </ul>
                    </li>
                    <li class="{{ (Request::is('cashbook') ? 'active' : '') }}"><a href="{{action('CashbookController@index')}}"><i class="icon-coin-dollar"></i> <span>Cash Book</span></a></li>
                    <li class="{{ (Request::is('bank/*', 'bank') ? 'active' : '') }}"><a href="#"><i class="icon-piggy-bank"></i> <span>Bank Book</span></a>
                        <ul>
                            <li class="{{ (Request::is('bank/book') ? 'active' : '') }}"><a href="{{action('Bank\BankbookController@index')}}"><i class="icon-diamond3"></i> <span>Bank Book</span></a></li>
                            <li class="{{ (Request::is('bank/info') ? 'active' : '') }}"><a href="{{action('Bank\BankInfoController@index')}}"><i class="icon-diamond3"></i> <span>Bank Info</span></a></li>
                        </ul>
                    </li>


                    <li class="navigation-divider"></li>

                    <li class="{{ (Request::is('reports/*', 'reports') ? 'active' : '') }}"><a href="#"><i class="icon-stats-growth"></i> <span>Reports</span></a>
                        <ul>
                            <li class="{{ (Request::is('reports/billing') ? 'active' : '') }}"><a href="{{action('Reports\BillingController@index')}}"><i class="icon-diamond3"></i> <span>Billing</span></a></li>
                            <li class="{{ (Request::is('reports/salary') ? 'active' : '') }}"><a href="{{action('Reports\SalaryController@index')}}"><i class="icon-diamond3"></i> <span>Salary</span></a></li>
                            <li class="{{ (Request::is('reports/income') ? 'active' : '') }}"><a href="{{action('Reports\IncomeController@index')}}"><i class="icon-diamond3"></i> <span>Income</span></a></li>
                            <li class="{{ (Request::is('reports/expanse') ? 'active' : '') }}"><a href="{{action('Reports\ExpanseController@index')}}"><i class="icon-diamond3"></i> <span>Expanse</span></a></li>
                            <li class="{{ (Request::is('reports/cashbook') ? 'active' : '') }}"><a href="{{action('Reports\CashbookController@index')}}"><i class="icon-diamond3"></i> <span>Cash Book</span></a></li>
                            <li class="{{ (Request::is('reports/bankbook') ? 'active' : '') }}"><a href="{{action('Reports\BankbookController@index')}}"><i class="icon-diamond3"></i> <span>Bank Book</span></a></li>
                            <li class="{{ (Request::is('reports/profit-and-lose') ? 'active' : '') }}"><a href="{{action('Reports\ReportController@index')}}"><i class="icon-diamond3"></i> <span>Profit & Lose</span></a></li>
							<li class="{{ (Request::is('reports/customer') ? 'active' : '') }}"><a href="{{action('Reports\CustomerController@index')}}"><i class="icon-diamond3"></i> <span>Customer</span></a></li>
                        </ul>
                    </li>
                    <li class="{{ (Request::is('users') ? 'active' : '') }}"><a href="{{action('Users\UsersController@index')}}"><i class="icon-users"></i> <span>All Users</span></a></li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>