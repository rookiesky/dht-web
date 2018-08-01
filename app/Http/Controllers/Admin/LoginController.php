<?php
/**
 * File name:LoginController.php
 * User: rookie
 * Url : PTP5.Com
 * Date: 2018/7/24
 * Time: 13:39
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view(self::VIEW_PATH . 'login.index');
    }

    /**
     * 登录逻辑
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:12',
            'password' => 'required|min:6|max:12'
        ]);

        if ($validator->fails()) {
            return $this->errorMsg($validator->errors()->first());
        }

        $data = $request->only(['name','password']);

        if (\Auth::attempt($data)) {
            $request->session()->regenerate();
            return $this->successMsg(['url'=>'/webAdmin/index'],'登录成功');
        }
        return $this->errorMsg('请输入正确的账号密码');
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/webAdmin/login');
    }

}