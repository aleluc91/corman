
<div class="card mb-3 shadow">
    <div class="card-body p-2">
        <p class="text-primary">{{$publication['type']}}</p>

        <h4>{{$publication['title']}}</h4>

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

        <p class="text-secondary">
            @if(!empty($publication['description']))
                {{$publication['description']}}
            @else
                No description founded for this publication
            @endif
        </p>
        @if(!empty($tags))
            <p>Tag : </p>
            <p>
                @foreach($tags as $tag)
                    <h5 class="d-inline-block mr-2"><span class="badge badge-info">{{$tag->tag}}</span></h5>
                @endforeach
            </p>
        @endif
    </div>
</div>