<?php

use Illuminate\Support\Facades\Route;


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




Route::get('/', 'HomeController@home');
Route::match(['GET', 'POST'], '/test-box', 'TestController@box')->name('test.box');
Route::match(['GET', 'POST'], '/test-export', 'TestController@export')->name('test.export');

Route::get('/test/{id}', 'TestController@index')->name('test');
Route::get('/test-all/{id}', 'TestController@all')->name('test-all');
Route::get('/test-distributor', 'TestController@distributor')->name('test-distributor');
Route::get('/test-distributor-date', 'TestController@distributorByDate')->name('test-distributor');


Route::get('/pass', function () {
    $pass = bcrypt('admin');
    dd($pass);
});




Route::match(['get', 'post'], 'login', 'AuthController@login')->name('login');
Route::match(['get', 'post'], 'logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    // XXX farmer routes
    Route::match(['get', 'post'], 'farmers', 'Admin\FarmerController@addFarmer')->name('admin.farmer');
    Route::get('farmer-list', 'Admin\FarmerController@listFarmer')->name('list.farmer');
    Route::post('farmer-list-by-center', 'Admin\FarmerController@listFarmerByCenter')->name('list.farmer.bycenter');
    Route::match(['get', 'post'], 'farmer/update', 'Admin\FarmerController@updateFarmer')->name('update.farmer')->middleware('authority');
    Route::get('farmer/delete/{id}', 'Admin\FarmerController@deleteFarmer')->name('delete.farmer')->middleware('authority');
    Route::get('farmer/detail/{id}', 'Admin\FarmerController@farmerDetail')->name('farmer.detail');
    Route::post('load-date', 'Admin\FarmerController@loadDate')->name('farmer.loaddetail');

    // XXX  farmer advance
    Route::get('farmer-advances', 'Admin\AdvanceController@index')->name('admin.farmer.advance');
    Route::post('farmer-advance-add', 'Admin\AdvanceController@addFormerAdvance')->name('admin.farmer.advance.add');
    Route::post('farmer-advance-list', 'Admin\AdvanceController@listFarmerAdvance')->name('admin.farmer.advance.list');
    Route::post('farmer-advance-update', 'Admin\AdvanceController@updateFormerAdvance')->name('admin.farmer.advance.update')->middleware('authority');
    Route::get('farmer-advance-delete/{id}', 'Admin\AdvanceController@deleteFarmerAdvance')->middleware('authority');
    Route::post('farmer-advance-list-by-date', 'Admin\AdvanceController@advanceListByDate')->name('admin.advance.list.by.date');

    // XXX farmer due payments
    Route::get('farmer-due', 'Admin\FarmerController@due')->name('admin.farmer.due');
    Route::post('farmer-due-load', 'Admin\FarmerController@dueLoad')->name('admin.farmer.due.load');
    Route::post('farmer-pay-save', 'Admin\FarmerController@paymentSave')->name('admin.farmer.pay.save');

    Route::match(['GET', 'POST'], 'farmer-add-due-list', 'Admin\FarmerController@addDueList')->name('admin.farmer.due.add.list');
    Route::match(['GET', 'POST'], 'farmer-add-due', 'Admin\FarmerController@addDue')->name('admin.farmer.due.add');

    // XXX collection centers
    Route::get('collection-centers', 'Admin\CenterController@index')->name('admin.collection');
    Route::post('collection-center-add', 'Admin\CenterController@addCollectionCenter')->name('add.center');
    Route::get('collection-center-list', 'Admin\CenterController@listCenter')->name('list.center');
    Route::get('collection-center-delete-{id}', 'Admin\CenterController@deleteCenter')->name('delete.center')->middleware('authority');
    Route::post('collection-center-update', 'Admin\CenterController@updateCollectionCenter')->name('update.center')->middleware('authority');

    // XXX milk data
    Route::get('milk-data', 'Admin\MilkController@index')->name('admin.milk');
    Route::post('milk-data-save/{type}', 'Admin\MilkController@saveMilkData')->name('store.milk');
    Route::post('milk-data-update', 'Admin\MilkController@update')->name('store.milk.update')->middleware('authority');
    Route::post('milk-data-delete', 'Admin\MilkController@delete')->name('store.milk.delete')->middleware('authority');
    Route::post('milk-data-load', 'Admin\MilkController@milkDataLoad')->name('load.milk.data');
    Route::post('farmer-data-load', 'Admin\MilkController@loadFarmerData')->name('load.farmer.data');

    // XXX snf and fats
    Route::get('snf-fats', 'Admin\SnffatController@index')->name('admin.snf.fat');
    Route::post('snf-fats-data', 'Admin\SnffatController@snffatDataLoad')->name('load.snffat.data');
    Route::post('snf-fats-save', 'Admin\SnffatController@saveSnffatData')->name('store.snffat');
    Route::post('snf-fats-update', 'Admin\SnffatController@update')->name('store.snffat.update')->middleware('authority');
    Route::post('snf-fats-delete', 'Admin\SnffatController@delete')->name('store.snffat.delete')->middleware('authority');

    // XXX items
    Route::get('items', 'Admin\ItemController@index')->name('admin.item');
    Route::post('item-add', 'Admin\ItemController@saveItems')->name('admin.item.save');
    Route::get('item-delete/{id}', 'Admin\ItemController@deleteItem')->name('admin.item.delete')->middleware('authority');
    Route::post('item-update', 'Admin\ItemController@updateItem')->middleware('authority');

    Route::match(['GET', 'POST'], 'item-center-stock/{id}', 'Admin\ItemController@centerStock')->name('center-stock');

    // XXX sell items
    Route::get('sell-items', 'Admin\SellitemController@index')->name('admin.sell.item');
    Route::post('sell-item-add', 'Admin\SellitemController@addSellItem')->name('admin.sell.item.add');
    Route::post('sell-item-list', 'Admin\SellitemController@sellItemList')->name('admin.sell.item.list');
    Route::post('sell-item-update', 'Admin\SellitemController@updateSellItem')->name('admin.sell.item.update');
    Route::post('sell-item-delete', 'Admin\SellitemController@deleteSellitem')->middleware('authority');
    Route::post('sell-item-delete-all', 'Admin\SellitemController@multidel')->name('del-all-selitem')->middleware('authority');

    // expe categories
    Route::get('expense-categories', 'Admin\ExpenseController@categoryIndex')->name('admin.exp.category');
    Route::post('expense-category-add', 'Admin\ExpenseController@categoryAdd')->name('admin.exp.category.add');
    Route::post('expense-category-update', 'Admin\ExpenseController@categoryUpdate')->name('admin.exp.category.update');
    Route::post('category/expenses', 'Admin\ExpenseController@categoryExpenses')->name('admin.category.expenses');


    // XXX  expensess
    Route::get('expenses', 'Admin\ExpenseController@index')->name('admin.exp');
    Route::post('expense-add', 'Admin\ExpenseController@addExpense')->name('admin.exp.add');
    Route::post('expense/edit/', 'Admin\ExpenseController@editExpenses')->name('admin.exp.edit')->middleware('authority');
    Route::get('expense-list', 'Admin\ExpenseController@listExpense')->name('admin.exp.list');
    Route::get('expense-delete/{id}', 'Admin\ExpenseController@deleteExpense')->middleware('authority');
    Route::post('expense-load', 'Admin\ExpenseController@loadExpense')->name('admin.exp.load');


    // XXX suppliers
    // Route::get('suppliers', 'Admin\SupplierController@index')->name('admin.sup');
    // Route::post('add-supplier','Admin\SupplierController@addSupplier')->name('admin.sup.add');
    // Route::get('supplier-list', 'Admin\SupplierController@supplierList')->name('admin.sup.list');
    // Route::get('supplier-delete/{id}', 'Admin\SupplierController@deleteSupplier')->middleware('authority');
    // Route::post('supplier/update','Admin\SupplierController@updateSupplier');
    // Route::get('supplier/{id}', 'Admin\SupplierController@supplierDetail')->name('supplier.detail');
    // Route::get('supplier-payment', 'Admin\SupplierController@supplierPayment')->name('supplier.pay');
    // Route::post('supplier-due', 'Admin\SupplierController@supplierDue')->name('supplier.due');
    // Route::post('supplier-due-pay', 'Admin\SupplierController@supplierDuePay')->name('supplier.due.pay');


    // XXX supplier bills

    // Route::get('supplier-bills', 'Admin\SupplierController@indexBill')->name('admin.sup.bill');
    // Route::post('supplier-bill-add', 'Admin\SupplierController@addBill')->name('admin.sup.bill.add');
    // Route::get('supplier-bill-list', 'Admin\SupplierController@listBill')->name('admin.sup.bill.list');
    // Route::post('supplier-bill-update', 'Admin\SupplierController@updateBill')->name('admin.sup.bill.update');
    // Route::get('supplier-bill-delete/{id}', 'Admin\SupplierController@deleteBill')->middleware('authority');
    // Route::post('supplier-bill-item', 'Admin\SupplierController@billItems')->name('admin.sup.bill.item.list');


    // XXX supplier previous

    //   Route::get('supplier-previous-balance', 'Admin\SupplierController@previousBalance')->name('supplier.previous.balance');
    //   Route::post('supplier-previous-balance-add', 'Admin\SupplierController@previousBalanceAdd')->name('supplier.previous.balance.add');
    //   Route::post('supplier-previous-balance-load', 'Admin\SupplierController@previousBalanceLoad')->name('supplier.previous.balance.load');


    Route::prefix('suppliers')->name('admin.supplier.')->group(function () {
        // XXX suppliers
        Route::get('', 'Admin\SupplierController@index')->name('index');
        Route::post('add', 'Admin\SupplierController@add')->name('add');
        Route::get('list', 'Admin\SupplierController@list')->name('list');
        Route::post('delete', 'Admin\SupplierController@delete')->name('delete')->middleware('authority');
        Route::post('update', 'Admin\SupplierController@update')->name('update');
        //XXX supplier details
        Route::get('detail/{id}', 'Admin\SupplierController@detail')->name('detail');
        Route::post('load-detail', 'Admin\SupplierController@loadDetail')->name('load-detail');
        Route::get('payment', 'Admin\SupplierController@payment')->name('pay');
        Route::post('due', 'Admin\SupplierController@due')->name('due');
        Route::post('due-pay', 'Admin\SupplierController@duePay')->name('due.pay');

        // XXX supplier bills
        Route::get('bills', 'Admin\SupplierController@indexBill')->name('bill');
        Route::match(['GET', 'POST'], 'bill-add', 'Admin\SupplierController@addBill')->name('bill.add');
        Route::post('bill-list', 'Admin\SupplierController@listBill')->name('bill.list');
        Route::post('bill-update', 'Admin\SupplierController@updateBill')->name('bill.update');
        Route::get('bill-delete', 'Admin\SupplierController@deleteBill')->name('bill.delete')->middleware('authority');
        Route::post('bill-item', 'Admin\SupplierController@billItems')->name('bill.item.list');
        Route::get('bill-detail/{bill}', 'Admin\SupplierController@billDetail')->name('bill.item.detail');

        // XXX supplier previous
        Route::get('previous-balance', 'Admin\SupplierController@previousBalance')->name('previous.balance');
        Route::post('previous-balance-add', 'Admin\SupplierController@previousBalanceAdd')->name('previous.balance.add');
        Route::post('previous-balance-load', 'Admin\SupplierController@previousBalanceLoad')->name('previous.balance.load');
    });

    // XXX distributer
    Route::get('distributers', 'Admin\DistributerController@index')->name('admin.dis');
    Route::post('distributer-add', 'Admin\DistributerController@addDistributer')->name('admin.dis.add');
    Route::get('distributer-list', 'Admin\DistributerController@DistributerList')->name('admin.dis.list');
    Route::post('distributer-update', 'Admin\DistributerController@updateDistributer')->name('admin.dis.update');
    Route::get('distributer/delete/{id}', 'Admin\DistributerController@DistributerDelete')->middleware('authority');

    Route::get('distributer/detail/{id}', 'Admin\DistributerController@distributerDetail')->name('distributer.detail');
    Route::post('distributer/detail', 'Admin\DistributerController@distributerDetailLoad')->name('distributer.detail.load');


    Route::get('distributer/opening', 'Admin\DistributerController@opening')->name('distributer.detail.opening');
    Route::post('distributer/opening/list', 'Admin\DistributerController@loadLedger')->name('distributer.detail.opening.list');
    Route::post('distributer/ledger', 'Admin\DistributerController@ledger')->name('distributer.detail.ledger');
    Route::post('distributer/ledger/update', 'Admin\DistributerController@updateLedger')->name('distributer.detail.ledger.update')->middleware('authority');

    // distributer request
    Route::get('distributer/request', 'Admin\DistributerController@distributerRequest')->name('admin.distri.request');
    Route::get('distributer/change/status/{id}', 'Admin\DistributerController@distributerRequestChangeStatus')->name('change.status');

    // credit list
    Route::match(['GET', 'POST'], 'distributer/credit-list', 'Admin\DistributerController@creditList')->name('distributer.credit.list');

    //XXX sms
    Route::prefix('sms')->name('admin.sms.')->group(function () {
        Route::post('distributer-credit', 'SMSController@distributerCredit')->name('distributer.credit');
    });

    // XXX distributer sell

    Route::get('distributer-sells', 'Admin\DistributersellController@index')->name('admin.dis.sell');
    Route::post('distributer-sell-add', 'Admin\DistributersellController@addDistributersell')->name('admin.dis.sell.add');
    Route::post('distributer-sell-list', 'Admin\DistributersellController@listDistributersell')->name('admin.dis.sell.list');
    Route::post('distributer-sell-del', 'Admin\DistributersellController@deleteDistributersell')->name('admin.dis.sell.del')->middleware('authority');

    //XXX Distributor Payments
    Route::get('distributer-payment', 'Admin\DistributorPaymentController@index')->name('admin.dis.payemnt');
    Route::post('distributer-due-list', 'Admin\DistributorPaymentController@due')->name('admin.dis.due');
    Route::post('distributer-due-pay', 'Admin\DistributorPaymentController@pay')->name('admin.dis.pay');


    Route::group(['prefix' => 'ledger1'], function () {
        Route::name('ledger1.')->group(function () {
            Route::match(['GET', 'POST'], 'update', 'Ledger1Controller@update')->name('update')->middleware('authority');
            Route::match(['GET', 'POST'], 'edit', 'Ledger1Controller@edit')->name('edit')->middleware('authority');
            Route::match(['GET', 'POST'], 'del', 'Ledger1Controller@del')->name('del')->middleware('authority');
        });
    });

    // XXX XXX employees
    Route::prefix('employees')->name('admin.employee.')->group(function () {
        // XXX XXX employees
        Route::middleware(['auth'])->group(function () {

            Route::get('', 'Admin\EmployeeController1@index')->name('index');
            Route::post('add', 'Admin\EmployeeController1@add')->name('add');
            Route::post('update', 'Admin\EmployeeController1@update')->name('update')->middleware('authority');
            Route::get('list', 'Admin\EmployeeController1@list')->name('list');
            Route::post('delete', 'Admin\EmployeeController1@delete')->name('delete')->middleware('authority');
            Route::get('detail/{id}', 'Admin\EmployeeController1@detail')->name('detail');
            Route::post('load/emp/data', 'Admin\EmployeeController1@loadData')->name('load.data');
        });

        //XXX Employee Advance Management
        Route::get('ret', 'Admin\EmployeeController1@ret')->name('ret');
        Route::post('addret', 'Admin\EmployeeController1@addRet')->name('ret.add');
        Route::post('getret', 'Admin\EmployeeController1@getRet')->name('ret.list');
        Route::post('delret', 'Admin\EmployeeController1@delRet')->name('ret.del')->middleware('authority');;
        Route::post('updateret', 'Admin\EmployeeController1@updateRet')->name('ret.update')->middleware('authority');
        //XXX Employee Advance Management
        Route::get('advance', 'Admin\EmployeeController1@advance')->name('advance');
        Route::post('addadvance', 'Admin\EmployeeController1@addAdvance')->name('advance.add');
        Route::post('getadvance', 'Admin\EmployeeController1@getAdvance')->name('advance.list');
        Route::post('deladvance', 'Admin\EmployeeController1@delAdvance')->name('advance.del')->middleware('authority');;
        Route::post('updateadvance', 'Admin\EmployeeController1@updateAdvance')->name('advance.update')->middleware('authority');
        Route::post('advance/transfer', 'Admin\EmployeeController1@amountTransfer')->name('amount.transfer');
        //XXX Employee Account Opening
        Route::match(['get', 'post'], 'account', 'Admin\EmployeeController1@accountIndex')->name('account.index');
        Route::match(['get', 'post'], 'account-add', 'Admin\EmployeeController1@accountAdd')->name('account.add');
        //XXX Employee Month Closing
        Route::post('account-closing', 'Admin\EmployeeController1@closeSession')->name('account.close');
    });



    //XXX backup
    Route::group(['prefix' => 'backup'], function () {
        Route::name('admin.backup.')->group(function () {
            Route::get('', 'BackupController@index')->name('index');
            Route::get('create', 'BackupController@create')->name('create');
            Route::get('del', 'BackupController@del')->name('del');
        });
    });


    // Route::get('employees', 'Admin\EmployeeController@index')->name('admin.emp');
    // Route::post('employee-add', 'Admin\EmployeeController@addEmployee')->name('admin.emp.add');
    // Route::post('employee/update', 'Admin\EmployeeController@updateEmployee')->middleware('authority');
    // Route::get('employee-list', 'Admin\EmployeeController@employeeList')->name('admin.emp.list');
    // Route::get('employee/delete/{id}', 'Admin\EmployeeController@employeeDelete')->middleware('authority');
    // Route::get('employee/detail/{id}', 'Admin\EmployeeController@employeeDetail')->name('emp.detail');
    // Route::post('load/emp/data', 'Admin\EmployeeController@loadEmployeeData')->name('admin.emp.load.data');

    // Route::get('employee/advance','Admin\EmployeeController@advance')->name('admin.emp.advance');
    // Route::post('employee/addadvance','Admin\EmployeeController@addAdvance')->name('admin.emp.advance.add');
    // Route::post('employee/getadvance','Admin\EmployeeController@getAdvance')->name('admin.emp.advance.list');
    // Route::post('employee/deladvance','Admin\EmployeeController@delAdvance')->name('admin.emp.advance.del')->middleware('authority');;
    // Route::post('employee/updateadvance','Admin\EmployeeController@updateAdvance')->name('admin.emp.advance.update')->middleware('authority');
    // Route::post('advance/transfer','Admin\EmployeeController@amountTransfer')->name('amount.transfer');

    // XXX salary payment
    Route::prefix('employee/salary')->name('admin.salary.')->middleware('password')->group(function () {
        Route::get('/', 'Admin\EmployeeController1@salaryIndex')->name('pay');
        Route::post('load', 'Admin\EmployeeController1@loadEmpData')->name('load.emp.data');
        Route::post('pay/salary', 'Admin\EmployeeController1@storeSalary')->name('save');
        Route::post('list', 'Admin\EmployeeController1@paidList')->name('list');
    });


    // XXX products
    Route::group(['prefix' => 'product'], function () {
        Route::name('product.')->group(function () {
            Route::get('', 'Admin\ProductController@index')->name('home');
            Route::post('add', 'Admin\ProductController@add')->name('add');
            Route::post('update', 'Admin\ProductController@update')->name('update')->middleware('authority');
            Route::post('del', 'Admin\ProductController@del')->name('del')->middleware('authority');
        });
    });

    Route::prefix('product/purchase')->name('purchase.')->group(function () {
        Route::get('', 'Admin\ProductController@productPurchase')->name('home');
        Route::post('', 'Admin\ProductController@productPurchaseStore')->name('store');
    });

    // manufacture
    Route::group(['prefix' => 'manufacture'], function () {
        Route::name('manufacture.')->group(function () {
            Route::get('', 'Admin\ManufactureController@index')->name('index');
            Route::post('/store', 'Admin\ManufactureController@store')->name('store');
            Route::get('/list', 'Admin\ManufactureController@list')->name('list');
        });
    });


    // XXX Milk payment
    Route::group(['prefix' => 'milk-payment'], function () {
        Route::name('milk.payment.')->group(function () {
            Route::match(['GET', 'POST'], '', 'Admin\MilkPaymentController@index')->name('home');
            // Route::post('load','Admin\ProductController@index')->name('load');
            Route::post('add', 'Admin\MilkPaymentController@add')->name('add');
            Route::post('update', 'Admin\MilkPaymentController@update')->name('update')->middleware('authority');
            // Route::post('del','Admin\ProductController@del')->name('del')->middleware('authority');
        });
    });


    // XXX Ledgers
    Route::group(['prefix' => 'ledger'], function () {
        Route::name('ledger.')->group(function () {
            Route::match(['GET', 'POST'], 'update', 'LedgerController@update')->name('update')->middleware('authority');
            Route::match(['GET', 'POST'], 'sellupdate', 'LedgerController@sellUpdate')->name('sellupdate')->middleware('authority');
            Route::match(['GET', 'POST'], 'payupdate', 'LedgerController@payUpdate')->name('payupdate')->middleware('authority');

            Route::match(['GET', 'POST'], 'del', 'LedgerController@del')->name('del')->middleware('authority');
            Route::group(['prefix' => 'farmer'], function () {
                Route::name('farmer.')->group(function () {
                    Route::match(['GET', 'POST'], 'update', 'FarmerLedgerController@update')->name('update')->middleware('authority');
                    Route::match(['GET', 'POST'], 'sellupdate', 'FarmerLedgerController@sellUpdate')->name('sellupdate')->middleware('authority');
                    Route::match(['GET', 'POST'], 'selldel', 'FarmerLedgerController@sellDel')->name('selldel')->middleware('authority');
                    Route::match(['GET', 'POST'], 'payupdate', 'FarmerLedgerController@payUpdate')->name('payupdate')->middleware('authority');
                    Route::match(['GET', 'POST'], 'del', 'FarmerLedgerController@del')->name('del')->middleware('authority');
                });
            });
        });
    });


    //XXX report routes

    Route::group(['prefix' => 'report'], function () {
        Route::name('report.')->group(function () {

            Route::get('', 'ReportController@index')->name('home');

            Route::get('farmer/adjsment', 'ReportController@adjustment')->name('adjustment');


            Route::match(['GET', 'POST'], 'farmer', 'ReportController@farmer')->name('farmer');
            Route::post('farmer/changeSession', 'ReportController@farmerSession')->name('farmer.session');
            Route::post('farmer/single/changeSession', 'ReportController@farmerSingleSession')->name('farmer.single.session');

            Route::match(['GET', 'POST'], 'milk', 'ReportController@milk')->name('milk');
            Route::match(['GET', 'POST'], 'sales', 'ReportController@sales')->name('sales');
            Route::match(['GET', 'POST'], 'pos', 'ReportController@posSales')->name('pos.sales');
            Route::match(['GET', 'POST'], 'distributor', 'ReportController@distributor')->name('dis');
            Route::match(['GET', 'POST'], 'employee', 'ReportController@employee')->name('emp');
            Route::match(['GET', 'POST'], 'credit', 'ReportController@credit')->name('credit');
            Route::post('employee/changeSession', 'ReportController@employeeSession')->name('emp.session');
            Route::match(['GET', 'POST'], 'expenses', 'ReportController@expense')->name('expense');
        });
    });

    Route::group(['prefix' => 'billing'], function () {
        Route::name('billing.')->group(function () {
            Route::get('', 'Billing\BillingController@index')->name('home');
            Route::post('save', 'Billing\BillingController@save')->name('save');
        });
    });

    Route::prefix('cash-flow')->name('cash.flow.')->middleware('password')->group(function () {
        Route::get('', 'Admin\CashflowController@index')->name('index');
        Route::match(['GET', 'POST'], 'data', 'Admin\CashflowController@data')->name('data');
    });

    Route::match(['get', 'post'], 'password', 'PasswordController@index')->name('super-password');
    Route::match(['get', 'post'], 'super-logout', 'PasswordController@logout')->name('super-logout');

    Route::prefix('home-setting')->name('setting.')->group(function () {
        Route::match(['GET', 'POST'], 'about', 'Admin\HomepageController@abountus')->name('about');
        Route::match(['GET', 'POST'], 'sliders', 'Admin\HomepageController@sliders')->name('sliders');
        Route::match(['GET', 'POST'], 'slider/{id}', 'Admin\HomepageController@sliderDel')->name('slider.del');
        Route::match(['GET', 'POST'], 'gallery', 'Admin\HomepageController@gallery')->name('gallery');
        Route::match(['GET', 'POST'], 'gallery/del/{gallery}', 'Admin\HomepageController@galleryDel')->name('gallery-del');
    });

    ///XXX billing
    Route::group(['prefix' => 'billing'], function () {
        Route::name('admin.billing.')->group(function () {
            Route::get('', 'Billing\BillingController@index')->name('home');
            Route::get('detail/{id}', 'Billing\BillingController@detail')->name('detail');
            Route::post('save', 'Billing\BillingController@save')->name('save');
        });
    });

    //XXX Customer
    Route::group(['prefix' => 'customer'], function () {
        Route::name('admin.customer.')->group(function () {
            Route::get('', 'Admin\CustomerController@index')->name('home');
            Route::post('add', 'Admin\CustomerController@add')->name('add');
            Route::post('update', 'Admin\CustomerController@update')->name('update')->middleware('authority');
            Route::post('del', 'Admin\CustomerController@del')->name('del')->middleware('authority');

            //detail
            Route::match(['get', 'post'], 'detail/{id}', 'Admin\CustomerController@detail')->name('detail');

            Route::name('payment.')->prefix('payment')->group(function () {
                Route::match(['get', 'post'],  '', 'Admin\CustomerController@payment')->name('index');
                Route::match(['get', 'post'],  'add', 'Admin\CustomerController@addPayment')->name('add');
            });
        });
    });



    Route::group(['prefix' => 'user'], function () {
        Route::name('user.')->group(function () {
            Route::match(['GET', 'POST'], '', 'Admin\UserController@index')->name('users');
            Route::match(['GET', 'POST'], 'add', 'Admin\UserController@userAdd')->name('add');
            Route::match(['GET', 'POST'], 'delete/{id}', 'Admin\UserController@delete')->name('delete');
            Route::match(['GET', 'POST'], 'update/{update}', 'Admin\UserController@update')->name('update')->middleware('authority');
            Route::match(['GET', 'POST'], 'change/password', 'Admin\UserController@changePassword')->name('change.password');
            Route::match(['GET', 'POST'], 'non-super-admin/change/password/{id}', 'Admin\UserController@nonSuperadminChangePassword')->name('non.super.admin.change.password');
        });
    });
});



