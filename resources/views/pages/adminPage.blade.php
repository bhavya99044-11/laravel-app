
@extends('frontend.admin_panel')

@section('content')

<div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <div class="table-data">

    </div>
    <body>
    <div class="container">
        <div class="heading">
            <div class="product-page">
<div class="row title-page">
    <div class="col-md-6">
    <div class="panel">
        <h1>Seller Panel</h1>
    </div>
</div>
<div class="col-md-6 text-end">

    <button type="button" class="add-button" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add
        Product</button>
    </div>
    </diV>
                <div class="row">
                    <form id="formData" enctype="multipart/form-data">


                        <div class="gap">
                            <label for="product name">Product Name</label>
                            <select class="form-select" id="productChange" name="products">
                                <option hidden value="">Products</option>

                                @foreach ($data['products'] as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->product_name }}</option>
                                @endforeach
                            </select>
                            <span class="err product_err"></span>
                        </div>

<div class="row">
    <div class="col-md-6">
                        <div class="gap">
                            <label for="product_color">select color</label>
                            <select class="form-select" name="color">
                                <option hidden value="">color</option>

                                @foreach ($data['colors'] as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->color }}</option>
                                @endforeach
                            </select>
                            <span class="err color_err"></span>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="gap">
                            <label for="product_size">select size</label>

                            <select class="form-select" name="size">
                                <option hidden value="">size</option>

                                @foreach ($data['sizes'] as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <span class="err size_error"></span>
                        </div>
                    </div>
                    </div>
                        <div class="gap">
                            <label for="product_image">Product Image</label>
                            <input type="file" name="image">
                            <span class="err image_error"></span>


                        </div>
<div class="row">
    <div class="col-md-6">

                    <div class="col-md-6">

                        <div class="gap">
                            <label for="product_stock">Stock</label>
                            <input type="number" name="stock" />
                            <span class="err stock_error"></span>
                        </div>
                    </div>
                    </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" id="addProduct" class="btn btn-outline-primary">Add
                                    Product</button>
                                <button disabled ="button" id="submitData"
                                    class="btn btn-outline-success">Submit</button>
                            </div>
                        </div>
                    </form>
                    <table id="tableData" class="table hide">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Image</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>

                            </tr>
                        </thead>
                        <tbody id="tableBody">

                        <tbody>

                    </table>
                </div>
            </div>


        </div>
        {{-- modal add product --}}

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="modalForm" enctype="multipart/form-data">

                            <div class="gap">
                                <label for="product name">Product Name</label>
                                <input type="text" name="product_name" class="product_form" />
                                <span class="err product_err"></span>
                            </div>

                            <div class="gap">
                                <label for="category">select category</label>
                                <select class="form-select" name="category">
                                    <option hidden value="">category</option>

                                    @foreach ($data['categories'] as $index => $cat)
                                        @if ($index != 0)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="err category_err"></span>
                            </div>

                            <div class="gap">
                                <label for="price">Price</label>
                                <input type="number" name="price" class="price_form" />
                            </div>

                            <div class="gap">
                                <label for="description">description</label>
                                <textarea class="form-control" id="body" placeholder="Enter the Description" name="body"></textarea>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>




    </body>
    </html>
    @endsection

    @push('scripts')
        <script>
            $(document).ready(function() {

                var toastMixin = Swal.mixin({
                    toast: true,
                    icon: 'success',
                    title: 'General Title',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var finalData = [];
                $('#exampleModal').on('show.bs.modal', function(event) {
                    $('.ck-reset').empty();
                    $('#modalForm')[0].reset();
                    var modal = $(this)
                    modal.find('.modal-title').text('New Product')
                    // modal.find('.modal-body input').val(recipient);
                    ClassicEditor
                        .create(document.querySelector('#body'))
                        .catch(error => {

                        });

                    $('#modalForm').validate({
                        rules: {
                            product_name: {
                                required: true
                            }
                        },
                        errorClass: 'err',
                        submitHandler: function(form, event) {
                            event.preventDefault();

                            var formData = new FormData(form);
                            addData(formData);

                        }
                    });
                })

                function addData(formData) {


                    $.ajax({
                        url: "{{ route('NewProduct') }}",
                        type: "post",
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            if (response.status == 200) {
                                window.location.reload();
                            } else {

                            }
                        }
                    })
                }

                $('#formData').validate({
                    rules: {
                        // product_name: {
                        //     required: true,
                        //     minlength: 5
                        // }
                        //    category:{
                        //     required:true,
                        //    },
                        //    color:{
                        //     required:true,
                        //    },
                        //    size:{
                        //     required:true,
                        //    },
                        //    stock:{
                        //     required:true,
                        //    }
                    },
                    errorClass: 'err',
                    submitHandler: function(form, event) {
                        event.preventDefault();
                        let productId = $('#productChange').val();
                        var formData = new FormData(form);
                        $.ajax({
                            url: "{{ route('AddProduct') }}",
                            type: "post",
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function(response) {
                                if (response.status == 200) {

                                    $('#formData')[0].reset();
                                    toastMixin.fire({
                                        animation: true,
                                        title: 'Product Added'
                                    });
                                    htmldata(productId);
                                } else {}
                            }
                        })



                    }
                })

                $('#productChange').on('change', function() {

                    let productId = $(this).val();
                    htmldata(productId);

                })

                function htmldata(productId) {
                    $.ajax({
                        url: "{{ route('tableData') }}",
                        type: "post",
                        data: {
                            productId: productId
                        },
                        success: function(response) {
                            if (response.status == 200) {

                                if (response.data != '') {
                                    $('#tableData').show();
                                    $('#tableBody').empty();
                                    $('#tableBody').html(response.data);
                                    deleteInitialization();
                                    updateInitialization();
                                    saveInlineInitialization()

                                } else {
                                    $('#tableData').hide();
                                }
                            } else {

                            }
                        }
                    })
                }

                function updateInitialization() {

                    $('.updateData').on('click', function() {
                        // inlineUpdate();
                        let colorId;
                        let sizeId;
                        $(this).parents('tr').children('td.data').each(function(index, data) {
                            let value = $(data).html();
                            $(data).html(`<input type="text" class="" value=${value}></input>`);
                        });
                        $(this).parents('tr').find('td.color').each(function(index, data) {
                            colorId = $(this).data('id');
                            // $(data).html(`<input type="text" class="" value=${value}></input>`);
                        });

                        $(this).parents('tr').find('td.size').each(function(index, data) {
                            // let value = $(data).html();
                            sizeId = $(this).data('id');
                            // $(data).html(`<input type="text" class="" value=${value}></input>`);
                        });

                        dropdownData(colorId, sizeId, $(this));

                        $(this).hide();
                        $(this).siblings('#saveInline').show();
                        $(this).siblings('#cancelInline').show();


                    })
                }



                function dropdownData(colorId, sizeId, data) {



                    $.ajax({
                        url: "{{ route('colorSize') }}",
                        type: "post",
                        data: {
                            colorId: colorId,
                            sizeId: sizeId
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                console.log();
                                data.parents('tr').find('.color').html(response.colorHtml);
                                data.parents('tr').find('.size').html(response.sizeHtml);

                            } else {

                            }
                        }
                    })
                }

                function saveInlineInitialization() {


                    $('.saveInline').on('click', function() {
                        console.log(11);
                        let productId = $('#productChange').val();

                        let pivotId = $(this).parents('tr').data('id');
                        let colorId = $(this).parents('tr').find('.color select').val();
                        let sizeId = $(this).parents('tr').find('.size select').val();
                        let stock = $(this).parents('tr').find('.data input').val()
                        $.ajax({
                            url: "{{ route('inlineUpdate') }}",
                            type: "post",
                            data: {
                                colorId: colorId,
                                sizeId: sizeId,
                                stock:stock,
                                pivotId:pivotId
                            },
                            success: function(response) {
                                if (response.status == 200) {
                                    htmldata(productId);
                                } else {

                                }
                            }
                        })

                    })
                }



                function deleteInitialization() {
                    $('.deleteData').on('click', function() {
                        let productId = $('#productChange').val();
                        let deleteId = this.getAttribute('value');
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{ route('deleteData') }}",
                                    type: "post",
                                    data: {
                                        deleteId: deleteId
                                    },
                                    success: function(response) {
                                        if (response.status == 200) {

                                            htmldata(productId);

                                        } else {

                                        }
                                    }
                                })
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                            }
                        });

                    })

                }

                function saveInline(data) {
                    console.log(data);
                }

                // $('.saveInline').on('click',function(data){
                //     // cancelInline();
                // })


            });
        </script>
@endpush
