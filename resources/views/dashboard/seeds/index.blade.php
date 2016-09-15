@extends('dashboard.layouts.master')

@push('pageLevelCssPlugins')
<link href="{{{ asset('assets/global/plugins/datatables/datatables.min.css') }}}" rel="stylesheet" type="text/css"/>
<link href="{{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css') }}}"
      rel="stylesheet" type="text/css"/>
<link href="{{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}}"
      rel="stylesheet" type="text/css"/>
@endpush


@push('pageLevelJsPlugins')
<script src="{{{ asset('assets/global/scripts/datatable.js') }}}" type="text/javascript"></script>
<script src="{{{ asset('assets/global/plugins/datatables/datatables.min.js') }}}" type="text/javascript"></script>
<script src="{{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}}"
        type="text/javascript"></script>
<script src="{{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}}"
        type="text/javascript"></script>
@endpush


@push('pageLevelScripts')
<script src="{{{ asset('js/ajaxdt.js') }}}" type="text/javascript"></script>
@endpush

@section('title')
    {{ $pagename or trans('seeds.name') }}
@endsection



@section('content')
    <!-- Begin: life time stats -->
    <div class="portlet light portlet-fit portlet-datatable bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-green"></i>
                <span class="caption-subject font-green sbold uppercase">  {{ trans('seeds.name') }}  </span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{{route('seeds.create')}}}"
                       class="btn btn-transparent green btn-circle"> {{ trans('seeds.new') }} </a>
                    <a href="{{{route('seeds.settings')}}}"
                       class="btn btn-transparent red btn-circle"> {{ trans('seeds.settings') }} </a>
                </div>
                <div class="btn-group">
                    <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                        <i class="fa fa-share"></i>
                        <span class="hidden-xs">  {{ trans('seeds.tools') }}  </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right" id="datatable_ajax_tools">
                        <li>
                            <a href="javascript:;" data-action="0" class="tool-action">
                                <i class="icon-printer"></i> {{ trans('seeds.print') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;" data-action="1" class="tool-action">
                                <i class="icon-check"></i> {{ trans('seeds.copy') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;" data-action="2" class="tool-action">
                                <i class="icon-doc"></i> {{ trans('seeds.pdf') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;" data-action="3" class="tool-action">
                                <i class="icon-paper-clip"></i> {{ trans('seeds.excel') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;" data-action="4" class="tool-action">
                                <i class="icon-cloud-upload"></i> {{ trans('seeds.csv') }} </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:;" data-action="5" class="tool-action">
                                <i class="icon-refresh"></i> {{ trans('seeds.reload') }} </a>
                        </li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <div class="table-actions-wrapper">
                    <span> </span>
                    <select class="table-group-action-input form-control input-inline input-small input-sm">
                        <option value=""> {{ trans('seeds.chose') }} </option>
                        <option value="activate"> {{ trans('seeds.activate') }} </option>
                        <option value="deactivate"> {{ trans('seeds.deactivate') }} </option>
                        <option value="delete"> {{ trans('seeds.delete') }} </option>
                    </select>
                    <button class="btn btn-sm btn-default table-group-action-submit">
                        <i class="fa fa-check"></i> {{ trans('seeds.action') }} </button>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable" id="seeds_datatable">
                    <thead>
                    <tr role="row" class="heading">
                        <th width="2%">
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes"/>
                                <span></span>
                            </label>
                        </th>
                        <th width="4%"> {{ trans('seeds.label.id') }} </th>
                        <th width="14%"> {{ trans('seeds.label.updated_at') }} </th>
                        <th width="20%"> {{ trans('seeds.label.title') }} </th>
                        <th width="15%"> {{ trans('seeds.label.category') }} </th>
                        <th width="10%"> {{ trans('seeds.label.feeds') }} </th>
                        <th width="5%"> {{ trans('seeds.label.status') }} </th>
                        <th width="20%"> {{ trans('seeds.label.tools') }} </th>
                    </tr>
                    <tr role="row" class="filter">
                        <td></td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="item_id">
                        </td>
                        <td>
                            <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control form-filter input-sm" readonly
                                       name="updated_date_from" placeholder="{{ trans('app.from') }}">
                                <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                            </div>
                            <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control form-filter input-sm" readonly
                                       name="updated_date_to" placeholder="{{ trans('app.to') }}">
                                <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                            </div>
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="title">
                        </td>

                        <td>
                            <select name="category" class="form-control form-filter input-sm">
                                <option value="">{{ trans('seeds.chose') }}</option>
                                @if(count($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['title'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            {{--<div class="margin-bottom-5">--}}
                                {{--<input type="text" class="form-control form-filter input-sm margin-bottom-5 clearfix"--}}
                                       {{--name="feeds_no_from" placeholder="{{ trans('app.from') }}"/></div>--}}
                            {{--<input type="text" class="form-control form-filter input-sm" name="feeds_no_to"--}}
                                   {{--placeholder="{{ trans('app.to') }}"/>--}}
                        </td>
                        <td>
                            <select name="status" class="form-control form-filter input-sm">
                                <option value="">{{ trans('seeds.chose') }}</option>
                                @if(count($status))
                                    @foreach($status as $key => $value)
                                        <option value="{{ $key }}">{{ trans(current($value)) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <div class="margin-bottom-5">
                                <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                    <i class="fa fa-search"></i> {{ trans('seeds.search') }} </button>
                            </div>
                            <button class="btn btn-sm btn-default filter-cancel">
                                <i class="fa fa-times"></i> {{ trans('seeds.reset') }} </button>
                        </td>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End: life time stats -->
@endsection
