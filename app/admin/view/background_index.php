<div class="aright">
    <div class="arz" style="float: left;margin: 0px 20px 20px 30px;"><a href="javscript:;"><i class="layui-icon">&#xe608;</i></a></div>

    <div style="float: left;">
        <form class="layui-form" action="" method="get">
            <input placeholder="输入id" name="id" value="<?php echo input('id'); ?>" type="text" class="layui-input" style="float: left;margin-right: 10px;width: 70px;">
            <button class="layui-btn" style="float: left;" value="查询" type="submit">查询</button>
        </form>
    </div>

    <form method="post" class="aform cl " >
        <table width="100%">
            <tr>
                <th width="2%" align="center">id</th>
                <th width="15%" align="center">头部背景图</th>
                <th width="5%" align="center">主背景图</th>
                <th width="10%" align="center">添加时间</th>
                <th width="5%" align="center">基本操作</th>
            </tr>
            {foreach $list as $key=>$vo } 
            <tr>
                <td align="center">{$vo.id}</td>
                <td align="center"><img src='{$vo.head_back_img}' width="150" /></td>
                <td align="center"><img src='{$vo.main_back_img}' width="150" /></td>
                <td align="center">{$vo.c_time}</td>
                <td align="center">
                    <a href="{:url('background/edit',['id'=>$vo['id']])}" class="layui-btn layui-btn-small">修改</a>
                </td>
            </tr>
            {/foreach}
        </table>
    </form>
    <div class="pages">
        {$list|raw}
    </div>
</div>
<script>
</script>