@extends('admin.layout.master')
@section('content')
    <div class="container">
        <h1 style="margin-bottom:3%">About Us</h1>
        <div class="ui form">
            <div class="field" id="chatbox">
                <label>Ask a question for chatgpt:</label>
                <textarea rows="2" id="chatbox-input" name="content" placeholder="Enter your message"></textarea>
                <button id="chatbox-send" type="button" value="Submit" class="btn btn-inverse-primary btn-fw" style="margin-top:2%">Send chatgpt</button>
            </div>
            <div class="field">
                <label>Reply from chatgpt:</label>
                <textarea rows="5" id="replychatgpt"></textarea>
            </div>
            <form action="{{ route('admin.aboutus.store') }}" role="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <label>Content About Us:</label>
                    <textarea id="description" name="description"></textarea>
                    <button type="submit" class="btn btn-inverse-primary btn-fw" style="margin-top:2%; margin-bottom:2%;">Save Data</button>
                    @error('description')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div >
            </form>
        </div>
    </div>
    @endsection

    @section('js-custom')
        <script>
            $(function() {
                $('#chatbox-send').click(function() {
                    var message = $('#chatbox-input').val();
                    $.ajax({
                        url: '/chatgpt',
                        method: 'POST',
                        data: {
                            'content': message,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            replychatgpt.innerHTML = response;
                        }
                    });
                });
            });
        </script>
    @endsection

    @section('description-ckeditor')
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ), {
                ckfinder: {
                    uploadUrl: '{{route('admin.aboutus.image.upload').'?_token='.csrf_token()}}',
                }
            })
            .catch( error => {
                console.error( error );
            });
    </script>
    @endsection
