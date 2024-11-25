<div>
    <html>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Password Prompt</title>
    </head>
    <style>
        .password-error{
            color: red;
            height: 10px;
        }
        </style>
    <body>

        @if(Session::get('content_password'))

        <h1>hello</h1>
        @endif
        <button type="button" class="btn btn-primary d-none" id="passwordShow" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form name="theForm" id="passwordVerfiy">
                        <div class="modal-body">
                            password

                            <input type="password" id="passwordContent">
                            <div class="password-error"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="verfiyPassword" class="btn btn-primary">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        let cookie=@json(Cookie::get('content_password'));
        if( @json(Session::get('content_password'))==null || @json(Session::get('content_password.value')) != cookie){
        passwordPrompt();
        function passwordPrompt() {
            $('#exampleModal').modal('show');
        }
    }

        $('#passwordVerfiy').submit(function(e){
            e.preventDefault();
            let password = $('#passwordContent').val();
            console.log(password);
            if(!password){
                $('.password-error').text('Please enter password');
                return false;
            }else{
            $.ajax({
                url: "{{ route('content.verify') }}",
                type: 'post',
                data: {
                    password: password
                },
                success: function(response) {
                    if (response.status == 200) {
                        window.location.reload();
                    } else {
                        $('.password-error').text(response.message);
                    }
                }
            });
        }
        })

    });
</script>
