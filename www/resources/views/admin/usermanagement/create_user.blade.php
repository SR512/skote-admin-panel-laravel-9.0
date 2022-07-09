@extends('admin.layouts.master')

@section('title'){{!isset($user) ? 'Add User':'Edit User'}}@endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('content')

    @component('components.breadcrumb',['li_1'=>['Dashboard'=>route('root'),'User list' => route('usermanagement.index')]])
        @slot('title') {{!isset($user) ? 'Add User':'Edit User'}}  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <a href="{{route('usermanagement.index')}}" class="btn btn-primary"><i
                                class="mdi mdi-account-plus"></i> Back to list</a>
                    </div>
                    <div class="float-start">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    @if(!isset($user))
                        {!! Form::open(['url' => route('usermanagements.store'),'id' =>'user-form','method' => 'post']) !!}
                        @csrf
                    @else
                        {!! Form::open(['url' => route('usermanagements.update',$user->id),'id' =>'user-form','method' => 'PATCH']) !!}
                    @endif
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    {!!  Form::label('name', 'Name',['style' =>'justify-content: right']); !!}<span
                                        class="required">*</span>
                                    {!! Form::text('name',isset($user) ? $user->name:old('name'),['class' => 'form-control','id' =>'name'])!!}
                                    @error('name')
                                    <span style="color:red">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    {!!  Form::label('email', 'email',['style' =>'justify-content: right']); !!}<span
                                        class="required">*</span>
                                    {!! Form::text('email',isset($user) ? $user->email:old('email'),['class' => 'form-control','id' =>'email'])!!}
                                    @error('email')
                                    <span style="color:red">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    {!!  Form::label('role', 'Role',['style' =>'justify-content: right']); !!}<span
                                        class="required">*</span>
                                    {!! Form::select('role',$roles,isset($user) ? $user->roles()->first()->id:old('role'),['class'=>'form-control','id'=>'role','style'=>'width: 100%','placeholder'=>'Select role']) !!}
                                    @error('role')
                                    <span style="color:red">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::button(!isset($user) ? 'Add User':'Edit User',['class'=>'btn btn-primary btnSubmit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#user-form'); !!}
    <script type="text/javascript">


        $(".btnSubmit").on('click', function (e) {

            $("#user-form").submit();

            if ($("#user-form").valid()) {
                $('#status').show();
                $('#preloader').show();
                $(".btnSubmit").prop('disabled', true);
            }
        });

    </script>
@endsection
