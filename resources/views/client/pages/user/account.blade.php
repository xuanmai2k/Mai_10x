@extends('client.layout.master')


@section('titleIntroAndButtonBanner')
    <h5>We are here for your care</h5>
    <h1>Introduction</h1>
    <p>At Mai Vaccine, we would like to extend our heartfelt gratitude to our valued customers for trusting us with their
        healthcare needs. Your trust in our brand fuels our commitment to providing the highest quality vaccines and
        exceptional customer service. As we navigate through these unprecedented times, rest assured that we remain
        dedicated to keeping you and your loved ones safe and healthy. Thank you for choosing Mai Vaccine as your healthcare
        partner.</p>
    <a href="{{ route('appointment.index') }}" class="btn_2">Appointment</a>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/user_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <div class="container" style="margin-bottom: 5%">
        <h1 style="text-align:center">Appointment history of {{ auth()->user()->name }}</h1>
        <div class="container">
            <div class="row profile">
                <div class="col-md-3" style=" border: 1px solid lightgray ; justify-content: center">
                    <div class="profile-sidebar">
                        <!--profile-->
                        <div class="profile-userpic">
                            <?php
                            $imageLink = is_null(auth()->user()->image_url) || !file_exists('images/client/' . auth()->user()->image_url) ? 'default-image.jpg' : auth()->user()->image_url;
                            ?>
                            <img class="right floated mini ui image" src="{{ asset('images/client/' . $imageLink) }}"
                                alt="{{ auth()->user()->name }}"
                                style="width: 100%; height: auto; object-fit: cover; border-radius: 50%; margin-bottom: 10%">
                        </div>
                        <div style="margin-bottom: 5%;">
                            <h2 style="text-align:center;">Profile</h2>
                            <p style="text-align:center; color:#001449"><i class="user icon"></i>Name:
                                {{ auth()->user()->name }}</p>
                            <p style="text-align:center; color:#001449"><i class="phone icon"></i>Phone:
                                {{ auth()->user()->phone }}</p>
                            <p style="text-align:center; color:#001449"><i class="envelope icon"></i>Email:
                                {{ auth()->user()->email }}</p>
                            <p style="text-align:center; color:#001449"><i class="birthday cake icon"></i>Day of Birth:
                                {{ auth()->user()->dob }}</p>
                        </div>
                        <div style="display: flex; justify-content: center;">
                            <button class="ui blue basic button" id="edit-btn" style="margin-right: 5px">Edit
                                Profile</button>
                            <button class="ui blue basic button" id="update-password">Update Password</button>
                        </div> <!-- Edit -->
                        <dialog id="edit-dialog">
                            <form action="{{ route('profile.update') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PATCH')
                                <label><i class="user icon"></i>Name:</label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}">

                                <label><i class="envelope icon"></i>Email:</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}">

                                <label><i class="phone icon"></i>Phone:</label>
                                <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone }}">

                                <label><i class="birthday cake icon"></i>Day of Birth:</label>
                                <input type="date" id="dob" name="dob" value="{{ auth()->user()->dob }}">

                                <label><i class="file image icon"></i>Avatar:</label>
                                <?php $imageLink = is_null(auth()->user()->image_url) || !file_exists('images/client/' . auth()->user()->image_url) ? 'default-image.jpg' : auth()->user()->image_url; ?>
                                <img class="left floated mini ui image" src="{{ asset('images/client/' . $imageLink) }}"
                                    alt="{{ auth()->user()->name }}"
                                    style="width: 100px; height: auto; object-fit: cover; border-radius: 50%;">
                                <input type="file" id="avatar" name="image_url">

                                <button type="submit">Save</button>
                                <button id="cancel-btn">Cancel</button>
                            </form>
                        </dialog>
                        <dialog id="update-pass-dialog">
                            <section>
                                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <x-input-label for="current_password" :value="__('Current Password')" />
                                        <x-text-input id="current_password" name="current_password" type="password"
                                            class="mt-1 block w-full" autocomplete="current-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="password" :value="__('New Password')" />
                                        <x-text-input id="password" name="password" type="password"
                                            class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="password_confirmation" name="password_confirmation"
                                            type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                                        <button id="cancel-uppass-btn"
                                            style="background-color: #f44336; color: white; border: 1px; padding: 7px 10px; text-align: center; display: inline-block; font-size: 16px;">Cancel</button>

                                        @if (session('status') === 'password-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                        @endif
                                    </div>
                                </form>
                            </section>
                        </dialog>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="profile-content">
                        <div>
                            <!--search-->
                            <form method="GET">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control"
                                        placeholder="Search name ..." aria-label="Recipient's username"
                                        value="{{ is_null(request()->keyword) ? '' : request()->keyword }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-primary" type="submit">Search</button>
                                    </div>
                                </div>
                                <div>
                                    <select name="status" id="status" style="margin-top: 2%"
                                    class="ui purple basic button">
                                        <option @if (request()->status === '') selected @endif value="">--Select--
                                        </option>
                                        <option @if (request()->status === '1') selected @endif value="1">Appointment</option>
                                        <option @if (request()->status === '2') selected @endif value="2">Complete
                                        </option>
                                        <option @if (request()->status === '3') selected @endif value="3">Cancel
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        @forelse ($bookingList as $booking)
                            <div class="card-deck" style="margin-top: 2%">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Name: {{ $booking->name }}</h3>
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
                                        <hr>
                                        @if ($booking->status == 1)
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
                                        @elseif ($booking->status == 2)
                                            <label style="float:right" class="btn btn-secondary">Complete</label>
                                        @else
                                            <label style="float:right" class="btn btn-secondary">Cancel</label>
                                        @endif
                                        <a href="{{ route('client.account.history', ['id' => $booking->id]) }}" class="ui teal basic button">Detail</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            No booking
                        @endforelse
                        <div class="clearfix" style="margin: 2% 0%">
                            {{ $bookingList->appends(request()->query())->links() }}
                        </div>
                    </div>
                    @if (session('message') == 'success')
                        <script>
                            Swal.fire(
                                'Success!',
                                'You clicked the button!',
                                'success'
                            );
                        </script>
                    @endif
                    @if (session('message') == 'failed')
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Because the appointment date has not arrived yet!'
                            });
                        </script>
                    @endif
                </div>
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
    <script>
        //edit profile
        var dialog = document.getElementById("edit-dialog"); // Lấy phần tử modal
        var btn = document.getElementById("edit-btn"); // Lấy phần tử nút hoặc phần tử HTML kích hoạt modal
        var cancelBtn = document.getElementById("cancel-btn"); // Lấy phần tử nút hoặc phần tử HTML để hủy bỏ chỉnh sửa

        // Khi nút hoặc phần tử HTML được nhấp vào, hiển thị modal
        btn.onclick = function() {
            dialog.showModal();
        }

        // Khi người dùng nhấp vào nút đóng hoặc nút hủy bỏ, đóng modal
        cancelBtn.onclick = function() {
            dialog.close();
        }
    </script>
    <script>
        //edit password
        var passDialog = document.getElementById("update-pass-dialog");
        var editPassBtn = document.getElementById("update-password");
        var cancelPassBtn = document.getElementById("cancel-uppass-btn");

        editPassBtn.onclick = function() {
            passDialog.showModal();
        }

        cancelPassBtn.onclick = function() {
            passDialog.close();
        }
    </script>
@endsection
