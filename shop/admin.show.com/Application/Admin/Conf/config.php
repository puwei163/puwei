<?php
defined('WEB_URL') or define('WEB_URL','http://admin.show.com');
return array (
    //'配置项'=>'配置值'
    //配置CSS,JS,images,文件目录
    'TMPL_PARSE_STRING' => array (
        '__CSS__' => WEB_URL . '/Public/Admin/css' , // 更改默认的/Public 替换规则
        '__JS__' => WEB_URL . '/Public/Admin/js' , // 增加新的JS类库路径替换规则
        '__IMG__' => WEB_URL . '/Public/Admin/images' , // 增加新的上传路径替换规则
        '__LAYER__' => WEB_URL . '/Public/Admin/layer/layer.js' , // 增加新的上传路径替换规则
        '__UPLOADIFY__' => WEB_URL . '/Public/Admin/uploadify' , // 增加新的上传路径替换规则
        '__TREEGRID__' => WEB_URL . '/Public/Admin/jquery-treegrid' , // 增加新的上传路径替换规则
        '__ZTREE_V3__' => WEB_URL . '/Public/Admin/zTree_v3' , // 增加新的上传路径替换规则
        '__BRAND__' => 'http://weipu-brand.b0.upaiyun.com' , // 品牌路劲
        '__GOODS__' => 'http://weipu-logo.b0.upaiyun.com' , // 商品路劲
        '__UEDITOR__' => WEB_URL.'/Public/Admin/ueditor' , // ueditor 富文本编辑器地址
        '__GALLERY__' => 'http://weipi-goods.b0.upaiyun.com' , // 商品相册路劲
        '__GOODSPATH__' => WEB_URL.'/Uploads' , // 商品相册路劲

    ),
    //配置分页显示条数
    'PAGE_SIZE'=>5,
);