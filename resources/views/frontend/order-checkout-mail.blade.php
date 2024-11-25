<div>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Order Status</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        <style>
            img{
                width: 100px;
                height: 100px;
                object-fit: cover;
            }
            .quantity{
                align-self: flex-end;

            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="text-center">
                <h3>
                    <div class="fw-bold">Inventory</div>
                </h3>
                <h4>
                    <div class="order-status mt-5  fw-normal">Order Confirmation</div>
                </h4>
                <p class="mt-3">We'll drop you another email when your order ships.</p>

                <div class="mt-4 fw-bold">Order No. {{ $data->order_number }}</div>
            </div>

            <p>items orderd</p>
            <a href="{{url('/home')}}"> visit the site</a>
            @foreach($data->orderItems as $item)
                <hr>
            {{-- {{dd($item->ColorSize->product->product_name)}} --}}
                <div class="ms-2 d-flex align-items-center">
                    {{-- {{dd}} --}}
                    <img src="{{ env('APP_URL') .'images/'.$item->ColorSize->image->first()->url}}">
                    <div class="ms-3 ">
                       {{$item->ColorSize->product->product_name}}</br>
                        <span class="mt-2">Color: {{ $item->colorSize->color->color }}</span>
                    </div>
                    <div class="ms-auto d-flex align-items-center">
                            <div class="quantity me-4">
                               x {{$item->quantity}}
                            </div>
                    <div class="">
                        $ {{$item->price}}
                    </div>
                </div>
                </div>

            @endforeach
            <hr>
            <p>Discount : -${{$data->discount}}</p>
            <p>Status :{{$data->status}}</p>
            <p>Subtotal :${{$data->total_price}}</p>

        </div>


    </body>

    </html>

</div>
