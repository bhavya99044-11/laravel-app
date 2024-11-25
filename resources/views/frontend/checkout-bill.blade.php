<div>
@extends('frontend.admin_panel')

@push('styles')
<style>
body{
margin-top: 100px;
font-family: "Poppins", serif;
font-weight: 500;
color: rgb(66, 66, 66);

background-color: rgba(240, 200, 200, 0.8) !important;
}

.form-group{
margin-bottom:10px;
}

input[type="text"], input[type="email"], input[type="password"], .form-select{
width: 80%;
}

::placeholder{
    font-family: "Poppins", serif;
font-weight: 500;
color: rgb(165, 164, 164) !important;
}

.coupon-form{
   position: absolute;
    margin-top: 100px;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
    background-color: white;
    border-radius: 35px;
   padding: 20px 10px;
   width: 70vh;

}

.main-form{
    margin-top: 30px;
}

.form-select{
    margin-top: 10px;
}

.main-form{
margin-left: 10px;
}

</style>
@endpush

@section('content')

<div class="container">
    <div class="coupon-form">
        <form class="main-form" id="couponForm">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Coupan Code</label>
              <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter coupan code">
              <span class="error coupon_code_err"></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Discoun Percentage Price</label>
                <input type="text" class="form-control" name="discount_percentage_price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Discount Percentage/price">
                <span class="error discount_percentage_price_err"></span>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">min_cart_value	</label>
                <input type="text" class="form-control" name="min_cart_value" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="min_cart_value	">
                <span class="error discount_percentage_price_err"></span>
              </div>

              <div class="form-group">
                <select class="form-select" aria-label="Default select example" name="coupon_type">
                    <option hidden>Coupon Type</option>
                    <option value="1">Percentage</option>
                    <option value="0">Price</option>

                  </select>
                  <span class="error coupon_type_err"></span>

              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">max_uses		</label>
                <input type="text" class="form-control" name="max_uses" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="max_use">
                <span class="error max_uses_err"></span>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">coupon_count</label>
                <input type="text" class="form-control" name="coupon_count" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="coupon_count">
                <span class="error discount_percentage_price_err"></span>
              </div>

              <div class="form-group">
                <select class="form-select" aria-label="Default select example" name="is_active">
                    <option hidden>is_active</option>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                  </select>
                  <span class="error is_active_err"></span>

              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">description	</label>
                <input type="text" class="form-control" name="description" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="description">
                <span class="error description_err"></span>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">start_date		</label>
                <input type="text" class="form-control dateTimePicker"  name="start_date" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="start_date">
                <span class="error >start_date_err"></span>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">expiry_date		</label>
                <input type="text" class="form-control  dateTimePicker" name="expiry_date"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="expiry_date">
                <span class="error expiry_date_err"></span>
              </div>

              <div class="form-group">
                <select class="form-select js-example-basic-single" aria-label="Default select example" name="products[]">
                    <option value="0">All</option>

                   @foreach ($data['products'] as $product )
                    <option value="{{$product->id}}">{{$product->product_name}}  </option>

                   @endforeach

                  </select>
                  <span class="error coupon_type_err"></span>

              </div>


            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>
{{-- <input type ="text" class="dateTimePicker"  placeholder="Enter text here"> --}}

@endsection

@push('scripts')
<script>
    $(document).ready(function(){

        $('.dateTimePicker').datetimepicker();


    $('.js-example-basic-single').select2({
        multiple: true,
    });

    $('#couponForm').on('submit', function(e){

         e.preventDefault();
         console.log(1  )
        $.ajax({
            url: "{{route('coupon.store')}}",
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(response){
               console.log(response);
            }
        });

    });
});
    </script>
@endpush
</div>
