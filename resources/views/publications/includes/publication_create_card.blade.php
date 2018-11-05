

<div class="row">
    <div class="col-12 col-sm-12 col-md-8 col-lg-8">

    </div>
    <div class="col-12 col-sm-12 col-md-4 col-lg-4">

    </div>
</div>

<div class="card shadow">
    <div class="card-body">

            <div class="form-group">
                <label class="text-dark" for="type">Type of publication</label>
                <select class="custom-select {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option selected>Journal Articles</option>
                    <option>Conference and Workshop Papers</option>
                    <option>Editorship</option>
                    <option>Parts in Books or Collections</option>
                    <option>Informal Publication</option>
                    <option>Book and thesis</option>
                </select>
                @if ($errors->has('type'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="text-dark" for="title">Title</label>
                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title"
                       >
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="text-dark" for="venue">Venue</label>
                <input type="text" class="form-control {{ $errors->has('venue') ? 'is-invalid' : '' }}" id="venue" name="venue">
                @if ($errors->has('venue'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('venue') }}</strong>
                    </span>
                @endif
                <span class="text-muted">Separate venue with a " , " if you want to add more than one.</span>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label class="text-dark" for="volume">Volume</label>
                    <input type="text" class="form-control {{ $errors->has('volume') ? 'is-invalid' : '' }}" id="volume" name="volume">
                    @if ($errors->has('volume'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('volume') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-3 form-group">
                    <label class="text-dark" for="number">Number</label>
                    <input type="text" class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" id="number" name="number">
                    @if ($errors->has('number'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('number') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-3 form-group">
                    <label class="text-dark" for="pages">Pages</label>
                    <input type="text" class="form-control {{ $errors->has('pages') ? 'is-invalid' : '' }}" id="pages" name="pages">
                    @if ($errors->has('pages'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('pages') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-3 form-group">
                    <label class="text-dark" for="year">Year</label>
                    <input type="text" class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" id="year" name="year">
                    @if ($errors->has('year'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('year') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="text-dark" for="publisher">Publisher</label>
                <input type="text" class="form-control {{ $errors->has('publisher') ? 'is-invalid' : '' }}" id="publisher" name="publisher">
                @if ($errors->has('publisher'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('publisher') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="text-dark" for="topic">Topic</label>
                <select class="{{ $errors->has('topics[]') ? 'is-invalid' : '' }}" name="topics[]" id="topics" multiple>
                    @foreach($allTopics as $topic)
                        <option value="{{ $topic->name }}">{{ $topic->name }}</option>
                    @endforeach
                        @if ($errors->has('topics[]'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('topics[]') }}</strong>
                    </span>
                        @endif
                </select>
            </div>
            <div class="form-group">
                <label class="text-dark" for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" cols="30"
                          rows="5"></textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="text-dark" for="publisher">Link to publication</label>
                <input type="text" class="form-control {{ $errors->has('ee') ? 'is-invalid' : '' }}" id="ee" name="ee">
                @if ($errors->has('ee'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ee') }}</strong>
                    </span>
                @endif
            </div>

    </div>
</div>

