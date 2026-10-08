<aside class="sidebar" id="sidebar">
    <div class="brand">
        <div class="brand-icon"><i class="bi bi-box-seam-fill"></i></div>
        <div class="brand-text">
            <h6>MFC</h6>
            <small>Madhu Fancy Store</small>
        </div>
    </div>

    <nav class="sidebar-nav">
       

        <a href="{{route('dashboard')}}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i><span class="nav-label">Dashboard</span>
        </a>
        <a href="{{route('product.index')}}"
        class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            <span class="nav-label">Products</span>
        </a>
        <a href="{{route('category.index')}}" 
        class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i><span class="nav-label">Categories</span>
        </a>
        <a href="{{route('supplier.index')}}"
         class="nav-link {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
            <i class="bi bi-truck"></i><span class="nav-label">Suppliers</span>
        </a>


        <a href="{{route('stockin.index')}}" 
        class="nav-link {{ request()->routeIs('stockin.*') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-in-down"></i><span class="nav-label">Stock In</span>
        </a>
        <a href="{{route('stockout.index')}}" class="nav-link {{ request()->routeIs('stockout.*') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-up"></i><span class="nav-label">Stock Out</span>
        </a>

        <a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
    <i class="bi bi-bag-check-fill"></i>
    <span class="nav-label">Orders</span>
</a>

        

        <a href="{{route('inventory.index')}}" class="nav-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
            <i class="bi bi-clipboard2-data"></i><span class="nav-label">Inventory Monitor</span>
        </a>

        <div class="nav-section-label">REPORTS</div>

        <a href="{{route('reports.index')}}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line-fill"></i><span class="nav-label">Reports</span>
        </a>

       
        <a href="#" class="nav-link" onclick="event.preventDefault(); if(confirm('Logout-aa confirm pannunga?')){ window.location.href='{{ url('/') }}'; }">
            <i class="bi bi-box-arrow-right"></i><span class="nav-label">Logout</span>
        </a>
    </nav>
</aside>