Route::group(['middleware' => 'role:farmer', 'prefix' => 'farmer'], function () {
    Route::name('farmer.')->group(function () {
        Route::get('home', 'Users\FarmerDashboardController@index')->name('dashboard');
        Route::post('change/password', 'Users\FarmerDashboardController@changePassword')->name('change.password');
        Route::get('transaction/detail', 'Users\FarmerDashboardController@transactionDetail')->name('milk.detail');
        Route::post('load-data', 'Users\FarmerDashboardController@loadData')->name('loaddata');
        Route::get('change-password', 'Users\FarmerDashboardController@changePasswordPage')->name('password.page');
    });
});


Route::group(['middleware' => 'role:distributer', 'prefix' => 'distributor'], function () {
    Route::name('distributer.')->group(function () {
        Route::get('home', 'Users\DistributorDashboardController@index')->name('dashboard');
        Route::post('change/password', 'Users\DistributorDashboardController@changePassword')->name('change.password');
        Route::get('transaction/detail', 'Users\DistributorDashboardController@transactionDetail')->name('transaction.detail');
        Route::post('load-data', 'Users\DistributorDashboardController@loaddata')->name('loaddata');
        Route::get('change-password', 'Users\DistributorDashboardController@changePasswordPage')->name('password.page');
        Route::get('make-a-request', 'Users\DistributorDashboardController@makeArequest')->name('request');
        Route::post('make-a-request-add', 'Users\DistributorDashboardController@makeArequestAdd')->name('request.add');
        Route::post('make-a-request-update', 'Users\DistributorDashboardController@makeArequestUpdate')->name('request.update');
        Route::get('make-a-request/{id}', 'Users\DistributorDashboardController@requestDelete')->name('request.delete');
    });
});
