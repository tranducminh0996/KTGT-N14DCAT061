@extends('layout.app')
@section('title', __('thuvienanh'))
@section('content')
<div class="wrap-page">

    <div class="content-page">
        <div class="section">

            <div class="tournament-image-library">

                <!-- <div class="item-image-library"> -->
                <div class="title-image-library">
                    <span class="facility_image-library-tournament" style="top: -8px;"><b>{{$tour->name}}</b></span>
                </div>


                <div class="container-sm">
                    <div class="row justify-content-center">
                        <div class="col col-md-10">
                            <div class="gallery-container" id="animated-thumbnails-gallery">

                                @foreach ($listImage as $img)
                                <a data-lg-size="10-10" class="gallery-item" data-src="{{ $img['img_url']}}" data-sub-html="<h4>Photo by -<a href='https://www.golfnews.vn/' target='_blank'> GolfNews </a></h4><p> Location - Puezgruppe, Wolkenstein in Gröden, Südtirol, Italien</a>layers of blue.</p>">
                                    <img alt="layers of blue." class="img-responsive" src="{{ $img['img_url'] }}" />
                                </a>

                                <!-- <a data-lg-size="10-10" class="gallery-item" data-src="{{ $img['img_resize'] }}" data-sub-html="<h4>Photo by - Golfer </a></h4><p> Location - Puezgruppe, Wolkenstein in Gröden, Südtirol, Italien</a>layers of blue.</p>">
                                    <img alt="layers of blue." class="img-responsive" src="{{ $img['img_resize'] }}" />
                                </a> -->
                                @endforeach
                                <!-- <a data-lg-size="10-10" class="gallery-item" data-src="{{asset('images/test.png')}}" data-sub-html="<h4>Photo by - <a href='{{asset('images/test.png')}}' >Golfer abc xyz </a></h4><p> Location - <a href='{{asset('images/test.png')}}'>Puezgruppe, Wolkenstein in Gröden, Südtirol, Italien</a>layers of blue.</p>">
                                        <img alt="layers of blue." class="img-responsive" src="{{asset('images/test.png')}}" />
                                    </a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.1.5/lightgallery.umd.min.js" integrity="sha512-l69eSOBGvDFhh5Q2RKrPVMTDEH96F3ePijw3Rzzph1C3e1jEk+Zq2LNgB1i6KmD6XaOWZQ89eY5V0cfF6M7RaA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.1.5/plugins/thumbnail/lg-thumbnail.umd.min.js" integrity="sha512-Y32mW3X2XL9mubA7TIL/5VJclC/pgKqa5WBvWNdELiI4iDqoyeudt44jZQ17D0XR01exKB98OSTUjN/3lqm/MQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.1.5/plugins/mediumZoom/lg-medium-zoom.umd.min.js" integrity="sha512-F0KX1abE3WscqKtImCTLr9fxrfBkPg9gbZV+U78RK+nmdrtuBiR5ZC9gKSp2AS5aNTP8pHFp6UAfjPVkFX2umA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript">

    jQuery("#animated-thumbnails-gallery")
        .justifiedGallery({
            captions: false,
            lastRow: 'nojustify',
            rowHeight: 220,
            margins: 5
        })
        .on("jg.complete", function() {
            document.querySelector('footer').style = 'display: inline-block; width: 100%';
            window.lightGallery(
                document.getElementById("animated-thumbnails-gallery"), {
                    autoplayFirstVideo: false,
                    pager: false,
                    galleryId: "nature",
                    plugins: [lgZoom, lgThumbnail],
                    mobileSettings: {
                        controls: false,
                        showCloseIcon: true,
                        download: true,
                        rotate: true
                    }
                }
            );
        });
    // $("footer").appendTo("body");

   
    $(document).ready(function() {
        document.querySelector('footer').style = 'display: none';
    });
</script>


@endsection
@push('style_head')
<link rel="stylesheet" href="{{asset('css/imageLibrary.css')}}">
@endpush