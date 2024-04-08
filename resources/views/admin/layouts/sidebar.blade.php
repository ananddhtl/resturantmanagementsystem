<aside id="layout-menu" class="layout-menu menu-vertical bg-menu-theme menu">
    <div class="app-brand demo">
        <a href="" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-light">{{ config('app.name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner">
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Analytics</span>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Authentication</span>
        </li>
        <li
            class="menu-item {{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.create') || request()->routeIs('admin.users.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Manage Users</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Products</span>
        </li>
        <li
            class="menu-item {{ request()->routeIs('admin.categories.index') || request()->routeIs('admin.categories.create') || request()->routeIs('admin.categories.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div>Manage Categories</div>
            </a>
        </li>

        
        <li
            class="menu-item {{ request()->routeIs('admin.products.index') || request()->routeIs('admin.products.create') || request()->routeIs('admin.products.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.products.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-coffee"></i>
                <div>Manage Products</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">File Management</span>
        </li>
        <li
            class="menu-item {{ request()->routeIs('admin.files.index') || request()->routeIs('admin.files.create') || request()->routeIs('admin.files.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.files.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image"></i>
                <div>Manage Files</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Bookings</span>
        </li>
        <li
            class="menu-item {{ request()->routeIs('admin.tables.index') || request()->routeIs('admin.tables.create') || request()->routeIs('admin.tables.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.tables.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div>Manage Tables</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Orders</span>
        </li>
        <li class="menu-item {{ request()->is('admin/orders*') ? 'active' : '' }}">
            <a href="{{ route('admin.orders.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                <div>All Orders</div>
            </a>
        </li>
    </ul>
</aside>
