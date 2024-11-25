<div class="main-comment-page">

    <div class="start-box">

        @php
            $rows = 6;

        @endphp
        @for ($i = 1; $i < $rows; $i++)

            <div class="comment-rating">
                @for ($j = 1; $j <= $rows - $i; $j++)
                    <label class="already-review" class="" for="star" title="stars">
                        <i class="active fa fa-star" aria-hidden="true"></i>
                    </label>
                @endfor
            </div>
            <span class="rating-percent">
                {{ $data["star{$i}"] }}
            </span>
            </br>
        @endfor


    </div>
    <div class="comment-box">
        <link href="{{ asset('assets/css/comment-section.css') }}" rel="stylesheet">


        @foreach ($data['product'] as $review)
            @foreach ($review->reviews as $reviewData)
                @if ($reviewData->product_review_id == null)
                    <div class="comment-template" id="comment-template">
                        <div class="  row .g-0 comment-container">

                            <div class="col-md-1 order-1 col-1  counts">
                                <i class=" fa fa-plus commentUpvote" id="commentUpvote" data-id="{{ $reviewData->id }}"
                                    aria-hidden="true"></i>
                                <div id="upvote-count">
                                    {{ $reviewData->likes }}
                                </div>
                                <i class="fa fa-minus commentDownvote" id="commentDownvote"
                                    data-id="{{ $reviewData->id }}" aria-hidden="true"></i>

                            </div>
                            <div class="col-md-1 order-3 col-3  comment-tools">

                                {{-- <div class=" col delete hidden" data-id="{{ $reviewData->id }} ">
                                    <i class="fa fa-trash " aria-hidden="true"></i>
                                    delete
                                </div>
                                <div class="col edit hidden" data-id="{{ $reviewData->id }} ">
                                    <i class="fas fa-edit"></i>
                                    edit
                                </div> --}}

                                <div class="col reply" id="commentReply" data-id="{{ $reviewData->id }} ">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                    reply
                                </div>
                            </div>
                            <div class="col-md-3 order-2  user-detail">
                                <img src="https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small/user-profile-icon-free-vector.jpg"
                                    alt="" class="user-img">
                                </img>
                                <p class="user-name"><span>@</span>{{ $reviewData->user->name }}</p>
                                <p class="user-time">2 weeks ago</p>

                            </div>
                        </div>
                        <div class=" row user-comment-data">
                            <p>{{ $reviewData->comment }}</p>
                        </div>
                        <div class="reply-input-box " id="reply-input-box" data-id={{ $reviewData->id }}>
                            {{-- <textarea class="reply-textarea" placeholder="Add a Comment..."></textarea>
                        <button class="reply-submit">send</button> --}}
                            <div>
                            </div>
                        </div>
                        <div class="left-margin">
                            <div class="user-comment-reply ">
                                @if ($reviewData->child->isNotEmpty())
                                    <button type="button" class="view-reply-class"><i
                                            class="fa-solid fa-angle-up hidden"></i><i class="fa fa-angle-down"
                                            aria-hidden="true"></i>
                                        {{ count($reviewData->child) }} Replies</button>
                                    @include('recursive', ['data' => $reviewData->child])
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach



    </div>

</div>
<div class="comment-section">
    <div class="start-box">
    </div>



    <div class="reply-input-container">

        <form class="reply-input-container" id="newComment" data-id="{{ $data['product'][0]->id }}">
            <div class="star-rating">
                <input id="star-5" type="radio" name="rating" value="star-5" />
                <label class="comment-review" for="star-5" title="5 stars">
                    <i class="active fa fa-star" aria-hidden="true"></i>
                </label>
                <input id="star-4" type="radio" name="rating" value="star-4" />
                <label class="comment-review" for="star-4" title="4 stars">
                    <i class="active fa fa-star" aria-hidden="true"></i>
                </label>
                <input id="star-3" type="radio" name="rating" value="star-3" />
                <label class="comment-review" for="star-3" title="3 stars">
                    <i class="active fa fa-star" aria-hidden="true"></i>
                </label>
                <input id="star-2" type="radio" name="rating" value="star-2" />
                <label class="comment-review" for="star-2" title="2 stars">
                    <i class="active fa fa-star" aria-hidden="true"></i>
                </label>
                <input id="star-1" type="radio" name="rating" value="star-1" />
                <label class="comment-review" for="star-1" title="1 star">
                    <i class="active fa fa-star" aria-hidden="true"></i>
                </label>
            </div>
            <textarea class="reply-textarea" name="commentText" id="commentText" placeholder="Add a Comment..."></textarea>

            <button class="reply-submit">send</button>
        </form>
    </div>
</div>



