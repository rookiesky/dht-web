<?php
/**
 * File name:NoticeController.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/29
 * Time: 20:32
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * 通知列表视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = Notice::orderBy('created_at','desc')->paginate(20);
        return view(self::VIEW_PATH . 'notice.index',compact('data'));
    }

    /**
     * 添加通知视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view(self::VIEW_PATH . 'notice.add');
    }

    /**
     * 编辑通知视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if($id){
            $data = Notice::find($id);
            if(empty($data)){
                return redirect()->back();
            }
            return view(self::VIEW_PATH . 'notice.add',compact('data'));
        }
    }

    /**
     * 删除指定通知
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        if($id){
            $data = Notice::find($id);
            if(empty($data)){
                return $this->errorMsg('通知不存在！');
            }
            $data->delete();
            return $this->successMsg('','删除成功');
        }
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->get('id');
        if(empty($ids)){
            return $this->errorMsg('请选择要删除的通知');
        }
        $data = Notice::whereIn('id',$ids)->get();
        if($data->isEmpty()){
            return $this->errorMsg('通知不存在');
        }
        Notice::whereIn('id',$ids)->delete();
        return $this->successMsg('','删除成功');
    }

    /**
     * 添加 OR 编辑通知逻辑
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $data = $request->only(['enddate','status','content']);
        if(empty($data['enddate'])){
            return $this->errorMsg('截止时间不能为空');
        }
        if(empty($data['content'])){
            return $this->errorMsg('内容必须填写！');
        }
        if(empty($data['status'])){
            $data['status'] = 0;
        }
        $id = $request->get('id');

        if($id){
            $result = Notice::where('id',$id)->update($data);
        }else{
            $result = Notice::create($data);
        }

        if($result){
            return $this->successMsg('','提交成功');
        }
        return $this->errorMsg('提交失败');
    }

    /**
     * 获取总数
     * @return mixed
     */
    public function total()
    {
        return Notice::count();
    }

}