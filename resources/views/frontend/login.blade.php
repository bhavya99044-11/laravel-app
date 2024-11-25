<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

<!-- google fonts -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Basic stylesheet -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css
" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>

<style>
    body {
        font-family: "Poppins", serif;

    }

    .login-page {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 100%;
        width: 1000px;
    }

    .row {
        height: 100%;
    }

    .col-md-6 {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-box {
        color: white;

        background-image: -webkit-linear-gradient(16deg, #ff005a 0%, #ff5d2d 64%, #ffba00 100%);
    }

    .margin-bottom>* {
        margin-bottom: 10px;
    }

    .login-box .title {
        text-transform: capitalize;
        font-size: 30px;
        font-weight: 700;

    }

    .login-box .create-button button {
        background-color: transparent;
        border: none;
        color: white;
        border: 1px solid white;
        border-radius: 40px;
        padding: 3 10px;
        text-transform: uppercase;
        margin-top: 5px;
    }

    .login-form {
        margin-top: 100px;
        padding-left: 46px;
        background-color: white;
    }

    .col-6 {}

    .login-form input[type=text] {
        width: 420px;
        margin-bottom: 20px;
        border: none;
        outline: none;
        border-bottom: 1px solid rgb(138, 134, 134);

    }

    .login-form input[type=text]::after {
        border: none;
    }

    .login-form h2 {
        text-transform: capitalize;
        font-size: 30px;
        font-weight: 600;
    }

    .login-form .title {
        text-transform: capitalize;
        font-size: 26px;
        line-height: 35px;
        font-weight: 700;
    }

    .login-form button {
        text-transform: capitalize;
        border: none;
        padding: 7px 170px;
        background-image: -webkit-linear-gradient(16deg, #ff005a 0%, #ff5d2d 64%, #ffba00 100%);
        border-radius: 40px;
        color: white;
        font-weight: 600;
    }

    .error {
        color: red;
    }
</style>
<div class="container">
    <div class="login-page">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="row">
            <div class="col-md-6 d-flex login-box justify-content-center align-items-center">
                <div class="margin-bottom">
                    <div class="title">new to our shop</div>
                    <div class="sub-title">please register here for products purchase</div>

                    <div class="create-button"><button>create an account</button></div>
                </div>
            </div>
            <div class="col-6 login-form">
                <span class="title"> welcome back<br>plesase sign in now </span>
                <form id="myForm">
                    <input type="text" class="mt-5" placeholder="Name" name="name">
                    <span class="name_error error"></span>

                    <input type="text" placeholder="Email"  @if(!empty(Cookie::get('email'))) value="{{Cookie::get('email')}}" @endif name="email"></br>
                    <span class="email_error error"></span>

                    <input type="text" placeholder="password" name="password"></br>
                    <span class="password_error error"></span>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="rememberMe"  id="rememberMe">
                        <label class="form-check-label" for="flexCheckDefault">
                            Remember Me
                        </label>
                    </div>

                    <button type="submit">Login Now</button>
                </form>

                <div class="invalid error mt-2"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#myForm').validate({
            errorClass: 'error',
            rules: {
                "name": {
                    required: true,
                    minlength: 3,
                },
                "email": {
                    required: true,
                },
                "password": {
                    required: true,
                    minlength: 3,

                }
            },
            submitHandler: function(form, event) {
                $('.invalid').html('');

                let errorClass=document.querySelectorAll('.error');
                errorClass.forEach(function(error) {
                  error.innerHTML ='';
                })
                event.preventDefault();
                let formData = new FormData(form);
                $.ajax({
                    url: "{{ route('loginUser') }}",
                    type: "post",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 200) {
                           window.location.href="{{ route('otpForm') }}";
                        } else if(response.status == 400) {
                            let errorClass=document.querySelectorAll('.error');
                            console.log(errorClass)
                            let errors = response.data;
                            Object.keys( errors ).forEach(key => {
                                let element=document.getElementsByClassName(`${key}_error`);
                               element[0].innerHTML=errors[key][0];
                               console.log(element)
                            });
                        } else {
                           let data=document.querySelector('.invalid');
                        //    console.log(data);
                        $('.invalid').html(response.msg);
                        //    data.inneHTML=response.msg;
                        }
                    }
                })
            }
        });
    })
</script>
