<?php
/**
 * Created by PhpStorm.
 * User: weizi
 * Date: 2015/11/10
 * Time: 21:52
 */

namespace Admin\Model;


use Think\Model;

class GoodsMemberPriceModel extends Model
{
    public function getMemberPrice($goods_id){
        $goodsMemberPrices=$this->field('member_level_id,price')->where(array('goods_id'=>$goods_id))->select();
        $member_level_ids=array_column($goodsMemberPrices,'member_level_id');
        $prices=array_column($goodsMemberPrices,'price');
        return array_combine($member_level_ids,$prices);
    }
}