@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Permission</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('permissions.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $permission->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles Associated with this Permission:</strong>
            @if(!empty($permissionRoles))
                @foreach($permissionRoles as $role)
                    <label class="label label-success">{{ $role->name }},</label>
                @endforeach
            @else
                <p>No roles associated with this permission.</p>
            @endif
        </div>
    </div>
</div>
@endsection
