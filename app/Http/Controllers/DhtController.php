<?php
/**
 * File name:DhtController.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/31
 * Time: 19:03
 */

namespace App\Http\Controllers;


use App\Tools\ClientTool;
use App\Tools\TokenManage;

class DhtController extends Controller
{
    public function search($keyword,$page = 0,$orderBy )
    {
        $token = $this->token();
        if (isset($token['status'])) {
            Log::create([
                'name' => 'tokenApi',
                'controller' => 'DhtController->search',
                'value' => $token['message']
            ]);
            return false;
        }

        $url = env('DHT_API_URL') . '/api/search';

        $client = new ClientTool();
        $data = [
            'token' => $token['token'],
            'keyword' => $keyword,
            'page' => 20,
            'limit' => $page,
            'orderby' => $orderBy
        ];

        try{
            return $client->post($url,$data);
        }catch (\Exception $e){
            Log::create([
                'name' => 'getList',
                'controller' => 'DhtController->search',
                'value' => $e->getMessage()
            ]);
            return false;
        }

    }


    public function getOne($hash)
    {
        $token = $this->token();
        if (isset($token['status'])) {
            Log::create([
                'name' => 'tokenApi',
                'controller' => 'DhtController->getOne',
                'value' => $token['message']
            ]);
            return false;
        }

        $client = new ClientTool();

        $url = env('DHT_API_URL') . '/api/find/' . $hash . '?token=' . $token['token'];


        try{
            return $client->get($url);
        }catch (\Exception $e){
            Log::create([
                'name' => 'getOne',
                'controller' => 'DhtController->getOne',
                'value' => $e->getMessage()
            ]);

            return false;
        }




    }

    /**
     * 获取token
     * @return array|mixed
     */
    private function token()
    {
        return (new TokenManage())->get();
    }
}