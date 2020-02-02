<div class="card mb-3">
    <div class="card-header">{{ __('user.filter.header') }}</div>

    <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-3">
                    <label for="author">{{ __('user.field.author') }}</label>
                    <input id="author" name="author" class="form-control" value="{{ request('author') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success">
                Search
            </button>

            <a href="{{ route('client.home') }}" class="btn btn-outline-primary">
                Reset
            </a>

    </div>
</div>
