@extends('admin.layouts.common')
@section('content')
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">系统管理</a>
        <a>
          <cite>错误日志</cite></a>
      </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                </th>
                <th>ID</th>
                <th>name</th>
                <th>Controller</th>
                <th>value</th>
                <th>添加时间</th>
                <th>更新时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $val)
                <tr>
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{ $val->id }}'><i class="layui-icon">&#xe605;</i></div>
                    </td>
                    <td>{{ $val->id }}</td>
                    <td>{!! $val->name !!}</td>
                    <td>{{ $val->controller }}</td>
                    <td>{{ $val->value }}</td>
                    <td>{{ $val->created_at }}</td>
                    <td>{{ $val->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="page">
            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection