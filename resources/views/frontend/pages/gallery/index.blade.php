@extends('frontend.master')
@section('title')
    Gallery
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Gallery</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item text-light">/</li>
                            <li class="breadcrumb-item text-light  active" aria-current="page">Gallery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!--Gallery Page Start-->
    <div style="display:none;">
        <div id="ninja-slider">
            <div class="slider-inner">
                <ul>
                    @foreach($items as $item)
                        <li>
                            <a class="ns-img" href="{{asset($item->image_path)}}"></a>
                        </li>
                    @endforeach

                </ul>
                <div id="fsBtn" class="fs-icon" title="Expand/Close"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="gallery">
            @php $i=0; @endphp
            @foreach($items as $item)
                <img src="{{asset($item->image_path)}}" onclick="lightbox({{$i++}})" />
            @endforeach

        </div>
    </div>
    <!--Gallery Page End-->
@endsection
@push('script')
    <script>
        function lightbox(idx) {
            var ninjaSldr = document.getElementById("ninja-slider");
            ninjaSldr.parentNode.style.display = "block";

            nslider.init(idx);

            var fsBtn = document.getElementById("fsBtn");
            fsBtn.click();
        }

        function fsIconClick(isFullscreen, ninjaSldr) {
            if (isFullscreen) {
                ninjaSldr.parentNode.style.display = "none";
            }
        }
    </script>
@endpush
