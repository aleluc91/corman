<div class="card bg-white w-100 mb-3">
    <div class="card-header bg-white">
        <h4 class="text-center">Upload new files</h4>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="text-info" for="topic">Add co-authors</label>
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



