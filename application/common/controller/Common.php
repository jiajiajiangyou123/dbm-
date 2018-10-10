<?php
/**
 * Created by PhpStorm.
 * User: wangjia
 * Date: 2018/10/9
 * Time: 11:10
 */

namespace app\common\controller;

use think\Controller;

class Common extends Controller
{
    protected $uid;
    /**
     *  @title  init
     *  @description    todo::后台账号基本验证操作（登录、权限、菜单）
     *  @author wangjia
     *  @time   2018年10月9日11:21:40
     */
    public function _initialize()
    {
        $this->loginManage();

        define('CONTRLLER_NAME',request()->controller());
        define('ACTION_NAME',request()->action());
        define('UID',$this->uid);

        $menu = $this->treeMenu();
        $this->assign('menu',$menu);
    }

    /**
     * @title   loginManage
     * @description todo::登录验证管理（未登录、登录超时、异地登录）
     * @author  wangjia
     * @time    2018年10月9日11:34:52
     */
    public function loginManage()
    {
        $this->uid = session('admin_m_id');
        if (!$this->uid) {
            return $this->redirect('/login');
        }

        $token = db('admin_token')->where('uid',$this->uid)->find();
        $time = time();
        if ($token['token_time'] > $time) {
            return  '登录超时，请重新登录';
        }

        $sToken = session('token');
        if ($token['token'] != $sToken) {
            return '异地登录、是否密码账号泄露';
        }

        $token['token_time'] += 3600;
        return db('admin_token')->save($token);
    }

    /**
     * @title  menu
     * @description todo::获取菜单列表
     * @author  wangjia
     * @time    2018年10月9日11:57:58
     */
    public function treeMenu()
    {
        $menu = cache('menu'.$this->uid);

        if (!$menu) {
            $map = [
                'status'    =>  1
            ];
            $menu = db('menu')->where($map)->select();
        }
    }
}