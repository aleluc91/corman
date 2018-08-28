
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

        <p class="text-secondary text-truncate">
            @if(!empty($publication['description']))
                {{$publication['description']}}
            @else
                No description founded for this publication
            @endif
        </p>
        @if(!empty($topics))
        <div>
            @foreach($topics as $topic)
                <h4 class="d-inline"><span class="badge badge-info">{{$topic->name}}</span></h4>
            @endforeach
        </div>
        @endif
    </div>
    <div class="card-footer bg-white p-2">
        <p><span class="text-primary">Authors:</span><br/>
            @for($i = 0 ; $i <= count($authors['authors']) - 1 ; $i++)
                @if($authors['active'][$i] === true)
                    <a href="#">{{$authors['authors'][$i]->name}}</a>
                @else
                    <span class="">{{$authors['authors'][$i]->name}}</span>
                @endif
            @endfor
        </p>
    </div>
</div>