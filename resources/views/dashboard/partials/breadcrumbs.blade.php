

<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    @if ($breadcrumbs)
        <ul class="page-breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!$breadcrumb->last)
                    <li>
                        <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                @else
                    <li> <span>{{ $breadcrumb->title }}</span></li>
                @endif
            @endforeach
        </ul>
    @endif
    {{--<div class="page-toolbar">--}}
    {{--<div class="btn-group pull-right">--}}
    {{--<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions--}}
    {{--<i class="fa fa-angle-down"></i>--}}
    {{--</button>--}}
    {{--<ul class="dropdown-menu pull-right" role="menu">--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<i class="icon-bell"></i> Action</a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<i class="icon-shield"></i> Another action</a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<i class="icon-user"></i> Something else here</a>--}}
    {{--</li>--}}
    {{--<li class="divider"> </li>--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<i class="icon-bag"></i> Separated link</a>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> {{ current($breadcrumb) }}
    {{--<small>{{ current($breadcrumb) }}</small>--}}
</h1>
<!-- END PAGE TITLE-->