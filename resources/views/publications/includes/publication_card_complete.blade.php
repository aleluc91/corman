
<div class="card">
    <div class="card-body">
        <p class="text-primary">{{$publication['type']}}</p>
        <div class="publication-card-link">
            <h4>
                <a href="{{ route('publications.show' , ['id' => $publication->id]) }}">{{$publication['title']}}</a>
            </h4>
        </div>

        <p class="text-secondary">{{$publication['venue']}}</p>
        <p class="text-secondary">Descrizione</p>
    </div>
</div>