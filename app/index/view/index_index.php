<link type="text/css" href="/src/blog/css/jcarousel.css?v=1.08" rel="stylesheet" />
<script type="text/javascript" src="/src/blog/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="/src/blog/js/jquery.pikachoose.min.js"></script>
<script type="text/javascript" src="/src/blog/js/jquery.touchwipe.min.js"></script>
<div id="main">
    <div id="soutab">
    </div>
    <!-- /header -->
    <div id="container">
        <?php if ($tops): ?>
            <div class="pikachoose ">
                <div class="showthispika">
                    <ul id="pikame" class="jcarousel-skin-pika">
                        {foreach $tops as $key=>$vo } 
                        <li>
                            <a href="{:url('info/'.$vo['id'])}">
                                <img src="{$vo.img}"/>
                            </a>
                            <span>{$vo.title}</span>
                        </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        {foreach $list as $key=>$vo } 
        <section class="list">
            <?php if ($vo['img']): ?>
                <span class="titleimg">
                    <a href="{:url('info/'.$vo['id'])}">
                        <img width="270" height="165" src="/src/blog/image/default.png" data-original="{$vo.img|default='/src/blog/image/default.png'}" class="attachment-thumbnail wp-post-image" />
                    </a>
                </span>
            <?php endif; ?>
            <div class="mecc">
                <h2 class="mecctitle">
                    <a href="{:url('info/'.$vo['id'])}">{$vo.title}</a> </h2>
                <address class="meccaddress">
                    <time>{$vo.c_time}</time>
                    <a href='/?type={$vo.type}'>{$headernav[$vo['type']]}</a>
                </address>
                <a href="{:url('info/'.$vo['id'])}">
                    <p>
                        <?php echo $vo['desc'] ? htmlspecialchars_decode($vo['desc']) : '暂无简介'; ?>...
                        [查看全文]
                    </p>
                    <div class="readmore">
                        <a class="me_articleItem_readMore" href="{:url('info/'.$vo['id'])}">
                            Read More –&gt;
                        </a>
                    </div>
                </a>
            </div>
            <div class="clear"></div>
        </section>
        {/foreach} 
        <div class="clear"></div>
        <!-- page start -->
        <div class="pageshow">
            {$page|raw}
        </div>
        <!-- page end -->
    </div>
    <!--Container-->
    {include file="public_aside"}
    <!-- /right -->
    <div class="clear"></div>
</div>
<!--main-->
<!--内容结束-->
<script>
    $(function () {
        setTimeout(function () {
            $('.showthispika').fadeIn('slow');
//            $('.pikachoose').removeClass('pikaloadimg');
        }, 100);
        $("#pikame").PikaChoose({carousel: true, carouselVertical: true});
    });
</script>
