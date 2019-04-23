<div id="main">
    <div id="soutab">
    </div>
    <!-- /header -->
    <div id="container">
        <nav id="mbx">当前位置: <a href="javascript:void(0);" onclick="window.history.go(-1);">返回</a> &gt; <a href="/?type={$info.type}">{$headernav[$info['type']]}</a></nav>
        <article class="content">
            <header class="contenttitle">
                <a href="javascript:;" class="count"></a>
                <div class="mscc">
                    <h1 class="mscctitle"> 
                        <a>{$info.title}</a></h1>
                    <address class="msccaddress ">
                        <time>{$info.c_time}</time> 
                    </address>
                </div>
            </header>
            <div class="content-text">
                {$info.content|raw}
            </div>
            <!--content_text-->
        </article>
        <!--content-->
        <div  class='button_to_top'>
            <button>返回顶部</button>
        </div>
        <!--百度分享-->
        <?php if (!checkWap()): ?>
            <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
            <script>
                window._bd_share_config = {"common": {"bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "1", "bdSize": "24"}, "share": {}};
                with (document)
                    0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = '/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
            </script>
        <?php endif; ?>
        <div class="comment" id="comments">
            <!--这里填写第三方评论代码-->
        </div>
        <!-- .nav-single -->
    </div>
    <!--Container End-->
    {include file="public_aside"}
    <!-- /right -->
    <div class="clear"></div>
</div>
<!--main-->
<script>
    $(function () {
        $('.button_to_top').click(function () {
            $('html,body').animate({scrollTop: '0px'}, 700);
        });
    });
</script>