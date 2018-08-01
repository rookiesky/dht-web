<?php
/**
 * File name:MessagesApi.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/23
 * Time: 19:59
 */

namespace App\Tools;


trait MessagesApi
{

    /**
     * 正常反馈
     * @param $data 反馈数据
     * @param string $message 反馈信息
     * @param int $code 状态代码
     * @return string
     */
    public function successMsg($data,$message = '',$code = 0)
    {
        return $this->jsonForm($code,$message,$data);
    }

    /**
     * 非正常反馈
     * @param $message 反馈信息
     * @param null $data 反馈数据
     * @param int $code  状态代码
     * @return string
     */
    public function errorMsg($message,$data = null,$code = 400)
    {
        return $this->jsonForm($code,$message,$data);
    }

    /**
     * 响应格式
     * @param int $code 反馈代码 0:正常
     * @param string $message 反馈信息
     * @param $data  反馈数据
     * @return string
     */
    private function jsonForm(int $code = 0,string $message = '',$data = null)
    {
        return $this->responseJson([
            'status' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * JSON响应
     * @param array $data
     * @return string
     */
    public function responseJson(array $data)
    {
        return \Response::json($data);
    }
}