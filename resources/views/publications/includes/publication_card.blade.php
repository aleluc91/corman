
<div class="card mb-3 shadow">
    <div class="card-body p-2">
        <div class="row">
            <div class="col-md-10">
                <p class="text-primary">{{$publication['type']}}</p>
            </div>
            <div class="col-md-2">
                <p class="text-right"><a href="#"><i class="fas fa-edit"></i></a></p>
            </div>
        </div>

        <h4>{{$publication['title']}}</h4>
        <p class="text-secondary">{{$publication['venue']}}</p>
        <p class="text-secondary">Descrizione</p>
    </div>
</div>