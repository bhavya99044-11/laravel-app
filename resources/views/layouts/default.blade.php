<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('assets/css/headers.css') }}" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1/dist/css/bootstrap-dark.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @stack('style')
    @include('includes.header')
    @include('includes.footer')
    @yield('content')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js" type="module"></script>
    <script type="module" src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@master/dist/latest/bootstrap-autocomplete.min.js"></script>
    <script src="//rawgit.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.js"></script>

    @stack('script')
</body>

</html>
<script type="module">
    //  import Autocomplete from "https://cdn.jsdelivr.net/gh/lekoala/bootstrap5-autocomplete@master/autocomplete.js";
</script>
<script type="module" >
        import Autocomplete from "https://cdn.jsdelivr.net/gh/lekoala/bootstrap5-autocomplete@master/autocomplete.js";
        var src = [];
        const opts = {
    onSelectItem: console.log,
  };
        Autocomplete.init("input.autocomplete", {
    items: src,
    valueField: "id",
    labelField: "title",
    highlightTyped: true,
    onSelectItem: console.log,
  });


    $(document).ready(function() {
        var current;
        var src=[];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#autocompleteDatalist').on('input',function(){
            // value = $(this).val();

            // $.ajax({
            //     url: "{{ route('LiveSearch') }}",
            //     type: "post",
            //     data: {
            //         value: value,
            //         category: category
            //     },
            //     success: function(response) {
            //         if (response.status == 200) {

            //         } else {
            //             $('.search-suggestions').hide();
            //         }
            //     }
            // })
        })
        var $input = $("#autocompleteDatalist");


        $input.typeahead({
            name: 'options',
            source: function(query,process){
            value=$('#autocompleteDatalist').val()
          $.ajax({
                url: "{{ route('LiveSearch') }}",
                type: "post",
                data: {
                    value: value,
                    category: category
                },
                dataType : 'json',

                success: function(response) {
                    console.log(response.data);
                    if (response.status == 200) {
                       process(JSON.parse(response.data));
                    } else {
                        console.log('errrro');
                    }
                }
            })
        },updater:function(data){
            console.log(data)
            current=data.id
            return data
        }

 })

//  $input.change(function() {
//   current = $input.typeahead("getActive");
//     if (current.name == $input.val()) {
//         console.log(current)
//     } else {

//     }
//  });

$('#productSearch').on('click',function(){

    let url='{{route("Product",["id"=>":current"])}}';
   url= url.replace(":current",current)
window.location.href=url;
});


        // $('#autocompleteDatalist').typeahead({source: src});


        function hello(){

        }

//         $('#autoCompleteDatalist').autoComplete({
//     resolver: 'custom',
//     events: {
//         search: function (qry, callback) {
//             // let's do a custom ajax call
//             $.ajax(
//                 'route("LiveSearch")',
//                 {
//                     data: { 'qry': qry}
//                 }
//             ).done(function (res) {
//                 callback( { "value": 1, "text": "Google Cloud Platform" },
//     { "value": 2, "text": "Amazon AWS" },
//     { "value": 3, "text": "Docker" },
//     { "value": 4, "text": "Digital Ocean" })
//             });
//         }
//     }
// });


        var value;
        var category;
        let oldInput;
        var currentInput;

        $(document).on('click', function() {
            let searchBox = $('.search-suggestions').hide();
        })

        $('#liveSearch').on('input', function() {
            value = $(this).val();
            oldInput=$(this).val();
            // livesearch(value, category)
        })


        $('#searchClick').on('click', function() {

        })

        $('.category-select').on('change', function() {
            category = $(this).val();
            value = null;
            livesearch(value, category)
        });

        async function livesearch(value, category) {
            $.ajax({
                url: "{{ route('LiveSearch') }}",
                type: "post",
                data: {
                    value: value,
                    category: category
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('.search-suggestions').show()
                        $('.search-suggestions').html(response.data);
                        serachInitialization();
                        let xxx = -1;
                        arrowSearch(xxx)
                    } else {
                        $('.search-suggestions').hide();
                    }
                }
            })

        }

        function serachInitialization() {
            $('.searchClick').on('click', function() {
                let id = this.getAttribute('data-id');
                let ul = document.querySelector('.search-suggestion');


            })
            // let data = document.querySelectorAll('#searchClick').forEach(button => {
            //     button.addEventListener('click', function(data) {
            //
            //         let url= "{{ url('/product') }}"+"/"+id;
            //        console.log(id);
            //         $.ajax({
            //     url: url,
            //     type: "get",
            //     success: function(response) {
            //         if (response.status == 200) {

            //         } else {
            //         }
            //     }
            // })
            //     })
            // });

        }

        function arrowSearch(currentLI) {

            //    if(currentLI==-1){
            //     this.addEventListener("keydown", function(event){
            //         switch(event.keyCode){
            //             case 40:
            //             currentLI=0;
            //             console.log(11111);
            //     break;
            //         }
            //     });
            //    }
            currentLI=-1;

                this.addEventListener("keydown", function(event) {

                    currentInput=$('#liveSearch').val();
                    console.log(currentInput,oldInput)
                    // if(currentInput != oldInput){
                    //     currentLI=-1;
                    //     console.log(1)
                    // }
                    if(currentLI!=-1){
                var listItems = document.querySelectorAll(".search-suggestions li");
                listItems[currentLI].classList.add("highlight");
            }
                    switch (event.keyCode) {
                        case 38:
                            listItems[currentLI].classList.remove("highlight");

                            currentLI = currentLI > 0 ? --currentLI : 0;
                            listItems[currentLI].classList.add(
                            "highlight");
                            let liveData=$('#liveSearch').val(listItems[currentLI].firstChild.innerHTML);
                            oldInput=$('#liveSearch').val()
                            break;
                        case 40:
                        if(currentLI==-1){
                            currentLI=0;
                            var listItems = document.querySelectorAll(".search-suggestions li");
                listItems[currentLI].classList.add("highlight");
                let liveData=$('#liveSearch').val(listItems[currentLI].firstChild.innerHTML);

                        }else{

                            listItems[currentLI].classList.remove("highlight");

                            currentLI = currentLI < listItems.length - 1 ? ++currentLI : listItems
                                .length - 1;



                            listItems[currentLI].classList.add("highlight");
                            let liveData=$('#liveSearch').val(listItems[currentLI].firstChild.innerHTML); // Highlight the new element
                            oldInput=$('#liveSearch').val();

                        }
                            break;

                        default:

                    }

                });
            }


 $('.language-main').on('change',function(){
 let value=$(this).val();
 let url='{{route("localChange",["language"=>":value"])}}';
 url =url.replace(':value',value);
    $.ajax({
                url:url,
                type: "get",

                success: function(response) {
                    if(response.status=='200'){
                        window.location.reload();
                    }
                }

            });

 })




    })
</script>
