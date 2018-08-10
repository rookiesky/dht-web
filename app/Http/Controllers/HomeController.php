<?php
/**
 * File name:HomeController.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/31
 * Time: 16:10
 */

namespace App\Http\Controllers;


use App\Banner;
use App\Hotdht;
use App\Notice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = $this->getIndexData();

        return view('home.index',compact('data'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');
        $page = $request->get('page') ?? 1;
        $orderBy = $request->get('type') ?? 'id';

        $banner = $this->Banner('list');


        $dht = [];

        if($keyword){
            $result = (new DhtController())->search($keyword,$page,$orderBy);
            $data = json_decode($result,true);

            if(isset($data['current_page'])){

                $listData = $this->lengthFrom($data['data']);

                $dht = [
                    'data' => $listData,
                    'last_page' => $data['last_page'],
                    'current_page' => $data['current_page'],
                    'keyword' => $keyword,
                    'type' => $orderBy
                ];
            }
        }

        return view('home.list',compact(['banner','dht']));
    }


    public function hash($hash)
    {
        if($hash){
            $result = (new DhtController())->getOne($hash);

            $dht = json_decode($result,true);

            if(isset($dht['status'])){
                return redirect('/');
            }
            $dht['file_num'] = 1;

            if(isset($dht['file_list'])){
                $dht['file_list']['file_list'] = $this->lengthFrom($dht['file_list']['file_list']);
                $dht['file_num'] = count($dht['file_list']['file_list']);
            }

            $dht['length'] = $this->lengthSize($dht['length']);

            $banner = $this->Banner('view');
            $hengfu = $this->Banner('hengfu');

            return view('home.view',compact(['dht','banner','hengfu']));

        }
        return redirect('/');
    }

    /**
     * 格式化字节
     * @param $data
     * @return static
     */
    private function lengthFrom($data)
    {
        return collect($data)->map(function($item){
            $item['length'] = $this->lengthSize($item['length']);
            return $item;
        });
    }

    private function lengthSize($length)
    {
        $size = strlen($length);

        switch ($size){
            case $size < 7 :
                $item = round( $length / 1024 , 2) . 'KB';
                break;
            case $size < 10:
                $item = round( ( $length / 1024 ) / 1024 , 2) . 'MB';
                break;
            default:
                $item = round( $length / 1073741824 , 2 ) . 'G';
        }

        return $item;
    }

    /**
     * 获取banner
     * @param string $type 广告位置
     * @return mixed
     */
    private function Banner($type)
    {
        return Banner::where('type',$type)->where('display',1)->get();
    }

    /**
     * 获取首页数据
     * @return array
     */
    private function getIndexData()
    {
        $notice = Notice::where('status',1)->first();

        $hotResult = Hotdht::orderBy('created_at','desc')->get();
        $hot = collect($hotResult)->map(function($item){
            $data = ['label-info','label-success','label-primary'];
            $item->style = $data[array_rand($data,1)];
            return $item;
        });

        return compact(['notice','hot']);
    }
}