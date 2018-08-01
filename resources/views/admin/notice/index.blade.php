@extends('admin.layouts.common')
@section('content')
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">系统管理</a>
        <a>
          <cite>通知列表</cite></a>
      </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
            <button class="layui-btn" onclick="x_admin_show('添加通知','/webAdmin/notice/add')"><i class="layui-icon"></i>添加</button>
            <span class="x-right" style="line-height:40px">共有数据：{{ $data->total() }} 条</span>
        </xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                </th>
                <th>编号</th>
                <th>内容</th>
                <th>截止时间</th>
                <th>状态</th>
                <th>添加时间</th>
                <th>更新时间</th>
                <th >操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $val)
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{ $val->id }}'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>{{ $val->id }}</td>
                <td>{!! $val->content !!}</td>
                <td>{{ $val->enddate }}</td>
                <td>{{ $val->statusTo() }}</td>
                <td>{{ $val->created_at }}</td>
                <td>{{ $val->updated_at }}</td>
                <td class="td-manage">
                    <a title="查看"  onclick="x_admin_show('编辑','/webAdmin/notice/edit/{{ $val->id }}')" href="javascript:;">
                        <i class="layui-icon">&#xe63c;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,'{{ $val->id }}')" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
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
    <script>
        /*用户-删除*/
        function member_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                $.get("/api/webAdmin/notice/delete/" + id, { id: id}, function(data){
                    layer.msg(data.message,{icon:1,time:1000});
                    if(data.status == 0){
                        $(obj).parents("tr").remove();
                    }
                },'json');
            });
        }

        function delAll (argument) {

            var data = tableCheck.getData();

            layer.confirm('确认要删除吗？',function(index){

                $.post("/api/webAdmin/notice/deleteAll", { id:data },function(data){
                        layer.msg(data.message, {icon: 1});
                        if(data.status == 0){
                            $(".layui-form-checked").not('.header').parents('tr').remove();
                        }
                 });
            });
        }
    </script>
@endsection