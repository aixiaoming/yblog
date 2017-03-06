<?php
///**
// * Created by PhpStorm.
// * User: zhao晓明
// * Date: 2017/3/6
// * Time: 22:12
// */
//
//<div class="comment rows">
//    <!--评论框-->
//    <div class="col-sm-12" id="com_all">
//        <div class="com_text col-sm-12">
//            <textarea id="fir_com" placeholder="说些什么吧。。。"></textarea>
//            <div class="col-sm-12 com_cap_div">
//                <span class="com_cap col-sm-2">请输入验证码</span>
//                <img  title="点击刷新" src="<?php echo \yii\helpers\Url::to(['comment/getvalid']);?>"  onclick="this.src='<?php echo \yii\helpers\Url::to(['comment/getvalid']);?>'" class="valid">
<!--//                <input type="text" name="com_cap" class="com_cap col-sm-2">-->
<!--//            </div>-->
<!--//        </div>-->
<!--//        <img src="http://q.qlogo.cn/qqapp/101381338/DBF7135BC86C14AE6B11BB42EFE847C6/40-->
<!--//" alt="第一个网名是啥来着" class="userlogo">-->
<!--//        <span>第一个网名是啥来着</span>-->
<!--//        <button type="button" class="btn btn-info com_btn" id="fir_btn">提交评论</button>-->
<!--//    </div>-->
<!--//-->
<!--//    <!--总评论回复-->-->
<!--//    <div class="--><?php //echo empty($comments)?"com_none":"com_con"?><!-- col-sm-12 com_rep">-->
<!--//        <h5>评论</h5>-->
<!--//        --><?php //foreach ($comments as $com):?>
<!--    <!--单个的评论与其回复的集合-->-->
<!--    <div  class="one_com col-sm-12">-->
<!--        <!--评论-->-->
<!--        <div class="col-sm-12 old_com" id="com_--><?php //echo $com['id'];?><!--">-->
<!--            <div class="col-sm-1">-->
<!--                <img src="http://q.qlogo.cn/qqapp/101381338/DBF7135BC86C14AE6B11BB42EFE847C6/40-->
<!--" alt="第一个网名是啥来着" class="userlogo">-->
<!--            </div>-->
<!--            <div class="col-sm-11 usermeg">-->
<!--                <div  class="col-sm-12">-->
<!--                    <span>第一个网名是啥来着</span>-->
<!--                    <span>2018-12-12</span>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-sm-11 content col-sm-offset-1">-->
<!--                --><?php //echo $com['content'];?>
<!--            </div>-->
<!--            <button type="button" class="btn btn-link reply_btn">回复</button>-->
<!--        </div>-->
<!--        <!--回复-->-->
<!--        --><?php //if(!empty($com['reply'])) :?>
<!--            <div class="col-sm-11 col-sm-offset-1">-->
<!--                --><?php //foreach ($com['reply'] as $reply):?>
<!--                    <div class="col-sm-12 one_rep">-->
<!--                        <div class="col-sm-1">-->
<!--                            <img src="http://q.qlogo.cn/qqapp/101381338/DBF7135BC86C14AE6B11BB42EFE847C6/40-->
<!--" alt="第一个网名是啥来着" class="userlogo">-->
<!--                        </div>-->
<!--                        <div class="col-sm-11 usermeg">-->
<!--                            <div  class="col-sm-12">-->
<!--                                <span>第一个网名是啥来着</span>-->
<!--                                <span>2018-12-12</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-sm-11 content col-sm-offset-1">-->
<!--                            --><?php //echo $reply['re_content'];?>
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?php //endforeach;?>
<!--            </div>-->
<!--        --><?php //endif;?>
<!--    </div>-->
<?php //endforeach;?>
<!--</div>-->
<!--</div>-->
<!---->
<!---->
<!--<script>-->
<!--    $('#fir_btn').click(-->
<!--        function () {-->
<!--            var mes = $('#fir_com').val();-->
<!--            $.ajax({-->
<!--                type: "POST",-->
<!--                url: "--><?php //echo \yii\helpers\Url::to(['comment/save'])?>//",
//                data: {'con':mes,'article_id':'<?php //echo $article->id;?>//'},
//                dataType:"json",
//                success: function(data){
//                    if(data.statue){
//                        $('.com_none').css('display','block'),
//                            $('.com_con').append("<div>"+data.con+"</div>"),
//                            $('#fir_com').val(''),
//                            layer.msg(data.message, {icon: 6});
//                    }else{
//                        layer.confirm(data.message, {icon: 4},function(index){
//                            layer.close(index),
//                                location.href = '<?php //echo  \yii\helpers\Url::to(['site/login'])?>//'
//                        });
//                    }
//                },
//                error:function(data){
//                    alert("评论失败，请稍后再试")
//                }
//            });
//        }
//    );
//
//    //回复按钮点击事件
//    $('.reply_btn').click(function () {
//        //取得要追加的未知的ID
//        var id = '#'+$(this).parent().attr('id');
//        //回复按钮暂时消失
//        var rep_cls = id + ' .reply_btn';
//        // $(rep_cls).text('取消回复').removeClass('reply_btn').addClass('cancle_reply').css('outline','none').css('color','#428bca').css('text-decoration','none').attr('id','cancle_reply');
//        $(rep_cls).remove();
//        $(id).append('<button type="button" class="btn btn-link cancle_reply" onclick="cancle_reply(this)">取消回复</button>')
//        //赋值评论框
//        $('#com_all').clone().appendTo(id);
//        //更改评论框的提交按钮
//        var rep_btn_id = id+' #com_all button';
//        $(rep_btn_id).attr('id','reply_btn_sub');
//    });
//
//    //取消回复事件
//    function cancle_reply(e) {
//        $(e).next("div").remove();
//        //删除取消回复 加上回复
//        var id = '#'+$(e).parent().attr('id');
//        $(e).remove();
//        $(id).append('<button type="button" class="btn btn-link reply_btn" onclick="com_reply(this)">回复</button>')
//    }
//
//    function com_reply(e) {
//        //取得要追加的未知的ID
//        var id = '#'+$(e).parent().attr('id');
//        //回复按钮暂时消失
//        var rep_cls = id + ' .reply_btn';
//        // $(rep_cls).text('取消回复').removeClass('reply_btn').addClass('cancle_reply').css('outline','none').css('color','#428bca').css('text-decoration','none').attr('id','cancle_reply');
//        $(rep_cls).remove();
//        $(id).append('<button type="button" class="btn btn-link cancle_reply" onclick="cancle_reply(this)">取消回复</button>');
//        //赋值评论框
//        $('#com_all').clone().appendTo(id);
//        //更改评论框的提交按钮
//        var rep_btn_id = id+' #com_all button';
//        $(rep_btn_id).attr('id','reply_btn_sub');
//
//    }
//
//</script>
