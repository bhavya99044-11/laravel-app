<div>
@extends('frontend.default')

@push('styles')
<style>
body{
    font-family: "Poppins", serif;

}
table{
    margin-top: 50px;
    width: 100%;
}
td,th{
    border-bottom:1px solid  #DEE2E6 ;
}

th.product{
    width: 40%;
}

th.price{
    width: 15%;
}

th.quantity{
    width: 15%;
}

th.total{
    width: 15%;
}

th.remove{
width: 15%;
}

.cart-table{
    width:  !important;
}
th{
font-weight: 400;
color: grey;
font-size: 20px;
padding: 5px;
}

.product-name{
    margin-left: 10px;
}

.cart-product-img{
    width: 100px;
    height: 100px;
    object-fit: contain;

}

.cart-table{
    padding-top: 100px;
}


/* quantity button */

button:focus,
input:focus{
  outline: none;
  box-shadow: none;
}
a,
a:hover{
  text-decoration: none;
}

/*--------------------------*/
.qty-container{
  display: flex;
  align-items: center;
  justify-content: center;
}
.qty-container .input-qty{
  text-align: center;
  padding: 5px 10px;
  border: 1px solid #d4d4d4;
  max-width: 80px;
}
.qty-container .qty-btn-minus,
.qty-container .qty-btn-plus{
  border: 1px solid #d4d4d4;
  padding: 10px 13px;
  font-size: 10px;
  height: 38px;
  width: 38px;
  transition: 0.3s;
}
.qty-container .qty-btn-plus{
  margin-left: -1px;
}
.qty-container .qty-btn-minus{
  margin-right: -1px;
}


/*---------------------------*/
.btn-cornered,
.input-cornered{
  border-radius: 4px;
}
.btn-rounded{
  border-radius: 50%;
}
.input-rounded{
  border-radius: 50px;
}

.fa-trash{
    color: red;
    font-size: 25px;
    cursor: pointer;

}

th,td{
    text-align: center;
}

.no-data{
    margin-top: 50px;
    text-align: center;
    font-size: 20px;
    color: black;
}

.checkout{
    margin-left: 10px;
            border: none;
            color: white;
            font-weight: 500;
            background-color: #e754ca;
            padding: 6px 20px;
            border-radius: 40px;
            text-transform: uppercase;

}

.checkout:hover,.checkout:active{
    opacity: 0.5;
}

/* end quantity button */

</style>
@endpush

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="cart-table">
          @if($data['cart']->isNotEmpty())
          <div class="out-stock"></div>
        <table>
            <thead><tr><th class="product">Product</th>
            <th class="price">Price</th>
            <th class="remove">Remove</th>
            <th class="quantity">Quantity</th>
            <th class="total">Total</th>
        </tr>
            </thead>
            <tbody>
                @foreach($data['cart'] as $item)
                <tr>
                <td><img src="{{asset('images/'.$item['ColorSize']['image'][0]['url'])}}" class="cart-product-img"></img><span class="product-name">{{$item->product->product_name}}</span></td>
                <td>${{$item->product->price}}</td>
                <td class=""> <a class="deleteCart" data-id="{{$item->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                <td>{{$item->quantity}}</td>
                <td>${{$item->total}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
      <div class="text-end mt-3">  <a type="button" class="checkout"><span id="text">Checkout</span></a></div>
        @else
        <div class="no-data">
            Oops ,no items added to cart
        </div>
        @endif
    </div>
    </div>
</body>
</html>
</div>
{{--

quantity comtainer

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="qty-container">
            <button class="qty-btn-minus btn-light" type="button"><i class="fa fa-minus"></i></button>
            <input type="text" name="qty" value="0" class="input-qty"/>
            <button class="qty-btn-plus btn-light" type="button"><i class="fa fa-plus"></i></button>
        </div>
    </div> --}}
@endsection

@push('scripts')
<script>
$(document).ready(function(){

    var buttonPlus  = $(".qty-btn-plus");
var buttonMinus = $(".qty-btn-minus");

var incrementPlus = buttonPlus.click(function() {
  var $n = $(this)
  .parent(".qty-container")
  .find(".input-qty");
  $n.val(Number($n.val())+1 );
});

var incrementMinus = buttonMinus.click(function() {
  var $n = $(this)
  .parent(".qty-container")
  .find(".input-qty");
  var amount = Number($n.val());
  if (amount > 0) {
    $n.val(amount-1);
  }
});

$('.deleteCart').click(function(){
let id=$(this).data('id');
let url='{{ route('deleteCart', '') }}'+'/'+id;
console.log(url);
$.ajax({
    url: url,
    method: "get",
    data: {id: id},
    success: function(response){
        if(response.status){
            window.location.reload();
        }else{
            console.log('Error');
        }
    }
});
});

$(document).on('click', '.checkout', function(){
    let url=@json(url()->current());
    document.cookie = `intended.url=${url}; expires=Sun, 1 Jan 2025 00:00:00 UTC; path=/`;

$.ajax({
    url: "{{ route('placeOrder') }}",
    method: "get",
    success: function(response){
      if(response.status==200){
        window.location.href = "{{ route('checkoutCart') }}";
      }else if(response.status==400){
        $('.out-stock').html(response.data);
      }
      else if(response.status==401){
        console.log(11222);
        window.location.href="/login";
      }
    }

});


});

});
    </script>
@endpush
