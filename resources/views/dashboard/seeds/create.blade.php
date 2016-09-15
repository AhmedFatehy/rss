@extends('dashboard.layouts.master')

@push('pageLevelCssPlugins')
<link href="{{{ asset('assets/global/plugins/bootstrap-summernote/summernote.css') }}}" rel="stylesheet"
      type="text/css"/>
{{--<link href="{{{ asset('assets/global/plugins/typeahead/typeahead.css') }}}" rel="stylesheet" type="text/css" />--}}
<link href="{{{ asset('assets/global/plugins/select2/css/select2.min.css') }}}" rel="stylesheet" type="text/css"/>
<link href="{{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}}" rel="stylesheet"
      type="text/css"/>
<link href="{{{ asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css') }}}" rel="stylesheet"
      type="text/css"/>
@endpush


@push('pageLevelJsPlugins')
<script src="{{{ asset('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}}"
        type="text/javascript"></script>
<script src="{{{ asset('assets/global/plugins/bootstrap-summernote/lang/summernote-ar-AR.js') }}}"
        type="text/javascript"></script>
{{--<script src="{{{ asset('assets/global/plugins/typeahead/handlebars.min.js') }}}" type="text/javascript"></script>--}}
<script src="{{{ asset('assets/global/plugins/typeahead/typeahead.bundle.min.js') }}}" type="text/javascript"></script>
<script src="{{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}}" type="text/javascript"></script>
<script src="{{{ asset('assets/global/plugins/fuelux/js/spinner.min.js') }}}" type="text/javascript"></script>
<script src="{{{ asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}}" type="text/javascript"></script>
@endpush


@push('pageLevelScripts')
<script src="{{{ asset('js/dashboard.js') }}}" type="text/javascript"></script>
<script type="application/javascript">
    $("#touchspin").TouchSpin({
        initval: 60,
        min: 60,
        max: 1000000000,
        step: 60,
        prefix: "كل",
        postfix: "دقيقة",
        buttondown_class: "btn blue",
        buttonup_class: "btn red"
    })
</script>
@endpush



@section('title')
    {{ trans('seeds.name') }} : {{ trans('app.create') }}
@endsection


@section('content')

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i> {{ trans('seeds.create.form_caption') }} </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            {!! Form::open(['route' => 'seeds.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
            {!! csrf_field()!!}
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label"> {{ trans('seeds.label.title') }}</label>
                    <div class="col-md-4">
                        <input type="text" name="title" class="form-control input-circle"
                               value="{{Request::old('title')}}" placeholder="اسم المصدر" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"> {{ trans('seeds.label.url') }}</label>
                    <div class="col-md-4">
                        <input type="url" name="url" class="form-control input-circle"
                               value="{{Request::old('url')}}" placeholder="رابط المصدر" required>
                    </div>
                </div>
            @if(count($categories) > 0)
                    <div class="form-group">
                        <label class="col-sm-3 control-label"> {{ trans('seeds.label.category') }} </label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <select id="single" name="category_id" class="form-control select2  input-circle" required>
                                    <option></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category['id'] }}"
                                                @if(Request::old('category_id') == $category['id']) selected @endif>{{ $category['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="col-md-3 control-label"> {{ trans('seeds.label.description') }} </label>
                    <div class="col-md-9">
                        <textarea name="description" id="summernote_1" required
                                  class="input-circle">{{Request::old('description')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"> {{ trans('seeds.label.reload') }} </label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input id="touchspin" type="number" class="form-control" name="reload" required>
                        </div>
                    </div>
                </div>

                <div class="form-group last">
                    <label class="col-md-3 control-label"> {{ trans('seeds.label.status') }} </label>
                    <div class="col-md-4">
                        <input type="checkbox" name="status" @if(Request::old('status')) checked
                               @endif class="make-switch  input-circle" id="test" data-size="small"
                               data-off-text=" {{ trans('seeds.label.deactivate') }} "
                               data-on-text=" {{ trans('seeds.label.activate') }} ">
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit"
                                class="btn btn-circle green"> {{ trans('seeds.create.submit') }} </button>
                        <button type="button"
                                class="btn btn-circle grey-salsa btn-outline"> {{ trans('seeds.label.cancel') }} </button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        <!-- END FORM-->
        </div>
    </div>
@endsection
