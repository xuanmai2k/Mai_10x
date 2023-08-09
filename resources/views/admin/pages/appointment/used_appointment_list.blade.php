@extends('admin.layout.master')
@section('content')

<div class="container" style="margin-bottom: 2%">
    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <!-- Appointment List -->
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-0">Appointment Used List</h2>
                    <form  method="GET">
                        <div class="input-group" style="margin: 2% 0%">
                            <input type="text" name="keyword" class="form-control" placeholder="Search name..." aria-label="Recipient's username" value="{{ is_null(request()->keyword) ? '' : request()->keyword}}">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="pl-0  pb-2 border-bottom">#</th>
                                    <th class="border-bottom pb-2">OrderID</th>
                                    <th class="border-bottom pb-2">Name</th>
                                    <th class="border-bottom pb-2">Phone</th>
                                    <th class="border-bottom pb-2">Email</th>
                                    <th class="border-bottom pb-2">Age</th>
                                    <th class="border-bottom pb-2">Date</th>
                                    <th class="border-bottom pb-2">Time</th>
                                    <th class="border-bottom pb-2">Product Category</th>
                                    <th class="border-bottom pb-2">Product</th>
                                    <th class="border-bottom pb-2">Doctor</th>
                                    <th class="border-bottom pb-2">Nurse</th>
                                    <th class="border-bottom pb-2">Payment</th>
                                    <th class="border-bottom pb-2">Comment</th>
                                    <th class="border-bottom pb-2">Rating</th>
                                    <th class="border-bottom pb-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($appointmentList as $appointment)
                                <tr>
                                    <td class="pl-0">{{ $loop->iteration }}</td>
                                    <td>{{ $appointment->id }}</td>
                                    <td>{{ $appointment->name }}</td>
                                    <td>{{ $appointment->phone }}</td>
                                    <td>{{ $appointment->email }}</td>
                                    <td>{{ $appointment->age }}</td>
                                    <td>{{ $appointment->date_appointment }}</td>
                                    <td>{{ substr($appointment->time_appointment, 0, 5) }}</td>
                                    <td>{{ $appointment->category->name }}</td>
                                    <td>{{ $appointment->product->name_product }}</td>
                                    <td>{{ $appointment->doctor->name }}</td>
                                    <td>{{ $appointment->nurse->name }}</td>
                                    <td>{{ $appointment->status_payment }}</td>
                                    <td>{{ $appointment->comment }}</td>
                                    <td>
                                        <ul class="list-inline" title="rating" style="display: flex;">
                                            <?php $rating = $appointment->rating ?? 0 ?>
                                            @for ($count = 1; $count <= 5; $count++)
                                                @php
                                                    if ($count <= $rating) {
                                                        $color = 'color:#ffcc00';
                                                    } else {
                                                        $color = 'color:#ccc';
                                                    }
                                                @endphp
                                                <li class="rating" style="cursor: pointer; {{ $color }}; font-size:30px;"> &#9733</li>
                                            @endfor
                                        </ul>
                                    </td>
                                    <td> <p class="btn btn-{{ $appointment->status == 2  ? 'success' : 'danger' }}">{{ $appointment->status== 2 ? 'Complete' : 'Not yet' }}</p></td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No Appointment</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="clearfix">
                            {{ $appointmentList->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-pop-up')

@endsection
