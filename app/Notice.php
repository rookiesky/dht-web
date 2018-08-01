<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = ['content','status','enddate'];

    /**
     * 统一显示状态
     * @return string
     */
    public function statusTo()
    {
        if($this->status == 1){
            return '开启';
        }
        return '关闭';
    }
}
