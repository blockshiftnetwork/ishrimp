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
                {{__('Overview')}}
            </h3></a>
            @yield("overview_options")
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
