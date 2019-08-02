<nav id="menu" class="nav-main" role="navigation">
				            
    <ul class="nav nav-main">
        <li class="">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-home" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>                        
        </li>
        {{-- <li class="nav-parent ">
            <a class="nav-link" href="#">
                <i class="fas fa-shopping-basket" aria-hidden="true"></i>
                <span>Orders</span>
            </a>
            <ul class="nav nav-children">
                <li>
                    <a class="nav-link" href="index.html">
                        Submenu 1
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="layouts-default.html">
                        Submenu 2
                    </a>
                </li>
 
            </ul>
        </li> --}}

         @if (auth()->user()->isClient())
            <li class="{{ request()->is('dashboard/order/*') ? 'nav-active' : '' }}">
                <a class="nav-link" href="{{ route('order.index') }}">
                    <i class="fas fa-shopping-basket" aria-hidden="true"></i>
                    <span>Orders</span>
                </a>                        
            </li>
        @else
            <li class="{{ request()->is('orders*') ? 'nav-active' : '' }}">
                <a class="nav-link" href="{{ route('order.main') }}">
                    <i class="fas fa-shopping-basket" aria-hidden="true"></i>
                    <span>Orders</span>
                </a>                        
            </li>

        @endif
        
        <li class="{{ request()->is('invoices*') ? 'nav-active' : '' }}">
            <a class="nav-link" href="{{ route('invoice.index') }}">
                <i class="fas fa-file-alt"  aria-hidden="true"></i>
                <span>Invoices</span>
            </a>                        
        </li>


        @if (auth()->user()->isAdmin())
            <li class="{{ request()->is('clients*') ? 'nav-active' : '' }}">
                <a class="nav-link" href="{{ route('client.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Clients</span>
                </a>                        
            </li>
        @endif

        @if (auth()->user()->isAdmin())
            <li class="{{ request()->is('discounts*') ? 'nav-active' : '' }}">
                
                <a class="nav-link" href="{{ route('service.index') }}">
                    <i class="fas fa-percent"></i>
                    <span>Discounts</span>
                </a>

            </li>

            <li class="{{ request()->is('services*') ? 'nav-active' : '' }}">
                
                <a class="nav-link" href="{{ route('service.index') }}">
                    <i class="fab fa-searchengin" aria-hidden="true"></i>
                    <span>Services</span>
                </a>

            </li>
            <li class="{{ request()->is('order-form*') ? 'nav-active' : '' }}">
                
                <a class="nav-link" href="{{ route('order-form.index') }}">
                    <i class="fas fa-list-alt" aria-hidden="true"></i>
                    <span>Order Form</span>
                </a>

            </li>
        @else
            <li class="{{ request()->is('dashboard/services') ? 'nav-active' : '' }}">
                
                <a class="nav-link" href="{{ route('services') }}">
                    <i class="fab fa-searchengin" aria-hidden="true"></i>
                    <span>Services</span>
                </a>

            </li>
        @endif

        <li class="{{ request()->is('profile') ? 'nav-active' : '' }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="far fa-user" aria-hidden="true"></i>
                <span>Profile</span>
            </a>                        
        </li>

        @if (auth()->user()->isAdmin())
        <li class="{{ request()->is('settings/general') ? 'nav-active' : '' }}">
            <a class="nav-link" href="{{ route('settings.general') }}">
                <i class="fas fa-cogs" aria-hidden="true"></i>
                <span>Settings</span>
            </a>                        
        </li>
        @endif
        
    </ul>
</nav>