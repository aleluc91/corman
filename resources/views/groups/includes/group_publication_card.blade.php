<div class="card my-2 shadow">
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
                @if(!empty($publication->volume))
                    <span class="ml-1">{{$publication->volume}}</span>
                @endif
                @if(!empty($publication->number))
                    <span class="ml-1">({{$publication->number}})</span>
                @endif
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
            @if(!empty($publication->venue))
                <p>
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

        <h6 class="text-info">Descritpion :</h6>
        <p class="text-muted ">
            @if(!empty($publication->description))
                {{$publication->description}}
            @else
                No description founded for this publication.
            @endif
        </p>

        <h6 class="text-info">Link :
            @if(!empty($publication->ee))
                <a class="text-muted" href="{{$publication->ee}}">{{$publication->ee}}</a>
            @else
                <span class="text-muted">This publication has no external link.</span>
            @endif
        </h6>

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
    <div class="card-footer bg-white p-2">
        <h6 class="text-info">Co-authors:</h6>

        @if(!empty($authors))
            <ul class="list-inline">
                @for($i = 0 ; $i <= count($authors['authors']) - 1 ; $i++)
                    @if($authors['authors'][$i]->dblp_url !== Auth::user()->dblp_url)
                        <li class="list-inline-item">
                            @if($authors['active'][$i] === true)
                                <a class="text-info"
                                   href="{{ route('authors.show' , array('id' => $authors['authors'][$i]->id )) }}">
                                    <i class="far fa-user mr-2 text-danger"></i>
                                    {{$authors['authors'][$i]->name}}
                                </a>
                            @else
                                <i class="far fa-user mr-2 text-danger"></i>
                                <span class="text-muted">{{$authors['authors'][$i]->name}}</span>
                            @endif
                        </li>
                    @endif
                @endfor
            </ul>
        @endif
        @if(($role === 'super_administrator') or ($role === 'administrator'))
            <button class="btn btn-danger float-right" data-toggle="modal" data-target="#deletePublicationModal"><i
                        class="fa fa-trash-alt mr-2"></i>Delete
            </button>

            <div class="modal fade" id="deletePublicationModal" tabindex="-1" role="dialog"
                 aria-labelledby="deletePublicationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deletePublicationModalLabel">Delete publication?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-center">Are you sure you want to delete this publication?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Close
                            </button>
                            <form method="POST" action="{{ route('groups.users.destroy.publication' , ['groupId' => $group , 'publicationId' => $publication->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt mr-2"></i>Delete
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

