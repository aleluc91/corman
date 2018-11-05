@extends('layouts.app')

@push('styles')
    <link href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fa/theme.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.default.css')}}"/>
@endpush

@section('content')

    <div class="container mt-3">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
            <div class="row mt-3">
                @csrf
                <input type="hidden" name="authorId" value="{{ Auth::user()->author->id }}">
                <div class="col-12 col-sm 12 col-md-7 col-lg-7">
                    @include('publications.includes.publication_create_card')
                </div>

                <div class="col-12 col-sm-12 col-md-5 col-lg-5">
                    @include('publications.includes.publication_create_authors_card')
                    @include('publications.includes.publication_create_multimedia_card')
                </div>


            </div>
            <div class="row justify-content-end mt-2">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary"></i>Create Publication<i class="fas fa-plus ml-2"></i>
                    </button>
                </div>
            </div>
        </form>

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
    <script type="text/javascript" src="{{asset('vendor/selectize.js/js/standalone/selectize.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 4000);

            var option = [];
            var optionId = [];


            $.ajax({
                url: "/topics/" + $('#publicationId').val() + "/get",
                type: 'GET',
                success: function (option) {
                    Object.keys(option.topics).forEach(function (key) {
                        optionId.push(option.topics[key].id);
                    });
                    console.log(optionId);
                    $('#topics').selectize({
                        plugins: ['remove_button'],
                        maxItems: 5,
                        delimiter: ',',
                        items: optionId,
                        highlight: true,
                        dropdownParent: 'body',
                        create: function (input) {
                            return {
                                value: input,
                                text: input
                            }
                        }
                    });
                },
                error: function (err) {
                    console.log(err);
                }
            })

            $('#authors').selectize({
                plugins: ['remove_button'],
                maxItems: null,
                valueField: 'id',
                labelField: 'name',
                searchField: ['name', 'last_name'],
                options: [],
                create: false,
                render: {
                    item: function (item, escape) {
                        return '<div>' +
                            (item.name ? '<span>' + escape(item.name) + '</span>' : '') + ' ' +
                            (item.last_name ? '<span>' + escape(item.last_name) + '</span>' : '') +
                            '</div>';
                    },
                    option: function (item, escape) {
                        return `<div class="row p-2">
                                    <div class="col-auto">
                                        <img style="height:32px; height:32px" alt="avatar" src="/storage/${item.avatar}">
                                    </div>
                                    <div class="col-auto my-auto">
                                        <a class="text-primary h6" href="">
                                            ${escape(item.name)} ${escape(item.last_name)}
                                        </a>
                                    </div>
                                </div>`;

                        // return '<div class="row justify-content-end my-1">' +
                        //     '<div class="col-4">' +
                        //     '<div class="p-2">' +
                        //     '<img style="height:50px" class="w-50 rounded-circle img-fluid" src="/storage/' + item.avatar + '">' +
                        //     '</div>' +
                        //     '</div>' +
                        //     '<div class="col-7">' +
                        //     '<div class="p-2">' +
                        //     '<h5>' + escape(item.name) + ' ' + escape(item.last_name) + '</h5>' +
                        //     '<h6>' +
                        //     '<span class="mr-1"><i class="fas fa-university text-danger"></i></span>' +
                        //     '<span class="font-weight-bold">Affiliation : </span>' +
                        //     '<span class="text-muted">' + item.affiliation + '</span>' +
                        //     '</h6>' +
                        //     '</div>' +
                        //     '</div>' +
                        //     '</div>';
                    }
                },
                load: function (query, callback) {
                    if (!query.length) return callback();
                    $.ajax({
                        url: '/search/users/' + encodeURIComponent($('#userId').val()) + '/' + encodeURIComponent(query),
                        type: 'GET',
                        error: function () {
                            console.log('error');
                            callback();
                        },
                        success: function (res) {
                            console.log(res.users);
                            callback(res.users);
                        }
                    });
                },

            });

            $('#filesToUpload').fileinput({
                hideThumbnailContent: false, // hide image, pdf, text or other content in the thumbnail preview
                minFileCount: 0,
                maxFileCount: 5,
                overwriteInitial: false,
                theme: 'explorer-fa',
                previewFileIcon: '<i class="fa fa-file"></i>',
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'avi', 'mp4', 'mkv', 'mp3', 'pdf', 'doc', 'docx', 'ppt', 'pptx'],
                maxFileSize: 10000,
                showUploadedThumbs: false,
                preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
                previewFileIconSettings: { // configure your icon file extensions
                    'doc': '<i class="fas fa-file-word text-primary"></i>',
                    'ppt': '<i class="fas fa-file-powerpoint text-primary"></i>',
                    'pdf': '<i class="fas fa-file-pdf text-primary"></i>',
                    'txt': '<i class="fas fa-file-text text-primary"></i>',
                    'mov': '<i class="fas fa-file-movie text-primary"></i>',
                    'mp3': '<i class="fas fa-file-audio text-primary"></i>',
                    'mp4': '<i class="fas fa-file-movie text-primary"></i>',
                    // note for these file types below no extension determination logic
                    // has been configured (the keys itself will be used as extensions)
                    'jpg': '<i class="fas fa-file-image text-primary"></i>',
                    'gif': '<i class="fas fa-file-image text-primary"></i>',
                    'png': '<i class="fas fa-file-image text-primary"></i>'
                },
                previewFileExtSettings: { // configure the logic for determining icon file extensions
                    'doc': function (ext) {
                        return ext.match(/(doc|docx)$/i);
                    },
                    'xls': function (ext) {
                        return ext.match(/(xls|xlsx)$/i);
                    },
                    'ppt': function (ext) {
                        return ext.match(/(ppt|pptx)$/i);
                    },
                    'zip': function (ext) {
                        return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                    },
                    'htm': function (ext) {
                        return ext.match(/(htm|html)$/i);
                    },
                    'txt': function (ext) {
                        return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
                    },
                    'mov': function (ext) {
                        return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                    },
                    'mp3': function (ext) {
                        return ext.match(/(mp3|wav)$/i);
                    }
                }
            });

            $('#type').ready(function () {
                switch ($('#type').val()) {
                    case 'Journal Articles' :
                        $('#volume').prop('disabled', false);
                        $('#number').prop('disabled', false);
                        $('#pages').prop('disabled', false);
                        $('#publisher').prop('disabled', true);
                        break;
                    case 'Conference and Workshop Papers' :
                        $('#volume').prop('disabled', true);
                        $('#number').prop('disabled', true);
                        $('#pages').prop('disabled', false);
                        $('#publisher').prop('disabled', true);
                        break;
                    case 'Editorship' :
                        $('#volume').prop('disabled', false);
                        $('#number').prop('disabled', true);
                        $('#pages').prop('disabled', true);
                        $('#publisher').prop('disabled', false);
                        break;
                    case 'Parts in Books or Collections' :
                        $('#volume').prop('disabled', true);
                        $('#number').prop('disabled', true);
                        $('#pages').prop('disabled', false);
                        $('#publisher').prop('disabled', true);
                        break;
                    case 'Informal Publications' :
                        $('#volume').prop('disabled', false);
                        $('#number').prop('disabled', true);
                        $('#pages').prop('disabled', true);
                        $('#publisher').prop('disabled', true);
                        break;
                    case 'Books and Theses' :
                        $('#volume').prop('disabled', false);
                        $('#number').prop('disabled', true);
                        $('#pages').prop('disabled', true);
                        $('#publisher').prop('disabled', false);
                        break;
                }
            });


            $('#type').on('change', function () {
                switch ($('#type').val()) {
                    case 'Journal Articles' :
                        $('#volume').prop('disabled', false);
                        $('#number').prop('disabled', false);
                        $('#pages').prop('disabled', false);
                        $('#publisher').prop('disabled', true);
                        break;
                    case 'Conference and Workshop Papers' :
                        $('#volume').prop('disabled', true);
                        $('#number').prop('disabled', true);
                        $('#pages').prop('disabled', false);
                        $('#publisher').prop('disabled', true);
                        break;
                    case 'Editorship' :
                        $('#volume').prop('disabled', false);
                        $('#number').prop('disabled', true);
                        $('#pages').prop('disabled', true);
                        $('#publisher').prop('disabled', false);
                        break;
                    case 'Parts in Books or Collections' :
                        $('#volume').prop('disabled', true);
                        $('#number').prop('disabled', true);
                        $('#pages').prop('disabled', false);
                        $('#publisher').prop('disabled', true);
                        break;
                    case 'Informal Publications' :
                        $('#volume').prop('disabled', false);
                        $('#number').prop('disabled', true);
                        $('#pages').prop('disabled', true);
                        $('#publisher').prop('disabled', true);
                        break;
                    case 'Books and Theses' :
                        $('#volume').prop('disabled', false);
                        $('#number').prop('disabled', true);
                        $('#pages').prop('disabled', true);
                        $('#publisher').prop('disabled', false);
                        break;
                }
            });


        });
    </script>

@endpush
