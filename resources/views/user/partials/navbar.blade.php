<nav class="navbar navbar-expand-lg madhu-navbar">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand madhu-brand d-flex align-items-center"
           href="{{ route('home') }}">

            <img src="{{ asset('images/logo.png') }}"
                 class="madhu-logo"
                 alt="Madhu Fancy Store">

            <div class="brand-text">
                <div class="brand-name">MADHU</div>
                <div class="brand-subtitle">Fancy Store</div>
            </div>

        </a>


        <!-- Mobile Button -->
        <button class="navbar-toggler custom-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <i class="bi bi-list"></i>

        </button>


        <div class="collapse navbar-collapse" id="navbarMenu">

            <!-- Center Menu -->
            <ul class="navbar-nav mx-auto madhu-menu">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#categories">
                        Categories
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#products">
                        Products
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contact
                    </a>
                </li>

            </ul>


            <!-- Right Side -->
            <div class="d-flex align-items-center navbar-actions">


                <!-- Search -->
                <form class="search-wrapper">

                    <i class="bi bi-search search-icon"></i>

                    <input class="search-box"
                           type="search"
                           placeholder="Search products">

                </form>


                <!-- Cart -->
                <a href="{{ route('cart.index') }}"
                   class="cart-btn"
                   title="Shopping Cart">

                    <i class="bi bi-cart3"></i>

                    <span id="cartCount">
                        {{ \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') }}
                    </span>

                </a>


                <!-- User -->
                <div class="dropdown">

                    <button class="user-btn dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                        <span class="user-icon">
                            <i class="bi bi-person-fill"></i>
                        </span>

                        <span class="user-name">
                            {{ Auth::user()->name }}
                        </span>

                    </button>


                    <ul class="dropdown-menu dropdown-menu-end madhu-dropdown">

                        <li class="dropdown-header">
                            <div class="fw-semibold">
                                {{ Auth::user()->name }}
                            </div>

                            <small>
                                Customer Account
                            </small>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person me-2"></i>
                                My Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-bag-check me-2"></i>
                                My Orders
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form action="{{ route('logout') }}"
                                  method="POST">
                                @csrf

                                <button class="dropdown-item logout-item"
                                        type="submit">

                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout

                                </button>

                            </form>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>
</nav>