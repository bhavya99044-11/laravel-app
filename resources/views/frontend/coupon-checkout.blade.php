<div>
    @extends('frontend.default')

    @push('styles')
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #e8e8e8;
            }

            .cart-product {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid black;
            }

            .cart-heading {
                font-size: 30px;
            }

            .cart-first img {
                height: 100px;
                border-radius: 10px;

                width: 100px;
            }

            .cart-summary {
                border-radius: 10px;
                padding: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 1);
                background-color: white;
            }

            .form {
                margin-top: 100px;
            }

            .coupon-button {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 20px;
            }

            .coupon-box input {
                width: 90%;
                /* margin-right: 10px; */
            }

            .coupon-button button {
                border-radius: 4px;
                border: none;
                padding: 10px;
                font-size: 14px;
                background-color: #28a745;
                color: white;
                cursor: pointer;
                width: 25%;
            }

            .pay-now {
                border-radius: 4px;
                border: none;
                padding: 10px;
                font-size: 14px;
                background-color: rgb(212, 135, 148);
                color: white;
                cursor: pointer;
                width: 100%;
                transition: ease 0.5s;
            }

            .coupon-button button:hover,
            .pay-now:hover {
                opacity: 0.8;
            }

            .coupon-response {
                height: 20px;
            }

            .fixed {}
        </style>
    @endpush


    @section('content')

        <body>
            <div class="container">
                <div class="row form">
                    <div class="col-8">
                        <div class="text-primary cart-heading">Shopping Cart</div>
                        @foreach ($data['cartData'] as $cart)
                            <div class="cart-product mt-3">
                                <div class="cart-first d-flex align-items-center">
                                    <!-- <h1>hello</h1> -->
                                    <img class="mb-2"
                                        src={{asset('images/'.$cart->ColorSize->image[0]->url)}}>
                                    <div class="product-info ms-3 ">
                                        <div class="product-name">{{ $cart['product']['product_name'] }}</div>
                                        <div class="product-price">${{ $cart['product']['price'] }}</div>
                                    </div>
                                </div>
                                <div class="product-count">
                                    {{ $cart->quantity }}
                                </div>
                                <div class="product-price">
                                    ${{ $cart->total }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-4">
                        <div class="cart-summary">
                            <h4>Cart Summary</h4>
                            <p>Subtotal: <span id="subtotal">${{ $data['cartSummary']['subTotal'] }}</span></p>
                            <p>GST (18%): <span id="gst">${{ $data['cartSummary']['gst'] }}</span></p>
                            <p>Total: <span id="subtotal">${{ $data['cartSummary']['total'] }}</span></p>
                            <p>Discount: <span id="discount">${{ $data['cartSummary']['discount'] }}</span></p>
                            <hr>
                            <div class="total">
                                <h4>total: $<span class="price">{{ $data['cartSummary']['grandTotal'] }}</span></h4>
                            </div>
                            <form id="payNow">
                                <div class="coupon-button">
                                    <div class="coupon-box"><input type="text" id="couponCode" class="form-control"
                                            placeholder="Enter coupon code"></input>
                                    </div>
                                    <button id="couponButton" type="submit" class="">Apply Button</button>
                                </form>

                                </div>
                                <div class="pt-2 pb-3 coupon-response"></div>
                                <div class="pt-3 fixed"><button class="pay-now" id="payClick">Pay Now</button></div>

                        </div>
                    </div>
                </div>
            </div>
        </body>
    @endsection

    @push('scripts')
        <script>
            $(document).ready(function() {
                var price = $('.price').text();
                $('#payNow').on('submit', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('couponApply') }}",
                        type: 'POST',
                        data: {
                            coupon_code: $('#couponCode').val()
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                $('.coupon-response').text(response.message);
                                console.log(response.message);
                                $('.price').text(response.amount);
                                console.log(response.message);
                            } else if (response.status == 404) {
                                console.log(response)
                                $('.coupon-response').text(response.message);
                                $('.price').text(price);

                                console.log(response.message);

                            }
                        }
                    })
                });



                $('#payClick').on('click', function(event) {

                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('payNow') }}",
                        type: 'POST',
                        data: {
                            coupon_code: $('#couponCode').val()
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                console.log(response);
                                window.location.href = '{{ url('/home') }}';
                            } else {
                                console.log(response.message);
                            }
                        }

                    })

                });



            });
        </script>
    @endpush
</div>
