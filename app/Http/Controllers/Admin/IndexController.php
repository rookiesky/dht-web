<?php
/**
 * File name:IndexController.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/24
 * Time: 14:10
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Log;
use App\Tools\ClientTool;
use App\Tools\TokenManage;

class IndexController extends Controller
{
    public function index()
    {
        return view(self::VIEW_PATH . 'index.index');
    }

    public function welcome()
    {

        $data['total'] = $this->getTotal();
        $data['log'] = (new LogController())->total();
        $data['notice'] = (new NoticeController())->total();
        $data['banner'] = (new BannerController())->total();
        return view(self::VIEW_PATH . 'index.welcome',compact('data'));
    }

    /**
     * 获取总数量
     * @return array|int|mixed|string
     */
    private function getTotal()
    {
        $tokenClient = new TokenManage();
        $result = $tokenClient->get();
        if (isset($result['status'])) {
            Log::create([
                'name' => 'tokenApi',
                'controller' => 'IndexController->getTotal',
                'value' => $result['message']
            ]);
            return 0;
        }

        $url = env('DHT_API_URL') . '/api/get/getTotal?token=' . $result['token'];
        $client = new ClientTool();
        $result = $client->get($url);
        if (is_numeric($result)) {
            return $result;
        }
        Log::create([
            'name' => 'TotalApi',
            'controller' => 'IndexController->getTotal',
            'value' => $result['message']
        ]);
        return 0;
    }

}