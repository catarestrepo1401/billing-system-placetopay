<div id="field_{{ $id }}" class="form-group">
    {!! $input !!}
    @foreach ($errors as $error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endforeach
</div>
