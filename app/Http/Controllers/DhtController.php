<?php
/**
 * File name:DhtController.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/31
 * Time: 19:03
 */

namespace App\Http\Controllers;


use App\Hash;

class DhtController extends Controller
{
    public function search($keyword,$page = 0,$orderBy )
    {
        return Hash::search($keyword)->orderBy($orderBy,'desc')->paginate(20,'page',$page);
    }


    public function getOne($hash)
    {
        $file = Hash::where('info_hash',$hash)->first();

        if(empty($file)){
            return false;
        }
        $file->fileList;

        return $file;
    }

}