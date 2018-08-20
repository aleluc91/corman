
<div class="card mb-3 shadow">
    <div class="card-body p-2">
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