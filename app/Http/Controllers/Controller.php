<?php

namespace App\Http\Controllers;

use App\Tools\MessagesApi;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,MessagesApi;

    //后台模板根目录
    const VIEW_PATH = 'admin.';
}
