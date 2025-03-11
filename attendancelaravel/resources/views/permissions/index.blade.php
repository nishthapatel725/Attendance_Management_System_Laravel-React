@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Permission Management</h2>
        </div>
        <div class="pull-right">
        @can('permission-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('permissions.create') }}"><i class="fa fa-plus"></i> Create New Permission</a>
        @endcan
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <tr>
       <th width="100px">No</th>
       <th>Name</th>
       <th width="280px">Action</th>
    </tr>
    @php $i = 0; @endphp
    @foreach ($permissions as $permission)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $permission->name }}</td>
        <td>
            <a class="btn btn-info btn-sm" href="{{ route('permissions.show', $permission->id) }}"><i class="fa fa-list"></i> Show</a>
            @can('permission-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('permissions.edit', $permission->id) }}"><i class="fa fa-pen-to-square"></i> Edit</a>
            @endcan

            @can('permission-delete')
            <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
            </form>
            @endcan
        </td>
    </tr>
    @endforeach
</table>

<!-- Pagination links -->
{!! $permissions->links('pagination::bootstrap-5') !!}

<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
