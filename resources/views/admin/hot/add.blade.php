@extends('admin.layouts.common')
@section('content')
    <div class="x-body">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="add" lay-submit="">
                    增加
                </button>
            </div>
        </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form
                ,layer = layui.layer;

       //监听提交
            form.on('submit(add)', function(data){
                $.post("/api/webAdmin/hot/add", { content: data.field.name },function(data){
                         layer.msg(data.message);
                         if(data.status == 0){
                             // 获得frame索引
                             var index = parent.layer.getFrameIndex(window.name);
                             //关闭当前frame
                             parent.layer.close(index);
                         }
                 });
                return false;
            });


        });
    </script>
@endsection