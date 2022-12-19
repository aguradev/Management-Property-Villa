    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
                <span class="app-brand-logo demo">

                </span>
                <span class="app-brand-text demo menu-text fw-bolder ms-2">Dashboard</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-alt"></i>
                    <div>Home</div>
                </a>
            </li>

            <!-- Layouts -->

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pages</span>
            </li>

            <li class="menu-item @if (request()->segment(2) == 'properties-villa' ||
                request()->segment(2) == 'properties-gallery' ||
                request()->segment(2) == 'properties-feature') active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    Property Villa
                </a>
                <ul class="menu-sub">
                    <li class="li menu-item @if (Route::is('properties-villa.index')) active @endif">
                        <a href="{{ route('properties-villa.index') }}" class="menu-link">
                            <div>View Property</div>
                        </a>
                    </li>
                    <li class="li menu-item @if (Route::is('properties-gallery.index')) active @endif">
                        <a href="{{ route('properties-gallery.index') }}" class="menu-link">
                            <div>Galleries Property</div>
                        </a>
                    </li>
                    <li class="li menu-item @if (Route::is('properties-feature.index')) active @endif">
                        <a href="{{ route('properties-feature.index') }}" class="menu-link">Feature Property</a>
                    </li>
                </ul>
            </li>

            <li class="menu-item @if (request()->segment(2) == 'categories-property') active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    Categories
                </a>
                <ul class="menu-sub">
                    <li class="li menu-item @if (Route::is('categories-property.index')) active @endif">
                        <a href="{{ route('categories-property.index') }}" class="menu-link">View Categories</a>
                    </li>
                </ul>
            </li>

    </aside>
    <!-- / Menu -->
