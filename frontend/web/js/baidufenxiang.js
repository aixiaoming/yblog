//百度分享
var $url=window.location.href;
window._bd_share_config = {
    "common": {
        "bdSnsKey": {},
        "bdText": "<? echo $article->title; ?>--<? echo \common\models\Website::find()->where(['englishtype'=>'site-title'])->one()->content?>",
        "bdMini": "2",
        "bdMiniList": false,
        "bdPic": "",
        "bdStyle": "0",
        "bdSize": "24",
        "bdUrl":$url,
    },
    "share": {},
    "image": {"viewList": ["qzone", "tsina", "tqq", "renren", "weixin"], "viewText": "分享到：", "viewSize": "16"},
    "selectShare": {"bdContainerClass": null, "bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin"]}
};
with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
