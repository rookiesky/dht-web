<?php
/**
 * File name:BannerController.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/29
 * Time: 17:19
 */

namespace App\Http\Controllers\Admin;


use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * 广告列表视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = Banner::all();
        return view(self::VIEW_PATH . 'banner.index',compact('data'));
    }

    /**
     * 增加广告视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View'
     */
    public function add()
    {
        return view(self::VIEW_PATH . 'banner.add');
    }

    /**
     * 编辑广告视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = Banner::find($id);
        return view(self::VIEW_PATH . 'banner.add',compact('data'));
    }

    /**
     * 删除广告逻辑
     * @param Request $request
     * @return string
     */
    public function delete(Request $request)
    {
         $id = $request->get('id');
         if(!is_numeric($id) || $id == ''){
              return $this->errorMsg('请提交正确的编号');
         }
         $result = Banner::find($id);

         if($result == null){
             return $this->errorMsg('不存在的广告');
         }
         Storage::delete($result->img);
         $result->delete();
         return $this->successMsg('','删除成功');
    }

    /**
     * 批量删除
     * @param Request $request
     * @return string
     */
    public function deleteAll(Request $request)
    {
        $id = $request->get('id');
        if(empty($id)){
            return $this->errorMsg('请选择内容');
        }

        $result = Banner::whereIn('id',$id)->get();

        if($result->isEmpty() === true){
            return $this->errorMsg('内容不存在');
        }

        $imgs = collect($result)->map(function ($item){
             return $item->img;
        });

        Storage::delete($imgs->toArray());
        Banner::whereIn('id',$id)->delete();
        return $this->successMsg('','删除成功');
    }
    
    /**
     * 增加 OR 修改广告逻辑
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')){

            if($_FILES['img']['size'] != 0 && $_FILES['img']['name'] != '') {
                $data['img'] = $this->upload($request);
            }

            $data['type'] = $request->get('type');
            $data['display'] = $request->get('display');
            $data['link'] = $request->get('link');
            $data['id'] = $request->get('id');

            if($data['id'] == null){
                $result = Banner::create($data);
            }else{
                $result = Banner::where('id',$data['id'])->update($data);
            }


            if ($result) {
                return redirect('webAdmin/banner');
            }
            return redirect()->back();
        }
    }

    /**
     * 获取总数
     * @return mixed
     */
    public function total()
    {
        return Banner::count();
    }
    /**
     * 上传图片
     * @param Request $request
     * @return false|string
     */
    private function upload(Request $request)
    {
        return $request->file('img')->store('banner');
    }
}