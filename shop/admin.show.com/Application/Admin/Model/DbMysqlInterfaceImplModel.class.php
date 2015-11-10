<?php
/**
 * Created by PhpStorm.
 * User: weizi
 * Date: 2015/11/6
 * Time: 16:51
 */

namespace Admin\Model;

class DbMysqlInterfaceImplModel implements DbMysqlinterfaceModel
{
    public function connect ()
    {
        // TODO: Implement connect() method.
        echo 'connect';
        exit;
    }

    public function disconnect ()
    {
        // TODO: Implement disconnect() method.
        echo 'disconnect';
        exit;
    }

    public function free ( $result )
    {
        // TODO: Implement free() method.
        echo 'free';
        exit;
    }

    public function query ( $sql , array $args = array () )
    {
        $getsqls = $this->buildSQL ( func_get_args () );//获取传过来的值
        return M ()->execute ( $getsqls );//发送语句并且返回


    }

    public function insert ( $sql , array $args = array () )
    {
        // TODO: Implement insert() method.'

        $params = func_get_args ();
        $sql = $params[ 0 ];//获取第一个字符串
        $sql = str_replace ( '?T' , $params[ 1 ] , $sql );//替换字符串
        $values = array ();
        //遍历值
        foreach ( $params[ 2 ] as $k => $v ) {
            if ( $k == 'id' ) {
                continue;//跳出本次循环
            }
            $values[] = "$k='$v'";
        }
        $values = implode ( ',' , $values );//将二维数组已,好分割
        $sql = str_replace ( '?%' , $values , $sql );//替换字符串
        $result = M ()->execute ( $sql );//发送SQL语句
        if ( $result !== false ) {
            return M ()->getLastInsID ();//插入成功返回ID号
        } else {
            return false;//插入失败返回
        }
    }

    public function update ( $sql , array $args = array () )
    {
        // TODO: Implement update() method.
        echo 'update';
        exit;
    }

    public function getAll ( $sql , array $args = array () )
    {
        // TODO: Implement getAll() method.
        echo 'getAll';
        exit;
    }

    public function getAssoc ( $sql , array $args = array () )
    {
        // TODO: Implement getAssoc() method.
        echo 'getAssoc';
        exit;
    }

    public function getRow ( $sql , array $args = array () )
    {
        // TODO: Implement getRow() method.
        $getsqls = $this->buildSQL ( func_get_args () );//获取传过来的值
        $rows = M ()->query ( $getsqls );
        if ( ! empty( $rows ) ) {
            return $rows[ 0 ];
        }
    }

    /**
     * 根据参数拼sql
     */
    private function buildSQL ( $getsqls )
    {
        $sql = array_shift ( $getsqls );//弹出第一个值,并且接收
        $sqls = preg_split ( '/\?[FNT]/' , $sql );
        $targetSQL = "";
        foreach ( $sqls as $k => $v ) {
            $targetSQL .= $v . $getsqls[ $k ];
        }
        return $targetSQL;
    }

    public function getCol ( $sql , array $args = array () )
    {
        // TODO: Implement getCol() method.
        echo 'getCol';
        exit;
    }

    /**
     * 根据SQL查询唯一的值
     * @param string $sql
     * @param array $args
     */
    public function getOne ( $sql , array $args = array () )
    {
        $sql = $this->buildSQL ( func_get_args () );
        $rows = M ()->query ( $sql );
        //获取关联数组中的第一个值
        $values = array_values ( $rows[ 0 ] );
        return $values[ 0 ];
    }

}