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
                <select class="custom-select" name="type" id="type" disabled>
                    <option>Journal articles</option>
                    <option>Workshop and conference paper</option>
                    <option>Book and thesis</option>
                </select>
            </div>
            <div class="form-group">
                <label class="text-info" for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{$publication->title}}"
                       disabled>
            </div>
            <div class="form-group">
                <label class="text-info" for="venue">Venue</label>
                <input type="text" class="form-control" id="venue" name="venue" value="{{$publication->venue}}"
                       disabled>
                <span class="text-muted">Separate venue with a ,</span>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label class="text-info" for="volume">Volume</label>
                    <input type="text" class="form-control" id="volume" name="volume" value="{{$publication->volume}}"
                           disabled>
                </div>
                <div class="col-md-3 form-group">
                    <label class="text-info" for="number">Number</label>
                    <input type="text" class="form-control" id="number" name="number" value="{{$publication->number}}"
                           disabled>
                </div>
                <div class="col-md-3 form-group">
                    <label class="text-info" for="pages">Pages</label>
                    <input type="text" class="form-control" id="pages" name="pages" value="{{$publication->pages}}"
                           disabled>
                </div>
                <div class="col-md-3 form-group">
                    <label class="text-info" for="year">Year</label>
                    <input type="text" class="form-control" id="year" name="year" value="{{$publication->year}}"
                           disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="text-info" for="publisher">Publisher</label>
                <input type="text" class="form-control" id="publisher" name="publisher"
                       value="{{$publication->publisher}}" disabled>
            </div>
            <div class="form-group">
                <label class="text-info" for="topic">Topic</label>
                <select name="topics[]" id="topics" multiple>
                    @foreach($allTopics as $topic)
                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="text-info" for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30"
                          rows="5">{{ $publication->description }}</textarea>
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
                            <form action="{{ route('multimedias.destroy' , ['id' => $multimedia->id]) }}" method="POST">
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
                                           target="_blank">{{ $ultimedias->name }}</a>
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
            url: "http://localhost/corman/public/topics/" + $('#publicationId').val() + "/get",
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
                console.log("Topic val" + $('#topics').val());
            },
            error: function (err) {
                console.log(err);
            }
        });

        $('#presentationShow').on('click', function () {
            $('.presentationHide').toggle('slow');
        })

    })
</script>
@endpush