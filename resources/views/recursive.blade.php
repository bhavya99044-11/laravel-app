<div>


{{-- @foreach ( $data as $key=>$view )

@endforeach --}}

@foreach ($data as $key=>$child )

<div class="comment-template reply-comment-box hidden"  id="comment-template">
    <div class="  row .g-0 comment-container">

        <div class="col-md-1 order-1 col-1  counts"></div>
        <div class="col-md-1 order-3 col-3  comment-tools">


            <div class="col reply" id="commentReply"
                data-id="{{ $child->id }} ">
                <i class="fa fa-reply" aria-hidden="true"></i>
                reply
            </div>

        </div>
        <div class="col-md-3 order-2  user-detail">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small/user-profile-icon-free-vector.jpg"
                alt="" class="user-img">

            <p class="user-name"><span>@</span>bhavay</p>
            <p class="user-time">2 weeks ago</p>

        </div>
    </div>
    <div class=" row user-comment-data">{{ $child->comment }}</div>
    <div class="reply-input-box" id="reply-input-box"
        data-id={{ $child->id }}></div>
    <div class="left-margin">
        <div class="user-comment-reply ">

        </div>
    </div>
</div>
@if($child->child->isNotEmpty())

<h1>{{$child['margin']}}</h1>
<div class="comment-template reply-comment-box" style="margin-left: 90px" id="comment-template">

@include('recursive',['data'=>$child->child])
</div>
@endif
@endforeach


</div>
