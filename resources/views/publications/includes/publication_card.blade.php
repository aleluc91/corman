<div class="card mb-3 shadow">
    <div class="card-header">
            <p class="text-dark">{{$publication->type}}</p>
            <div>
                <h4>
                    <a class="text-primary" style="text-transform: uppercase;" href="{{ route('publications.show' , ['id' => $publication->id]) }}">{{$publication->title}}</a>
                </h4>
            </div>

            @if($publication->type === "Journal Articles")
            <p class="text-secondary">
                <span>{{$publication->venue}}</span>
                @if(!empty($publication->volume))
                    <span class="ml-1">{{$publication->volume}}</span>
                @endif
                @if(!empty($publication->number))
                    <span class="ml-1">({{$publication->number}})</span>
                @endif
                @if(!empty($publication->pages))
                    <span class="ml-1"> : {{$publication->pages}}</span>
                @endif
                <span class="ml-1">({{$publication->year}})</span>
            </p>

        @elseif($publication->type === "Conference and Workshop Papers")
            <p class="text-secondary">
                <span>{{$publication->venue}}</span>
                <span class="ml-1">{{$publication->year}}</span>
                {{--@if(!empty($publication->volume))
                    <span class="ml-1">{{$publication->volume}}</span>
                @endif
                @if(!empty($publication->number))
                    <span class="ml-1">({{$publication->number}})</span>
                @endif--}}
                @if(!empty($publication->pages))
                    <span class="ml-1"> : {{$publication->pages}}</span>
                @endif
            </p>

        @elseif($publication->type === "Editorship")
            <p class="text-secondary">
                <span>{{$publication->venue}}</span>
                @if(!empty($publication->volume))
                    <span class="ml-1">{{$publication->volume}}</span>
                @endif
                @if(!empty($publication->publisher))
                    <span class="ml-1">({{$publication->publisher}})</span>
                @endif
                <span class="ml-1">{{$publication->year}}</span>
            </p>

        @elseif($publication->type === "Parts in Books or Collections")
            <p class="text-secondary">
                <span>{{$publication->venue}}</span>
                <span class="ml-1">{{$publication->year}}</span>
                @if(!empty($publication->pages))
                    <span class="ml-1">{{$publication->pages}}</span>
                @endif
            </p>

        @elseif($publication->type === "Informal Publication")
            <p class="text-secondary">
                <span>{{$publication->venue}}</span>
                @if(!empty($publication->volume))
                    <span class="ml-1">{{$publication->volume}}</span>
                @endif
                <span class="ml-1">{{$publication->year}}</span>
            </p>

        @elseif($publication->type === "Books and Theses")
            <p>
            @if(!empty($publication->venue))
                <span>{{$publication->venue}}</span>
                @if(!empty($publication->volume))
                    <span class="ml-1">{{$publication->volume}}</span>
                @endif
                @if(!empty($publication->publisher))
                    <span class="ml-1">{{$publication->publisher}}</span>
                @endif
                <span class="ml-1">{{$publication->year}}</span>
            </p>
            @else
            <p class="text-secondary">
                <span class="ml-1">{{$publication->year}}</span>
            </p>
            @endif
        @endif

    </div>
    <div class="card-body ">

        <h6 class="text-dark">Descritpion :</h6>
        <p class="text-muted ">
            @if(!empty($publication->description))
                {{$publication->description}}
            @else
                No description founded for this publication.
            @endif
        </p>

        <h6 class="text-dark">Link :
            @if(!empty($publication->ee))
                <a class="text-info" href="{{$publication->ee}}">{{$publication->ee}}</a>
            @else
                <span class="text-muted">This publication has no external link.</span>
            @endif
        </h6>

        <h6 class="text-dark">Topics :</h6>
        <div>
            @if($topics->isNotEmpty())
                @foreach($topics as $topic)
                    <h5 class="d-inline"><span class="badge badge-info">{{$topic->name}}</span></h5>
                @endforeach
            @else
                <p class="text-muted">This publication has no topic</p>
            @endif
        </div>


    </div>
    <div class="card-footer ">
        <h6 class="text-dark">Co-authors:</h6>

        @if(!empty($authors))
            <ul class="list-inline">
                @for($i = 0 ; $i <= count($authors['authors']) - 1 ; $i++)
                    @if($authors['authors'][$i]->dblp_url !== Auth::user()->dblp_url)
                        <li class="list-inline-item">
                            @if($authors['active'][$i] === true)
                                <a class="text-primary"
                                   href="{{ route('authors.show' , array('id' => $authors['authors'][$i]->id )) }}">
                                    <i class="far fa-user mr-2 text-dark"></i>
                                    {{$authors['authors'][$i]->name}}
                                </a>
                            @else
                                <i class="far fa-user mr-2 text-muted"></i>
                                <span class="text-muted">{{$authors['authors'][$i]->name}}</span>
                            @endif
                        </li>
                    @endif
                @endfor
            </ul>
        @endif

    </div>
</div>