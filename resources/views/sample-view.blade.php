<div>
@foreach($data as $review)
@include('recursive',['data'=>$review])
@endforeach
</div>
