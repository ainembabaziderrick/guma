<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url(auth()->user()->foto ?? '') }}" class="img-circle img-profil" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            @if (auth()->user()->level == 1)
            <li class="header">MASTER</li>
            <li>
                <a href="{{ route('kategori.index') }}">
                    <i class="fa fa-cube"></i> <span>Category</span>
                </a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}">
                    <i class="fa fa-cubes"></i> <span>Product</span>
                </a>
            </li>
            <li>
                <a href="{{ route('lowstock.index') }}">
                    <i class="fa fa-cubes"></i> <span>Low Stock</span>
                </a>
            </li>
            <li>
                <a href="{{ route('member.index') }}">
                    <i class="fa fa-id-card"></i> <span>Member</span>
                </a>
            </li>
            <li>
    <a href="{{ route('messages') }}">
        <i class="fa fa-info"></i> <span>Messages</span>
        @if(isset($unreadMessageCount) && $unreadMessageCount > 0)
            <span class="badge badge-danger">{{ $unreadMessageCount }}</span> <!-- Show badge if there are unread messages -->
        @endif
    </a>
</li>

            <li>
                <a href="{{ route('supplier.index') }}">
                    <i class="fa fa-truck"></i> <span>Supplier</span>
                </a>
            </li>
            <li>
                <a href="{{ route('supplier.details') }}">
                    <i class="fa fa-truck"></i> <span>Supply Details</span>
                </a>
            </li>
            <li class="header">TRANSACTION</li>
            <li>
                <a href="{{ route('pengeluaran.index') }}">
                    <i class="fa fa-money"></i> <span>Expenses</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pengeluaran.daily') }}">
                    <i class="fa fa-money"></i> <span>Daily Expenses</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pembelian.index') }}">
                    <i class="fa fa-download"></i> <span>Purchase</span>
                </a>
            </li>
            <li>
                <a href="{{ route('penjualan.index') }}">
                    <i class="fa fa-dollar"></i> <span>Sales List</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.baru') }}">
                    <i class="fa fa-cart-plus"></i> <span>New Transaction</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transactions') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Daily Transactions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('orders') }}">
                <i class="fa fa-money"></i> <span>Orders</span>
        @if(isset($newOrderCount) && $newOrderCount > 0)
            <span class="badge badge-danger">{{ $newOrderCount }}</span> <!-- Show badge if there are unread orders -->
        @endif
</a>
            </li>
            <li>
                <a href="{{ route('cartorders') }}">
                <i class="fa fa-money"></i> <span>Cart Orders</span>
        @if(isset($newCartCount) && $newCartCount > 0)
            <span class="badge badge-danger">{{ $newCartCount }}</span> <!-- Show badge if there are unread orders -->
        @endif
</a>
            </li>
            <li>
                <a href="{{ route('dailyorders') }}">
                    <i class="fa fa-money"></i> <span>Daily Orders</span>
                    @if(isset($newOrderCount) && $newOrderCount > 0)
            <span class="badge badge-danger">{{ $newOrderCount }}</span> <!-- Show badge if there are unread orders -->
        @endif
                </a>
            </li>
            <li>
                <a href="{{ route('debts') }}">
                    <i class="fa fa-download"></i> <span>Debts</span>
                </a>
            </li>
            <li>
            <a href="{{ route('debtor') }}">
            <i class="fa fa-dollar"></i> <span>Debtors</span>
            @if($pendingDebtorsCount > 0)
                <span class="badge badge-danger" >
                    {{ $pendingDebtorsCount }}
                </span>
            @endif
            </a>
            </li>
            <li>
                <a href="{{ route('debts_recovery') }}">
                    <i class="fa fa-download"></i> <span>Debts Recovery</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{ route('daily_debts_recovery') }}">
                    <i class="fa fa-download"></i> <span>Daily Debts Recovery</span>
                </a>
            </li> -->
            
            <li>
                <a href="{{ route('debtors_recovery') }}">
                    <i class="fa fa-dollar"></i> <span>Debtors Recovery</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('daily_debtors_recovery') }}">
                    <i class="fa fa-dollar"></i> <span>Daily Debtors Recovery</span>
                </a>
            </li>
            
            <li class="header">REPORT</li>
            <li>
                <a href="{{ route('laporan.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Income</span>
                </a>
            </li>
            <li>
                <a href="{{ route('laporan.daily') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Daily Income</span>
                </a>
            </li>
            <li class="header">SYSTEM</li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-users"></i> <span>User</span>
                </a>
            </li>
            <li>
                <a href="{{ route('staff') }}">
                    <i class="fa fa-users"></i> <span>Staff</span>
                </a>
            </li>
            <li>
                <a href="{{ route("setting.index") }}">
                    <i class="fa fa-cogs"></i> <span>Settings</span>
                </a>
            </li>
            <li class="header">Frontend</li>
            <li>
                <a href="{{ route('products.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('blog.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Blog</span>
                </a>
            </li>
            <li>
                <a href="{{ route('carousel.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Carousel</span>
                </a>
            </li>

            @elseif (auth()->user()->level == 2)
            <li>
                <a href="{{ route('transaksi.baru') }}">
                    <i class="fa fa-cart-plus"></i> <span>New Transaction</span>
                </a>
            </li>
            <li>
                <a href="{{ route('usertransactions') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Daily Transaction</span>
                </a>
            </li>         
            <li>
                <a href="{{ route('member.user') }}">
                    <i class="fa fa-id-card"></i> <span>Member</span>
                </a>
            </li>  
           
            <li>
   <a href="{{ route('user_debtors') }}">
      <i class="fa fa-dollar"></i> <span>Debtors</span>
   </a>
