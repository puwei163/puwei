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
    
        <!--预留一个位置共CSS样式使用-->
    
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo mb_substr($meta_title,2,null,'utf-8');?>列表</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>

    <div style="clear:both"></div>
</h1>

    <div class="main-div">
        <form method="post" action="<?php echo U();?>">
            <table cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    <td class="label">标题</td>
                    <td>

                        <input type="text" name="name" value="<?php echo ((isset($row["name"]) && ($row["name"] !== ""))?($row["name"]):''); ?>"> <span
                            class="require-field">*</span>
                    </td>
                </tr>

                <tr>
                    <td class="label">文章分类</td>
                    <td>

                        <?php echo arr2select('article_category_id',$articleCategorys);?>
                    </td>
                </tr>

                <tr>
                    <td class="label">内容</td>
                    <td>

                        <textarea name="content" style="resize: none" cols="40"
                                  rows="6"><?php echo ((isset($row["content"]) && ($row["content"] !== ""))?($row["content"]):''); ?></textarea>
                        <span class="require-field">*</span>
                    </td>
                </tr>

                <tr>
                    <td class="label">摘要</td>
                    <td>

                        <textarea name="intro" style="resize: none" cols="40"
                                  rows="6"><?php echo ((isset($row["intro"]) && ($row["intro"] !== ""))?($row["intro"]):''); ?></textarea>
                        <span class="require-field">*</span>
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


                <tr>
                    <td colspan="2" align="center"><br/>
                        <input type="hidden" name="id" value="<?php echo ($row["id"]); ?>"/>
                        <input type="submit" class="button ajax-post" value=" 确定 "/>
                        <input type="reset" class="button" value=" 重置 "/>
                    </td>
                </tr>
            </table>
        </form>
    </div>



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

     <!--预留一个位置共JS样式使用-->
 
</body>
</html>