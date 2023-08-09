@extends('client.layout.master')


@section('titleIntroAndButtonBanner')
    <h5>We are here for your care</h5>
    <h1>Introduction</h1>
    <p>At Mai Vaccine, we would like to extend our heartfelt gratitude to our valued customers for trusting us with their
        healthcare needs. Your trust in our brand fuels our commitment to providing the highest quality vaccines and
        exceptional customer service. As we navigate through these unprecedented times, rest assured that we remain
        dedicated to keeping you and your loved ones safe and healthy. Thank you for choosing Mai Vaccine as your healthcare
        partner.</p>
    <a href="{{ route('account.index') }}" class="btn_2">Account</a>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/user_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <div class="container" style="margin-bottom: 5%">
        <h1 style="text-align:center">Appointment history of {{ auth()->user()->name }}</h1>
        <div class="container">
            <div class="profile-content">
                @forelse ($bookingList as $booking)
                    <div class="card-deck" style="margin-top: 2%">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Name: {{ $booking->name }}</h3>
                                <p class="card-text">Email: {{ $booking->email }}</p>
                                <p class="card-text">Phone: {{ $booking->phone }}</p>
                                <p class="card-text">Age: {{ $booking->age }}</p>
                                <p class="card-text">Doctor: {{ $booking->doctor->name }}</p>
                                <p class="card-text">Nurse: {{ $booking->nurse->name }}</p>
                                <p class="card-text">Product category: {{ $booking->category->name }}</p>
                                <p class="card-text">Product: {{ $booking->product->name_product }}</p>
                                <p class="card-text">Price: {{ $booking->total_price }} vnd </p>
                                <p class="card-text">Date: {{ $booking->date_appointment }} <span>Time:
                                        {{ substr($booking->time_appointment, 0, 5) }}</span> </p>
                                <p class="card-text">Pay by:
                                    <?php
                                    if ($booking->pay_by == 0) {
                                        echo 'cash in hand';
                                    } elseif ($booking->pay_by == 1) {
                                        echo 'momo';
                                    } else {
                                        echo 'vnpay';
                                    }
                                    ?>
                                </p>
                                <p class="card-text">Payment: {{ $booking->status_payment }}</p>
                                @if (!is_null($booking->comment)) <!-- có comment thì show -->
                                    <p class="card-text">Comment: {{ $booking->comment }}</p>
                                @endif
                                <hr>
                                @if ($booking->status == 1) <!-- complete/cancel -->
                                    <div style="display:flex; float:right">
                                        <form style="margin-right: 5%" method="POST"
                                            action="{{ route('client.account.changeStatusComplete', ['account' => $booking->id]) }}">
                                            @csrf
                                            <button class="ui green basic button" type="submit">Complete</button>
                                        </form>
                                        <form id={{ $booking->id }} method="POST"
                                            action="{{ route('client.account.changeStatusCancel', ['account' => $booking->id]) }}">
                                            @csrf
                                            <button onclick="myfunction({{ $booking->id }})" type="button"
                                                class="ui red basic button">Cancel</button>
                                        </form>
                                    </div>
                                @elseif ($booking->status == 2) <!--complete-->
                                    <label style="float:right" class="btn btn-secondary">Complete</label>
                                @else<!--cancel-->
                                    <label style="float:right" class="btn btn-secondary">Cancel</label>
                                @endif
                                <!--rating-->
                                @if ($booking->status == 2 && is_null($booking->rating))
                                    <button class="ui blue basic button" id="evaluate-btn">Evaluate</button>
                                @elseif (!is_null($booking->rating))
                                <ul class="list-inline" title="rating" style="display: flex;">
                                    @for ($count = 1; $count <= 5; $count++)
                                        @php
                                            if ($count <= $booking->rating) {
                                                $color = 'color:#ffcc00';
                                            } else {
                                                $color = 'color:#ccc';
                                            }
                                        @endphp
                                        <li id="{{ $booking->id }}-{{ $count }}" data-index="{{ $count }}" data-rating="{{ $booking->rating }}" class="rating" style="cursor: pointer; {{ $color }}; font-size:30px;"> &#9733</li>
                                    @endfor
                                </ul>
                                @endif
                                <dialog id="evalate-dialog">
                                    <form action="{{ route('client.account.evaluate') }}" method="POST"
                                        class="rating-form" id="evaluate-form">
                                        @csrf
                                        <label>Rating:</label>
                                        <ul class="list-inline" title="rating" style="display: flex;">
                                            <?php $rating = $rating ?? 0; ?>
                                            @for ($count = 1; $count <= 5; $count++)
                                                @php
                                                    if ($count <= $rating) {
                                                        $color = 'color:#ffcc00';
                                                    } else {
                                                        $color = 'color:#ccc';
                                                    }
                                                @endphp
                                                <li id="{{ $booking->id }}-{{ $count }}"
                                                    data-index="{{ $count }}"
                                                    data-rating="{{ $rating }}" class="rating"
                                                    style="cursor: pointer; {{ $color }}; font-size:30px;">
                                                    &#9733</li>
                                            @endfor
                                        </ul>

                                        <label><i class="envelope icon"></i>Comment:</label>
                                        <input type="textarea" id="comment" name="comment">
                                        <input type="hidden" name="rating" value="{{ $rating }}">
                                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                                        <button type="submit">Save</button>
                                        <button style="background-color: #f44336; color: white; border: 1px; padding: 10px 10px; text-align: center; display: inline-block; font-size: 16px;" id="cancel-evaluate-btn" name="rating" value="{{ $rating=null }}" >Cancel</button>
                                    </form>
                                </dialog>
                            </div>
                        </div>
                    </div>
                @empty
                    No booking
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('script-pop-up')
    <script>
        // Lắng nghe sự kiện click trên nút alert
        function myfunction(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel appointment!',
                cancelButtonText: "No, I don't!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(id)?.submit()
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        };
    </script>
    <script>//evaluate
        var dialogEvaluate = document.getElementById("evalate-dialog");
        var evaluateBtn = document.getElementById("evaluate-btn");
        var cancelEvaluateBtn = document.getElementById("cancel-evaluate-btn");
        evaluateBtn.onclick = function() {
            dialogEvaluate.showModal();
        }
        cancelEvaluateBtn.onclick = function() {
            dialogEvaluate.close();
        }

        $(document).ready(function(){
            // var selectedRating = {{ $rating }};
            var lis = document.querySelectorAll(".rating");
            for (var i = 0; i < lis.length; i++) {
                lis[i].addEventListener("click", function(){
                    selectedRating = this.getAttribute("data-index");
                    document.querySelector("input[name='rating']").value = selectedRating;
                    for (var j = 0; j < lis.length; j++) {
                        if (j < selectedRating) {
                            lis[j].style.color = "#ffcc00";
                        } else {
                            lis[j].style.color = "#ccc";
                        }
                    }
                });
            }
        });
    </script>
@endsection
