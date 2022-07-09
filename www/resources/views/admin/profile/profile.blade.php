@extends('admin.layouts.master')

@section('title') Profile @endsection
@section('css')
@endsection
@section('content')


    @component('components.breadcrumb',['li_1'=>['Dashboard'=>route('root')]])
        @slot('title') Profile  @endslot
    @endcomponent


    <!-- start row -->
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="profile-widgets py-3">
                        <div class="text-center">
                            <div class="">
                                <img
                                    src="{{!empty(auth()->user()->profile)?asset('storage'.DIRECTORY_SEPARATOR."profile".DIRECTORY_SEPARATOR.auth()->user()->id.DIRECTORY_SEPARATOR.auth()->user()->profile):asset('assets/images\users\avatar-2.png')}}"
                                    alt=""
                                    class="avatar-lg mx-auto img-thumbnail rounded-circle">
                            </div>

                            <div class="mt-3 ">
                                <a href="#"
                                   class="text-dark font-weight-medium font-size-16">{{auth()->user()->name}}</a>
                                <p class="text-body mt-1 mb-1">{{auth()->user()->email}}</p>
                                <p class="text-body mt-1 mb-1">{{auth()->user()->getRoleNames()->first()}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-6">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <ul class="nav nav-tabs nav-tabs-custom card-header-tabs ms-auto" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#profileinfo" role="tab">
                                Profile info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changepassword" role="tab">
                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="profileinfo" role="tabpanel">
                                {!! Form::open(array('url' => route('profiles.update',auth()->user()->id),'method'=>'PATCH','id'=>'user-form','enctype'=>'multipart/form-data')) !!}
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('Profile')}}
                                            {!! Form::file('profile',['class'=>'form-control']) !!}
                                            @error('profile')
                                            <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                         </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('Name')}}<span class="required">*</span>
                                            {!! Form::text('name',isset(auth()->user()->name)?auth()->user()->name:old('name'),['class'=>'form-control','placeholder'=>'Name']) !!}
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                     </span>
                                            @enderror
                                        </div>
                                    </div>
{{--                                    <div class="col-xs-6 col-sm-6 col-md-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            {{ Form::label('Email')}}<span class="required">*</span>--}}
{{--                                            {!! Form::email('email',isset(auth()->user()->email)?auth()->user()->email:old('email'),['class'=>'form-control','placeholder'=>'Email']) !!}--}}
{{--                                            @error('email')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                                                                <strong>{{ $message }}</strong>--}}
{{--                                                                                             </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                        {{Form::submit('Update',['class'=>'btn btn-primary waves-effect waves-light'])}}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane" id="changepassword" role="tabpanel">

                                {!! Form::open(array('url' => route('change.password'),'method'=>'POST','id'=>'chagepassword-form','enctype'=>'multipart/form-data')) !!}
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('Current password')}}<span class="required">*</span>
                                            {!! Form::password('current_password',['class'=>'form-control','placeholder'=>'Current password']) !!}
                                            @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                             </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('Password')}}<span class="required">*</span>
                                            {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password']) !!}
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                             </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('Confirm Password')}}<span class="required">*</span>
                                            {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Confirm password']) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                        {{Form::submit('Change Password',['class'=>'btn btn-primary waves-effect waves-light'])}}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                </div>
            </div>
        </div>
    </div>


    </div>

    <!-- end row -->
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ChangePasswordRequest','#chagepassword-form'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\UserProfileRequest','#user-form'); !!}


@endsection
