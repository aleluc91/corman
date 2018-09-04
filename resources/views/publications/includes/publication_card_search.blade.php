<div class="card mb-3 shadow">
    <div class="card-body p-2">
        <p class="text-info">{{$publication->type}}</p>
        <div class="publication-card-link">
            <h4>
                <a href="{{ route('publications.show' , ['id' => $publication->id]) }}">{{$publication->title}}</a>
            </h4>
        </div>
        @if($publication->type === "Journal Articles")
            <p class="text-secondary">
                <span>{{$publication->venue}}</span>
                @if(!empty($publication->volume))
                    <span class="ml-1">{{$publication->volume}}</span>
                @endif
                @if(!empty($publication['number']))
                    <span class="ml-1">({{$publication->number}})</span>
                @endif
                @if(!empty($publication['pages']))
                    <span class="ml-1"> : {{$publication->pages}}</span>
                @endif
                <span class="ml-1">({{$publication->year}})</span>
            </p>
        @elseif($publication->type === "Conference and Workshop Papers")
            <p class="text-secondary">
                <span>{{$publication['venue']}}</span>
                <span class="ml-1">{{$publication->year}}</span>
                @if(!empty($publication['volume']))
                    <span class="ml-1">{{$publication->volume}}</span>
                @endif
                @if(!empty($publication['number']))
                    <span class="ml-1">({{$publication->number}})</span>
                @endif
                @if(!empty($publication['pages']))
                    <span class="ml-1"> : {{$publication->pages}}</span>
                @endif
            </p>
        @endif

        <h6 class="text-info">Topics :</h6>
        <div>
            @if($topics->isNotEmpty())
                @foreach($topics as $topic)
                    <h5 class="d-inline"><span class="badge badge-info">{{$topic->name}}</span></h5>
                @endforeach
            @else
                <p>This publication has no topic</p>
            @endif
        </div>

    </div>

</div>