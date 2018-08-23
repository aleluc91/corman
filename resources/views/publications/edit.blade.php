@extends('layouts.app')

@section('content')
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
                                <select class="custom-select" name="type" id="type">
                                    <option>Journal articles</option>
                                    <option>Workshop and conference paper</option>
                                    <option>Book and thesis</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="">
                            </div>
                            <div class="form-group">
                                <label for="venue">Venue</label>
                                <input type="text" class="form-control" id="venue" name="venue" value="">
                                <span class="text-muted">Separate venue with a ,</span>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="volume">Volume</label>
                                    <input type="text" class="form-control" id="volume" name="volume" value="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="number">Number</label>
                                    <input type="text" class="form-control" id="number" name="number" value="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="pages">Pages</label>
                                    <input type="text" class="form-control" id="pages" name="pages" value="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="year">Year</label>
                                    <input type="text" class="form-control" id="year" name="year" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5">

                                </textarea>
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
                                <a class="nav-link" id="image-tab" data-toggle="tab" href="#image" aria-controls="image"
                                   aria-selected="true">Image</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" aria-controls="video"
                                   aria-selected="false">Video</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="audio-tab" data-toggle="tab" href="#audio" aria-controls="audio"
                                   aria-selected="false">Audio</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Image tab-->
                            <div class="tab-pane fade show active mt-2" id="image" role="tabpanel" aria-labelledby="image-tab">
                                <div class="row mb-3">
                                    <div class="col-md-8" style="height: 120px;">
                                        <img class="d-block h-100 w-100 img-thumbnail"
                                             src="https://picsum.photos/500/500/?random"
                                             alt="First slide">
                                    </div>
                                    <div class="col-md-4 align-self-md-center">
                                        <a href="#" class="btn btn-outline-danger">X Delete</a>
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


                                <div class="input-group mt-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" multiple>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-info">Update</button>
                                    </div>
                                </div>


                            </div>
                            <!-- /.Image tab-->

                            <!-- Video tab -->
                            <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="image-tab">
                                <h3>Video</h3>
                            </div>
                            <!-- Video tab -->
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection()