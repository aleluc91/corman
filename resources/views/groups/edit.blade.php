@extends('layouts.app')

@push('styles')
    <link href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fa/theme.min.css') }}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card bg-white">
                    <div class="card-header bg-white">
                        <h1 class="text-center">Edit group data</h1>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                <form method="POST" action="{{ route('groups.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" value="{{ $group->id }}" name="id">
                                    <div class="form-group">
                                        <label class="text-dark" for="name"><b>{{ __('Name') }}</b></label>
                                        <input id="name" type="text"
                                               class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                               name="name"
                                               placeholder="" value="{{$group->name}}">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark"
                                               for="description"><b>{{ __('Description') }}</b></label>
                                        <textarea id="description" type="text"
                                                  class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                                  name="description"
                                                  placeholder="" >{{$group->description}}
                                        </textarea>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark" for="description"><b>{{ __('Privacy') }}</b></label>
                                        <select id="privacy" type="text"
                                                class="custom-select {{ $errors->has('privacy') ? 'is-invalid' : '' }}"
                                                name="privacy"
                                                placeholder=""
                                                value="{{$group->privacy}}">
                                            <option value="public" selected>Public</option>
                                            <option value="private">Private</option>
                                        </select>
                                        @if ($errors->has('privacy'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('privacy') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark" for="imageToUpload"><b>Upload a new image</b></label>
                                        <input type="file" id="imageToUpload" name="image"
                                               multiple data-show-caption="true"
                                               data-msg-placeholder="Select image for upload..."
                                               data-show-upload="false">
                                    </div>
                                    <div class="row justify-content-end mt-2">
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary">Update<i class="fas fa-plus ml-2"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('body.scripts')
    <script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
    <!-- the main fileinput plugin file -->
    <script src="{{ asset('vendor/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
    <!-- optionally uncomment line below for loading your theme assets for a theme like Font Awesome (`fa`) -->
    <script src="{{ asset('vendor/bootstrap-fileinput/themes/fa/theme.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fa/theme.min.js') }}"
            type="text/javascript"></script>

    <!-- optionally if you need translation for your language then include  locale file as mentioned below -->
    <script type="text/javascript">

        $(document).ready(function () {


            $('#imageToUpload').fileinput({
                hideThumbnailContent: false, // hide image, pdf, text or other content in the thumbnail preview
                minFileCount: 0,
                maxFileCount: 1,
                overwriteInitial: false,
                theme: 'explorer-fa',
                uploadExtraData: function () {
                    return {
                        userId: $('#userId').val(),
                        _token: $("input[name = '_token']").val()
                    }
                },
                allowedFileExtensions: ['jpg', 'jpeg', 'png'],
                maxFileSize: 5000,
                showUploadedThumbs: false,
                preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
                previewFileIconSettings: { // configure your icon file extensions
                    'jpg': '<i class="fas fa-file-image text-primary"></i>',
                    'jpeg': '<i class="fas fa-file-image text-primary"></i>',
                    'png': '<i class="fas fa-file-image text-primary"></i>'
                },
            });
        })
    </script>
@endpush