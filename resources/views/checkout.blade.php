@extends('theme')
@section('content')
<div class="page-section section mt-90 mb-30">
    <div class="container">
        <div class="row">
            <div class="col-12">
                
                <!-- Checkout Form s-->
                <form action="{{ url('place-order2')}}" class="checkout-form" method="POST">
                    @csrf
                   <div class="row row-40">
                       
                       <div class="col-lg-7 mb-20">
                          
                           <!-- Billing Address -->
                           <div id="billing-form" class="mb-40">
                               <h4 class="checkout-title">Billing Address</h4>

                               <div class="row">

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>First Name*</label>
                                       <input type="text" placeholder="First Name" class="name" name="name">
                                       <span id="name_error" class="text-danger"></span>
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Last Name*</label>
                                       <input type="text" placeholder="Last Name" class="lastname" name="lastname">
                                       <span id="lname_error" class="text-danger"></span>
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Email Address*</label>
                                       <input type="email" placeholder="Email Address" class="email" name="email">
                                       <span id="email_error" class="text-danger"></span>
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Phone no*</label>
                                       <input type="text" placeholder="Phone number" class="phone" name="phone">
                                       <span id="phone_error" class="text-danger"></span>
                                   </div>



                                   <div class="col-12 mb-20">
                                       <label>Address*</label>
                                       <input type="text" placeholder="Address line 1" class="address1" name="address1">
                                       <span id="address1_error" class="text-danger"></span>
                                       <input type="text" placeholder="Address line 2" class="address2" name="address2">
                                       <span id="address2_error" class="text-danger"></span>
                                   </div>



                                   <div class="col-md-6 col-12 mb-20">
                                       <label>State*</label>
                                       <input type="text" placeholder="State" class="state" name="state">
                                       <span id="state_error" class="text-danger"></span>

                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Zip Code*</label>
                                       <input type="text" placeholder="Zip Code" class="zipcode" name="zipcode">
                                       <span id="zipcode_error" class="text-danger"></span>
                                   </div>

                                  

                               </div>

                           </div>
                           
                           <!-- Shipping Address -->
     
                       </div>
                       
                       <div class="col-lg-5">
                           <div class="row">
                               
                               <!-- Cart Total -->
                               <div class="col-12 mb-60">
                               
                                   <h4 class="checkout-title">Cart Total</h4>
                           
                                   <div class="checkout-cart-total">

                                       <h4>Product <span>Total</span></h4>
                                       
                                       <ul>
                                        <?php $total = 10; ?>
                                        @foreach ($donnee as $i)
                                           <li>{{$i->productName}} X {{$i->productQuantity}} <span>${{$i->productPrice}}</span></li>
                                           {{$total = $total + $i->productPrice * $i->productQuantity}}
                                        @endforeach
                                          
                                       </ul>
                                       
                                       <p>Sub Total <span class="grand_total_checkout2">$00.00</span></p>
                                       <p>Shipping Fee <span>$10.00</span></p>
                                       
                                       <h4>Grand Total <span class="grand_total_checkout">$00.00</span></h4>
                                       
                                   </div>
                                   
                               </div>
                               
                               <!-- Payment Method -->
                               <div class="col-12 mb-60">
                               
                                   <h4 class="checkout-title">Payment Method</h4>
                           
                                   <div class="checkout-payment-method">
                                    <div class="single-method">
                                        <input type="radio" id="payment_cash" name="payment-method" value="cash" onclick="togglePaymentButtons()">
                                        <label for="payment_cash">Cash on Delivery</label>
                                        <p data-method="cash">Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
                                    </div>
                                
                                    <div class="single-method">
                                        <input type="radio" id="payment_paypal" name="payment-method" value="paypal" onclick="togglePaymentButtons()">
                                        <label for="payment_paypal">Paypal</label>
                                    </div>
                                
                                    <button class="place-order2" id="place-order-btn" style="display:none; shape:pill" >Place order</button>
                                    <div id="paypal-button-container" style="display:none; margin-top: 5px"></div>
                                </div>
                                   
                                   

                                   

                                   
                               </div>
                               
                           </div>
                       </div>
                       
                   </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://www.paypal.com/sdk/js?client-id=AeXCNA-SyyI-g_JXp_z2NgNw2yP5vuOi97ldXmZbiHUZ8BW6g0a1NUyHM4kt7NJPUE-VnLeonpkb4xmm"></script>
<script>
    paypal.Buttons({
        style: {
            shape: 'pill',
            color: 'gold',
            layout: 'vertical',
            label: 'paypal',
            
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{$total}}'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                

                var name = $('.name').val();
                var lastname = $('.lastname').val();
                var email = $('.email').val();
                var phone = $('.phone').val();
                var address1 = $('.address1').val();
                var address2 = $('.address2').val();
                var state = $('.state').val();
                var zipcode = $('.zipcode').val();

                

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
               });

       
                $.ajax({
                method : "POST",
                url : "/place-order",
                data : {
                    'name' : name,
                    'lastname' : lastname,
                    'email' : email,
                    'phone' : phone,
                    'address1' : address1,
                    'address2' : address2,
                    'state' : state,
                    'zipcode' : zipcode,

                },
                success : function(response){
                    window.location.href = "/placed";
                }

            })
                // Call your server to save the transaction
                return fetch('/paypal-transaction-complete', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                });
            });
        }
    }).render('#paypal-button-container'); // Display payment options on your web page
</script>

<script>
    function togglePaymentButtons() {
        var cashRadio = document.getElementById("payment_cash");
        var paypalRadio = document.getElementById("payment_paypal");
        var placeOrderBtn = document.getElementById("place-order-btn");
        var paypalBtnContainer = document.getElementById("paypal-button-container");
    
        if (cashRadio.checked) {
            placeOrderBtn.style.display = "block";
            paypalBtnContainer.style.display = "none";
        } else if (paypalRadio.checked) {
            placeOrderBtn.style.display = "none";
            paypalBtnContainer.style.display = "block";
        }
    }
    </script>