</li>
<li>
                <a href="{{ route('pengeluaran.userexpense') }}">
                    <i class="fa fa-money"></i> <span>Daily Expenses</span>
                </a>
            </li>

            <!-- <li>
                <a href="{{ route('laporan.userdaily') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Daily Income</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="{{ route('orders') }}">
                    <i class="fa fa-money"></i> <span>Orders</span>
                </a>
            </li> -->
            <li>
                <a href="{{ route('dailyordersuser') }}">
                    <i class="fa fa-money"></i> <span>Daily Orders</span>
                    @if(isset($newOrderCount) && $newOrderCount > 0)
            <span class="badge badge-danger">{{ $newOrderCount }}</span> <!-- Show badge if there are unread orders -->
        @endif
                </a>
            </li>
            @elseif (auth()->user()->level == 3)
                <!-- Customer Sidebar Menu -->
                <li class="header">CUSTOMER MENU</li>
                <li>
                    <a href="{{ route('customerindex') }}">
                        <i class="fa fa-shopping-cart"></i> <span>My Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mydebts.customer') }}">
                        <i class="fa fa-dollar"></i> <span>My Debts</span>
                    </a>
                </li>
                @elseif (auth()->user()->level == 4)
                <!-- Supplier Sidebar Menu -->
                <li class="header">SUPPLIER MENU</li>
                <li>
    <a href="{{ route('mysupplies') }}">
        <i class="fa fa-shopping-cart"></i> <span>My Supplies</span>
    </a>
</li>

                <li>
                    <a href="{{ route('mybalances') }}">
                        <i class="fa fa-dollar"></i> <span>My Balances</span>
                    </a>
                </li>

                 @elseif (auth()->user()->level == 5)
            <li class="header">MASTER</li>
           
            <li>
                <a href="{{ route('produk.sub_index') }}">
                    <i class="fa fa-cubes"></i> <span>Product</span>
                </a>
            </li>
            <li>
                <a href="{{ route('lowstock.sub') }}">
                    <i class="fa fa-cubes"></i> <span>Low Stock</span>
                </a>
            </li>
            <li>
                <a href="{{ route('member.sub') }}">
                    <i class="fa fa-id-card"></i> <span>Member</span>
                </a>
            </li>
                      
            <li class="header">TRANSACTION</li>
           
            <li>
                <a href="{{ route('pengeluaran.sub_daily') }}">
                    <i class="fa fa-money"></i> <span>Daily Expenses</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pembelian.sub_index') }}">
                    <i class="fa fa-download"></i> <span>Purchase</span>
                </a>
            </li>
           
            <li>
                <a href="{{ route('transaksi.baru') }}">
                    <i class="fa fa-cart-plus"></i> <span>New Transaction</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transactions.sub') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Daily Transactions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('orders.sub') }}">
                <i class="fa fa-money"></i> <span>Orders</span>
        @if(isset($newOrderCount) && $newOrderCount > 0)
            <span class="badge badge-danger">{{ $newOrderCount }}</span> <!-- Show badge if there are unread orders -->
        @endif
</a>
            </li>
            <li>
                <a href="{{ route('sub_cartorders') }}">
                <i class="fa fa-money"></i> <span>Cart Orders</span>
        @if(isset($newCartCount) && $newCartCount > 0)
            <span class="badge badge-danger">{{ $newCartCount }}</span> <!-- Show badge if there are unread orders -->
        @endif
</a>
            </li>
            <li>
                <a href="{{ route('dailyorders.sub') }}">
                    <i class="fa fa-money"></i> <span>Daily Orders</span>
                    @if(isset($newOrderCount) && $newOrderCount > 0)
            <span class="badge badge-danger">{{ $newOrderCount }}</span> <!-- Show badge if there are unread orders -->
        @endif
                </a>
            </li>
            <li>
                <a href="{{ route('sub_debts') }}">
                    <i class="fa fa-download"></i> <span>Debts</span>
                </a>
            </li>
            <li>
                <a href="{{ route('debtor.sub') }}">
                    <i class="fa fa-dollar"></i> <span>Debtors</span>
                </a>
            </li>
            <li>
                <a href="{{ route('debts_recovery') }}">
                    <i class="fa fa-download"></i> <span>Debts Recovery</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{ route('daily_debts_recovery') }}">
                    <i class="fa fa-download"></i> <span>Daily Debts Recovery</span>
                </a>
            </li> -->
            
            <li>
                <a href="{{ route('debtors_recovery') }}">
                    <i class="fa fa-dollar"></i> <span>Debtors Recovery</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('daily_debtors_recovery') }}">
                    <i class="fa fa-dollar"></i> <span>Daily Debtors Recovery</span>
                </a>
            </li>
            
            <li class="header">REPORT</li>
           
            <li>
                <a href="{{ route('laporan.daily.sub') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Daily Income</span>
                </a>
            </li>

             @elseif (auth()->user()->level == 3)
                <!-- Customer Sidebar Menu -->
                <li class="header">CUSTOMER MENU</li>
                <li>
                    <a href="{{ route('customerindex') }}">
                        <i class="fa fa-shopping-cart"></i> <span>My Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mydebts') }}">
                        <i class="fa fa-dollar"></i> <span>My Debts</span>
                    </a>
                </li>
                @elseif (auth()->user()->level == 6)
                <!-- Customer Sidebar Menu -->
                <li class="header">CUSTOMER MENU</li>
                <li>
                    <a href="{{ route('customerindex_online') }}">
                        <i class="fa fa-shopping-cart"></i> <span>My Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mydebts') }}">
                        <i class="fa fa-dollar"></i> <span>My Debts</span>
                    </a>
                </li>
           
                
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside><!-- visit "codeastro" for more projects! -->