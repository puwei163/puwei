//列表中复选框的特效class='all'
$('.all').click(function () {
    //通过这个的状态赋值给下面的
    $('.id').prop('checked', $(this).prop('checked'))
})
//在所有的class='id'上面加上click事件
$('.id').change(function () {
    //判断复选框是否全部选中,如果全部选中,就让class='all'选中
    $('.all').prop('checked', $('.id:not(:checked)').length == 0)
})


//页面加载完成,找到class='ajax-post'的标签添加点击事件,并且发送ajax请求
$('.ajax-post').click(function () {
    var form = $(this).closest('form');//如果找到form,说明提交的是表单
        var url = form.length==0?$(this).attr('url'):form.attr('action');  //找到form上的action属性作为url
        var param = form.length==0?$('.id').serialize():form.serialize();  //获取form上的所有请求参数
    //发送POST请求
    $.post(url, param, function (data) {
        showLayer(data);
    })
    return false;//取消默认操作
})

//页面加载完成,找到class='ajax-get'的标签添加点击事件,并且发送ajax请求
$('.ajax-get').click(function () {
    var url = $(this).attr('href');
    $.get(url, function (data) {
        showLayer(data);
    })
    return false;
});
/**
 * 根据data的值弹出提示框
 * @param data
 */
function showLayer(data) {
    //正上方
    layer.msg(data.info, {
        offset: 0,
        shift: 6,
        icon: data.status ? 1 : 0,
        time: 1000,   //1秒钟之后执行下面的函数
    }, function () {
        if (data.status) {
            //成功才跳转
            location.href = data.url;
        }
    })
}
