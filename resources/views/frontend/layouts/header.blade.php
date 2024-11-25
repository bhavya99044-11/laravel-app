
{{-- <link href="
https://cdn.jsdelivr.net/npm/jquery-typeahead@2.11.1/dist/jquery.typeahead.min.css
" rel="stylesheet"> --}}


{{-- end type head js --}}

<!-- Include js plugin -->

<style>

    :root{
        --background: #ECFDFF;
    }

.navbar{
    background-color:var(--background) !important;

}

header{
    width: 100%;
    background-color: var(--background);
    padding: 5px 0;
}

.nav-item{
    margin :0 10px;
}

.nav-link{
    color:#000;
    font-family: "Poppins", serif;
  font-weight: 400;
  text-transform: uppercase;
  font-size:15px;
}

.nav-icons a i{
color:#000 !important;
font-size:17px;
}

.nav-icons{
    justify-content: center;
    align-items: center
}

.nav-icons a{
    margin: 0 14px;
}



.navbar-brand{
    color:#000;
    font-family: "Poppins", serif;
  font-weight: bold;
  text-transform: capitalize;
  font-size:35px;
}

.cart-icon{
    position: relative;
}

.cart-icon span{
    display: inline-block;
    background-color: red;
    border-radius: 100%;
    text-align: center;
    line-height: 14px;
    top: -5px;
    padding: 2px 3px;
    right: -9px;
    font-weight: 600;
    position: absolute;
    color: white;
}

.nav-item{
position: relative;

}

.sub-menu{
    position: absolute;
    background-color: #FF3368;
    list-style: none !important;
    padding: 20px;
    left: -4px;
    border-radius: 3px;
    transition: 0.6s ease;
    transform: scale(1,0);
    color: white !important;
    line-height: 25px;
    transform-origin: top;


}

.sub-menu li{
    font-family: "Poppins", serif;
  font-weight:400 ;
  font-size: 15px;
  text-transform: capitalize;
}

.nav-item:hover .sub-menu{

    transform: scale(1);

}

body{
    font-family: "Poppins", serif;

}

.banner-img{
    display: flex;
    align-items: center;
    justify-content: center;
}
.banner-img img{
    width: 700px !important;
    height: 400px;
}
.banner-content h1{
    font-weight: bold;
    margin-bottom: 30px;
    font-size: 50px;
    object-fit: cover;
    text-transform: capitalize;
}

.banner-content p{

line-height: 23px;
margin-bottom: 40px;

}




.banner-content a{
    font-weight: 600;
    color: white;
    display:inline-block;
    text-transform: uppercase;
    background-color: #ff3368;
    text-decoration: none;
    height: 50px;
    line-height: 50px;
    text-align: center;
    justify-content: center;
    width: 150px;
    border-radius: 5px;
    background-image: linear-gradient(16deg, #ff005a 0%, #ff5d2d 82%, #ffba00 100%);
    transition:all 1s ease !important; /* Adjusted duration */
}

.banner-content a:hover{
    background-image: linear-gradient(16deg, #ff005a 0%, #ff5d2d 50%, #ffba00 100%);
}

 .sub-menu li{
    white-space: nowrap;

}
.sub-menu li a{
    color: white;
    text-decoration: none;

}
.owl-prev i{
    font-size: 40px;
}

.owl-next i{
    font-size: 40px;
}
.fa{
    cursor: pointer;
}

.fa-angle-left{
    color: #86bec6;
    font-size: 40px;
}

.fa-angle-right{
    color: #86bec6;

    font-size: 40px;
}
.banner{
    background-color: var(--background);
    padding: 185px 0;
    width: 100%;
}

.col-
/*
.item .container{
    position: relative;
}

.container-right{
    margin-left: 10px;
}

.container-left{
    top: 174px;
    margin-bottom: 50px !important;
    position: absolute;
} */
.container-right {
    margin-left: -76px;
}

.container-left{
    margin-right: 7px;
}

.categories-start{
    margin-top: 100px;
}

.col-4{
    flex: 0 0 auto;
    width:400px;
}

.categories-first,.categories-second{
    background-color: #F8FBFF;
    padding-top: 40px;
    padding-left: 50px;
    bottom: 0 !important;
    /* box-sizing: border-box;

    border: 10px solid transparent;
    background-clip:padding-box; */
    position: relative;
    height: 400px !important;
}

.categories-second{
padding-right: 50px;
}

.categories-first h1,.categories-second h1{
    font-weight: bold;

}


.s-title h1{
    margin-top: 50px;
    color:#000;
    font-family: "Poppins", serif;
  font-weight: 600;
  text-transform: capitalize;
  font-size:40px;
}

.categories-first img,.categories-second img{
    width: 350px;
    padding-right: 40px;
    object-fit: cover;
    height: 330px;
}

.categories-second img{
padding-right: 50px !important;
}

header{
    position: fixed;
    height: 80px;
    top: 0;
    left: 0;

  z-index: 100;
}

.categories-first a,.categories-second a{
    text-decoration: none;
    position: absolute;
    bottom: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: red;
    letter-spacing: 2px;
    font-size: 20px;
    font-weight: bold;
    opacity: 0;
    transition: 0.5s ease;
}

.categories-first:hover a,.categories-second:hover a{
transform-origin: top;
transform: translateY(10px);
transition: 0.5s ease;
opacity: 1;
}

.categories-first a i,.categories-second a i{

margin-left: 10px;
font-size: 30px;

}

.latest-products{
    height:600px;
    margin-bottom: 100px
}

/* latest product css */
.latest-products h1{

    font-size: bold;
    font-weight: 600;
    margin-top: 20px;
    margin-bottom: 80px;

}

.latest-first-product .product-data{
    transition: 0.5s ease;

}

.product-height{
    height: 600px;
}

.col-3{
}

.latest-first-product{
    background-color: #FFFAF9;
    padding-bottom: 20px;
    margin-top: 30px
}

.col-3 a{
    display: block;
    text-decoration: none;
    color: #000;
    transition: 0.5s ease;
}

.latest-first-product img{
    width: 100%;
    height: 300px;
}

.latest-first-product .heading{
    /* opacity: 0; */
    text-transform: uppercase;
    text-align: start;
    text-decoration: none;
    font-weight: 500;
    color: rgb(213, 110, 127);
}

.latest-first-product i{
    opacity: 0;
    text-align: end;
    color: #ff005a;
    float: right;
}

.latest-first-product:hover i{
    opacity: 1;
}


.latest-first-product:hover .heading{
    opacity: 1;

}

.latest-first-product:hover {
    box-shadow: 2px 2px 10px 0px rgba(0, 0, 0, 0.5);
}

/* .latest-first-product i {
padding-bottom: 50px;
} */


.latest-first-product:hover .product-data{
    margin: 0px 10px;
}

/* .margin-bottom{
    padding-bottom: 100px;
} */

.latest-first-product{
}

.nav-icons input{
background: transparent;
outline: none;
border: 1px solid rgb(179, 170, 170);
border-radius: 40px;
width:140px;
padding: 3px
}
.nav-icons input[type="text"]{
    padding-left: 10px
}

.nav-icons button{
    position: absolute;
    border: none;
    margin-left: 63px;

    background-color: transparent
}
.nav-icons form{
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin:  auto;
    position: relative;
    margin-right: 10px;
    width:140px;
}

.search-box{
    display: flex;
    align-items: center;
    justify-content: center;
}

.tt-menu{
    margin-top: 5px;
    width: 140px;
    background-color: white
}

.width{
    width: 450px;
}

a{
    cursor: pointer;
}



/* end latest product css */

</style>



    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- header start -->
     <header>
        <div class="container">

    <nav class="navbar navbar-expand-lg bg-body-tertiary custom-navbar">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{url('/home')}}">Inventory.</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse  navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{url('/home')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#shopView">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active " href="#">categories<span class="ms-1"><i class="fa fa-angle-down"></i></span></a>
                <ul class="sub-menu">
                    @foreach($data['categories'] as $key=>$category)
                    @if($key==0)
                    @else
                    <li><a href="{{url('/categories/'.$category->id)}}">{{$category->name}}</a></li>
                    @endif

                    @endforeach
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active " href="{{route('viewOrder')}}" >Orders<span class="ms-1"></span></a>
              </li>
            </ul>
            <div class="d-flex nav-icons" >

             <input type="text" placeholder="Search Here" class="searchProduct" name="search_product" id="searchProduct"></input><button id="productButton"><i class="fa fa-search"></i></button>

                <a href="{{route('addCart')}}" class="cart-icon"><i class="fa fa-shopping-cart" aria-hidden="true"><span class="cart_count">
                    @if($data['cart_count']>0)
              {{$data['cart_count']}}
                    @else
                    0
                    @endif
                </span>
                  </i>
                </a>

            </div>
          </div>
        </div>
        </div>
      </nav>
    </header>
      <!-- header end -->







<script>
    $(document).ready(function(){

        var productData=null;
        var owl = $('.owl-carousel').owlCarousel({
    // loop:true,
    //     autoplay: true,
    //     autoplayTimeout: 3000,
    // margin:10,
    // smartSpeed: 1000,
    // autoPlay:true,
    autoHeight:false,
    autoWidth:false,
    responsive:{
        0:{
            items:1
        }
    }
})

$(document).on('click', '#productButton', function(){
    if(productData!=null){
       if(productData['id']!='')
      window.location.href="{{route('productData','')}}/"+productData['id']
    }

    })

$('.slider-left').click(function(){
    owl.trigger('prev.owl.carousel')
    owl.trigger('stop.owl.autoplay');

})
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

// $('.searchProduct').typeahead({
//     hint: true,
//     highlight: true,
//     minLength: 1,
//     source: function(query, process) {
//     let value=$('#searchProduct').val();
//         return $.ajax({
//             url: "{{route('LiveSearch')}}",
//             type: 'Post',
//             data: {value:value},
//             success: function(json) {
//                 if(json.status==200){
//                 console.log(json.data)
//                process( JSON.parse(json.data))
//                 }
//             else{
//                 console.log(333);
//             }
//             }
//         });
//     }
// })

$('.searchProduct').typeahead({
minLength:1,
highlight:true},{
name:'name',
display:'product_name',
source:function(query,syncResult,asyncResults){
    let value=$('#searchProduct').val();
$.ajax({
    url:"{{route('LiveSearch')}}",
    type:'post',
    data:{value:value},
    success:function(json){
       data=JSON.parse(json.data);
       if(Array.isArray(data)){
        asyncResults(data)
//         asyncResults(data.map(function(item) {
//   return {
//    value: item.product_name,
//    id: item.id
//   };
// }));
       }else{
        console.log(222)
       }
    }

})
}

}).bind('typeahead:select',function(ev,sug){
    productData=sug;
});


$('.slider-right').click(function(){
    owl.trigger('next.owl.carousel')
    owl.trigger('stop.owl.autoplay');

})

$(document).on('keypress', '#searchProduct', function(e){
onClick(e,'productButton')
    })


// $('.owl-prev').html('<i class="fa fa-angle-left"></i>');
// $('.owl-next').html('<i class="fa fa-angle-right"></i>');

})
</script>
