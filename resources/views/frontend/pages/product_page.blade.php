@extends('frontend.default')
@push('styles')
    <style>
        body {
            font-family: "Poppins", serif;

        }

        .product-page {
            font-family: "Poppins", serif;
            margin-top: 100px;
            padding-top: 50px;

        }

        .product-page-details h1 {
            text-transform: capitalize;
            font-weight: 600;
        }

        .product-page .cc ul li {
            list-style: none;
        }


        .product-page .cc ul li img {
            height: 100px;
            width: 100px;
            margin-bottom: 50px;
        }

        .first {
            padding-right: 10px;
        }

        #mainImage {
            height: 461px;
            width: 478px;
            object-fit: contain;
        }

        .product-page .cc ul {
            margin-left: 65px;
            margin-right: 0;
        }

        .price-main {
            font-weight: bold;
            font-size: 30px;
            color: #e754ca;
        }

        .category,
        .availability {
            margin-top: 10px;
            text-transform: capitalize;
        }

        .availability-value,
        .category-value {
            margin-left: 10px;
        }

        .list li {
            list-style: none;
        }

        .category {
            width: 100px !important;
            display: inline-block;
        }


        .product-page-details ul {
            padding: 0;
            margin: 0;
        }

        .break {
            margin-top: 40px;
            border-top: 1px dotted black;
            width: 100%;

        }

        .text-start li {
            font-weight: 350;
            font-size: 16px;
        }

        .description {
            margin-top: 50px;
        }

        .product-page-details select {
            margin-top: 30px;
            width: 38%;
        }

        .buttons {
            margin-top: 30px;
        }

        .quantity {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100px;
            line-height: 40px;
            border: 1px solid rgb(202, 190, 190);
            color: #000;
            padding: 5px;
            border-radius: 40px;
        }

        .quantity .icon {
            flex: 0 0 auto;
            margin: 0 5px;
        }

        .quantity .count {
            flex: 1;
            text-align: center;
        }

        .buttons button {
            margin-left: 10px;
            border: none;
            color: white;
            font-weight: 500;
            background-color: #e754ca;
            padding: 2px 20px;
            border-radius: 40px;
            text-transform: uppercase;
        }


        .comment-button,
        .review-button {
            color: #000;
            background-color: white;
            border: none;
            border: 1px solid rgb(120, 117, 117);
            padding: 7px 15px;
            margin-top: 50px;
            margin-bottom: 50px;
            text-transform: uppercase;
            margin-right: 10px;
            border-radius: 40px;
            transition: 0.5s ease;
        }

        .comment-reply {
            text-transform: uppercase;
            color: #000;
            background-color: white;
            border: none;
            border: 1px solid rgb(120, 117, 117);
            padding: 5px 20px;
            margin-right: 10px;
            border-radius: 40px;
            transition: 0.5s ease;
        }

        .comment-button:hover,
        .review-button:hover {
            color: white;
            border: 1px solid #FF3368;
            background-color: #FF3368;
        }

        .comment-box img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .media {
            margin-bottom: 10px;
            align-items: center;
        }


        .media .details {
            margin-left: 10px;
        }

        .media .details h4 {
            font-size: 16px;
        }

        .details .time-details {
            font-size: 13px;
            margin-top: -5px;
        }

        .comment-box p {
            color: rgb(109, 106, 106);
            margin-bottom: 10px;

        }




        .comment-box .details {
            vertical-align: top;
            height: 50px !important;
        }

        .comment-post {
            padding-left: 50px;
        }

        .comment-post .title {
            font-size: 26px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .comment-post input {
            display: block;
            margin-top: 15px;
            width: 100%;
            height: 40px;
        }

        .comment-page {
            margin-bottom: 100px;
        }

        input[type="text"] {
            padding-left: 10px;
            outline: none;
        }

        .comment-box-reply {
            padding-left: 20px;
            margin-top: 20px;
        }

        .reply-box button {
            border: none;
            border-radius: 40px;
            background-color: #005AC9;
            margin-left: 5px;
            color: white;
            font-weight: 500;
            padding: 5px 13px;
        }

        .reply-box .cancel {
            background-color: red;
        }

        #addToCart {
            width: 150px !important;
        }

        #addToCart:disabled {
            opacity: 0.5;
        }

        .spinner img {
            height: 45px;
            object-fit: contain;
            width: 50px;
        }

        #addToCart .spinner {
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row product-page">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="col-md-7 cc d-flex first">
                <img id="mainImage" src={{ asset('images/' . $data['product']->ColorSize[0]->image[0]->url) }}>
            </div>
            <div class="col-md-5 product-page-details " data-id="{{ $data['product']->id }}">
                <h1>{{ $data['product']->product_name }}</h1>
                <span class="price-main">$<span class="price">{{ $data['product']->price }}</span></span>

                <ul class="list text-start">
                    <li>
                        <span class="category">Category</span> : {{ $data['product']->ProductCategory->name }}
                    </li>
                    <li>
                        <span class="category">Availability</span> : @if (((int) $data['product']->ColorSize[0]['Inventory'][0]['quantity']))
                        <span class="availability" style="color:green;"> In Stock</span> @else<span class="availability"
                                style="color:red;"> Out Of Stock</span>
                        @endif
                    </li>
                </ul>
                <select class="form-select form-select-sm" id="sizeSelect" aria-label=".form-select-sm example">
                    @foreach ($data['groupSize'] as $size)
                        <option value={{ $size->id }}>{{ $size->name }}</option>
                    @endforeach
                </select>
                <select class="form-select form-select-sm" id="colorSelect" aria-label=".form-select-sm example">
                    @foreach ($data['groupColor'] as $size)
                        <option value={{ $size[0]['color']->id }}>{{ $size[0]['color']->color }}</option>
                    @endforeach
                </select>
                <div class="break"></div>
                <div class="description">
                    <p>hello godd evening there is no data diff between m and you</p>
                </div>
                <div class="break"></div>
                <div class="d-flex buttons">
                    <div class="quantity"><span class="icon"><i class="fa fa-minus ms-auto" id="quantityMinus"
                                aria-hidden="true"></i></span><span id="quantityCount" class="count">
                                    {{ $data['product']->quantity !=null ? $data['product']->quantity :1}}
                                </span><span class="icon"><i class="fa fa-plus " id="quantityPlus"
                                aria-hidden="true"></i></span>
                    </div>
                    <button type="button" id="addToCart"
                        @if ((int) $data['groupColor']->first()[0]['Inventory'][0]['quantity'] == 0) {{ 'disabled' }} @endif><span id="text">add to
                            cart</span><span class="spinner"><img src="{{ asset('images/spinner-1.gif') }}"
                                alt="Loading.."></span></button>
                </div>
            </div>
        </div>

        <div class="d-flex review-buttons">
            <button class="comment-button">comments</button>
            <button class="review-button">reviews</button>
        </div>

        <div class="review-page">

        </div>

        <div class="comment-page">
            <div class="row">
                <div class="col-md-6 comment-review-box">
                    @if ($data['reviews']->isNotEmpty())
                        @foreach ($data['reviews'] as $review)
                            <div class="parent">
                                <div data-id="{{ $review->id }}" class="comment-box ">
                                    <div class="media d-flex"><img
                                            src="https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&dl=pexels-anjana-c-169994-674010.jpg&fm=jpg">
                                        <div class="details">
                                            <h4>{{ $review->user->name }}</h4>
                                            <div class="time-details">{{ $review->created_at->format('jS M Y') }}</div>
                                        </div>
                                        <div class="butto ms-auto"><button class="comment-reply">reply</button></div>
                                    </div>

                                    <p>{{ $review->comment }}</p>
                                    {{-- <div class="reply-box"><input type="text" placeholder="reply"></input><button class="cancel replyCancel" id="replyCancel">cancel</button><button class="send replySend" id="replySend">send</button></div> --}}

                                </div>
                                @foreach ($review->children as $child)
                                    <div data-id="{{ $child->id }}" class="comment-box comment-box-reply">
                                        <div class="media d-flex"><img
                                                src="https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&dl=pexels-anjana-c-169994-674010.jpg&fm=jpg">
                                            <div class="details">
                                                <h4>{{ $child->user->name }}</h4>
                                                <div class="time-details">{{ $child->created_at->format('jS M Y ') }}</div>
                                            </div>
                                            <div class="butto ms-auto"><button class="comment-reply">reply</button></div>
                                        </div>
                                        <p>{{ $child->comment }}</p>
                                        {{-- <div class="reply-box"><input type="text" placeholder="reply"></input><button class="cancel replyCancel" id="replyCancel">cancel</button><button class="send replySend" id="replySend">send</button></div> --}}
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <div class="empty-comment">Be the first one to add comment</div>
                    @endif
                </div>
                <div class="col-md-6 comment-post">
                    <form id="newComment" data-id={{ $data['product']->id }}>
                        <div class="title">Post a comment</div>
                        <input type="text" name="email" placeholder="Email Address"></input>
                        <input type="text" name="comment" placeholder="Message"></input>
                        <input type="submit" placeholder="Message"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // console.log(@json($data['product']['ColorSize']))
        localStorage.setItem('product', JSON.stringify(@json($data['product']['ColorSize'])))

        var product = JSON.parse(localStorage.getItem('product'));

        $('#colorSelect').on('change', function() {
            let colorId = $(this).val();
            let data = product.filter(item => item.color_id == colorId)

            let sizeHtml = '';
            let image = '';
            data.forEach(function(value) {
                console.log(value);
                if (value['image'].length != 0)
                    image = value['image'][0]['url']

                let name = value['size']['name']
                let id = value['size']['id']
                sizeHtml += `<option value=${id}>${name}</option>`;
            })
            let url = '{{ URL::asset('images') }}' + "/" + image;
            let select = document.getElementById('sizeSelect').innerHTML = sizeHtml;
            $('#mainImage').attr('src', url);
            availability();

        })

        $('#sizeSelect').on('change', function() {
            availability();
        })





        function availability() {
            $("#quantityCount").text(1);
            let colorId = $('#colorSelect').val();
            let sizeId = $('#sizeSelect').val();
            console.log(sizeId)
            let data = product.filter(item => item.color_id == colorId && item.size_id == sizeId);
            if (parseInt(data[0]['inventory'][0]['quantity']) != 0) {
                $('.availability').html('In Stock').css('color', 'green');
                document.getElementById("addToCart").disabled = false;
            } else {
                $('.availability').html('Out of Stock').css('color', 'red');
                document.getElementById("addToCart").disabled = true;

            }
        }


        $('#addToCart').on('click', function() {
            let text = $(this).children('#text').css('display', 'none');
            $(this).children('.spinner').css('display', 'block');
            $.ajax({
                url: "{{ route('addUserCart') }}",
                type: 'post',
                data: {
                    productId: $('.product-page-details').attr('data-id'),
                    colorId: $('#colorSelect').val(),
                    sizeId: $('#sizeSelect').val(),
                    quantity: $('#quantityCount').text()
                },
                success: function(response) {
                    if (response.status == 200) {

                        setTimeout(() => {
                            $(this).children('.spinner').css('display', 'none');
                            let text = $(this).children('#text').css('display', 'block');
                            $('.cart_count').text(response.count);
                            Swal.fire({
                                toast: true,
                                icon: 'success',
                                title: response.message,
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })
                        }, 2000);
                    } else {
                        console.log(response.message);
                    }
                }.bind(this)
            })
        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#newComment').submit(function(event) {

                event.preventDefault();

                let productId = $(this).attr('data-id');

                let formData = new FormData(this)
                formData.append('productId', productId);
                let commentBox = $('.comment-page').find('.comment-review-box');
                console.log(commentBox)

                $.ajax({
                    url: "{{ route('newComment') }}",
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        commentBox.append(` <div class="parent"> <div data-id=${response.data.id} class="comment-box">\
                        <div class="media d-flex"><img src="https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&dl=pexels-anjana-c-169994-674010.jpg&fm=jpg">\
                          <div class="details"><h4>${response.data.user.name}</h4><div class="time-details">${response.data.created_at}</div></div>\
                          <div class="butto ms-auto"><button class="comment-reply">reply</button></div>\
                        </div>\
                        <p>${response.data.comment}</p></div></div>`)
                        $('.empty-comment').remove();
                    }
                })

            })
            $('#quantityPlus').on('click', function() {
                let count = parseInt($('#quantityCount').html());
                quantityCheck(count)

            })

            function quantityCheck(count) {
                let productId = $('#newComment').attr('data-id');
                let sizeId = $('#sizeSelect').val();
                let colorId = $('#colorSelect').val();

                let url = '{{ route('quantity.check', [':productId', ':colorId', ':sizeId']) }}';
                url = url.replace(':productId', productId);
                url = url.replace(':colorId', colorId);
                url = url.replace(':sizeId', sizeId);
                $.ajax({
                    url: url,
                    type: 'get',
                    data: {
                        count: count
                    },
                    success: function(json) {
                        if (json.status == 200) {
                            success();
                            count++;
                            $('#quantityCount').html(count)
                        } else if (json.status == 400) {
                            console.log('Out of Stock');
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: json.message,
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {}
                            })

                        } else if (json.status == 500) {
                            console.log('Server Error');
                        }
                    }
                })


            }

            $('#quantityMinus').on('click', function() {

                let count = parseInt($('#quantityCount').html());
                count--;
                if (count >= 1) {
                    $('#quantityCount').html(count)
                }
            })

            $(document).on('click', '.comment-reply', function() {
                let data = $(this).parents('.comment-box').find('p');
                data.after(
                    '<div class="reply-box"><input type="text" placeholder="reply"></input><button class="cancel replyCancel" id="replyCancel">cancel</button><button class="send replySend" id="replySend">send</button></div>'
                );
            })


            $(document).on('click', '.replySend', function() {
                let commentReply = $(this).siblings('input[type=text]').val();
                let commentReviewId = $(this).parents('.comment-box').attr('data-id');

                let productId = $('#newComment').attr('data-id');
                let parent = $(this).parents('.parent');
                console.log(parent)
                $.ajax({
                    url: "{{ route('commentReply') }}",
                    type: 'post',
                    data: {
                        comment: commentReply,
                        commentReviewId: commentReviewId,
                        productId: productId
                    },
                    success: function(response) {
                        $(this).parents('.comment-box').find('.reply-box').remove();
                        parent.append(`<div data-id=${response.data.id} class="comment-box comment-box-reply">
                                <div class="media d-flex"><img
                                        src="https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&dl=pexels-anjana-c-169994-674010.jpg&fm=jpg">
                                    <div class="details">
                                        <h4>${response.data.user.name}</h4>
                                        <div class="time-details">12 th nov</div>
                                    </div>
                                    <div class="butto ms-auto"><button class="comment-reply">reply</button></div>
                                </div>
                                <p>${response.data.comment}</p>
                                {{-- <div class="reply-box"><input type="text" placeholder="reply"></input><button class="cancel replyCancel" id="replyCancel">cancel</button><button class="send replySend" id="replySend">send</button></div> --}}
                            </div>`)
                    }.bind(this)

                })

            });

            $(document).on('click', '.replyCancel', function() {
                let data = $(this).parents('.comment-box').find('.reply-box');
                data.remove();
            })


        })
    </script>
@endpush
