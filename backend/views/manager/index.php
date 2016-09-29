<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '会员列表';
?>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">前台用户</a></li>
        <li role="presentation"><a href="#profile" role="tab" data-toggle="tab">管理员</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <table class="table table-hover">
               <thead>
                   <tr>
                       <td>用户名</td>
                       <td>邮箱</td>
                       <td>状态</td>
                       <td>IP</td>
                       <td>注册时间</td>
                       <td>操作</td>
                   </tr>
               </thead>
               <tbody>
               <?php foreach($users1 as $user): ?>
                   <tr>
                       <td><?php echo isset($user->username)?$user->username : '未填写'; ?></td>
                       <td><?php echo isset($user->email) ? $user->email : '未填写'; ?></td>
                       <td><?php echo $user->status==10 ? '正常' : '停止';  ?></td>
                       <td><?php echo $user->lastip; ?></td>
                       <td><?php echo date("Y-m-d H:i:s", $user->created_at); ?></td>
                       <td>修改&nbsp;删除</td>
                   </tr>
               <?php endforeach; ?>
               </tbody>
            </table>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
            <br>
            <a href="<? echo Url::to(['manager/add'])?>"><button type="button" class="btn btn-info">新增管理员</button></a>
            <table class="table table-hover">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>用户名</td>
                        <td>邮箱</td>
                        <td>状态</td>
                        <td>IP</td>
                        <td>注册时间</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users0 as $user): ?>
                        <tr>
                            <td><?php echo isset($user->username)?$user->username : '未填写'; ?></td>
                            <td><?php echo isset($user->email) ? $user->email : '未填写'; ?></td>
                            <td><?php echo $user->status==10 ? '正常' : '停止';  ?></td>
                            <td><?php echo $user->lastip; ?></td>
                            <td><?php echo date("Y-m-d H:i:s", $user->created_at); ?></td>
                            <td><a href="<? echo Url::to(['manager/update','id'=>$user->id])?>">修改</a>&nbsp;<a href="<? echo Url::to(['manager/delete','id'=>$user->id])?>">删除</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </table>
        </div>
    </div>