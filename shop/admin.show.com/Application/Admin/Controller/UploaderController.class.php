<?php
/**
 * Created by PhpStorm.
 * User: weizi
 * Date: 2015/11/4
 * Time: 22:17
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class UploaderController extends Controller
{
    public function index11(){
          //接收文件目录
        $dir = I ( 'post.dir' );
        if ( ! is_dir ( ROOT_PATH . 'Uploads/' . $dir ) ) {//判断文件存在不,不存在就创建
            mkdir ( ROOT_PATH . 'Uploads/' . $dir , 0777 , true );
        }
        $config = array (
                   'exts' => array () , //允许上传的文件后缀
                   'rootPath' => './' , //保存根路径 ./代表又拍云的每个空间的根目录, 必须是./
//                   'savePath' => './' , //保存路径
                   'saveExt' => '' , //文件保存后缀，空则使用原后缀
                   'driver' => 'Upyun' , // 文件上传驱动
                   'driverConfig' => array( // 上传驱动配置  ,就是哪个云服务
                    'host'     => 'v0.api.upyun.com', //又拍云服务器
                    'username' => 'weipu3402023',
                     //又拍云用户
                    'password' => 'weipu3402023', //又拍云密码
                    'bucket'   => 'weipu-'.$dir, //空间名称
                    'timeout'  => 90, //超时时间
                ),

               );
                $upload = new Upload( $config );

               $inof = $upload->uploadOne ( $_FILES[ 'Filedata' ] );

               if ( $inof) {
                   echo $inof[ 'savepath' ] . $inof[ 'savename' ];
               } else {

                   echo $upload->getError ();
               }

    }
    public function index ()
    {
        //接收文件目录
        $dir = I ( 'post.dir' );
        if ( ! is_dir ( ROOT_PATH . 'Uploads/' . $dir ) ) {//判断文件存在不,不存在就创建
            mkdir ( ROOT_PATH . 'Uploads/' . $dir , 0777 , true );
        }
        $config = array (
            'exts' => array () , //允许上传的文件后缀
            'rootPath' => './Uploads/' , //保存根路径
            'savePath' => $dir.'/' , //保存路径
            'saveExt' => '' , //文件保存后缀，空则使用原后缀
            'driver' => '' , // 文件上传驱动
            'driverConfig' => array () , // 上传驱动配置
        );
        $upload = new Upload( $config );
        $inof = $upload->uploadOne ( $_FILES[ 'Filedata' ] );
        if ( $inof) {
            echo $inof[ 'savepath' ] . $inof[ 'savename' ];
        } else {
            echo $upload->getError ();
        }
    }
}