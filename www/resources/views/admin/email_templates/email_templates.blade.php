@extends('admin.layouts.master')

@section('title') Email template @endsection
@section('content')

    @component('components.breadcrumb',['li_1'=>['Dashboard'=>route('root')]])
        @slot('title') Email template  @endslot
    @endcomponent



    <div class="row">
        <div class="col-12">
            <!-- Left sidebar -->
            <div class="email-leftbar card">

                <div class="mail-list mt-2">
                    @if(!empty($emailtemplates))
                        @foreach($emailtemplates as $row)
                            <a href="{{route('emailtemplate.index')}}?id={{$row->id}}"
                               class="{{$emailtemplate->template_name == $row->template_name ?'active':''}}"><i
                                    class="mdi mdi-email-outline"></i>&nbsp;{{$row->template_name}}</a>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- End Left sidebar -->

            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @can('emailtemplates.create')
                                {!! Form::open(array('url' => route('emailtemplates.store'),'method'=>'POST','id'=>'email-template-form','class'=>'col-md-12','enctype'=>'multipart/form-data')) !!}
                                <input type="hidden" name="id" value="{{$emailtemplate->id}}">
                                <input type="hidden" name="template_code" value="{{$emailtemplate->template_code}}">
                                <input type="hidden" name="mailable" value="{{$emailtemplate->mailable}}">
                                <input type="hidden" name="template_type" value="{{$emailtemplate->template_type}}">
                            @endcan
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        {{ Form::label('Template name')}}<span class="required">*</span>
                                        {!! Form::text('template_name',$emailtemplate->template_name,['class'=>'form-control','placeholder'=>'Template name']) !!}
                                        @error('template_name')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                             </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="mb-3">
                                <div class="form-group">
                                    {{ Form::label('Subject')}}<span class="required">*</span>
                                    {!! Form::text('subject',$emailtemplate->subject,['class'=>'form-control','placeholder'=>'Subject']) !!}
                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                             </span>
                                    @enderror
                                </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="mb-3">
                                <div class="form-group">
                                    {{ Form::label('Content')}}<span class="required">*</span>
                                    {!! Form::textarea('email_template_content',$emailtemplate->html_template,['class'=>'form-control','placeholder'=>'Content' ]) !!}
                                    @error('email_template_content')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                </div>
                            </div>
                            @can('emailtemplates.create')
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                    {{Form::button('Save',['class'=>'btn btn-primary btnSubmit waves-effect waves-light'])}}
                                </div>
                            @endcan
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- End row -->
@endsection

@section('script')
    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
    <script>
        //CK Editor
        CKEDITOR.replace('email_template_content', {
            extraPlugins: 'colorbutton,colordialog,font'
        });
    </script>
    <script type="text/javascript" src="{{ asset('assets/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\EmailTemplateRequest', '#email-template-form'); !!}
    <script type="text/javascript">
        $(".btnSubmit").on('click', function (e) {

            $("#email-template-form").submit();

            if ($("#email-template-form").valid()) {
                $('#status').show();
                $('#preloader').show();
                $(".btnSubmit").prop('disabled', true);
            }
        });
    </script>
@endsection
