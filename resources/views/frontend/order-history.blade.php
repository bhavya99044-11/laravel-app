<div>
    @extends('frontend.default')

    @push('styles')
    <style>
        .padding-top{
            margin-top: 100px;
        }
        .fa-file-pdf-o{
            color: red;
        }
        </style>
    @endpush
    @section('content')
    <div class="container">

        @if($data['orders']->isNotEmpty())
    <table class="table padding-top">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Status</th>
            <th scope="col">Price</th>
            <th scope="col">Invoice</th>
            <th scope="col">date</th>
          </tr>
        </thead>
        <tbody>
        @foreach($data['orders'] as $item)
          <tr>
            <th scope="row">{{$item->order_number}}</th>
            <td>{{$item->status}}</td>
            <td>{{$item->total_price}}</td>
            <td><a class="invoiceDownload" data-route="{{route('invoiceDownload',['orderId'=>$item->id])}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
            </td>
            <td>{{$item->created_at->format('j F Y')}}</td>

          </tr>

        @endforeach
        </tbody>
      </table>
      @else
      <div>Oops no orders history available</div>
      @endif

    </div>
      @endsection

</div>

@push('scripts')

<script>
$(document).ready(function(){

    $('.invoiceDownload').click(function(e){

        e.preventDefault();

        let url=$(this).data('route');
       $.ajax({
        url:url,
        type:'GET',
        xhrFields: {
responseType: 'blob'
},
        success:function(response){
            var blob = new Blob([response]);
var link = document.createElement('a');
link.href = window.URL.createObjectURL(blob);
link.download = "MyPDF.pdf";
link.click();
        },
        error:function(error){
            console.log(error);
        }

    });

});

});
    </script>

@endpush

