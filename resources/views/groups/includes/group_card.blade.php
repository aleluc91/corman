<ul class="list-group">
    @foreach($groups as $group)
        <li class="list-group-item">
            <div class="row">
                <div class="col-8">
                    {{ $group->name }}
                </div>
                <div class="col-4">
                    <a href="{{ route('groups.show' , ['id' => $group->id]) }}" class="btn btn-info">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{--
<div class="card bg-white my-2">
    <div class="card bg-white">
        @if(!empty($group->image_url))
            <div class="card-header bg-white p-0">
                <img class="card-img-top" src="{{ asset('storage/' . $group->image_url) }}" alt="">
            </div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h5>{{ $group->name }}</h5>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <a href="{{ route('groups.show' , ['id' => $group->id]) }}" class="btn btn-info">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>--}}
