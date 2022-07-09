<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">{{$title}}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if(isset($li_1))
                        @foreach($li_1 as $key => $list)
                            <li class="breadcrumb-item">
                                <a href="{{$list}}">
                                    {{ $key }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                    @if(isset($title))
                        <li class="breadcrumb-item active">{{$title}}</li>
                    @else
                        <li class="breadcrumb-item active">{{$title}}</li>
                    @endif
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
