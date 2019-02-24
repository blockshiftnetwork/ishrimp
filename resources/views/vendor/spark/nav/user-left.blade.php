<!-- Left Side Of Navbar -->

@push('scripts')
    @if (Spark::billsUsingStripe())
        <script src="https://js.stripe.com/v3/"></script>
    @else
        <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    @endif

@endpush
<div class="spark-settings-tabs sidebar bg-white">
    <aside>
    <a class="nav-link" href="/home">
            <h3 class="nav-heading ">
                {{__('Tablero')}}
            </h3></a>
            @yield("overview_options")
    </aside>
    <aside>
        <a class="nav-link" href="">
        <h3 class="nav-heading ">
            {{__('Inventario')}}
        </h3></a>
        @yield('Inventario_options')

    </aside>
    <aside>
        <a class="nav-link" href="/culture">
        <h3 class="nav-heading ">
            {{__('Cultivo')}}
        </h3></a>
        @yield('Cultivo_options')
    </aside>
    <aside>
        <a class="nav-link" href="/sowing">
        <h3 class="nav-heading ">
            {{__('Siembra')}}
        </h3></a>
        @yield('Sowing_options')

    </aside>
        <aside>
            <a class="nav-link" href="/settings">
            <h3 class="nav-heading ">
                {{__('Settings')}}
            </h3></a>
            @yield('settings_options')

        </aside>

        <!-- Billing Tabs -->
        @if (Spark::canBillCustomers())
            <aside>
            <a class="nav-link" href="#">
                    <h3 class="nav-heading ">
                            {{__('Billing')}}
                        </h3>
            </a>
               @yield("billing_options")
            </aside>
        @endif
    </div>
