@extends('admin.layouts.master')

@section('title') Role @endsection
@section('css')

@endsection
@section('content')

    @component('components.breadcrumb',['li_1'=>['Dashboard'=>route('root')]])
        @slot('title') Role  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        @can('roles.create')
                        <a href="{{route('roles.create')}}" class="btn btn-primary"><i
                                class="mdi mdi-plus"></i> New Role</a>
                        @endcan
                    </div>
                    <div class="clearfix"></div>
                    <table id="role-data " class="table table-striped table-bordered dt-responsive mt-3"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $key => $row)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->created_at_formatted }}</td>
                                <td>
                                    {{--<a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>--}}
                                    @can('roles.edit')
                                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$row->id) }}"><i class="mdi mdi-pencil"></i>&nbsp;Edit</a>
                                    @endcan
                                    @can('roles.destroy')
                                        <a class="btn btn-sm {{ $row->is_active == 'Y' ? 'btn-danger':'btn-success'}}"
                                           href="{{ route('role.status',$row->id) }}"><i
                                                class="mdi {{ $row->is_active == 'Y' ? 'mdi-block-helper':'mdi-eye'}}"></i>&nbsp;{{ $row->is_active == 'Y' ? 'Inactive':'Active'}}
                                        </a>
                                        <a href="#" class="edit btn btn-sm btn-danger"
                                       onclick="if(confirm('Are you sure you want to delete.')) document.getElementById('delete-{{ $row->id }}').submit()">
                                        <i class="fa fa-trash">&nbsp;Delete</i>
                                        <form id="delete-{{ $row->id }}" action="{{ route('roles.destroy', $row->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
@section('script')


@endsection
