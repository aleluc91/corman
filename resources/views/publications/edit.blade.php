@extends('layouts.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.default.css')}}"/>
    @endpush

    <div class="container mt-3">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row mt-3">

            <div class="col-md-7">
                @include('publications.includes.publication_edit_card')
            </div>

            <div class="col-md-5">
                @include('publications.includes.publication_multimedia_card_edit')
            </div>


        </div>


    </div>

@endsection

    {{--@push('body.scripts')

        <script type="text/javascript">
            $(document).ready(function () {


                /*$('#btnImage').click(function (e) {
                    e.preventDefault();
                    let formData = new FormData();
                    let files = $('#image')[0].files[0];
                    alert(files);
                });

                var files = null;

                $('#filesToUpload').on('change', function () {

                    let countFile = $(this)[0].files.length;
                    $('#imageHolder').empty();
                    if ($(this)[0].files) {
                        if (typeof (FileReader) != 'undefined') {

                            files = Array.from($(this)[0].files);

                            console.log(files);

                            var newElem = $("<ol></ol>");
                            newElem.addClass('list-group list-group-flush');
                            newElem.css('height', 'auto');

                            function load(file) {
                                return new Promise(function (resolve, reject) {
                                    let fileReader = new FileReader();

                                    fileReader.onload = function (e) {
                                        resolve(e.target.result);
                                    }

                                    if ((file.type === 'image/png') || (file.type === 'image/jpeg') || (file.type === 'image/jpg'))
                                        fileReader.readAsDataURL(file);
                                    else if ((file.type === 'video/mp4') || (file.type === 'video/mkv'))
                                        resolve(URL.createObjectURL(file));
                                    else if (file.type === 'audio/mpeg')
                                        resolve(URL.createObjectURL(file));
                                    else if (
                                        (file.type === 'application/pdf') ||
                                        (file.type === 'application/msword') ||
                                        (file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') ||
                                        (file.type === 'application/application/vnd.ms-powerpoint') ||
                                        (file.type === 'application/vnd.openxmlformats-officedocument.presentationml.presentation')) {

                                        resolve(URL.createObjectURL(file));
                                    }
                                })

                            }

                            var queue = Promise.resolve();

                            [].reduceRight.call(files, function (queue, file, index) {
                                return queue.then(function () {
                                    return load(file).then(function (fileData) {
                                        let container = $("<li></li>");
                                        container.addClass('list-group-item');
                                        let containerRow = $("<div class='row'></div>");
                                        let firstColumn = $("<div class='col-md-8'></div>");
                                        let secondColumn = $("<div class='col-md-4'></div>");
                                        secondColumn.addClass('align-self-center');
                                        let fileToAppend;
                                        if ((file.type === 'image/png') || (file.type === 'image/jpeg') || (file.type === 'image/jpg')) {
                                            fileToAppend = $('<img/>');
                                            fileToAppend.attr('src', fileData);
                                            fileToAppend.css('height', '120px');
                                            fileToAppend.css('width', '100%');
                                        } else if ((file.type === 'video/mp4') || (file.type === 'video/mkv')) {
                                            fileToAppend = $("<video style='height: 120px ; width:100%' controls></video>");
                                            fileToAppend.append(`<source src="${fileData}" type="${file.type}">`);
                                        } else if (file.type === 'audio/mpeg') {
                                            fileToAppend = $("<audio style='height: 50px; width:100%' controls></audio>");
                                            fileToAppend.append(`<source src="${fileData}" type="${file.type}">`);
                                        }else if(
                                            (file.type === 'application/pdf') ||
                                            (file.type === 'application/msword') ||
                                            (file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') ||
                                            (file.type === 'application/application/vnd.ms-powerpoint') ||
                                            (file.type === 'application/vnd.openxmlformats-officedocument.presentationml.presentation')){

                                            fileToAppend = $('<a class="align-middle"></a>');
                                            fileToAppend.attr('href' , '#');
                                            fileToAppend.append(file.name);

                                        }

                                        let button = $('<button></button>');
                                        button.addClass('btn btn-danger mt-2');
                                        button.append("<i class='far fa-trash-alt mr-2'></i>Delete");
                                        button.on('click', function () {
                                            container.remove();
                                            files[index] = 'deleted';

                                        });
                                        firstColumn.append(fileToAppend);
                                        secondColumn.append(button);
                                        containerRow.append(firstColumn);
                                        containerRow.append(secondColumn);
                                        container.append(containerRow);
                                        newElem.append(container);

                                    })
                                })
                            }, Promise.resolve()).then(function () {
                                $('#imageHolder').append(newElem);
                            })

                        }
                    }
                    ;
                });

                $('#uploadFile').on('click', function (e) {
                    e.preventDefault();

                    if (files != null) {

                        function cleanFiles(item) {
                            console.log('filtering');
                            console.log(typeof(item));
                            if (typeof(item) != 'string')
                                return item;
                        }

                        let filesCleaned = files.filter(cleanFiles);

                        let formData = new FormData();
                        files.forEach(function (file) {
                            formData.append('file[]', file);
                        });

                        for (let value of formData.values()) {
                            console.log(value);
                        }

                        formData.append('publicationId', $('#publicationId').val());

                        $.ajax({
                            url: 'http://localhost/corman/public/multimedias/store',
                            type: 'POST',
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                console.log(response);
                                location.reload();
                            },
                            error: function (response) {
                                console.log(response);
                            }
                        });
                    } else {
                        alert("You need to select some file first!");
                    }
                });
*/
            });

        </script>
    @endpush--}}
