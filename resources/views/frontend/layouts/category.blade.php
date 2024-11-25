
<div class="row">
    <div class="col-md-6">
        <p>Premium quality</p>
        <h1>{{$data->name}}</h1>
        <span class="explore-button text-center"><a class="text-center"  href="{{url('categories/'.$data->id)}}">Explore now<i class="fa fa-caret-right"></i></a></span>
    </div>
    <div class="col-md-6 text-end">
        <img src={{$data->image_url}}>
    </div>
</div>
