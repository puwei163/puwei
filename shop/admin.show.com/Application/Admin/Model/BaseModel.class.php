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

class BaseModel extends Model
{
    // 是否批处理验证
    protected $patchValidate = true;
    // 自动验证定义


    /**
     * 通过id修改修改status的值
     * 是伪删除
     * @param $id
     * @param $status
     * @return bool
     */
    public function changeStatus ( $id , $status )
    {
        $data = array ( 'status' => $status );
        if ( $status == - 1 ) {
            //表示删除,将原来的name原始数据修改成,xxx_del
            $data[ 'name' ] = array ( 'exp' , "concat(name,'_del')" );
        }
        $this->where ( array ( 'id' => array ( 'in' , $id ) ) );
        return parent::save ( $data );
        //UPDATE supplier SET  STATUS = -1  ,  NAME = CONCAT(NAME,'_del' ) WHERE id = 6;
    }

    /**
     * 获取分页效果,分页数据
     * @return array
     */
    public function getPageResult ( $wheres = array () )
    {
        //保存查询条件
        $wheres[ 'status' ] = array ( 'neq' , - 1 );
        //提供分页工具条
        $getpage = $this->where ( $wheres )->count ();//获取总条数
        //获取每页显示条数,没有配置就默认10条
        $pagesize = C ( 'PAGE_SIZE' ) ? C ( 'PAGE_SIZE' ) : 10;
        //实例page类
        $page = new page( $getpage , $pagesize );
        $pageHtml = $page->show ();
        //查询数据
        $rows = $this->where ( $wheres )->limit ( $page->firstRow , $page->listRows )->select ();
        //返回数据
        return array ( 'rows' => $rows , 'pageHtml' => $pageHtml );


    }

    /**
     * 获取status=1并且通过sort排序的数据
     * @return mixed
     */
    public function getShowList ( $field = array () ,  $wheres= "*" )
    {
        $wheres[ 'status' ] = 1;
        return $this->where ( $wheres )->field ( $field )->order ( 'sort' )->select ();
    }

}