@extends('layouts.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.default.css')}}"/>
    @endpush

    <div class="container mt-3">
        <div class="row mt-3">

            <div class="col-md-7">
                <div class="card bg-white shadow">
                    <div class="card-header bg-white">
                        <h4 class="text-center">Publication info</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="type">Type of publication</label>
                                <select class="custom-select" name="type" id="type" disabled>
                                    <option>Journal articles</option>
                                    <option>Workshop and conference paper</option>
                                    <option>Book and thesis</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$publication['title']}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="venue">Venue</label>
                                <input type="text" class="form-control" id="venue" name="venue" value="{{$publication['venue']}}" disabled>
                                <span class="text-muted">Separate venue with a ,</span>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="volume">Volume</label>
                                    <input type="text" class="form-control" id="volume" name="volume" value="" disabled>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="number">Number</label>
                                    <input type="text" class="form-control" id="number" name="number" value="" disabled>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="pages">Pages</label>
                                    <input type="text" class="form-control" id="pages" name="pages" value="" disabled>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="year">Year</label>
                                    <input type="text" class="form-control" id="year" name="year" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5">

                                </textarea>
                            </div>
                            <div id="form-group">
                                <label for="tag">Publication tag</label>
                                <select name="tag" id="tag">
                                    <option value="1">Test 1</option>
                                    <option value="2">Test 2</option>
                                    <option value="3">Test 3</option>
                                    <option value="4">Test 4</option>
                                    <option value="5">Test 5</option>
                                    <option value="6">Test 6</option>
                                    <option value="7">Test 7</option>
                                    <option value="8">Test 8</option>
                                </select>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card bg-white shadow">
                    <div class="card-header bg-white">
                        <h4 class="text-center">Publication Multimedia</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" id="image-tab" data-toggle="tab" href="#imageTabPanel"
                                   aria-controls="image"
                                   aria-selected="true">Image</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="video-tab" data-toggle="tab" href="#videoTabPanel" aria-controls="video"
                                   aria-selected="false">Video</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="audio-tab" data-toggle="tab" href="#audioTabPanel" aria-controls="audio"
                                   aria-selected="false">Audio</a>
                            </li>
                            <li class="navItem">
                                <a class="nav-link" id="upload-tab" data-toggle="tab" href="#uploadTabPanel" aria-controls="upload"
                                   aria-selected="false">Upload</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- Image tab-->
                            <div class="tab-pane fade show active mt-2" id="imageTabPanel" role="tabpanel"
                                 aria-labelledby="image-tab">
                                <h4 class="my-3">Publication Image</h4>
                                <div class="row mb-3 p-0">
                                    <div class="col-md-8" style="height: 120px;">
                                        <img class="d-block h-100 w-100 img-thumbnail"
                                             src="https://picsum.photos/500/500/?random"
                                             alt="First slide">
                                    </div>
                                    <div class="col-md-4 align-self-center">
                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8" style="height: 120px;">
                                        <img class="d-block h-100 w-100 img-thumbnail"
                                             src="https://picsum.photos/500/500/?random"
                                             alt="First slide">
                                    </div>
                                    <div class="col-md-4 align-self-center">
                                        <a href="#" class="btn btn-danger">X Delete</a>
                                    </div>

                                </div>
                            </div>
                            <!-- /.Image tab-->

                            <!-- Video tab -->
                            <div class="tab-pane fade" id="videoTabPanel" role="tabpanel" aria-labelledby="video-tab">
                                <h3>Video</h3>
                            </div>
                            <!-- /.Video tab -->

                            <!-- Audio tab -->
                            <div class="tab-pane fade" id="audioTabPanel" role="tabpanel" aria-labelledby="audio-tab">
                                <h3>Audio</h3>
                            </div>
                            <!-- /.Audio tab -->

                            <!-- Upload tab -->
                            <div class="tab-pane fade" id="uploadTabPanel" role="tabpanel" aria-labelledby="upload-tab">
                                <h4 class="mt-4 mb-3">Upload new image</h4>
                                <form enctype="multipart/form-data" id="uploadForm">
                                    <input type="hidden" id="publicationId" name="publicationId" value="{{$publication['id']}}">
                                    <div class="input-group mt-2">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="filesToUpload" name="file[]"
                                                   multiple>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-info" id="uploadFile">Update</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="mt-3" id="imageHolder" class="mt-3"></div>
                            </div>
                            <!-- /.Upload tab -->


                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    @push('scripts')
        <script type="text/javascript" src="{{asset('vendor/selectize.js/js/standalone/selectize.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#tag').selectize({
                    plugins: ['remove_button'],
                    maxItems: 3,
                    delimiter: ',',
                    items: ['1', '2'],
                    highlight: true,
                    dropdownParent: 'body',
                    create: function (input) {
                        return {
                            value: input,
                            text: input
                        }
                    }
                });

                $('#btnImage').click(function (e) {
                    e.preventDefault();
                    let formData = new FormData();
                    let files = $('#image')[0].files[0];
                    alert(files);
                });

                var files = null;

                $('#filesToUpload').on('change' , function () {

                    let countFile = $(this)[0].files.length;
                    $('#imageHolder').empty();
                    if($(this)[0].files){
                        if(typeof (FileReader) != 'undefined'){

                            files = Array.from($(this)[0].files);

                            var newElem = $("<ol></ol>");
                            newElem.addClass('list-group list-group-flush');
                            newElem.css('height' , 'auto');

                            function loadImage(image){
                                return new Promise(function (resolve, reject){
                                    let fileReader = new FileReader();

                                    fileReader.onload = function(e){
                                        resolve(e.target.result);
                                    }
                                    fileReader.readAsDataURL(image);
                                })
                            }

                            var queue = Promise.resolve();

                            [].reduceRight.call(files , function(queue , file , index){
                                return queue.then(function(){
                                    return loadImage(file).then(function (imageAsDataUrl){
                                        console.log(index);
                                        //console(files[index]);
                                        let container = $("<li></li>");
                                        container.addClass('list-group-item');
                                        let containerRow = $("<div class='row'></div>");
                                        let firstColumn = $("<div class='col-md-8'></div>");
                                        let secondColumn = $("<div class='col-md-4'></div>");
                                        secondColumn.addClass('align-self-center');
                                        let image = $('<img/>');
                                        image.attr('src' , imageAsDataUrl);
                                        image.css('height' , '80px');
                                        image.css('width' , '100%');
                                        console.log('test' + newElem);

                                        let button = $('<button></button>');
                                        button.addClass('btn btn-danger mt-2');
                                        button.append("<i class='far fa-times-circle mr-2'></i>Delete");
                                        button.on('click' , function(){
                                            console.log(index);
                                            console.log(files[index]);
                                            container.remove();
                                            files.splice(index , 1);
                                            console.log(files);
                                        });
                                        firstColumn.append(image);
                                        secondColumn.append(button);
                                        containerRow.append(firstColumn);
                                        containerRow.append(secondColumn);
                                        container.append(containerRow);
                                        newElem.append(container);

                                    })
                                })
                            },Promise.resolve()).then( function(){
                                console.log(newElem);
                                $('#imageHolder').append(newElem);
                            })

                        }
                    };
                });

                $('#uploadFile').on('click' , function(e){
                    e.preventDefault();
                    console.log($('#uploadDForm').children().first());
                    console.log(files);
                    if(files != null){

                        var formData = new FormData();
                        files.forEach(function(file){
                            console.log(file);
                            formData.append('file[]' , file);
                        });

                        for (var value of formData.values()) {
                            console.log(value);
                        }

                        console.log($('#publicationId').val());
                        formData.append('publicationId' , $('#publicationId').val());

                        $.ajax({
                            url: 'http://localhost/corman/public/multimedias/store',
                            type: 'POST',
                            data : formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(response){
                                console.log(response);
                            },
                            error: function(response){
                                console.log(response);
                            }
                        });
                    }else{
                        alert("You need to select some file first!");
                    }
                });

            });

        </script>
    @endpush
@endsection()