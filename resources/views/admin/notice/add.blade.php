@extends('admin.layouts.common')
@section('content')
    <div class="x-body">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="enddate" class="layui-form-label">
                    <span class="x-red">*</span>截止时间
                </label>
                <div class="layui-input-inline">
                    <input class="layui-input" placeholder="开始日" name="start" id="start" value="@if(isset($data['enddate'])){{ $data->enddate }}@endif" required>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="status" class="layui-form-label">
                    <span class="x-red">*</span>是否启用
                </label>
                <div class="layui-input-inline">
                    <input type="checkbox" name="status" value="1" lay-skin="switch" lay-text="开启|关闭" @if(!isset($data->status) || $data->status == 1) checked @endif>
                    <div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>关闭</em><i></i></div>
                </div>
            </div>
    <div class="layui-form-item layui-form-text">
        <label for="desc" class="layui-form-label">
            内容
        </label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容" id="desc" name="desc" required class="layui-textarea">@if(isset($data->content)){{ $data->content }}@endif</textarea>
            <input type="hidden" name="id" value="@if(isset($data->id)){{ $data->id }}@endif">
        </div>
    </div>
    <div class="layui-form-item">
        <label for="L_repass" class="layui-form-label">
        </label>
        <button  class="layui-btn" lay-filter="add" lay-submit="">
            提交
        </button>
    </div>
    </form>
    </div>
@endsection
@section('script')
    <script>

        layui.use('laydate', function(){
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

        });

        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form;
            //监听提交
            form.on('submit(add)', function(data){
                $.post("/api/webAdmin/notice/add", { enddate:data.field.start, status: data.field.status,content:data.field.desc ,id:data.field.id},function(data){
                        layer.msg(data.message,{icon: 5,time:1000});
                        if(data.status == 0){
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                        }
                        return false;
                 });
                return false;
            });


        });
    </script>
@endsection