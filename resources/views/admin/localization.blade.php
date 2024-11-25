<div>
    @extends('layouts.cdn')
    @section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('assets/css/localization.css') }}">

        <div class="langOptions">
            <select class="form-select" id="selectLanguage" aria-label="Default select example">
                @foreach ($data['options'] as $option)
                    <option value={{ $option }}>{{ $option }}</option>
                @endforeach
            </select>

        </div>

        <button type="button" class="btn btn-primary createButton" id="createButton" data-toggle="modal">Create</button>
        <table class="table table-bordered data-table" id="tableUsers">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>message</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" id="">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="languageForm">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Message key</label>
                                <input type="text" class="form-control" name="messageKey" id="messageKey">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message data</label>
                                <textarea class="form-control" name="messageData" id="messageData"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="closeModal"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="button">Send message</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="localization-form hidden">
            <form id="localizationData">
                <div class="form-group">
                    <label for="exampleInputEmail1">Message Key</label>
                    <input type="text" name="messageKey" class="form-control" id="messageKey"
                        aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Message Data</label>
                    <input type="text" class="form-control" id="messageData" name="messageData">
                </div>

                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    @endsection

    @push('script')
        <script>
            $(document).ready(function() {

                var language = null;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                yajraTable(language);

                const theButton = document.querySelector(".button");

theButton.addEventListener("click", () => {
    theButton.classList.add("button--loading");
});

                $('#languageForm').submit(function(event) {
                    event.preventDefault();
                    let language = $('#selectLanguage').val();
                    let formData = new FormData(this);
                    formData.append('language', language)
                    $.ajax({
                        url: "{{ route('addLocalization') }}",
                        type: "post",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == 200) {
                                setTimeout(() => {
                                    console.log("Waited for 5 seconds");
                                    $('#exampleModal').modal('hide');
                                    yajraTable(language)
                                }, 5000);
                            }
                        }
                    })

                })

                function yajraTable(language) {
                    console.log(language);
                    var table = $('.data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        bDestroy: true,
                        ajax: {
                            url: "{{ route('languageYajraTable') }}",
                            type: 'post',
                            data: {
                                language: language
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'message',
                                name: 'message'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },

                        ]
                    });


                    // ini();
                }
                // function ini(){

                $('#tableUsers').DataTable().on('click', '.editButton', function(e) {
                    theButton.classList.remove("button--loading");

                    let key = $(this).attr('data-key');
                    let message = $(this).attr('data-message');
                    $('#messageKey').val(key);
                    $('#messageData').val(message);
                    $('#exampleModal').modal('show');
                });

                $('#createButton').on('click', function() {
                    $('#exampleModal').modal('show');

                })
                $('#closeModal').on('click', function() {
                    $('#exampleModal').modal('hide');

                })


                // }

                $('#selectLanguage').on('change', function() {
                    // console.log($('#selectLanguage').val())
                    yajraTable($('#selectLanguage').val())
                    // table.ajax.reload()
                })

                $('#localizationData').submit(function(event, form) {
                    event.preventDefault();


                    let formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('addLocalization') }}",
                        type: "post",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#localizationData').reset();
                        }
                    })
                })





            })
        </script>
    @endpush
</div>
