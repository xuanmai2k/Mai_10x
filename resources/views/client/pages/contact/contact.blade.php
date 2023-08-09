@extends('client.layout.master')

@section('seo')
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="description" content="{{ $meta_desc }}">
    <link rel="canonical" href="{{ $url_canonical }}">
    <!-- Share FB -->
    {{-- <meta property="og:site_name" content="http://127.0.0.1:8000/contact"> --}}
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:title" content="MaiVaccine">
    <meta property="og:url" content="{{ $url_canonical }}">
    <meta property="og:type" content="website">
    <head>
        <style>
            #chatbox {
                display: none;
                position: fixed;
                bottom: 0;
                right: 30px;
                width: 300px;
                height: 400px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: white;
                z-index: 1;
            }

            #chatbox-header {
                background-color: #f1f1f1;
                padding: 10px;
                border-bottom: 1px solid #ccc;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
            }

            #chatbox-messages {
                height: 290px;
                overflow-y: scroll;
            }

            #chatbox-input {
                width: 85%;
                height: 10%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            #chatbox-send {
                background-color: #4CAF50;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
            }

            #chatbox-send:hover {
                background-color: #3e8e41;
            }
        </style>
    </head>
    {{-- <meta property="og:image" content="link image" /> --}}
@endsection

@section('titleIntroAndButtonBanner')
    <h5>We are here for your care</h5>
    <h1>Contact</h1>
    <p>Contact with healthcare providers and public health agencies is an important part of accessing vaccines and promoting public health. Healthcare providers can provide accurate information about vaccines, help individuals understand their vaccination options, and administer vaccines safely and effectively. Public health agencies may offer vaccine clinics or other services to make vaccines more accessible to the community. By staying in contact with healthcare providers and public health agencies, individuals can stay up-to-date on the latest vaccine recommendations and protect themselves and their communities from preventable diseases. Contact with these organizations also allows for monitoring of vaccine safety and effectiveness, ensuring that vaccines continue to be a valuable tool in promoting public health.</p>
    {{-- share --}}
    <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="" data-size=""><a target="_blank"
        href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore btn_2"><i class="share icon"></i>Share FB</a></div>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/contact_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection

@section('content')
    <!-- ================ contact section start ================= -->
    <section class="contact-section section_padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Form</h2>
                </div>
                <div class="col-lg-8">
                    <div class="container mt-3">
                        <form action="{{ route('client.contact.store') }}" role="form" method="POST">
                            @csrf
                            <div class="mb-3 mt-3">
                                <label><i class="user icon"></i>Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name"
                                    name="name">
                            </div>
                            @error('name')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mb-3 mt-3">
                                <label><i class="envelope icon"></i>Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    name="email">
                            </div>
                            @error('email')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mb-3 mt-3">
                                <label><i class="phone icon"></i>Phone:</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Enter phone"
                                    name="phone">
                            </div>
                            @error('phone')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mb-3 mt-3">
                                <label><i class="pencil alternate icon"></i>Content:</label>
                                <input type="text" class="form-control" id="content" placeholder="Enter content"
                                    name="content">
                            </div>
                            @error('content')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>HCMC, VIETNAM</h3>
                            <p>District 11</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>+(84)783362649</h3>
                            <p>Mon to Sat 8am to 6pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>maivaccine@gmail.com</h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                    <div>
                        <button id="chatbox-button" class="btn btn-primary">Chat with Simsimi</button>

                        <div id="chatbox">
                            <div id="chatbox-header">Chatbox<span><i class="close icon" id="close-chat"></i></span></div>

                            <div id="chatbox-messages"></div>
                            <div style="display : flex">
                                <input type="text" id="chatbox-input" name="utext" placeholder="Enter your message">
                                <button id="chatbox-send" type="button" value="Submit">Send</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection

@section('script-pop-up')
    <div class="content">
        @if (session('message') == "success")
            <script>
                Swal.fire(
                    'Success!',
                    'You have successfully submitted your information, thank you!',
                    'success'
                );
            </script>
        @endif
        @if(session('message') == "failed")
            <script>
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
                });
            </script>
        @endif
    </div>
@endsection

@section('js-custom')
<script>
    $(function() {
        $('#chatbox-button').click(function() {
            $('#chatbox').show();
        });

        $('#close-chat').click(function() {
            $('#chatbox').hide();
        });

        $('#chatbox-send').click(function() {
            var message = $('#chatbox-input').val();
            $('#chatbox-messages').append('<p>You: ' + message + '</p>');
            $('#chatbox-input').val('');
            $.ajax({
                url: '/chatsimsimi',
                method: 'POST',
                data: {
                    'utext': message,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // atext.innerHTML = response;
                    $('#chatbox-messages').append('<p>Simsimi: ' + response + '</p>');
                }
            });
        });
    });
</script>
@endsection
