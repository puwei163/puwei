<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - <?php echo ($meta_title); ?> </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="http://admin.show.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.show.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css"/>
    
    <link href="http://admin.show.com/Public/Admin/zTree_v3/css/zTreeStyle/zTreeStyle.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.show.com/Public/Admin/uploadify/uploadify.css" rel="stylesheet" type="text/css"/>


</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo mb_substr($meta_title,2,null,'utf-8');?>列表</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>

    <div style="clear:both"></div>
</h1>

    <div id="tabbar-div">
        <p>
            <span class="tab-front">通用信息</span>
            <span class="tab-back">商品描述</span>
            <span class="tab-back">会员价格</span>
            <span class="tab-back">商品属性</span>
            <span class="tab-back">商品相册</span>
            <span class="tab-back">关联文章</span>
        </p>
    </div>
    <div class="main-div">
        <form method="post" action="<?php echo U();?>">
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <tr>
                    <td class="label">名称</td>
                    <td>
                        <input type="text" name="name" value="<?php echo ((isset($row["name"]) && ($row["name"] !== ""))?($row["name"]):''); ?>"> <span
                            class="require-field">*</span>
                    </td>
                </tr>

                <tr>
                    <td class="label">商品分类</td>
                    <td>
                        <input type="text" class="goods_category_text" name="goods_category_text" disabled="disabled"
                               value="请选择下面的分类"> <span
                            class="require-field">*</span>
                        <input type="hidden" class="goods_category_id" name="goods_category_id"/>
                    </td>
                </tr>
                <tr>
                    <td class="label"></td>
                    <td>
                        <ul id="treeDemo" class="ztree"></ul>
                    </td>
                </tr>
                <tr>
                    <td class="label">品牌</td>
                    <td>
                        <?php echo arr2select('brand_id',$brands,$row['brand_id']);?>
                    </td>
                </tr>
                <tr>
                    <td class="label">供货商</td>
                    <td>
                        <?php echo arr2select('supplier_id',$supplier,$row['supplier_id']);?>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店价格</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php echo ((isset($row["shop_price"]) && ($row["shop_price"] !== ""))?($row["shop_price"]):''); ?>"> <span
                            class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">市场价格</td>
                    <td>
                        <input type="text" name="market_price" value="<?php echo ((isset($row["market_price"]) && ($row["market_price"] !== ""))?($row["market_price"]):''); ?>"> <span
                            class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">库存</td>
                    <td>
                        <input type="text" name="stock" value="<?php echo ((isset($row["stock"]) && ($row["stock"] !== ""))?($row["stock"]):''); ?>"> <span
                            class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架</td>
                    <td>
                        <input type="radio" name="is_on_sale" class="status_is" value="1">是
                        <input type="radio" name="is_on_sale" class="status_is" value="0">否 <span
                            class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品状态</td>
                    <td>
                        <input type="checkbox" name="goods_status[]" class="goods_status" value="1">精品
                        <input type="checkbox" name="goods_status[]" class="goods_status" value="2">新品
                        <input type="checkbox" name="goods_status[]" class="goods_status" value="4">热销
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">关键字</td>
                    <td>

                        <input type="text" name="keyword" value="<?php echo ((isset($row["keyword"]) && ($row["keyword"] !== ""))?($row["keyword"]):''); ?>"> <span
                            class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">LOGO</td>
                    <td>

                        <input type="file" name="upload-logo" id="upload-logo" maxlength="60">
                        <input type="hidden" class="logo" name="logo" value="<?php echo ($logo); ?>">

                        <div class="upload-img-box" style="display: <?php echo ($row["logo?'block':'none'"]); ?>">
                            <div class="upload-pre-item">
                                <img src="http://admin.show.com/Uploads/<?php echo ($row["logo"]); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">状态</td>
                    <td>

                        <input type="radio" name="status" class="status" value="1">是 <input type="radio" name="status"
                                                                                            class="status" value="0">否
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">排序</td>
                    <td>

                        <input type="text" name="sort" value="<?php echo ((isset($row["sort"]) && ($row["sort"] !== ""))?($row["sort"]):20); ?>"> <span
                            class="require-field">*</span>
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <tr>
                    <td >
                        <textarea name="intro" id="intro"><?php echo ($intro); ?></textarea>
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: block">
                <!--会员价格开始-->
                <?php if(is_array($memberLevels)): $i = 0; $__LIST__ = $memberLevels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$memberLevel): $mod = ($i % 2 );++$i;?><tr>

                    <td class="label"><?php echo ($memberLevel["name"]); ?></td>
                    <td>
                        <input type="text" name="memberPrice[<?php echo ($memberLevel["id"]); ?>]" maxlength="60"
                               value="<?php echo ($goodsMemberPrice[$memberLevel['id']]); ?>"> <span
                            class="require-field">*</span>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <!--会员价格结束-->
            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <tr>
                    <td class="label">商品属性</td>
                    <td>
                        <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                            class="require-field">*</span>
                    </td>
                </tr>


            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <tr>
                    <td>
                        <div class="upload-img-gallery">
                            <div class="upload-pre-item" style="display: inline-block">
                                <?php if(is_array($goodsGallerys)): $i = 0; $__LIST__ = $goodsGallerys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsGallery): $mod = ($i % 2 );++$i;?><img style="width: 100px" src="http://admin.show.com/Uploads/<?php echo ($goodsGallery["path"]); ?>">
                                    <a href="javascript:;" dbid="<?php echo ($goodsGallery["id"]); ?>" style="color: red">X</a><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="upload-logo" id="upload-gallery" maxlength="60">
                        (支持批量上传)
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <tr>
                    <td class="label" style="text-align: left;">
                        <div style="width: 300px">
                        文章搜索: <input  type="text" class="keyword" name="keyword">
                        <input class="search_article" type="button" value="搜索" >
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <select multiple="multiple" class="left_select" style="width: 100%;height: 300px"></select>
                    </td>
                    <td style="text-align: right;">
                        <div class="selectedOption">
                            <?php if(is_array($goodsAritcles)): $i = 0; $__LIST__ = $goodsAritcles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsAritcle): $mod = ($i % 2 );++$i;?><input type="hidden" name="article_id[]" value="<?php echo ($goodsAritcle["id"]); ?>"/><?php endforeach; endif; else: echo "" ;endif; ?>
                         </div>
                        <select multiple="multiple" class="rifht_select" style="width: 50%;height: 300px;">
                            <?php if(is_array($goodsAritcles)): $i = 0; $__LIST__ = $goodsAritcles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsAritcle): $mod = ($i % 2 );++$i;?><option value="<?php echo ($goodsAritcle["id"]); ?>"><?php echo ($goodsAritcle["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                </tr>
            </table>
    </div>
    <div style="text-align: center">
        <input type="hidden" name="id" value="<?php echo ($row["id"]); ?>"/>
        <input type="submit" class="button" value=" 确定 "/>
        <input type="reset" class="button" value=" 重置 "/>
    </div>
    </form>


<div id="footer">
    共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
<script type="text/javascript" src="http://admin.show.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://admin.show.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://admin.show.com/Public/Admin/js/common.js"></script>
<script type="text/javascript">
    $(function () {
        $('.status').val([<?php echo ((isset($row["status"]) && ($row["status"] !== ""))?($row["status"]): 1); ?>]);


    });
</script>

    <script type="text/javascript" src="http://admin.show.com/Public/Admin/zTree_v3/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript" src="http://admin.show.com/Public/Admin/uploadify/jquery.uploadify.js"></script>
    <script type="text/javascript" src="http://admin.show.com/Public/Admin/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="http://admin.show.com/Public/Admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="http://admin.show.com/Public/Admin/ueditor/ueditor.all.min.js"></script>

    <script type="text/javascript">
        $(function () {


            /////////////////////////切换特效 开始//////////////////////////////
            //在所有的span加上点击事件
            $('#tabbar-div span').click(function () {
                //先改变使用的span的class='tab-back'
                $('#tabbar-div span').removeClass('tab-front').addClass('tab-back');
                //然后把当前span的点击改变
                $(this).removeClass('tab-back').addClass('tab-front');
                //然后把对应的table显示出来
                var index =$(this).index();
                $('form>table').hide().eq(index).show();
                if(index==1){  //判断点击是不是描述,是就加载
                    /////////////////////////////商品描述在线编辑器   开始
                    UE.getEditor('intro',{
                        initialFrameHeight:500  //初始化编辑器高度,默认320
                    })
                }
                /////////////////////////////商品描述在线编辑器   结束
            })
            /////////////////////////切换特效 结束//////////////////////////////

            /////////////////////////////商品分类树   开始//////////////////////

            //>>1.树的设置
            var setting = {
                data: {
                    simpleData: {
                        enable: true, //编辑状态
                        pIdKey: "parent_id", //节点数据中保存其父节点唯一标识的属性名称
                    }
                },
                callback: { //树里面的点击事件 开始
                    onClick: function (event, treeId, treeNode) {
                        $('.goods_category_id').val(treeNode.id);
                        $('.goods_category_text').val(treeNode.name);
                    },
                    beforeClick: function (treeId, treeNode, clickFlag) {
                        if (treeNode.isParent) {
                            layer.msg('必须选择最小分类', {
                                offset: 0,
                                icon: 0,
                            });
                        }
                        //如果该分类有子节点就返回false ,false表示不选中
                        return !treeNode.isParent;
                    }
                },
            };
            //数里面的点击事件 结束
            var nodes = <?php echo ($nodes); ?>;  //准备数的数据
            //给页面分配数据
            treeObject = $.fn.zTree.init($("#treeDemo"), setting, nodes);
            //判断页面是否有ID的值,有ID表示回显

            <?php if(!empty($id)): ?>var goods_category_id =<?php echo ($row["goods_category_id"]); ?>;
                var node  = treeObject.getNodeByParam('id',goods_category_id);
                 treeObject.selectNode(node);
                  //并且将选中的节点的id,name设置
                  $('.goods_category_id').val(node.id);
                     $('.goods_category_text').val(node.name);
              <?php else: ?>
            treeObject.expandAll(true);   //树全部打开<?php endif; ?>

                /////////////////////////////商品分类树   结束//////////////////////
                /////////////////////////////图片上传   开始//////////////////////

            window.setTimeout(function () {
                $("#upload-logo").uploadify({
                    height: 30, //指定删除插件的高和宽
                    width: 120,
                    swf: "http://admin.show.com/Public/Admin/uploadify/uploadify.swf",//指定SWF地址
                    uploader: '<?php echo U("uploader/index");?>',//服务器处理上传PHP
                    buttonText: '选择图片',   //上传按钮上面的文字
                    //                'fileSizeLimit': '100KB',  //限制大小
                    formData: {'dir': 'logo'},   //通过post方式传递的额外参数
                    multi: false,   //是否支持多文件上传
                    onUploadSuccess: function (file, data, response) {   //上传成功时执行的方法
                        $('.logo').val(data);
                        $('.upload-img-box').show();
                        $('.upload-img-box img').attr('src', "http://weipu-logo.b0.upaiyun.com/" + data + '!m');
                    },
                    onUploadError: function (file, errorCode, errorMsg, errorString) { //上传失败时该方法执行
                        alert('该文件上传失败!错误信息为:' + errorString);
                    }
                })
            }, 10);
            /////////////////////////////图片上传   结束//////////////////////
            /////////////////////////////回显是否上架 开始//////////////////
            $('.status_is').val([<?php echo ((isset($row["is_on_sale"]) && ($row["is_on_sale"] !== ""))?($row["is_on_sale"]): 1); ?>]);
            /////////////////////////////回显是否上架 结束//////////////////

             /////////////////////////////编辑时回显商品状态  开始////////////////////
            <?php if(!empty($id)): ?>var goods_status=<?php echo ($row["goods_status"]); ?>;
                        var goods_status_value=new Array();
                        if((goods_status & 1) >0){
                            goods_status_value.push(1);
                        }if((goods_status & 2) >0){
                            goods_status_value.push(2);
                        }if((goods_status & 4) >0){
                            goods_status_value.push(4);
                        }
                    $('.goods_status').val(goods_status_value);<?php endif; ?>
             /////////////////////////////编辑时回显商品状态  结束////////////////////
             /////////////////////////////商品相册上传插件  结束////////////////////
        window.setTimeout(function () {
                        $("#upload-gallery").uploadify({
                            height: 30, //指定删除插件的高和宽
                            width: 120,
                            swf: "http://admin.show.com/Public/Admin/uploadify/uploadify.swf",//指定SWF地址
                            uploader: '<?php echo U("uploader/index");?>',//服务器处理上传PHP
                            buttonText: '选择图片',   //上传按钮上面的文字
                            //                'fileSizeLimit': '100KB',  //限制大小
                            formData: {'dir': 'goods'},   //通过post方式传递的额外参数
                            multi: true,   //是否支持多文件上传
                            onUploadSuccess: function (file, data, response) {   //上传成功时执行的方法
                               var html ='<div class="upload-pre-item"style="display: inline-block">\
                                        <img src="http://admin.show.com/Uploads/'+data+'" style="width:100px">\
                                         <input type="hidden" class="path" \
                                         name="gallery_path[]" value="'+data+'">\
                                          <a href="javascript:;" style="color: red">X</a>\
                                          </div>';

//                                alert(data)
                                $(html).appendTo('.upload-img-gallery');

                            },
                            onUploadError: function (file, errorCode, errorMsg, errorString) { //上传失败时该方法执行
                                alert('该文件上传失败!错误信息为:' + errorString);
                            }
                        })
                    }, 10);
        //删除商品相册的数据
                $('.upload-img-gallery').on('click','a',function(){
                    var dbid=$(this).attr('dbid');
                    //判断有没有值有就发送ajax从数据库里面删除
                    if(dbid){
                        var that = $(this);
                        //>>2. 如果存在,需要发送ajax请求让服务器删除数据库中数据
                        $.post("<?php echo U('deleteGallery');?>",{gallery_id:dbid},function(data){
                            if(data.success){
                               that.closest('div').remove();
                            }
                        })
                    }else{
                        //>>3.如果不存在直接从页面上删除
                        $(this).closest('div').remove();

                    }
                })
             /////////////////////////////商品相册上传插件  结束////////////////////
        /////////////////////////////关联文章   开始////////////////////////////////////////////
            $('.search_article').click(function(){
                loadArticle();
            })
        //根据关键字查询文章
        function loadArticle(){
            $.getJSON('<?php echo U("Article/search");?>',{keyword:$('.keyword').val()},function(data){
                var option_html="";
                $(data).each(function(){
                    option_html+="<option value='"+this.id+"'>"+this.name+"</option>"
                })
                $(option_html).appendTo('.left_select');
            })
        };
        $('.rifht_select').on('dblclick','option',function(){
            $(this).appendTo('.left_select');
            select2Hidden();
        });

        //给option添加双击事件
        $('.left_select').on('dblclick','option',function(){
            $(this).appendTo('.rifht_select');
            select2Hidden();
        })
        function select2Hidden(){
            var hiddenHtml="";
           $('.rifht_select>option').each(function(){
               hiddenHtml+="<input type='hidden' name='article_id[]' value='"+this.value+"'/>"
           })
            $('.selectedOption').empty();//将隐藏域放到div中之前先清空
            $(hiddenHtml).appendTo(".selectedOption");

        }
        /////////////////////////////关联文章   结束////////////////////////////////////////////

        })
    </script>

</body>
</html>