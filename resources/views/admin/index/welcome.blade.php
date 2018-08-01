@extends('admin.layouts.common')
@section('content')
<div class="x-body layui-anim layui-anim-up">
    <blockquote class="layui-elem-quote">欢迎管理员：
        <span class="x-red">{{ Auth::user()->name }}</span>！当前时间:{{ date('Y-m-d H:i:s') }}</blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据统计</legend>
        <div class="layui-field-box">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                            <div carousel-item="">
                                <ul class="layui-row layui-col-space10 layui-this">
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>总数量</h3>
                                            <p>
                                                <cite>{{ $data['total'] }}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>广告</h3>
                                            <p>
                                                <cite>{{ $data['banner'] }}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>通知</h3>
                                            <p>
                                                <cite>{{ $data['notice'] }}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>错误</h3>
                                            <p>
                                                <cite>{{ $data['log'] }}</cite></p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>系统信息</legend>
        <div class="layui-field-box">
            <table class="layui-table">
                <tbody>
                <tr>
                    <th>{{ env('APP_NAME') }}版本</th>
                    <td>0.1</td></tr>
                <tr>
                    <th>服务器地址</th>
                    <td>{{ $_SERVER['DB_HOST'] }}</td></tr>
                <tr>
                    <th>操作系统</th>
                    <td>{{ PHP_OS }}</td></tr>
                <tr>
                    <th>运行环境</th>
                    <td>{{ $_SERVER ['SERVER_SOFTWARE'] }}</td></tr>
                <tr>
                    <th>PHP版本</th>
                    <td>{{ PHP_VERSION }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
@endsection