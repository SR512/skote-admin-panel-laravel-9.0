@extends('admin.layouts.master')

@section('title') User list @endsection
@section('css')


@endsection
@section('content')

    @component('components.breadcrumb',['li_1'=>['Dashboard'=>route('root')]])
        @slot('title') User list  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        @can('usermanagements.create')
                        <a href="{{route('usermanagements.create')}}" class="btn btn-primary"><i
                                class="mdi mdi-account-plus"></i>&nbsp;Add User</a>
                        @endcan
                    </div>
                    <div class="float-start">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <table id="user-data " class="table table-striped table-bordered dt-responsive mt-2"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key => $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->getRoleNames()->first()  }}</td>
                                <td>{{ $row->created_at_formatted }}</td>
                                <td>
                                    @can('usermanagements.edit')
                                        <a class="btn btn-sm btn-primary"
                                           href="{{route('usermanagements.edit',$row->id)}}"><i
                                                class="mdi mdi-pencil"></i>&nbsp;Edit</a>
                                    @endcan
                                    @can('usermanagements.destroy')
                                            <a class="btn btn-sm {{ $row->is_active == 'Y' ? 'btn-danger':'btn-success'}}"
                                               href="{{ route('usermanagements.status',$row->id) }}"><i
                                                    class="mdi {{ $row->is_active == 'Y' ? 'mdi-block-helper':'mdi-eye'}}"></i>&nbsp;{{ $row->is_active == 'Y' ? 'Inactive':'Active'}}
                                            </a>
                                        <a href="#" class="edit btn btn-danger btn-sm"
                                           onclick="if(confirm('Are you sure you want to delete.')) document.getElementById('delete-{{ $row->id }}').submit()">
                                            <i class="fa fa-trash">&nbsp;Delete</i></a>
                                        <form id="delete-{{ $row->id }}"
                                              action="{{ route('usermanagements.destroy', $row->id) }}"
                                              method="POST">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->appends($_GET)->links()}}
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.show_confirm').click(function (e) {
            if (!confirm('Are you sure you want to delete this?')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
