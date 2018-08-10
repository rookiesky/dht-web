<?php

namespace App\Tools;


use Illuminate\Support\Facades\Cache;

class TokenManage
{
    const TOKEN_API = '/api/user/login';
    const TOKEN_CACHE_KEY = 'apitoken';

    public function get()
    {
        if (Cache::has(self::TOKEN_CACHE_KEY)) {
            return $this->getFile();
        }
        $data = $this->post();

        return $data;
    }

    /**
     * 向接口获取token
     * @return array
     */
    private function post()
    {
        $url = env('DHT_API_URL') . self::TOKEN_API;
        $data = [
            'username' => env('DHT_API_USERNAME'),
            'password' => env('DHT_API_PASSWORD')
        ];

        $client = new ClientTool();
        $result = $client->post($url,$data);
        $token = json_decode($result,true);

        if (empty($token['token'])) {
            return [
                'status' => false,
                'message' =>$token['error']
            ];
        }
        $this->setFile($token);
        return $token;
   }



    /**
     * 获取文件内容
     * @return mixed
     */
    private function getFile()
    {
        return Cache::get(self::TOKEN_CACHE_KEY);
    }

    /**
     * 写入文件
     * @param $data
     */
    private function setFile($data)
    {
        Cache::put(self::TOKEN_CACHE_KEY,$data,$data['minute']);
    }

}