@extends('layouts.app')

@push('styles')
    <link href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fa/theme.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.default.css')}}"/>
@endpush

@section('content')

    <div class="container my-2">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-md-12 col-lg-12">

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7">
                        <div class="card bg-white shadow">
                            <div class="card-body">
                                <form method="POST" action="{{ route('users.update' , ['id' => $user->id]) }}">
                                    @csrf
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 form-group">
                                            <label class="text-info" for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value=" {{ $user->name }}"
                                                   autofocus>
                                        </div>
                                        <div class="col-md-6 col-sm-12 form-group">
                                            <label class="text-info" for="lastName">Last name</label>
                                            <input type="text" class="form-control" id="lastName" name="lastName"
                                                   value="{{ $user->last_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-info" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value=" {{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-info" for="dateOfBirth">Date of birth</label>
                                        <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth"
                                               value="{{ $user->date_of_birth }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-info" for="country">Country</label>
                                        <select id="country" class="form-control" name="country">
                                            <option>Select your country...</option>
                                            <option>Italy</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-info" for="gender">Gender</label>
                                        <select id="gender" class="form-control" name="gender">
                                            @if(empty($user->gender))
                                                <option selected>Select your gender...</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            @elseif($user->gender === 'Male')
                                                <option>Select your gender...</option>
                                                <option value="Male" selected>Male</option>
                                                <option value="Female">Female</option>
                                            @else
                                                <option>Select your gender...</option>
                                                <option value="Male">Male</option>
                                                <option value="Female" selected>Female</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-info" for="dateOfBirth">Affiliation</label>
                                        <input type="text" class="form-control" id="affiliation" name="affiliation"
                                               value="{{ $user->affiliation }}">
                                    </div>
                                    <div class="form-group">
                                        {{ $user->lines_of_research }}
                                        <label class="text-info" for="linesOfResearch">{{ __('Lines of research') }}</label>
                                        <input id="linesOfResearch" type="text"
                                               class="{{ $errors->has('linesOfResearch') ? 'is-invalid' : '' }}"
                                               name="linesOfResearch" value="{{ $user->lines_of_research }}">
                                        @if ($errors->has('linesOfResearch'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('linesOfResearch') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Edit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5">
                        <div class="card bg-white shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="profile-card mb-2">
                                            <img class="avatar1" src="{{ asset('storage/' . $user->avatar) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-center">Upload a new image</h4>
                                        <div class="mt-3">
                                            <input id="userId" value="{{ $user->id }}" type="hidden">
                                            <input type="file" id="imageToUpload" name="image"
                                                   multiple data-show-caption="true"
                                                   data-msg-placeholder="Select image for upload...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@push('body.scripts')
    <script type="text/javascript" src="{{asset('vendor/selectize.js/js/standalone/selectize.js')}}"></script>
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

            $('#linesOfResearch').selectize({
                plugins: ['remove_button'],
                maxItems: 5,
                delimiter: ',',
                highlight: true,
                dropdownParent: 'body',
                create: function (input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            });

            $('#imageToUpload').on('filebatchuploadsuccess', function (event, data) {
                console.log('File batch upload success');
                window.location.reload(true);
            });


            $('#imageToUpload').fileinput({
                hideThumbnailContent: false, // hide image, pdf, text or other content in the thumbnail preview
                minFileCount: 1,
                maxFileCount: 1,
                overwriteInitial: false,
                theme: 'explorer-fa',
                uploadUrl: '/users/image/store',
                uploadExtraData: function () {
                    return {
                        userId: $('#userId').val(),
                        _token: $("input[name = '_token']").val()
                    }
                },
                allowedFileExtensions: ['jpg', 'jpeg', 'png'],
                maxFileSize: 5000,
                uploadAsync: false,
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