<?php
/**
 * Created by PhpStorm.
 * User: wangjia
 * Date: 2018/10/9
 * Time: 18:12
 */

namespace app\index\controller;

use think\Controller;

class Login extends Controller
{
    public function index()
    {
        $src = captcha_src();
        $this->assign('src',$src);
        return $this->fetch();
    }
}