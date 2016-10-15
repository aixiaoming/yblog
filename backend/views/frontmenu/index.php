<?php
/**
 * Created by PhpStorm.
 * User: zhao晓明
 * Date: 2016/10/4
 * Time: 17:41
 */
use yii\helpers\Url;
?>


<div class="frontmenu-index">

    <a href="<? echo Url::to(['frontmenu/add'])?>"><button class="btn btn-info">新增分类</button></a>

    <table class="table table-striped">
        <thead>
        <tr>
            <td>分类id</td>
            <td>分类名称</td>
            <td>路由</td>
            <td>上级分类</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($lists as $list): ?>
            <tr>
                <td><?php echo  $list['id']; ?></td>
                <td><?php echo  $list['title']; ?></td>
                <td><?php echo  $list['route']; ?></td>
                <td><?php echo  $list['parentid']; ?></td>
                <td> <a href="<? echo Url::to(['frontmenu/update','id'=>$list['id']])?>">修改</a>&nbsp;<a href="<? echo Url::to(['frontmenu/delete','id'=>$list['id']])?>">删除</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>