@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('layouts.header')

        <nav class="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills" role="tablist">
                            {{--<li role="presentation" class="active"><a href="#">创建日期</a></li>--}}
                            {{--<li role="presentation"><a href="#">文件大小</a></li>--}}
                            {{--<li role="presentation"><a href="#">下载热度</a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container content">
            <div class="row">
                <div class="col-md-9">
                    @if(isset($dht['data']))
                    @foreach($dht['data'] as $val)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a href="/hash/{{ $val['info_hash'] }}" target="_blank">{{ $val['name'] }}</a></h3>
                        </div>
                        <div class="panel-body">
                            {{ $val['name'] }}
                            <div class="panel-body-footer">
                                <div class="info">收录时间：<span>{{ $val['create_time'] }}</span></div>
                                <div class="info">文件大小：<span>{{ $val['length'] }}</span></div>
                                <div class="info">下载热度：<span>{{ $val['requests'] }}</span></div>
                                <div class="info">文件类型：<span>{{ $val['category'] }}</span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p>暂无数据</p>
                            </div>
                        </div>
                    @endif
                    @if(isset($dht['current_page']))
                    <nav aria-label="Page navigation" style="text-align: center">
                        <ul class="pagination pagination-lg">
                            <li>
                                <a href="/search?keyword={{ $dht['keyword'] }}@if($dht['current_page'] != 1)&page={{ $dht['current_page'] - 1 }}@endif"
                                   aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @for($i = 1; $i <= $dht['last_page'];$i++ )
                            <li class="@if($i == $dht['current_page']) active @endif"><a href="/search?keyword={{ $dht['keyword'] }}&page={{ $i }}">{{ $i }}</a></li>
                            @endfor
                            <li>
                                <a href="/search?keyword={{ $dht['keyword'] }}@if($dht['current_page'] < $dht['last_page'])&page={{ $dht['current_page'] + 1 }}@endif"
                                   aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    @endif
                </div>

                <div class="col-md-3">
                    @include('layouts.right-banner')
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection