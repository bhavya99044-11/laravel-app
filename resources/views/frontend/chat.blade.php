<div>

    @extends('frontend.cdn')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@^1.0.0/dist/echo.iife.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">
    @endpush
    @section('content')

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-6  users-chat">
                        <div class="users-container">
                            @foreach ($data['users'] as $user)
                                @if ($user->id == Auth::user()->id)
                                @else
                                    <a class="user-page" data-id={{ $user->id }}>
                                        <div class="user-details mt-2" data-id={{ $user->id }}>
                                            <img
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D">
                                            <div class="span ms-3">{{ $user->name }}</div>
                                        </div>
                                    </a>
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 chat-container">
                        <div class="chats-container d-flex">
                            <div class="user-header" data-id={{ $data['receiver']->id }}>
                                <img class="mb-1"
                                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D">
                                <div class="data  ms-3">
                                    <div class="span">{{ $data['receiver']->name }}</div>
                                    <span class="status offline">{{$data['last_active']}}</span>
                                </div>
                            </div>
                            <div class="chat-box" id="chat-box">
                                @if ($data['users-chat']->isNotEmpty())
                                    @foreach ($data['users-chat'] as $message)
                                        <div class="message send ">
                                        </div>
                                        <div
                                            class="message {{ $message->sender_id == $data['receiver']->id ? 'received' : 'send' }}">
                                            @if ($message->message_type == 0)
                                                <span class="message-text">{{ $message->message }}</span>
                                            @elseif($message->message_type == 1)
                                                <div class="text_img"><img class="text_image"
                                                        src={{ asset($message->image_path) }}>
                                                </div>
                                            @endif
                                            <div class="message-time">
                                                {{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}</div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <form id="formSubmit" enctype="multipart/form-data">

                                <div class="chat-input">
                                    <input type="text" id="message-input" name="message"
                                        placeholder="Type a message..." />
                                    <input class="d-none" type="file" name="images[]" id="imageInput" accept="image/*"
                                        multiple></input>
                                    <i class="fa fa-image" id="showImage"></i>
                                    <button type="submit" id="send-button">Send</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </body>
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {

                //Pusher Echo setup to show user active or not
                //If user already in channel it will show active using here functionality
                //If usaer join after then using joining his activity will be updated
                const echo = new Echo({
                    broadcaster: 'pusher',
                    key: '0519053939aefd09aa7d',
                    cluster: 'ap2',
                    forceTLS: true,
                });
                const receiver_id = $('.user-header').data('id');
                let status=document.querySelector('.status');
                echo.join('status-channel')
                    .here((users) => {
                        const userId=element=>element.id==receiver_id;
                        let user=users.some(userId)
                        if(user){
                        status.classList.add('active'),
                        status.textContent='active';
                        }
                    })
                    .joining((users) => {
                        if(users.id==receiver_id){
                        status.classList.add('active'),
                        status.textContent='active';
                        }
                    })

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var ckEditorView = null;
                $('#showImage').on('click', function() {
                    $('#imageInput').click();
                })
                let receiver = @json($data['receiver']);
                let authId = @json(Auth::user()->id);
                //Pusher integration for send chats and images in real time
                var pusher = new Pusher(@json(config('broadcasting.connections.pusher.key')), {
                    cluster: 'ap2'
                });
                var channel = pusher.subscribe(`chat-${authId}`);

                channel.bind('ChatSender', function(data) {
                    data.forEach((message) => {
                        if (receiver.id == message.sender_id) {
                            sendMessage(message, 'received')
                        }
                    })
                });
                console.log(receiver.id);
                var offlineChannel=pusher.subscribe(`chat-${receiver.id}`)
                offlineChannel.bind('ChatSender', function(data) {
                    status.classList.remove('active'),
                    status.textContent='last seen recently';
                });
                const button = document.getElementById('send-button');
                const chatBox = document.getElementById('chat-box');
                chatBox.scrollTop = chatBox.scrollHeight;
                //On user click to load chats
                $(document).on('click', '.user-page', function(e) {
                    let receiverId = $(this).data('id');
                    let url = '{{ route('chat.user', [':id']) }}';
                    url = url.replace(':id', receiverId);
                    window.location.href = url;
                })
                //Message container functionality
                function sendMessage(message, type) {
                    const messageDiv = document.createElement('div');
                    const mainMessage = messageDiv.classList.add('message', type);
                    let textMessage = null;
                    if (message.message_type == 0) {
                        textMessage = document.createElement('span');
                        textMessage.classList.add('message-text');
                        textMessage.textContent = message.message;
                    } else if (message.message_type == 1) {
                        let imageUrl = '{{ asset('') }}' + '' + (message.image_path);
                        textMessage = document.createElement('div');
                        textMessage.classList.add('text_img');
                        textMessage.textContent = message.message;
                        let imageTag = document.createElement('img');
                        imageTag.classList.add('text_image');
                        imageTag.src = imageUrl;
                        textMessage.appendChild(imageTag);
                    }
                    const messageTime = document.createElement('div');
                    messageTime.classList.add('message-time');
                    messageTime.textContent = message.date;
                    messageDiv.appendChild(textMessage);
                    messageDiv.appendChild(messageTime);
                    chatBox.appendChild(messageDiv);
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
                //message send functionality
                $('#formSubmit').on('submit', function(e, form) {
                    e.preventDefault();
                    const message = $('#message-input').val().trim();
                    let images = $("input[name='images[]']").val();
                    let formData = new FormData(this);
                    formData.append('receiver_id', receiver_id);
                    if (images || message) {
                        $.ajax({
                            url: "{{ route('chat.send') }}",
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                $('#message-input').val('');
                                $("input[name='images[]']").val();
                                response.data.forEach((message) => {
                                    sendMessage(message, 'send');
                                })

                            },
                            error: function(error) {
                                console.log(error);
                            }
                        })
                    }
                });
            });
        </script>
    @endpush
</div>
