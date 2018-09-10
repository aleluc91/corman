@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.default.css')}}"/>
@endpush

<div class="card bg-white shadow">
    <div class="card-header bg-white">
        <h4 class="text-center">Publication info</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('publications.update' , ['id' => $publication->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <input id="publicationId" type="hidden" value="{{ $publication->id }}">
            <div class="form-group">
                <label class="text-info" for="type">Type of publication</label>
                <select class="custom-select {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type"
                        value="{{ $publication->type }}">
                    <option @if($publication->type === 'Journal Articles') selected @endif >Journal Articles</option>
                    <option @if($publication->type === 'Conference and Workshop Papers') selected @endif>Conference and
                        Workshop Papers
                    </option>
                    <option @if($publication->type === 'Editorship') selected @endif>Editorship</option>
                    <option @if($publication->type === 'Parts in Books or Collections') selected @endif>Parts in Books
                        or Collections
                    </option>
                    <option @if($publication->type === 'Informal Publication') selected @endif>Informal Publication
                    </option>
                    <option @if($publication->type === 'Book and thesis') selected @endif>Book and thesis</option>
                </select>
                @if ($errors->has('type'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="text-info" for="title">Title</label>
                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title"
                       name="title" value="{{$publication->title}}">
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="text-info" for="venue">Venue</label>
                <input type="text" class="form-control {{ $errors->has('venue') ? 'is-invalid' : '' }}" id="venue"
                       name="venue" value="{{$publication->venue}}">
                @if ($errors->has('venue'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('venue') }}</strong>
                    </span>
                @endif
                <span class="text-muted">Separate venue with a " , " if you want to add more than one.</span>

            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label class="text-info" for="volume">Volume</label>
                    <input type="text" class="form-control {{ $errors->has('volume') ? 'is-invalid' : '' }}" id="volume"
                           name="volume" value="{{$publication->volume}}">
                    @if ($errors->has('volume'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('volume') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-3 form-group">
                    <label class="text-info" for="number">Number</label>
                    <input type="text" class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" id="number"
                           name="number" value="{{$publication->number}}">
                    @if ($errors->has('number'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('number') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-3 form-group">
                    <label class="text-info" for="pages">Pages</label>
                    <input type="text" class="form-control {{ $errors->has('pages') ? 'is-invalid' : '' }}" id="pages"
                           name="pages" value="{{$publication->pages}}">
                    @if ($errors->has('pages'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('pages') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-3 form-group">
                    <label class="text-info" for="year">Year</label>
                    <input type="text" class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" id="year"
                           name="year" value="{{$publication->year}}">
                    @if ($errors->has('year'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('year') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="text-info" for="publisher">Publisher</label>
                <input type="text" class="form-control {{ $errors->has('publisher') ? 'is-invalid' : '' }}"
                       id="publisher" name="publisher"
                       value="{{$publication->publisher}}">
                @if ($errors->has('publisher'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('publisher') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="text-info" for="topic">Topic</label>
                <select class="{{ $errors->has('topics[]') ? 'is-invalid' : '' }}" name="topics[]" id="topics" multiple>
                    @foreach($allTopics as $topic)
                        <option value="{{ $topic->name }}">{{ $topic->name }}</option>
                    @endforeach
                    @if ($errors->has('topics[]'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('topics[]') }}</strong>
                    </span>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label class="text-info" for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" cols="30"
                          rows="5">{{ $publication->description }}</textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="text-info" for="publisher">Link to publication</label>
                <input type="text" class="form-control {{ $errors->has('ee') ? 'is-invalid' : '' }}" id="ee" name="ee" value="{{ $publication->ee }}">
                @if ($errors->has('ee'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ee') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-edit mr-2"></i>Update</button>

        </form>
        <div class="mt-5">
            <h6 class="text-info">Presentation file :</h6>
            @if(!empty($publicationPresentation))
                <ul class="list-unstyled">
                    @if(count($publicationPresentation)  < 5)
                        @foreach($publicationPresentation as $multimedia)
                            <li>
                                <form action="{{ route('multimedias.destroy' , ['id' => $multimedia->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="row">
                                        <div class="col-md-10 col-sm-8">
                                            @if($multimedia->type === 'pdf')
                                                <i class="far fa-file-pdf text-danger mr-2"></i>
                                            @elseif(($multimedia->type === 'doc') or ($multimedia->type === 'docx'))
                                                <i class="far fa-file-word text-danger mr-2"></i>
                                            @elseif(($multimedia->type === 'ppt') or ($multimedia->type === 'pptx'))
                                                <i class="far fa-file-powerpoint text-danger mr-2"></i>
                                            @endif
                                            <a class="" href="{{ asset('storage/' . $multimedia->url) }}"
                                               target="_blank">{{ $multimedia->name }}</a>
                                        </div>
                                        <div class="col-md-2 col-sm-4">
                                            <button type="submit" class="btn btn-link "><i
                                                        class="fas fa-trash-alt text-danger"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        @endforeach
                    @else
                        @for($i = 0 ; $i <= 4 ; $i++)
                            <li>
                                <form action="{{ route('multimedias.destroy' , ['id' => $publicationPresentation[$i]->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="row">
                                        <div class="col-md-10 col-sm-8">
                                            @if($publicationPresentation[$i]->type === 'pdf')
                                                <i class="far fa-file-pdf text-danger mr-2"></i>
                                            @elseif(($publicationPresentation[$i]->type === 'doc') or ($publicationPresentation[$i]->type === 'docx'))
                                                <i class="far fa-file-word text-danger mr-2"></i>
                                            @elseif(($publicationPresentation[$i]->type === 'ppt') or ($publicationPresentation[$i]->type === 'pptx'))
                                                <i class="far fa-file-powerpoint text-danger mr-2"></i>
                                            @endif
                                            <a class=""
                                               href="{{ asset('storage/' . $publicationPresentation[$i]->url) }}"
                                               target="_blank">{{ $publicationPresentation[$i]->name }}</a>
                                        </div>
                                        <div class="col-md-2 col-sm-4">
                                            <button type="submit" class="btn btn-link "><i
                                                        class="fas fa-trash-alt text-danger"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        @endfor
                        @for($i = 4 ; $i <= count($publicationPresentation) - 1 ; $i++)
                            <li class="presentationHide" style="display: none">
                                <form action="{{ route('multimedias.destroy' , ['id' => $publicationPresentation[$i]->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="row">
                                        <div class="col-md-10 col-sm-8">
                                            @if($publicationPresentation[$i]->type === 'pdf')
                                                <i class="far fa-file-pdf text-danger mr-2"></i>
                                            @elseif(($publicationPresentation[$i]->type === 'doc') or ($publicationPresentation[$i]->type === 'docx'))
                                                <i class="far fa-file-word text-danger mr-2"></i>
                                            @elseif(($publicationPresentation[$i]->type === 'ppt') or ($publicationPresentation[$i]->type === 'pptx'))
                                                <i class="far fa-file-powerpoint text-danger mr-2"></i>
                                            @endif
                                            <a class=""
                                               href="{{ asset('storage/' . $publicationPresentation[$i]->url) }}"
                                               target="_blank">{{ $publicationPresentation[$i]->name }}</a>
                                        </div>
                                        <div class="col-md-2 col-sm-4">
                                            <button type="submit" class="btn btn-link "><i
                                                        class="fas fa-trash-alt text-danger"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        @endfor
                        <li>
                            <button id="presentationShow" class="btn btn-link">
                                <i class="fas fa-plus text-info mr-2"></i><span class="text-info">More</span>
                            </button>
                        </li>
                    @endif
                </ul>
            @else
                <h6>The are no presentation file for this publication.</h6>
            @endif
        </div>
    </div>
</div>

@push('body.scripts')
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
                        optionId.push(option.topics[key].name);
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
                    console.log("Topic val" + $('#topics').val());
                },
                error: function (err) {
                    console.log(err);
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

            $('#presentationShow').on('click', function () {
                $('.presentationHide').toggle('slow');
            })

        })
    </script>
@endpush