<?php
/**
 * File name:Client.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/24
 * Time: 19:33
 */

namespace App\Tools;


use GuzzleHttp\Client;

class ClientTool
{
    public $statusCode = 200;   //状态码
    /**
     * get请求
     * @param string $url 请求地址
     * @return string
     */
    public function get($url)
    {
        try{
            $result = $this->client()->get($url,['timeout'=>2]);
            $this->statusCode = $result->getStatusCode();
            return $result->getBody()->getContents();
        }catch (\Exception $e){
            return json_encode([
                'status' => 404,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * POST请求
     * @param string $url 请求地址
     * @param $data 请求数据
     * @return string
     */
    public function post($url,$data)
    {
        try{
            $result = $this->client()->post($url,[
                'form_params' => $data,
                'timeout' => 2
            ]);
            $this->statusCode = $result->getStatusCode();
            return $result->getBody()->getContents();
        }catch (\Exception $e){
            return json_encode([
                'status' => 404,
                'error' => $e->getMessage()
            ]);
        }

    }

    private function client()
    {
        return new Client(['http_errors' => false]);
    }
}