<?php
/**
 * File name:IndexController.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/24
 * Time: 14:10
 */

namespace App\Http\Controllers\Admin;


use App\Hash;
use App\Http\Controllers\Controller;


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
        return Hash::count();
    }

}