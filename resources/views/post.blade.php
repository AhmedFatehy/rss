@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{{ $post->title }}} <br>
                        <small>{!! words(strip_tags(Html::decode($post->description)),17,'') !!}</small>
                    </h1>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{{ $post->title }}}</h3>
                    </div>
                    <div class="panel-body">
                        {!! Html::decode($post->body)!!}
                    </div>
                    <div class="panel-footer">
                        Panel footer
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


