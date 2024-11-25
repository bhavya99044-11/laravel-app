@extends('layouts.default')
@section('content')
<div>

    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link rel="stylesheet" href="{{ asset('assets/css/productPage.css') }}" />

        </head>
        <body>


            <section id="product-info">

                <div class="item-image-parent">
                    <div class="item-list-vertical">
                        {{-- <div class="thumb-box">
                            <img src="https://i.ibb.co/VJf6fXm/thumb1.jpg" alt="thumbnail" />
                        </div>
                        <div class="thumb-box">
                            <img src="https://i.ibb.co/Jt5zc58/thumb2.jpg" alt="thumbnail" />
                        </div>
                        <div class="thumb-box">
                            <img src="https://i.ibb.co/Yf9LMpy/thumb3.jpg" alt="thumbnail" />
                        </div>
                        <div class="thumb-box">
                            <img src="https://i.ibb.co/60hPGy2/thumb4.jpg" alt="thumbnail" />
                        </div> --}}

                    </div>
                    <div class="item-image-main">
                           <h1></h1>
                        <img id="mainImage" src={{asset("images/".$data['product'][0]->ColorSize[0]->image[0]->url)}} alt="default" />
                    </div>
                </div>

                <div class="item-info-parent">
                    <!-- main info -->
                    <div class="main-info">
                        <h4>{{$data['product'][0]->product_name}}</h4>
                        <div class="star-rating">
                        </div>
                        <p>Price: <span id="price">{{$data['product'][0]->price}}</span></p>
                    </div>
                    <!-- Choose -->
                    <div class="select-items">

                        <div class="change-color">
                            <label><b>Colour:</b> <div style="color:{{$data['product'][0]->ColorSize[0]->color->color}};" id="colorName">{{$data['product'][0]->ColorSize[0]->color->color}}</div></label><br>
                            @foreach($data['product'][0]->ColorSize as $view)
                            @foreach($view->image as $image)
                                <div class="thumb-box">
                                    <img data-id="{{$image->id}}" src="{{ asset("images/".$image->url)}}" alt="thumbnail" />
                                </div>
                            @endforeach
                            @endforeach


                        </div>

                        <div class="change-size">
                            <label><b>Size:</b></label><br>
                            <select>
                                @foreach($data['product'][0]->ColorSize as $view)

                               <option value="{{$view->size->id}}">{{$view->size->name}}</option>
                                @endforeach

                            </select>

                            {{-- @foreach($view->size as $size)
                            <h1>{{$size[0]->name}}</h1>
                            @endforeach --}}

                        </div>
                        <h1>

                        </h1>

                        <div class="description">
                            {!! $data['product'][0]->product_description !!}
                        </div>
                    </div>
                    <!-- Description -->
                </div>
            </section>
        </body>
        </html>
</div>
@include('pages.comment-page')
@endsection

@push('script')
<script>
$(document).ready(function(){
   let data=@json($data['product'][0]['ColorSize']);
   localStorage.setItem("productData",JSON.stringify(data) );




$('.thumb-box').on('click',function(){
    let click=this.querySelector('img').getAttribute('data-id');
    let url;
    let product=JSON.parse(localStorage.getItem('productData'));
    product.forEach(function(data){
        if(click==data['image'][0]['id']){
            url=data['image'][0]['url'];
            $('#colorName').html(data['color']['color']).css({"color":data['color']['color']})
        }
    })
   let imageUrl='{{ URL::asset("images") }}'+"/"+url;
    $('#mainImage').attr('src',imageUrl);


})


});

    </script>
@endpush