{{-- <div class="comment-template">
    <div class="comment-container row">
        <div class=" counts">
            <i class=" fa fa-plus" aria-hidden="true"></i>
            8
            <i class="fa fa-minus" aria-hidden="true"></i>

        </div>
        <div class="comment-tools">


            <div class="delete ">
                <i class="fa fa-trash" aria-hidden="true"></i>
                delete
            </div>
            <div class="edit">
                <i class="fas fa-edit "></i>
                edit
            </div>

            <div class="reply">
                <i class="fa fa-reply" aria-hidden="true"></i>

            </div>
        </div>

        <div class="user-detail">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small/user-profile-icon-free-vector.jpg"
                alt="" class="user-img">
            </img>
            <p class="user-name">bhavay</p>
            <p class="user-time">2 weeks ago</p>

        </div>

        <div class="user-text">
            <span class="reply-to">bhavya</span>
            <span class="user-text-data">to bas quality of product never try to but this</span>
        </div>
    </div>
</div> --}}

<div class="modal-delete hidden ">
    <h3>delete comment</h3>
    <p>are you sure you want to delete it</p>
    <button class="comment-yes">yes</button>
    <button class="comment-no">no</button>
</div>

</div>
</div>

@push('script')
    <script>
        $(document).ready(function() {

            newFunction()

            function newFunction() {
                console.log(11111);
                $('.reply').on('click', function() {
                    let dataId = $(this).attr('data-id');
                    let parent = $(this).parents('.comment-template')
                    // console.log( $(this).parents('.comment-template'))
                    $(this).parents('.comment-template').children('#reply-input-box[data-id=' + dataId +
                        ']').html(
                        '<form id="replyFormData" data-id=' + dataId + ' class="reply-input-box-form"> <textarea class="reply-textarea" name="replyComment" placeholder="Add a Comment..."></textarea>\
                                        <button  class="reply-submit">send</button></form>');
                    parent.find('.reply-textarea').focus()
                    formSubmit();
                })

            }

            function formSubmit() {
                $('#replyFormData').submit(function(event) {
                    event.preventDefault()
                    let dataId = $(this).attr('data-id');
                    let url = window.location.href
                    let productId = url.split('/').pop();
                    let formData = new FormData(this);
                    formData.append('dataId', dataId);
                    formData.append('productId', productId);
                    $.ajax({
                        url: "{{ route('productCommentReply') }}",
                        type: 'post',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            let child = $(this).parents('.comment-template').children(
                                '.left-margin ').first().children('.user-comment-reply');


                            $('.reply-input-box').html('');
                            let clone = $('#comment-template').clone();
                            clone.children('#reply-input-box[data-id=' + dataId + ']');
                            clone.find('#commentReply').attr('data-id', response.msg.id)

                            clone.find('.comment-container .counts ').html('');
                            clone.find('.user-comment-data').html(response.msg.comment)
                            clone.children('#reply-input-box').attr('data-id', response.msg.id)
                            // clone.find('.comment-container .comment-tools .edit').show()
                            // clone.find('.comment-container .comment-tools .delete').show()
                            clone.find('.user-comment-reply').html('')
                            child.append(clone);
                            newFunction();
                        }.bind(this)

                    });



                });

            }
            //         $.ajax({
            // url:"{{ route('productComment') }}",
            // type:'post',
            // data:formData,
            // contentType: false,
            // processData: false,
            // success:function(response){


            //     });
            var repliesShow = 0;
            $('.view-reply-class').on('click', function() {
                if ($(this).hasClass('active')) {

                    $(this).parent().find('.reply-comment-box').hide()
                    $(this).removeClass('active')

                } else {
                    $(this).addClass('active')

                    $(this).parent().find('.reply-comment-box').show()
                }

            })
            $('#newComment').submit(function(event, form) {
                event.preventDefault();

                let formData = new FormData(this);
                formData.append('productId', this.getAttribute('data-id'));

                if ($('#commentText').val() != '') {
                    $.ajax({
                        url: "{{ route('productComment') }}",
                        type: 'post',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            let clone = $('#comment-template').clone();
                            clone.find('.user-comment-reply').empty();
                            clone.find('.comment-container .counts #upvote-count').html(response
                                .msg.likes);
                            clone.find('.user-comment-data').html(response.msg.comment)
                            clone.find('.user-comment-data').html(response.msg.comment)

                            clone.find('.comment-container .comment-tools .col').each(function(
                                event, data) {
                                $(data).attr('data-id', response.msg.id)
                            }.bind(response));
                            $('.comment-box').append(clone)
                            newFunction();
                        }
                    })



                }

                // $('.reply-comment-box').on('click',function(){
                //                 console.log(11111)
                //             })


            })

            $('.commentUpvote').on('click', function() {
                dataId = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('commentUpvote') }}",
                    type: 'post',
                    data: {
                        dataId: dataId
                    },

                    success: function(response) {
                        $(this).siblings('#upvote-count').html(response.msg);

                    }.bind(this)
                })
            })

            $('.commentDownvote').on('click', function() {
                dataId = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('commentDownvote') }}",
                    type: 'post',
                    data: {
                        dataId: dataId
                    },

                    success: function(response) {
                        $(this).siblings('#upvote-count').html(response.msg);

                    }.bind(this)
                })
            })

        })
    </script>
@endpush
