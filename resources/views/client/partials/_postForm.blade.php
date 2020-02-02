
            <div class="row form-group title">
                <label class="title__label col-md-4 col-form-label text-md-right" for="title">
                    {{ __('user.field.title') }}<sup class="text-danger">*</sup>
                </label>
                <div class="col-md-6 title__div">
                    <input autocomplete="off" class="title__input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           id="title" name="title" value="{{ old('title', $post->title) }}" required>
                </div>
                @if ($errors->has('title'))
                    <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
                @endif
            </div>
            <div class="row form-group PostBody">
                <label class="PostBody__label col-md-4 col-form-label text-md-right" for="PostBody">
                    {{ __('user.field.body') }}<sup class="text-danger">*</sup>
                </label>
                @if ($errors->has('PostBody'))
                    <span class="invalid-feedback">
                <strong>{{ $errors->first('PostBody') }}</strong>
            </span>
                @endif
            </div>
            <textarea id="PostBody" name="PostBody" required {{ $errors->has('PostBody') ? ' is-invalid' : '' }}>{{ old('PostBody', $post->body) }}</textarea>

            <div class="submit form-group row mb-0 submitBtn">
                <div class="submitBtn__div col-md-6 offset-md-4">
                    <button type="submit" class="submitBtn__button btn btn-outline-success">
                     {{$buttonTitle}}
                    </button>
                </div>
            </div>

