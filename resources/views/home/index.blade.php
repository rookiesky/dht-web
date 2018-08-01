@extends('layouts.master')
@section('content')
    @if(isset($data['notice']->id) && $data['notice']->id != '')
    <div class="header">
        <ul class="list-group">
            <li class="list-group-item"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>{!! $data['notice']->content !!}</li>
        </ul>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12 logo">
                CiLiBt<span>.</span>Org
            </div>
            <div class="col-md-12 search">
                <form class="form-inline" method="get" action="/search">
                    <div class="form-group">
                        <label for="inputsearch" class="sr-only">搜索内容</label>
                        <input type="text" class="form-control" name="keyword" id="inputsearch" placeholder="请输入要搜索的内容">
                    </div>
                    <button type="submit" class="btn btn-info">搜索</button>
                </form>
            </div>
            <div class="col-md-12 hots">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-fire" aria-hidden="true"></span>热门搜索</h3>
                    </div>
                    <div class="panel-body">
                        @foreach($data['hot'] as $val)
                            <a class="label {{ $val->style }}" href="/search?keyword={{ $val->content }}">{{ $val->content }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@include('layouts.footer')
@endsection