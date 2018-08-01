<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['type','img','display','link'];

    public function typeView()
    {
        switch ($this->type){
            case 'view':
                return '详情页竖幅';
                break;
            case 'list':
                return '列表页竖幅';
                break;
            case 'hengfu':
                return '详情页横幅';
                break;
            default:
                return '';
        }

    }
}
