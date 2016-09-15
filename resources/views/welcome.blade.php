<?php //dd($items) ?>

@extends('layouts.app')


@section('content')

    <div class="container-fluid">
        @if(count($items)>0)
        <div class="row js-masonry">
            @foreach($items as $item)
            <div class="col-md-3 brick">
                <div class="thumbnail">
                    @if($item->image)
                        <div class="news-block">
                        <img data-src="3" alt="{{ $item['title'] }}" src="{{{ $item->image }}}">
                        </div>
                    @endif
                    <div class="caption">
                        <h3>{{ $item['title'] }}</h3>
                        <p>
                            {!! words(strip_tags(Html::decode($item['description'])),20,'...') !!}
                            </p>
                        <p>
                            <a href="{{{ route('post', $item->slug) }}}" class="btn btn-primary">{{{ trans('app.read') }}}</a>
                            <a href="{{{ route('category', $item->category->slug) }}}" class="btn btn-primary">{{{ $item->category->title }}}</a>
                            <a href="{{{ route('seed', $item->seed->slug) }}}" class="btn btn-default">{{{ $item->seed->title }}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    {{ $items->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection
