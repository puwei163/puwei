<?php
/**
 * Created by PhpStorm.
 * User: weizi
 * Date: 2015/11/3
 * Time: 15:16
 */

namespace Admin\Controller;


use Think\Controller;

class GiiController extends Controller
{
    public function index ()
    {
        if ( IS_POST ) {
            header ( 'Content-Type: text/html;charset=utf-8' );
            //接收表名
            $table_name = I ( 'post.tabl_name' );
            $name = parse_name ( $table_name , 1 );//修改传人的表名为规定的类名
            //查询meta_title的值从information_schame表中查询
            //SELECT TABLE_COMMENT FROM information_schema.`TABLES` WHERE TABLE_SCHEMA='shop' AND TABLE_NAME='brand'
            $sql = "SELECT TABLE_COMMENT FROM information_schema.`TABLES` WHERE TABLE_SCHEMA='" . C ( 'DB_NAME' ) . "' AND TABLE_NAME='$table_name'";
            $row = M ()->query ( $sql );
            $meta_title = $row[ 0 ][ 'table_comment' ];

            //根据数据合成代码
            defined ( 'TEMPLATE_PATH' ) or define ( 'TEMPLATE_PATH' , ROOT_PATH . 'Template/' );

            ////////////////////////生成控制器//////////////////////////////////////
            ob_start ();//开启OB缓存
            require TEMPLATE_PATH . 'Controller.tpl';
            $controller_content = ob_get_clean ();//关闭OB并且接收
            //给控制器前面加上一个<?php\r\n
            $controller_content = "<?php\r\n" . $controller_content;
            //定义生成路劲
            $controller_path = APP_PATH . 'Admin/Controller/' . $name . 'Controller.class.php';
            //把控制器写入文件
            file_put_contents ( $controller_path , $controller_content );


            //////////////////////成功模型//////////////////////////////
            //查询表中的每个字段
            $sql = "show full columns from " . $table_name;
            $fields = M ()->query ( $sql );
            //根据表里面的注释分解,表单类型,表单值
            foreach ( $fields as &$field ) {
                $comment = $field[ 'comment' ];//获取注释内容
                preg_match ( '/(.*)@([a-z]*)\|?(.*)/' , $comment , $result );
                if ( ! empty( $result ) ) {
                    $field[ 'comment' ] = $result[ 1 ];
                    $field[ 'input_type' ] = $result[ 2 ];
                    if ( ! empty( $result[ 3 ] ) ) {//判断表单值是否存在,
                        parse_str($result[ 3 ],$option_values);
                        $field[ 'option_values' ] = $option_values;
                    }
                }
            }

            unset($field); //避免后面在使用$field出错,因为field也是在foreach中使用
            ob_start ();//开启OB缓存
            require TEMPLATE_PATH . 'Model.tpl';
            //给控制器前面加上一个<?php\r\n
            $model_content = ob_get_clean ();//关闭OB并且接收
            $model_content = "<?php\r\n" . $model_content;
            //定义生成路劲
            $model_path = APP_PATH . 'Admin/Model/' . $name . 'Model.class.php';
            //把模型写入文件
            file_put_contents ( $model_path , $model_content );

            //////////////////////成功index页面//////////////////////////////

            ob_start ();//开启OB缓存
            require TEMPLATE_PATH . 'index.tpl';
            $index_content = ob_get_clean ();//关闭OB并且接收
            //定义文件夹目录创建
            $view_paht = APP_PATH . 'Admin/View/' . $name;
            if ( ! is_dir ( $view_paht ) ) {
                mkdir ( $view_paht , 0777 , true );
               
            }
            //定义生成路劲
            $index_path = $view_paht . '/index.html';
            //把模型写入文件
            file_put_contents ( $index_path , $index_content );

            ///////////////////生成add页面////////////////////
            ob_start ();//开启OB缓存
            require TEMPLATE_PATH . 'add.tpl';
            $add_content = ob_get_clean ();//关闭OB并且接收
             //定义生成路劲
            $add_path = $view_paht . '/add.html';
             //把模型写入文件
            file_put_contents ( $add_path , $add_content );

            $this->success('代码生成成功');

        } else {
            $this->display ( 'index' );
        }

    }

}