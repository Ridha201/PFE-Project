@extends('theme')
@section('content')
<div class="track-order-section section mt-40 mb-50">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="track-order-title text-center col-12 mb-50">
                <h2>Track your order...</h2>
                <p>To track your order please enter your Order ID in the box below and press the “Track” button. This was give to you on your receipt and in the confirmation email you should have reveived</p>
            </div>
            
            <div class="col-lg-6 col-md-7 col-12 mb-40">
                <div class="track-order-form">
                    <form action="#">
                        <label for="order_id">Order ID</label>
                        <input type="text" id="order_id" placeholder="Find it in your order confirmation email">
                        <label for="billing_email">Billing Email Address</label>
                        <input type="email" id="billing_email" placeholder="Email you used during checkout">
                        <input type="submit" class="stockbtn"value="Track Order">
                    </form>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-5 col-12 ms-auto mb-40">
                <div class="banner"><a href="#"><img src="assets/images/banner/banner-33.jpg" alt="Banner"></a></div>
            </div>
            
        </div>
    </div>
</div>
@endsection