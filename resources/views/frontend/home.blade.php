 @extends('frontend.default')

@push('sripts')

@endpush

@section('content')



 <!-- banner start -->
 <section class="banner">
    <div class="owl-carousel owl-theme">

        @foreach($data['products'] as $product)
        <div class="item">
            <div class="container d-flex align-items-center">
                <span class="container-left ">
                    <i class="fa fa-angle-left slider-left"></i></span>
                <div class="row">

                    <div class="col-4">

                        <div class="ms-3 banner-content">
                            <h1 >{{$product->product_name}}</h1>
                            <p class="mt-3">{!! $product->product_description !!}</p>
                            <a href="{{route('productData',['id'=>$product->id])}}">Buy now</a>
                            {{-- @php $url= $product->ColorSize[0]->image[0]->url @endphp --}}
                            {{-- {{$data['products'][0]->ColorSize[0]->image[0]->url}}
                            {{dd($product->ColorSize[0]->image[0]->url)}} --}}
                        </div>
                    </div>

                    <div class="d-flex  banner-img col-7">
                        <img src="{{asset('images/'.$product->ColorSize->first()->image->first()->url)}}">

                    </div>
                </div>
                <span class="container-right">
                    <i class="fa fa-angle-right slider-right"></i>
                </span>
            </div>

           </div>
           @endforeach
        </div>
        {{-- <div class="item"> <div class="container d-flex align-items-center">

            <span class="container-left">
                <i class="fa fa-angle-left slider-left"></i></span>
            <div class="row">
                <div class="col-lg-4">
                    <div class="ms-3 banner-content">
                        <h1 >Kitchen</h1>
                        <p class="mt-3">the new arrival of sofa you can definity love thishhhhhhhhh hhhhhhhhhhhhhh h</p>
                        <a href="">Buy now</a>
                    </div>
                </div>
                <div class="d-flex  banner-img col-lg-8">
                    <img src="https://img.freepik.com/free-photo/organic-cosmetic-product-with-dreamy-aesthetic-fresh-background_23-2151382816.jpg">

                </div>
            </div>
            <span class="container-right">

                <i class="fa fa-angle-right slider-right"></i>
</span>

    </div> --}}

</section>
<!-- banner end -->


<!-- featured categories -->
    <section class="featured-categories" id="shopView">
        <div class="container">
            <div class="s-title text-center">
            <h1>Categories</h1>
        </div>

            <div class="row g-2 categories-start align-items-center d-flex">
                @for($i=1;$i<=4;$i+=2)
                <div class="col-md-6 me-3 categories-first">
                   @include('frontend.layouts.category',['data'=>$data['categories'][$i]])
                </div>

                <div class="col-md-5 categories-second">
                    @include('frontend.layouts.category',['data'=>$data['categories'][$i+1]])

                </div>
                @endfor
            </div>

        </div>
    </section>
<!-- end feautured categories -->

<!-- latest products -->
    <section class="latest-products">
        <div class="container">
            <h1 class="text-center">Latest Products</h1>
        <div class="row">
            @foreach($data['products'] as $product)
           @include('frontend.layouts.product_home')
           @endforeach
            </div>
        </div>
    </section>
    @endsection
<!-- end latest products -->
@push('scripts')

@endpush
