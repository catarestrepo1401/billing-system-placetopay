<div class="form-group">
    {{ Form::label('name', 'Role name') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>
<div class="form-group">
    {{ Form::label('slug', 'Permission name') }}
    {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
</div>
<br>
<h3>Special permission</h3>
<div class="form-group">
    <label>{{ Form::radio('special', 'all-access') }} All-access</label>
    <label>{{ Form::radio('special', 'no-access') }} No-access</label>
</div>
<br>
<div class="form-group">
    <h3>Permissions list</h3>
    <ul class="list-unstyled">
        @foreach($permissions as $permission)
            <li>
                <label>
                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                    {{ $permission->name }}
                </label>
            </li>
        @endforeach
    </ul>
</div>
