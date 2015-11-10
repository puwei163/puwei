<?php
/**
 * Created by PhpStorm.
 * User: weizi
 * Date: 2015/10/31
 * Time: 16:55
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class SupplierModel extends BaseModel
{

    // 自动验证定义
    protected $_validate = array (

        array ( 'name' , 'require' , '供货商不能为空!' ) ,
        array ( 'name' , '' , '供货商重复' , '' , 'unique' ) ,
        array ( 'intro' , 'require' , '简介不能为空' ) ,
    );

    /**
     * 获取所有数据
     * @return mixed
     */
    public function getShowList ()
    {
        return $this->select ();
    }
}