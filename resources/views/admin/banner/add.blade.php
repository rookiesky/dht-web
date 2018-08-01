@extends('admin.layouts.common')
@section('content')
    <div class="x-body">
        <form class="layui-form" method="post" enctype="multipart/form-data" action="/webAdmin/banner/store">
            <div class="layui-form-item">
                <label for="link" class="layui-form-label">
                    <span class="x-red">*</span>链接
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="link" name="link" required="" lay-verify="required"
                           autocomplete="off" class="layui-input" value="@if(isset($data->link)) {{ $data->link }} @endif">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>广告位置
                </label>
                <div class="layui-input-inline">
                    <select id="shipping" name="type" class="valid">
                        <option value="list" @if(isset($data->type) && $data->type == 'list') selected @endif>列表页</option>
                        <option value="view" @if(isset($data->type) && $data->type == 'view') selected @endif>详情页</option>
                        <option value="hengfu" @if(isset($data->type) && $data->type == 'hengfu') selected @endif>详情页横幅</option>
                    </select>
                    {{ csrf_field() }}
                </div>
            </div>
            <div class="layui-form-item">
                <label for="display" class="layui-form-label">
                    <span class="x-red">*</span>是否显示
                </label>
                <div class="layui-input-inline">
                        <input type="radio" name="display" value="1" title="是" @if(isset($data->display) && $data->display == 1) checked @elseif(!isset($data->display)) checked @endif><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>是</div></div>
                        <input type="radio" name="display" value="0" title="否" @if(isset($data->display) && $data->display == 0) checked @endif><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon layui-anim-scaleSpring"></i><div>否</div></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>选择图片
                </label>
                <div class="layui-input-inline">
                    <input type="file" id="img" name="img" @if(!isset($data->img)) required="" @endif class="layui-input">
                    @if(isset($data->img) && $data->img != '')
                        <p style="color:red">如不修改图片，请勿选择</p>
                        <input type="hidden" name="id" value="{{ $data->id }}" >
                    @endif
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>
    <div class="layui-form-item">
        <label for="L_repass" class="layui-form-label">
        </label>
        <button  class="layui-btn" lay-filter="add" type="submit">
            提交
        </button>
    </div>
    </form>
    </div>
@endsection