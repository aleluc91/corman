@push('styles')
    <link href="{{ asset('vendor/blueimp/css/blueimp-gallery.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('vendor/blueimp/css/blueimp-gallery-indicator.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('vendor/blueimp/css/blueimp-gallery-video.css') }}" type="text/css" rel="stylesheet">
@endpush

<div class="row">
    <div class="col-12">
        <div class="card shadow">

            <div class="card-header">
                <h4 class="text-dark">Images and videos</h4>
            </div>

            <div class="card-body">
                <div id="links">
                    @if($publicationImages->isNotEmpty() or $publicationVideos->isNotEmpty())
                        @foreach($publicationImages as $image)
                            <a href="{{ asset('storage/' . $image->url) }}"
                               title="Multimedia for current publication">
                            </a>
                        @endforeach
                        @foreach($publicationVideos as $video)
                            <a
                                    href="{{ asset('storage/' . $video->url) }}"
                                    title=""
                                    type="{{ $video->type }}"
                                    data-poster=""
                                    data-source="{{ asset('storage/' . $video->url) }}">
                            </a>
                        @endforeach
                    @else
                        <h5>There are no images or videos for this publication.</h5>
                    @endif
                </div>

                <div id="blueimp-gallery-carousel" class="blueimp-gallery blueimp-gallery-carousel">
                    <div class="slides"></div>
                    <h3 class="title"></h3>
                    <a class="prev">‹</a>
                    <a class="next">›</a>
                    <a class="play-pause"></a>
                    <ol class="indicator"></ol>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h4>Audio</h4>
            </div>

            <div class="card-body">
                @foreach($publicationAudios as $audio)
                    <div class="row">
                        <div class="col-12">
                            <audio class="d-block w-100" controls>
                                <source src="{{ asset('storage/' . $audio->url) }}" type="{{ $audio->type }}">
                            </audio>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>



@push('body.scripts')
    <script src="{{ asset('vendor/blueimp/js/blueimp-gallery.min.js')}}"></script>
    <script type="text/javascript">


        blueimp.Gallery(
            document.getElementById('links').getElementsByTagName('a'),
            {
                container: '#blueimp-gallery-carousel',
                carousel: true
            }
        )
        blueimp.Gallery(
            document.getElementById('videoLinks').getElementsByTagName('a'),
            {
                container: '#blueimp-video-carousel',
                carousel: true
            }
        );

    </script>
@endpush