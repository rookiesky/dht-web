@extends('layouts.master')
@section('content')
    <style type="text/css">
        .view-banner .panel-body{
            padding:0px;
        }
        .view-banner .panel-body a{
            padding:0px;
        }
        .view-banner .panel-body img{
            width: 100%;
        }
    </style>
    <div class="container-fluid">
        @include('layouts.header')
        <nav class="navigation line"></nav>

        <div class="container view">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span>{{ $dht['name'] }}</h3>
                        </div>
                        <div class="panel-body">
                            <p>种子哈希：{{ strtoupper($dht['info_hash']) }}</p>
                            <p>文件数量：{{ $dht['file_num'] }}</p>
                            <p>文件大小：{{ $dht['length'] }}</p>
                            <p>收录时间：{{ $dht['create_time'] }}</p>
                        </div>
                    </div>
                    @foreach($hengfu as $val)
                    <div class="panel panel-default view-banner">
                        <div class="panel-body">
                            <a href="{{ $val->link }}"><img src="/{{ $val->img }}" alt=""> </a>
                        </div>
                    </div>
                    @endforeach
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-magnet" aria-hidden="true"></span>磁力链接</h3>
                        </div>
                        <div class="panel-body">
                            <div class="dht-link"><a href="magnet:?xt=urn:btih:{{ $dht['info_hash'] }}&dn={{ $dht['name'] }}">magnet:?xt=urn:btih:{{ strtoupper($dht['info_hash']) }}&dn={{ $dht['name'] }}</a> </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>下载种子文件</h3>
                        </div>
                        <div class="panel-body">
                            <a type="button" class="btn btn-success btn-lg" href="https://storetorrents.com/hash/{{ $dht['info_hash'] }}" target="_blank">下载Torrent文件</a>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon glyphicon-list" aria-hidden="true"></span>文件列表</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                @if(isset($dht['file_list']['file_list']))
                                    @foreach($dht['file_list']['file_list'] as $val)
                                    <li class="list-group-item">
                                        {{ $val['path'] }}
                                        <span class="pull-right">{{ $val['length'] }}</span>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @include('layouts.right-banner')
                </div>
            </div>
        </div>

        @include('layouts.footer')

    </div>
@endsection