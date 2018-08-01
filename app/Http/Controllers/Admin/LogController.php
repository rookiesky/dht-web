<?php
/**
 * File name:LogController.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/30
 * Time: 22:30
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Log;

class LogController extends Controller
{
    public function index()
    {
        $data = Log::orderBy('created_at','desc')->paginate(20);
        return view(self::VIEW_PATH . 'log.index',compact('data'));
    }

    /**
     * 获取总数
     * @return mixed
     */
    public function total()
    {
        return Log::count();
    }
}