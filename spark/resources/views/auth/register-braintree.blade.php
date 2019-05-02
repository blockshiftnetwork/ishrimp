@extends('spark::layouts.app')

@push('scripts')
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
@endpush

@section('content')
<spark-register-braintree inline-template>
    <div>
        <div class="spark-screen container">
            <!-- Common Register Form Contents -->
            @include('spark::auth.register-common')


    </div>
</spark-register-braintree>
@endsection
