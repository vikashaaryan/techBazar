@extends('manager.managerlayout')

@section('title')
    payment Dashboard
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Test Payment (₹100)</h4>
                </div>

                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-shopping-cart fa-4x text-primary"></i>
                    </div>
                    
                    <h5>Test Product</h5>
                    <p class="text-muted">This is a dummy payment for testing purposes</p>
                    
                    <div class="payment-options mt-4">
                        <button id="rzp-button" class="btn btn-primary btn-lg">
                            Pay ₹100 Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection