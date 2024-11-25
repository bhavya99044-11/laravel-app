@extends('frontend.default')

@push('styles')
<style>
.category-products{
padding-top: 80px;
}

.latest-first-product{
    border: 1px solid rgb(190, 185, 185);
}
.latest-first-product h1{
    margin-bottom: 10px !important;
}

ul{
list-style-type: none;
padding-left: 0 ;
}


</style>
@endpush

@section('content')
<div class="latest-products category-products">
    <div class="container ">
    <div class="row">
        @if($data['products']->isNotEmpty())
        @foreach($data['products'] as $product)
        <div class="col-3 ">
            <a class="href" href="{{url('product/'.$product->id)}}">

            <div class="latest-first-product">
                    <img src="https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&dl=pexels-anjana-c-169994-674010.jpg&fm=jpg">
                    <div class="product-data">
                    <h1>{{$product->product_name}}</h1>
                    <h5>{!!$product->product_description!!}</h5>
                    <div class="margin-bottom">$<span class="product-price">500</span></div>
                    <a class="text-start heading add-to-cart"  data-id="{{$product->id}}">+ add to cart </a><i class="fa fa-heart ml-auto"></i>
                </div>
            </a>

                </div>
        </div>
       @endforeach
       @else
        <h4>oops, no prodcuts avaialble in this category</h4>


       @endif
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function(){

$(document).on('click', '.add-to-cart', function(){
    let productId=$(this).data('id');
 success(productId,quantity=1);
});

});
    </script>
@endpush
