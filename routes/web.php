<?php

use App\Http\Controllers\{
    DashboardController,
    KategoriController,
    LaporanController,
    ProdukController,
    MemberController,
    PengeluaranController,
    PembelianController,
    PembelianDetailController,
    PenjualanController,
    PenjualanDetailController,
    SettingController,
    SupplierController,
    UserController,
    BuyController,
    MessageController,
    AuthController,
    DebtsController,
    StaffController,
    SuppliesController,
    TransctionsController,
    ForgotPasswordController,
    ProductsController,
    BlogController,
    CarouselController,
    CartController,
    EmployerController,
    AgentController,
    JobOrderController,
    CandidateController,
    ScreeningController,
    MedicalController,
};
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

// Route::get('/', function () {
//     return view('index');
// })->name('home');

Route::get('/', function () {
    return view('index');
});

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('register', [AuthController::class, 'Register']
)->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.post');

Route::get('/about', function () {
    return view('about');
});

Route::get('/team', function () {
    return view('team');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/contact', function () {
    return view('contact');
});

// cart
Route::get('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('view.cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('update.cart');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('remove.from.cart');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');


Route::get('/combhoney', [BuyController::class, 'index']);
Route::post('combhoney/buy', [BuyController::class, 'StoreBuy']);
Route::get('/combhoneyz', [BuyController::class, 'customerz']);

Route::get('/rawhoney', function () {
    return view('details1');
});

Route::get('/wildflowerhoney', function () {
    return view('details3');
});

Route::get('/queenbeehoney', function () {
    return view('details2');
});
//forgot password
Route::get('/forgot_password', [ForgotPasswordController::class, 'forgot'])->name('password.request');
Route::post('/password_reset', [ForgotPasswordController::class, 'password'])->name('password.reset');
Route::get('/reset_password/{email}/{code}', [ForgotPasswordController::class, 'reset'])->name('reset.password');
Route::post('/reset_password/{email}/{code}', [ForgotPasswordController::class, 'resetPassword'])->name('reset');


//Messages
Route::get('admin/messages/add', [MessageController::class, 'add_messages']);
Route::post('admin/messages/add', [MessageController::class, 'insert_add_messages']);
Route::get('/messages/unread-count', [MessageController::class, 'getUnreadCount']);
Route::get('/admin/messages/data', [MessageController::class, 'getData'])->name('messages.data');
Route::get('/admin/messages/data/sub', [MessageController::class, 'getData_sub'])->name('messages.data.sub');
Route::delete('/admin/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'level:1,5'], function () {

        //Employers
        Route::get('/employers/data', [EmployerController::class, 'data'])->name('employers.data');
        Route::delete('/employers/delete-selected', [EmployerController::class, 'deleteSelected'])->name('employers.delete_selected');
        Route::resource('/employers', EmployerController::class);

        //Agents
        Route::get('/agents/data', [AgentController::class, 'data'])->name('agents.data');
        Route::delete('/agents/delete-selected', [AgentController::class, 'deleteSelected'])->name('agents.delete_selected');
        Route::resource('/agents', AgentController::class);

        // Job Orders
        Route::get('/job-orders/data', [JobOrderController::class, 'data'])->name('job_orders.data');
        Route::delete('/job-orders/delete-selected', [JobOrderController::class, 'deleteSelected'])->name('job_orders.delete_selected');
        Route::resource('/job-orders', JobOrderController::class);

        //Candidates
        Route::get('/candidates/data', [CandidateController::class, 'data'])->name('candidates.data');
        Route::delete('/candidates/delete-selected', [CandidateController::class, 'deleteSelected'])->name('candidates.delete_selected');
        Route::get('/candidates/{id}', [CandidateController::class, 'show'])->name('candidates.show');
        Route::resource('/candidates', CandidateController::class);

        //Screening
        Route::get('/screening', [ScreeningController::class, 'index'])->name('screening.index');
        Route::get('/screening/data', [ScreeningController::class, 'data'])->name('screening.data');
        Route::post('/screening/update-status', [ScreeningController::class, 'updateStatus'])->name('screening.update_status');

        //Medical
        Route::get('/medical', [MedicalController::class, 'index'])->name('medical.index');
        Route::get('/medical/data', [MedicalController::class, 'data'])->name('medical.data');
        Route::post('/medical/update', [MedicalController::class, 'update'])->name('medical.update');


        Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
        Route::resource('/kategori', KategoriController::class);

        Route::get('/produk/sub', [ProdukController::class, 'sub'])->name('produk.sub_index');
        Route::get('/produk/data/sub', [ProdukController::class, 'data_sub'])->name('produk.data_sub');
        Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
        Route::post('/produk/delete-selected', [ProdukController::class, 'deleteSelected'])->name('produk.delete_selected');
        Route::post('/produk/cetak-barcode', [ProdukController::class, 'cetakBarcode'])->name('produk.cetak_barcode');
        Route::resource('/produk', ProdukController::class);
        Route::get('/product-stock/{id}', [ProdukController::class, 'getStock']);

        //low stock
        Route::get('/lowstock', [ProdukController::class, 'lowstock'])->name('lowstock.index');
        Route::get('/lowstock/data', [ProdukController::class, 'lowstock_data'])->name('lowstock.data');

        Route::get('/lowstock/sub', [ProdukController::class, 'lowstock_sub'])->name('lowstock.sub');
        Route::get('/lowstock/data/sub', [ProdukController::class, 'lowstock_data_sub'])->name('lowstock.data_sub');
      

        Route::get('supplier/data', [SupplierController::class, 'data'])->name('supplier.data');

        Route::resource('/supplier', SupplierController::class);

        Route::get('/suppliee/details', [SuppliesController::class, 'store'])->name('supplier.details');

        Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
        Route::resource('/pengeluaran', PengeluaranController::class);

        Route::get('/pembelian/sub', [PembelianController::class, 'sub_index'])->name('pembelian.sub_index');
        Route::get('/pembelian/data/sub', [PembelianController::class, 'sub_data'])->name('pembelian.sub_data');
        Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
        Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
        Route::resource('/pembelian', PembelianController::class)
            ->except('create');

        Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
        Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
        Route::resource('/pembelian_detail', PembelianDetailController::class)
            ->except('create', 'show', 'edit');

        Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
        Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
        Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
        Route::get('/get-product-stock/{id}', [PenjualanController::class, 'getProductStock']);
        


            //Products
    Route::get('admin/products', [ProductsController::class, 'Homeproducts'])->name('products.index');
    Route::get('admin/products/add', [ProductsController::class, 'Addproducts']);
    Route::post('admin/products/add', [ProductsController::class, 'Storeproducts']);
    Route::get('/admin/products/edit/{id}', [ProductsController::class, 'Editproducts']);
    Route::post('/admin/products/update/{id}', [ProductsController::class, 'Updateproducts']);
    Route::get('/admin/products/delete/{id}', [ProductsController::class, 'Deleteproducts']);

    //Blog
    Route::get('admin/blog', [BlogController::class, 'Homeblog'])->name('blog.index');
    Route::get('admin/blog/add', [BlogController::class, 'Addblog']);
    Route::post('admin/blog/add', [BlogController::class, 'Storeblog']);
    Route::get('/admin/blog/edit/{id}', [BlogController::class, 'Editblog']);
    Route::post('/admin/blog/update/{id}', [BlogController::class, 'Updateblog']);
    Route::get('/admin/blog/delete/{id}', [BlogController::class, 'Deleteblog']);

    //carousel
    Route::get('admin/carousel', [CarouselController::class, 'Homecarousel'])->name('carousel.index');
    Route::get('admin/carousel/add', [CarouselController::class, 'Addcarousel']);
    Route::post('admin/carousel/add', [CarouselController::class, 'Storecarousel']);
    Route::get('/admin/carousel/edit/{id}', [CarouselController::class, 'Editcarousel']);
    Route::post('/admin/carousel/update/{id}', [CarouselController::class, 'Updatecarousel']);
    Route::get('/admin/carousel/delete/{id}', [CarouselController::class, 'Deletecarousel']);


    });

    Route::group(['middleware' => 'level:1,2,5'], function () {
        Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
        Route::post('/transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
        Route::get('/transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
        Route::get('/transaksi/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');
        Route::get('/transaksi/nota-besar', [PenjualanController::class, 'notaBesar'])->name('transaksi.nota_besar');
        Route::post('/validate-stock', [PenjualanController::class, 'validateStock'])->name('validate.stock');
        Route::get('/get-product-stock/{id}', [PenjualanController::class, 'getProductStock']);



        //Debts
        
        Route::get('admin/debts/add', [PenjualanController::class, 'add_debts']);
        Route::post('admin/debts/add', [PenjualanController::class, 'insert_add_debts']);
        Route::get('/admin/debts/pay/{id}', [PenjualanController::class, 'Deletedebts']);

        Route::get('debts', [DebtsController::class, 'index'])->name('debts');
         Route::get('sub_debts', [DebtsController::class, 'sub_index'])->name('sub_debts');
        Route::post('/debts/update-payment', [DebtsController::class, 'updatePayment'])->name('debts.update_payment');
        Route::get('/debts/edit/{id}', [DebtsController::class, 'Editdebts']);
        Route::post('/debts/update/{id}', [DebtsController::class, 'Updatedebts']);
        Route::get('/debts/debts_recovery', [DebtsController::class, 'debts_recovery'])->name('debts_recovery');
        Route::get('/debts/daily_debts_recovery', [DebtsController::class, 'daily_debts_recovery'])->name('daily_debts_recovery');
        Route::get('debts/data', [DebtsController::class, 'getDebtsData'])->name('debts.data');
        Route::get('debts/sub_data', [DebtsController::class, 'sub_getDebtsData'])->name('debts.sub_data');
        //Route::get('debtors/data', [DebtsController::class, 'getDebtorsData'])->name('debtors.data');
     

        //Orders
        Route::get('/orders', [BuyController::class, 'list'])->name('orders');
        Route::get('/daily/orders', [BuyController::class, 'daily'])->name('dailyorders');
        Route::get('/orders/sub', [BuyController::class, 'list_sub'])->name('orders.sub');
        Route::get('/daily/orders/sub', [BuyController::class, 'daily_sub'])->name('dailyorders.sub');
        Route::get('/daily/cart/orders', [BuyController::class, 'cartorders'])->name('cartorders');
        Route::get('/daily/cart/sub_orders', [BuyController::class, 'sub_cartorders'])->name('sub_cartorders');
        Route::get('/daily/orders/user', [BuyController::class, 'userdaily'])->name('dailyordersuser');
        Route::get('admin/orders/add', [BuyController::class, 'add_orders']);
        Route::post('admin/orders/add', [BuyController::class, 'insert_add_orders']);
        // Route for fetching orders data for DataTables
        Route::get('admin/orders/data', [BuyController::class, 'getData'])->name('orders.data');
        Route::get('admin/orders/data/sub', [BuyController::class, 'getData_sub'])->name('orders.data.sub');
        Route::get('admin/orders/data/cart', [BuyController::class, 'getDataCart'])->name('cart.data');
        Route::get('admin/orders/data/sub_cart', [BuyController::class, 'sub_getDataCart'])->name('cart.sub_data');
        Route::delete('/admin/cartorders/{id}', [BuyController::class, 'deleteCartOrder'])->name('cartorders.delete');
        Route::delete('/admin/orders/{id}', [BuyController::class, 'destroy'])->name('orders.destroy');


        // Debtors
        Route::get('/debtors', [PenjualanController::class, 'Debtors'])->name('debtors');
        Route::get('admin/debtors/add', [PenjualanController::class, 'add_debtors']);
        Route::post('admin/debtors/add', [PenjualanController::class, 'insert_add_debtors']);
        Route::get('/admin/debtors/pay/{id}', [PenjualanController::class, 'Deletedebtors']);
        Route::get('/debtors/edit/{id}', [DebtsController::class, 'Editdebtors']);
        Route::post('/debtors/update/{id}', [DebtsController::class, 'Updatedebtors']);
        Route::get('/debtors/debtors_recovery', [DebtsController::class, 'debtors_recovery'])->name('debtors_recovery');
        Route::get('/debtors/daily_debtors_recovery', [DebtsController::class, 'daily_debtors_recovery'])->name('daily_debtors_recovery');
        Route::get('/debtor', [DebtsController::class, 'Debtor'])->name('debtor');
        //Route::get('debtors/data', [DebtsController::class, 'getData'])->name('debtors.data');
        Route::get('debtor/data', [DebtsController::class, 'getDebtorsData'])->name('debtor.data');
        Route::post('/debtors/delete', [DebtsController::class, 'deleteDebtor'])->name('debtor.delete');

        //debtors sub
        Route::get('/debtors/sub', [DebtsController::class, 'Debtors_sub'])->name('debtor.sub');
        Route::get('debtors/data/sub', [DebtsController::class, 'getData_sub'])->name('debtors.data_sub');
        Route::get('sub/debtors/add', [DebtsController::class, 'add_debtors']);
        Route::post('sub/debtors/add', [DebtsController::class, 'insert_add_debtors']);

        Route::get('sub/debtors/edit/{id}', [DebtsController::class, 'Editdebtors_sub']);
        Route::post('sub/debtors/update/{id}', [DebtsController::class, 'Updatedebtors_sub']);

        Route::post('/debtor/approve', [DebtsController::class, 'approveDebtor'])->name('debtor.approve');
        Route::post('/debtor/deny', [DebtsController::class, 'denyDebtor'])->name('debtor.deny');

       
         //Supply Details
         Route::get('/supplies', [SuppliesController::class, 'store'])->name('supplies');
         Route::get('supplies/data', [SuppliesController::class, 'getData'])->name('supplies.data');
        Route::get('supplies/add', [SuppliesController::class, 'add_supplies']);
        Route::post('supplies/add', [SuppliesController::class, 'insert_add_supplies']);
        Route::get('/supplies/delete/{id}', [SuppliesController::class, 'Deletesupplies']);

        //supplier supplies
        Route::get('suplier/data', [SuppliesController::class, 'getDatas'])->name('suplier.data');
        Route::get('/suplier/edit/{id}', [SuppliesController::class, 'Editsuplier']);
        Route::post('/suplier/update/{id}', [SuppliesController::class, 'Updatesuplier']);

 

        // Debtors
        Route::get('/user_debtors', [DebtsController::class, 'Debtors'])->name('user_debtors');
        Route::get('debtors/data', [DebtsController::class, 'getDebtorzData'])->name('debtors.data');


        //Messages
        Route::get('admin/messages', [MessageController::class, 'messages_list'])->name('messages');
        Route::get('admin/messages/sub', [MessageController::class, 'messages_list_sub'])->name('messages.sub');
        Route::get('/admin/messages/delete/{id}', [MessageController::class, 'Deletemessages']);
        Route::get('/messages/unread-count', [MessageController::class, 'getUnreadCount']);


        // Staff
        Route::get('/staff', [StaffController::class, 'staff'])->name('staff');
        Route::get('admin/staff/add', [StaffController::class, 'add_staff']);
        Route::post('admin/staff/add', [StaffController::class, 'insert_add_staff']);
        Route::get('/admin/staff/delete/{id}', [StaffController::class, 'Deletestaff']);


        Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
        Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.load_form');
        Route::resource('/transaksi', PenjualanDetailController::class)
            ->except('create', 'show', 'edit');

        Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
        Route::resource('/pengeluaran', PengeluaranController::class);
        // Daily Expenses daily
        Route::get('/expenses/daily', [PengeluaranController::class, 'daily'])->name('pengeluaran.daily');
        Route::get('/expenses/data', [PengeluaranController::class, 'getdata'])->name('expenses.data');

         Route::get('/expenses/sub_daily', [PengeluaranController::class, 'sub_daily'])->name('pengeluaran.sub_daily');
        Route::get('/expenses/sub_data', [PengeluaranController::class, 'sub_getdata'])->name('expenses.sub_data');

        // Daily Expenses User
        Route::get('/userexpense', [PengeluaranController::class, 'userexpense'])->name('pengeluaran.userexpense');
        Route::get('/userexpense/data', [PengeluaranController::class, 'getdatauserexpense'])->name('userexpense.data');

        //Daily transactions
        Route::get('/usertransactions', [TransctionsController::class, 'user'])->name('usertransactions');
        Route::get('/usertransactions/data', [TransctionsController::class, 'userdata'])->name('usertransactions.data');

        //User members
         Route::get('/member/datas', [MemberController::class, 'datas'])->name('member.datas');
        // Route::post('/member/cetak-member', [MemberController::class, 'cetakMember'])->name('member.cetak_member');
        Route::get('user/member', [MemberController::class, 'user_member'])->name('member.user');
        Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
        Route::get('user/member_sub', [MemberController::class, 'user_member_sub'])->name('member.sub');
        Route::get('/member/sub_admin/data', [MemberController::class, 'sub_data'])->name('member.sub_data');
        Route::post('/member/cetak-member', [MemberController::class, 'cetakMember'])->name('member.cetak_member');
        Route::resource('/member', MemberController::class);

        

    });

    Route::group(['middleware' => 'level:1,2,5'], function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
        Route::get('/laporan/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('laporan.export_pdf');

        //Daily Income
        Route::get('/daily', [LaporanController::class, 'daily'])->name('laporan.daily');
        Route::get('/daily/sub', [LaporanController::class, 'daily_sub'])->name('laporan.daily.sub');
        Route::get('/daily/data/{awal}/{akhir}', [LaporanController::class, 'datas'])->name('daily.data');

        //Daily Income for user
        Route::get('/userdaily', [LaporanController::class, 'userdaily'])->name('laporan.userdaily');
        Route::get('/userdaily/data/{awal}/{akhir}', [LaporanController::class, 'userdatas'])->name('userdaily.data');

        

        //Daily transactions
        Route::get('/transactions', [TransctionsController::class, 'index'])->name('transactions');
        Route::get('/transactions/data', [TransctionsController::class, 'data'])->name('transactions.data');

        Route::get('/transactions/sub', [TransctionsController::class, 'index_sub'])->name('transactions.sub');
        Route::get('/transactions/data/sub', [TransctionsController::class, 'index_data'])->name('transactions.index_data');



        // Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
        // Route::resource('/user', UserController::class);

        //user
        // Users DataTable AJAX route
Route::get('/user/data', [UserController::class, 'data'])->name('user.data');

// Show all users
Route::get('/user', [UserController::class, 'index'])->name('user.index');

// Show form to create a new user
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

// Store a new user
Route::post('/user', [UserController::class, 'store'])->name('user.store');

// Show a specific user
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

// Show form to edit a user
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

// Update a specific user
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

// Delete a specific user
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::get('/setting/first', [SettingController::class, 'show'])->name('setting.show');
        Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');
    });

    Route::group(['middleware' => 'level:1,2,3,4,5,6'], function () {
        Route::get('/profil', [UserController::class, 'profil'])->name('user.profil');
        Route::post('/profil', [UserController::class, 'updateProfil'])->name('user.update_profil');
    });

    Route::group(['middleware' => 'level:3'], function () {
         //Orders
         Route::get('/neworders/make', [BuyController::class, 'neworders'])->name('neworders');
         Route::get('/myorders/list', [BuyController::class, 'customerindex'])->name('customerindex');
         Route::post('combhoney/buys', [BuyController::class, 'StoreBuys']);
         Route::get('/myorders/customer', [BuyController::class, 'customer'])->name('customers');

         // Debtors
        Route::get('/mydebts/customer', [DebtsController::class, 'CustomerDebtors_customer'])->name('mydebts.customer');
      
    });
    Route::group(['middleware' => 'level:4'], function () {
        Route::get('/suplies/my_supplies', [SuppliesController::class, 'supplies'])->name('mysupplies');  
       
    //my balances    
    Route::get('/suplies/my_balances', [SuppliesController::class, 'balances'])->name('mybalances');   
     
   });

    Route::group(['middleware' => 'level:6'], function () {
         //Orders
         Route::get('/neworders/make/online', [BuyController::class, 'neworders_online'])->name('neworders_online');
         Route::get('/myorders/list/online', [BuyController::class, 'customerindex_online'])->name('customerindex_online');
         Route::post('combhoney/buys/online', [BuyController::class, 'StoreBuys_online']);
         Route::get('/myorders/customer', [BuyController::class, 'customer'])->name('customers');

         // Debtors
        Route::get('/mydebts', [DebtsController::class, 'CustomerDebtors'])->name('mydebts');

        // cart
// Add product to online cart
Route::get('/add-to-cart-online', [CartController::class, 'addToCart_online'])->name('add.to.cart.online');

// View online cart
Route::get('/cart-online', [CartController::class, 'viewCart_online'])->name('view.cart.online');

Route::post('/cart/update/online', [CartController::class, 'updateCart_online'])->name('update.cart.online');
Route::post('/cart/remove/online', [CartController::class, 'removeFromCart_online'])->name('remove.from.cart.online');

Route::get('/checkout/online', [CartController::class, 'checkout_online'])->name('checkout_online');
Route::post('/checkout/online', [CartController::class, 'processCheckout_online'])->name('checkout.process.online');


Route::get('/combhoney', [BuyController::class, 'index']);
Route::post('combhoney/buy', [BuyController::class, 'StoreBuy']);
Route::get('/combhoneyz', [BuyController::class, 'customerz']);

      
    });
    
   
});

