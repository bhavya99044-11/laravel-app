
<div class="col-3 ">
    <a href="{{url('product/'.$product->id)}}">
    <div class="latest-first-product">
            <img src="{{asset("images/".$product->ColorSize->first()->image->first()->url)}}">
            <div class="product-data">
            <h1>{{$product->product_name}}</h1>
            <div class="margin-bottom">$<span class="product-price">500</span></div>
            <a class="text-start heading add-to-cart"  data-id="{{$product->id}}">+ add to cart </a>

        </div>
        </div>
    </a>

</div>

<script>
$(document).on('click', '.add-to-cart', function(){
    let productId=$(this).data('id');
 success(productId,quantity=1);
});
    </script>
