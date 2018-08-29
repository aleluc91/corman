
<div class="card mb-3 shadow">
    <div class="card-body p-2">
        <p class="text-primary">{{$publication['type']}}</p>
        <div class="publication-card-link">
            <h4>
                <a href="{{ route('publications.show' , ['id' => $publication->id]) }}">{{$publication['title']}}</a>
            </h4>
        </div>
        @if($publication['type'] === "Journal Articles")
            <p class="text-secondary">
                <span>{{$publication['venue']}}</span>
                @if(!empty($publication['volume']))
                    <span class="ml-1">{{$publication['volume']}}</span>
                @endif
                @if(!empty($publication['number']))
                    <span class="ml-1">({{$publication['number']}})</span>
                @endif
                @if(!empty($publication['pages']))
                    <span class="ml-1"> : {{$publication['pages']}}</span>
                @endif
                <span class="ml-1">({{$publication['year']}})</span>
            </p>
        @elseif($publication['type'] === "Conference and Workshop Papers")
            <p class="text-secondary">
                <span>{{$publication['venue']}}</span>
                <span class="ml-1">{{$publication['year']}}</span>
                @if(!empty($publication['volume']))
                    <span class="ml-1">{{$publication['volume']}}</span>
                @endif
                @if(!empty($publication['number']))
                    <span class="ml-1">({{$publication['number']}})</span>
                @endif
                @if(!empty($publication['pages']))
                    <span class="ml-1"> : {{$publication['pages']}}</span>
                @endif
            </p>
        @endif

        <h6>Descritpion :</h6>
        <p class="text-secondary text-truncate">
            @if(!empty($publication['description']))
                {{$publication['description']}}
            @else
                No description founded for this publication.
            @endif
        </p>

        <h6>Link to publication :</h6>
        <p>
            @if(!empty($publication['ee']))
                <a href="{{$publication['ee']}}">{{$publication['ee']}}</a>
            @else
                This publication has no external link.
            @endif
        </p>

        <h6>Topics :</h6>
        <div>
            @if($topics->isNotEmpty())
                @foreach($topics as $topic)
                    <h4 class="d-inline"><span class="badge badge-info">{{$topic->name}}</span></h4>
                @endforeach
            @else
                <p>This publication has no topic</p>
            @endif
        </div>


    </div>
    <div class="card-footer bg-white p-2">
        <p><span class="text-primary">Authors:</span><br/>
            @if(!empty($authors))
                @for($i = 0 ; $i <= count($authors['authors']) - 1 ; $i++)
                    @if($authors['active'][$i] === true)
                        <a href="{{ route('authors.show' , array('id' => $authors['authors'][$i]->id )) }}">{{$authors['authors'][$i]->name}}</a>
                    @else
                        <span class="">{{$authors['authors'][$i]->name}}</span>
                    @endif
                @endfor
            @endif
        </p>
    </div>
</div>