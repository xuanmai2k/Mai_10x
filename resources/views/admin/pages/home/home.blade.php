@extends('admin.layout.master')
@section('content')

<div class="content-wrapper">
    <!-- content-wrapper start -->
    <div class="row"><!-- Welcome -->
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome MaiVaccine</h3>
                    <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><!-- Tong thong ke -->
        <div class="col-md-6 grid-margin stretch-card"> <!-- decoration -->
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="{{ asset('admin/images/dashboard/people.svg') }}" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div class="ml-2">
                                <h4 class="location font-weight-normal">{{ $now }}</h4>
                                <h6 class="font-weight-normal">VietNam - HCM</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent"> <!-- Statistics -->
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <h5 class="mb-4">Today’s Bookings</h5>
                            <p class="fs-30 mb-2">{{ $totalTodayBooking }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <h5 class="mb-4">Total Bookings</h5>
                            <p class="fs-30 mb-2">{{ $totalBooking }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <h5 class="mb-4">Number of Complete</h5>
                            <p class="fs-30 mb-2">{{ $totalCompleteBooking }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <h5 class="mb-4">Number of Cancel</h5>
                            <p class="fs-30 mb-2">{{ $totalCancelBooking }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><!-- Chart about system and  sales -->
        <div class="col-md-6 grid-margin stretch-card"><!--Line Chart System + Total sometings-->
            <div class="card"><!-- Total Somethings -->
                <div class="card-body">
                    <p class="card-title">System</p>
                    <p class="font-weight-500">The total number of sessions within the date range. It is the
                        period time a user is actively engaged with your website, page or app, etc</p>
                    <div class="d-flex flex-wrap mb-5">
                        <div class="mr-5 mt-3"><!-- Total User In System -->
                            <p class="text-muted">Users</p>
                            <h3 class="text-primary fs-30 font-weight-medium">{{ $totalUsers }}</h3>
                        </div>
                        <div class="mr-5 mt-3"><!-- Total Vaccine In Store-->
                            <p class="text-muted">Vaccine In Store</p>
                            <h3 class="text-primary fs-30 font-weight-medium">{{ $totalVaccine }}</h3>
                        </div>
                        <div class="mr-5 mt-3"><!-- Total Contact In System -->
                            <p class="text-muted">Contact</p>
                            <h3 class="text-primary fs-30 font-weight-medium">{{ $totalContact }}</h3>
                        </div>
                        {{-- chart --}}
                        <div id="piechart" style="width: 900px; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card"><!-- Bar Chart Sales-->
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <p class="card-title">User Rating</p>
                    </div>
                    <p class="font-weight-500">This chart represents the total number of ratings from 1 star to 5 stars after users have experienced the service.</p>
                    <div id="piechart_3d" style=" height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><!-- Top Products and To Do Lists  -->
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card"><!-- Table Top (Suit 5-7 items) -->
                <div class="card-body">
                    <p class="card-title mb-0">Top Products</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topVaccine as $vaccine)
                                    <tr>
                                        <td>
                                            @php
                                                $imageLink = is_null($vaccine->image_url) || !file_exists('images/admin/vaccine/' . $vaccine->image_url) ? 'default-image.jpg' : $vaccine->image_url;
                                            @endphp
                                            <img src="{{ asset('images/admin/vaccine/'.$imageLink) }}" width="150" height="150" >
                                        </td>
                                        <td>{{ $vaccine->name_product }}</td>
                                        <td>{{ $vaccine->price }}vnd</td>
                                        <td class="font-weight-bold">{{ $vaccine->number }}</td>
                                        {{-- <td class="font-weight-medium">
                                            <div class="badge badge-success">Completed</div>
                                        </td> --}}
                                    </tr>
                                @empty
                                    No Product
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Empty In Store</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vaccineEmpty as $item)
                                    <tr>
                                        <td>
                                            @php
                                                $imageLink = is_null($item->image_url) || !file_exists('images/admin/vaccine/' . $item->image_url) ? 'default-image.jpg' : $item->image_url;
                                            @endphp
                                            <img src="{{ asset('images/admin/vaccine/'.$imageLink) }}" width="150" height="150" >
                                        </td>
                                        <td>{{ $item->name_product }}</td>
                                        <td>{{ $item->price }} vnd</td>
                                        <td class="font-weight-bold">{{ $item->qty }}</td>

                                        {{-- <td class="font-weight-medium">
                                            <div class="badge badge-success">Completed</div>
                                        </td> --}}
                                    </tr>
                                @empty
                                    No Product Empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><!-- Table about doctors are booked and list booking of doctor -->
        <div class="col-md-6 stretch-card grid-margin"> <!-- Doctors -->
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Top Doctors</p>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="pb-2 border-bottom">Image</th>
                                    <th class="border-bottom pb-2">Name</th>
                                    <th class="border-bottom pb-2">Position</th>
                                    <th class="border-bottom pb-2">Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $topDoctor as $doctor )
                                <tr>
                                    <td>
                                        @php
                                            $imageLink = is_null($doctor->image_url) || !file_exists('images/admin/doctor/' . $doctor->image_url) ? 'default-image.jpg' : $doctor->image_url;
                                        @endphp
                                        <img src="{{ asset('images/admin/doctor/'.$imageLink) }}" alt="{{ $doctor->name }}" width="150" height="150" >
                                    </td>
                                    <td class="pl-0">{{ $doctor->name }}</td>
                                    <td class="text-muted">{{ $doctor->position }}</td>
                                    <td> <p class="mb-0"><span class="font-weight-bold mr-2">{{ $doctor->number }}</span> </p> </td>
                                </tr>
                                @empty
                                    No doctor
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Complain Appointment</p>
                    <ul class="icon-data-list">
                        @forelse ( $complainList as $complain)
                        <li>
                            <div class="d-flex">
                                @php
                                    $imageLink = is_null($complain->user->image_url) || !file_exists('images/client/' . $complain->user->image_url) ? 'default-image.jpg' : $complain->user->image_url;
                                @endphp
                                <img src="{{ asset('images/client/'.$imageLink) }}" alt="{{ $complain->user->name }}">
                                <div>
                                    <p ><span class="text-info mb-1">{{ $complain->user->name }}  </span><span class="mb-0" style="color:red">  (OrderID: {{ $complain->order_id }}) </span><small>{{ $complain->updated_at }}</small></p>
                                    <p class="mb-0">Comment: {{ $complain->comment }}</p>
                                    <ul class="list-inline" style="display: flex;">
                                        <?php $rating = $complain->rating ?? 0; ?>
                                        @for ($count = 1; $count <= 5; $count++)
                                            @php
                                                if ($count <= $rating) {
                                                    $color = 'color:#ffcc00';
                                                } else {
                                                    $color = 'color:#ccc';
                                                }
                                            @endphp
                                            <li style=" {{ $color }}; font-size:20px;">&#9733</li>
                                        @endfor

                                    </ul>

                                </div>
                            </div>
                        </li>
                        @empty
                            No Complain
                        @endforelse

                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <div id="detailedReports"
                        class="carousel slide detailed-report-carousel position-static pt-2"
                        data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div
                                        class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                        <div class="ml-xl-4 mt-3">
                                            <p class="card-title">Detailed Reports</p>
                                            <h1 class="text-primary">$34040</h1>
                                            <h3 class="font-weight-500 mb-xl-4 text-primary">North America
                                            </h3>
                                            <p class="mb-2 mb-xl-0">The total number of sessions within the
                                                date range. It is the period time a user is actively engaged
                                                with your website, page or app, etc</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-9">
                                        <div class="row">
                                            <div class="col-md-6 border-right">
                                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                    <table class="table table-borderless report-table">
                                                        <tr>
                                                            <td class="text-muted">Illinois</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-primary"
                                                                        role="progressbar"
                                                                        style="width: 70%"
                                                                        aria-valuenow="70"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">713</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Washington</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-warning"
                                                                        role="progressbar"
                                                                        style="width: 30%"
                                                                        aria-valuenow="30"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">583</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Mississippi</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-danger"
                                                                        role="progressbar"
                                                                        style="width: 95%"
                                                                        aria-valuenow="95"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">924</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">California</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-info"
                                                                        role="progressbar"
                                                                        style="width: 60%"
                                                                        aria-valuenow="60"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">664</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Maryland</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-primary"
                                                                        role="progressbar"
                                                                        style="width: 40%"
                                                                        aria-valuenow="40"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">560</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Alaska</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-danger"
                                                                        role="progressbar"
                                                                        style="width: 75%"
                                                                        aria-valuenow="75"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">793</h5>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <canvas id="north-america-chart"></canvas>
                                                <div id="north-america-legend"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div
                                        class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                        <div class="ml-xl-4 mt-3">
                                            <p class="card-title">Detailed Reports</p>
                                            <h1 class="text-primary">$34040</h1>
                                            <h3 class="font-weight-500 mb-xl-4 text-primary">North America
                                            </h3>
                                            <p class="mb-2 mb-xl-0">The total number of sessions within the
                                                date range. It is the period time a user is actively engaged
                                                with your website, page or app, etc</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-9">
                                        <div class="row">
                                            <div class="col-md-6 border-right">
                                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                    <table class="table table-borderless report-table">
                                                        <tr>
                                                            <td class="text-muted">Illinois</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-primary"
                                                                        role="progressbar"
                                                                        style="width: 70%"
                                                                        aria-valuenow="70"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">713</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Washington</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-warning"
                                                                        role="progressbar"
                                                                        style="width: 30%"
                                                                        aria-valuenow="30"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">583</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Mississippi</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-danger"
                                                                        role="progressbar"
                                                                        style="width: 95%"
                                                                        aria-valuenow="95"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">924</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">California</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-info"
                                                                        role="progressbar"
                                                                        style="width: 60%"
                                                                        aria-valuenow="60"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">664</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Maryland</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-primary"
                                                                        role="progressbar"
                                                                        style="width: 40%"
                                                                        aria-valuenow="40"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">560</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Alaska</td>
                                                            <td class="w-100 px-0">
                                                                <div class="progress progress-md mx-4">
                                                                    <div class="progress-bar bg-danger"
                                                                        role="progressbar"
                                                                        style="width: 75%"
                                                                        aria-valuenow="75"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="font-weight-bold mb-0">793</h5>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <canvas id="south-america-chart"></canvas>
                                                <div id="south-america-legend"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#detailedReports" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#detailedReports" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- content-wrapper ends -->
</div>

@endsection

@section('js-custom')
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable(@json($arrayDatas));

      var options = {
        title: 'My Daily Activities'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>
  <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable(@json($arrayRating));

      var options = {
        title: 'User Rating',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }
  </script>
@endsection
