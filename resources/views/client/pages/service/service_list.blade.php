@extends('client.layout.master')

@section('seo')
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="description" content="{{ $meta_desc }}">
    <link rel="canonical" href="{{ $url_canonical }}">
    <!-- Share FB -->
    {{-- <meta property="og:site_name" content="http://127.0.0.1:8000/doctor"> --}}
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:title" content="MaiVaccine">
    <meta property="og:url" content="{{ $url_canonical }}">
    <meta property="og:type" content="website">
    {{-- <meta property="og:image" content="link image" /> --}}
@endsection

@section('titleIntroAndButtonBanner')
    <h5>We are here for your care</h5>
    <h1>Service</h1>
    <p>Vaccine services are an important aspect of public health. They provide access to vaccines that protect against
        infectious diseases and help prevent the spread of illness. Vaccine services may be provided by healthcare
        providers, public health agencies, or community organizations. These services may include administering vaccines,
        providing information about vaccines, and monitoring vaccine safety and effectiveness. By making vaccines accessible
        and promoting vaccine belief, vaccine services help improve public health outcomes and protect individuals and
        communities from preventable diseases.</p>
    {{-- share --}}
    <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="" data-size=""><a target="_blank"
            href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore btn_2"><i class="share icon"></i>Share FB</a>
    </div>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/service_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    {{-- title --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section_tittle text-center">
                    <h2 id="tableservice">Price All Service</h2>
                </div>
            </div>
        </div>
        {{-- search --}}
        <div class="container" style="margin-bottom: 2%">
            <form method="GET">
                <div class="ui action input">
                    <select name="sort" id="sort" style="margin-right: 2%" class="btn btn-primary">
                        <option @if(request()->sort === '0') selected @endif value="0">Lastest</option>
                        <option @if(request()->sort === '1') selected @endif value="1">Price Low to High</option>
                        <option @if(request()->sort === '2') selected @endif value="2">Price High to Low</option>
                    </select>
                    <input type="text" placeholder="Search..." name="keyword"
                        value="{{ is_null(request()->keyword) ? '' : request()->keyword }}">
                    <button type="submit" class="ui icon button"><i class="search icon"></i></button>
                </div>
                <p>
                    <label for="amount">Price range:</label>
                    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                    <input type="hidden" name="amount_start" id="amount_start">
                    <input type="hidden" name="amount_end" id="amount_end">
                </p>
                <div id="slider-range"></div>
            </form>
        </div>

        {{-- content --}}
        <div class="container">
            <div class="row">
                <table class="ui teal table" style="margin-bottom: 2%">
                    <thead>
                        <tr>
                            <th class="pl-0  pb-2 border-bottom">#</th>
                            <th class="border-bottom pb-2">Image</th>
                            <th class="border-bottom pb-2">Name</th>
                            <th class="border-bottom pb-2">Price</th>
                            <th class="border-bottom pb-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($serviceClientList as $service)
                            <tr>
                                <td class="pl-0">{{ $loop->iteration }}</td>
                                <td class="ui tiny images">
                                    @php
                                        $imageLink = is_null($service->image_url) || !file_exists('images/admin/service/' . $service->image_url) ? 'default-image.jpg' : $service->image_url;
                                    @endphp
                                    <img class="ui image" src="{{ asset('images/admin/service/' . $imageLink) }}"
                                        alt="{{ $service->name }}" width="150" height="150">
                                </td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->price }} vnd</td>
                                <td>
                                    <a href="{{ route('client.service.show', ['slug' => $service->slug]) }}"
                                        class="ui teal basic button">Detail</a>
                                </td>
                            </tr>
                    </tbody>
                @empty
                    <p>No Service</p>
                    @endforelse
                </table>
                <div class="clearfix" style="margin: 2% 0%">
                    {{ $serviceClientList->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-custom')

<script type="text/javascript">
    $(document).ready(function() {
        $("#slider-range").slider({
            range: true,
            min: {{ $minPrice }},
            max: {{ $maxPrice }},
            values: [ {{ request()->amount_start ?? 0 }} , {{ request()->amount_end ?? 10 }} ],
            slide: function(event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                $('#amount_start').val(ui.values[0]);
                $('#amount_end').val(ui.values[1]);
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1));
    });
</script>

@endsection
