<?php
namespace Admin\Model;


use Admin\Service\NestedService;
use Think\Model;

class GoodsCategoryModel extends BaseModel
{

    // 自动验证定义
    protected $_validate = array (
        array ( 'name' , 'require' , '名称不能够为空!' ) ,
        array ( 'parent_id' , 'require' , '父分类不能够为空!' ) ,
        array ( 'lft' , 'require' , '左边界不能够为空!' ) ,
        array ( 'rght' , 'require' , '右边界不能够为空!' ) ,
        array ( 'level' , 'require' , '级别不能够为空!' ) ,
        array ( 'status' , 'require' , '状态不能够为空!' ) ,
        array ( 'sort' , 'require' , '排序不能够为空!' ) ,

    );

    /**
     * 获取所有数据
     * @return mixed
     */
    public function getList ()
    {
        return $this->order ( 'lft' )->where('status>=0')->select ();
    }

    /**
     * 覆盖ADD方法,加入自己的逻辑
     */
    public function add ()
    {
        //>>1.使用NestedSetService业务类完成 边界的运算
        $DbMysqlInterfaceImplModel = new DbMysqlInterfaceImplModel();
        $NestedService = new NestedService( $DbMysqlInterfaceImplModel , 'goods_category' , 'lft' , 'rght' , 'parent_id' , 'id' , 'level' );
        //>>2.才将数据添加到数据表中
        return $NestedService->insert ( $this->data[ 'parent_id' ] , $this->data , 'bottom' );
    }

    /**
     * 覆盖默认的修改方法
     * 因为默认的修改方法不满足我的要求
     */
    public function save ()
    {
        $DbMysqlInterfaceImplModel = new DbMysqlInterfaceImplModel();
        $NestedService = new NestedService( $DbMysqlInterfaceImplModel , 'goods_category' , 'lft' , 'rght' , 'parent_id' , 'id' , 'level' );
        //移动分类,仅仅是移动
        $result = $NestedService->moveUnder ( $this->data[ 'id' ] , $this->data[ 'parent_id' ] );
        if ( $result === false ) {
            $this->error = "不能将父分类作为自己的分类!";
            return false;
        }
        return parent::save ();//修改分类的数据,调用父类的修改数据到数据库
    }


    /**
     * 将id以及id的子分类的状态修改掉
     * @param $id
     * @param $status
     */
    public function changeStatus ( $id , $status )
    {
        $sql = "SELECT child.id FROM goods_category AS parent,goods_category AS child WHERE child.lft>=parent.`lft` AND child.rght<=parent.`rght` AND parent.id=$id";
        $rows=$this->query($sql);
        $ids=array_column($rows,'id');
        //然后在修改奇状态
        return parent::changeStatus($ids,$status);
    }
}