
<div class="card shadow">
    <div class="card-header bg-white">
        <h3>Authors List</h3>
    </div>
    <div class="card-body">
        @for($i = 0 ; $i <= $authorsCount - 1 ; $i++)
            <div class="row mb-4">
                <div class="col-md-4 authors-card-image">
                    <img src="{{ asset('storage/'. $images[$i]) }}"/>
                </div>
                <div class="col-md-8">
                    {{$authors[$i]->name}}
                </div>
            </div>
        @endfor
    </div>
</div>