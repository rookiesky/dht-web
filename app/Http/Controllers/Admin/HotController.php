<?php
/**
 * File name:HotController.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/31
 * Time: 16:43
 */

namespace App\Http\Controllers\Admin;


use App\Hotdht;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotController extends Controller
{
    public function index()
    {
        $data = Hotdht::all();
        return view(self::VIEW_PATH . 'hot.index',compact('data'));
    }

    public function add()
    {
        return view(self::VIEW_PATH . 'hot.add');
    }

    /**
     * 删除指定内容
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        if($id){
            $result = Hotdht::find($id);
            if(empty($result)){
                return $this->errorMsg('内容不存在');
            }

            $result->delete();
            return $this->successMsg('','删除成功！');
        }
    }

    /**
     * 批量删除
     * @param Request $request
     * @return string
     */
    public function deleteAll(Request $request)
    {
        $ids = $request->get('id');
        if(empty($ids)){
            return $this->errorMsg('请选择内容');
        }
        $result = Hotdht::whereIn('id',$ids)->get();

        if($result->isEmpty()){
            return $this->errorMsg('内容不存在');
        }
        Hotdht::whereIn('id',$ids)->delete();
        return $this->successMsg('','删除成功');
    }

    public function store(Request $request)
    {
        $data = $request->only(['content']);
        if(empty($data)){
            return $this->errorMsg('内容不能为空');
        }

        $result = Hotdht::create($data);

        if($result){
            return $this->successMsg('','提交成功');
        }
        return $this->errorMsg('提交失败！');
    }
}