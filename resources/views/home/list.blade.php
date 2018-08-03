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
                            <nav aria-label="Page navigation" style="text-align: center">
                                <ul class="pagination pagination-lg pagejs">

                                </ul>
                            </nav>
                </div>

                <div class="col-md-3">
                    @include('layouts.right-banner')
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
@section('script')
<script>
    var total = parseInt( "@if(isset($dht['last_page'])){{ $dht['last_page'] }}@else 0 @endif" );
    var keyword = "@if(isset($dht['keyword'])){{ $dht['keyword'] }} @else '' @endif";
    var newPage = parseInt( "@if(isset($dht['current_page'])){{ $dht['current_page'] }} @else '' @endif" );


    $(function () {

        if(total > 1){
            bodys = '';

            if(total < 10){
                bodys = page(1,total,newPage,total);
            }else{
                initpage = (parseInt( newPage / 10) * 10);

               bodys = page( (initpage == 0 ? 1 : initpage),numstopPage(initpage));

                if(isInteger(newPage)){
                    bodys = page(newPage,numstopPage(initpage));
                }
            }
            $(".pagejs").html(bodys);
        }

        function numstopPage(initpage)
        {
            num = initpage + 10;

            if(num > total){
                num = total;
            }
            return num;
        }


        function page(star,limit)
        {

            bodyhtml = upHtml( newPage == 1 ? 1 : (newPage - 1) );

             for (i=star; i<=limit; i++ ) {

                 bodyhtml += commonHtml(i, (i==newPage) ? 'active' : '' );
             }

            bodyhtml += nextHtml( (newPage < total) ? (newPage + 1) : 0 );
            return bodyhtml;
        }

        function isInteger(obj){
            return obj%10 === 0;
        }

        function commonHtml(key,type)
        {
            return '<li class="'+ type +'"><a href="/search?keyword='+ keyword +'&page='+ key +'">'+ key +'</a></li>';
        }

        /**
         * 上一页
         * @param $key
         * @returns {string}
         */
        function upHtml(key)
        {
            return '<li><a href="/search?keyword='+ keyword +'&page='+ key +'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        /**
         * 下一页
         * @param int $key
         * @returns {string}
         */
        function nextHtml(key) {
            return '<li><a href="/search?keyword='+ keyword +'&page='+ key +'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        }

    });
</script>
@endsection