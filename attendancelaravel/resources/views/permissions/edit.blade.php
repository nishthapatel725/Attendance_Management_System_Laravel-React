@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Permission</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('permissions.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('permissions.update', $permission->id) }}">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission Name:</strong>
                <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $permission->name }}">
            </div>
        </div>

        {{-- If permission-related roles or settings are needed, uncomment the section below --}}
        {{-- 
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Assign Roles:</strong>
                <br/>
                @foreach($roles as $role)
                    <label><input type="checkbox" name="roles[{{$role->id}}]" value="{{$role->id}}" {{ in_array($role->id, $permissionRoles) ? 'checked' : ''}}>
                    {{ $role->name }}</label>
                <br/>
                @endforeach
            </div>
        </div>
        --}}

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form>

<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>

@endsection
