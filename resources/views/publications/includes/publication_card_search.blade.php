<li class="list-group-item">
    <div class="row">
        <div class="col-12">
            <p class="text-dark">{{$publication->type}}</p>
        </div>
        <div class="col-12">
            <div>
                <h5>
                    <a class="text-primary" style="text-transform: uppercase;" href="{{ route('publications.show' , ['id' => $publication->id]) }}">{{$publication->title}}</a>
                </h5>
            </div>
        </div>
        <div class="col-12">
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
    </div>
</li>


