<div class="card w-100 mb-3">
    <div class="card-body">
        <div class="form-group">
            <label class="text-dark" for="topic">Add co-authors</label>
            <select class="{{ $errors->has('authors[]') ? 'is-invalid' : '' }}" name="authors[]" id="authors" multiple>
                @if ($errors->has('authors[]'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('authors[]') }}</strong>
                    </span>
                @endif
            </select>
        </div>
    </div>
</div>



