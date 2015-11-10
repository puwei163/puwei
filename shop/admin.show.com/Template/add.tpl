<extend name="Common:add"/>
<block name="content">
    <div class="main-div">
        <form method="post" action="{:U()}">
            <table cellspacing="1" cellpadding="3" width="100%">

                <?php foreach($fields as $field):
                 if($field['key']=='PRI'){
                    continue;
                 }

                 ?>
                <tr>
                    <td class="label"><?php echo $field['comment']; ?></td>
                    <td>

                        <?php
                        if($field['input_type']=='text'){
                         //目的: 根据每个字段的注解中指定的表单元素的类型,生成不同的表单元素
                                //1. 获取每个注解中的表单元素类型
                            echo "<textarea name=\"{$field['field']}\" style=\"resize: none\" cols=\"40\" rows=\"6\">{\$row.{$field['field']}|default=''}</textarea>";
                                echo "\r\n";
                        }elseif($field['input_type']=='file'){
                            echo "<input type=\"file\" name=\"{$field['field']}\"/>";
                        }elseif($field['input_type']=='radio'){ //对status单独生成
                            foreach($field['option_values'] as $key=>$value){
                                echo "<input type=\"radio\" name=\"{$field['field']}\" class=\"status\" value=\"{$key}\" >{$value} ";
                            }
                        }else{
                            if($field['field']=='sort'){
                                echo "<input type=\"text\" name=\"{$field['field']}\" value=\"{\$row.{$field['field']}|default=20}\" >";
                            }else{
                                echo "<input type=\"text\" name=\"{$field['field']}\" value=\"{\$row.{$field['field']}|default=''}\" >";

                            }
                        }
                        ?>
                        <span class="require-field">*</span>
                    </td>
                </tr>

              <?php  endforeach;?>




                <tr>
                    <td colspan="2" align="center"><br/>
                        <input type="hidden" name="id" value="{$row.id}"/>
                        <input type="submit" class="button ajax-post" value=" 确定 "/>
                        <input type="reset" class="button" value=" 重置 "/>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</block>