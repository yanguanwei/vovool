<?php
$this->extend('layouts/html.php@Kernel');
$this->block('title')->add('宁波网站建设 | 宁波网页设计 | 企业网站制作 | 网络营销专家-沃喔科技', 2);
?>

<?php $head = $this->block('head')->start(); ?>
<base href="<?php echo $this->asset('');?>" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv=X-UA-Compatible content=IE=EmulateIE8 />
<meta name="description" content="网站建设、网站制作、网站优化专家宁波高新区沃喔网络科技有限公司，为您提供专业的企业网站建设，B2B门户开发，B2C商
城开发，软件系统开发，网络营销解决方案。公司业务涉及慈溪，余姚，象山等地区，咨询热线0574-27900053" />
<meta name="keywords" content="宁波网站建设,宁波网页设计,宁波网站制作,宁波网站优化,慈溪网站建设,余姚网站建设,沃喔科技" />
<?php $head->end();?>

<?php $stylesheets = $this->block('stylesheets')->start(-1);?>
<!-- 基本样式 -->
<link href="<?php echo $this->asset('css/bootstrap.css');?>" rel="stylesheet" />
<link href="<?php echo $this->asset('css/bootstrap-responsive.css');?>" rel="stylesheet" />
<!-- 基本样式 -->
<link href="<?php echo $this->asset('css/top.css');?>" rel="stylesheet" />
<link href="<?php echo $this->asset('css/foot.css');?>" rel="stylesheet" />
<?php $stylesheets->end();?>

<?php $javascripts = $this->block('javascripts')->start(-1);?>
    <!-- JavaScript和压缩后的版本 -->
    <script type="text/javascript" src="<?php echo $this->asset('js/respond.src.js');?>"></script>
    <script src="<?php echo $this->asset('js/jquery-1.7.2.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo $this->asset('js/scrolltopcontrol.js');?>"></script>
    <script type="text/javascript" src="<?php echo $this->asset('js/bootstrap.js');?>"></script>
<?php $javascripts->end();?>

<?php $body = $this->block('body')->start();?>

<div class="w_1200">
    <div class="header clearfix">
        <div class="logo2">
            <A href="<?php echo $this->url('home');?>"><img src="<?php echo $this->asset('images/logo.jpg');?>" /></A>
        </div>
        <div class="nav_main nav-right">
            <ul class="clearfix w-450">

                <li class="clearfix">
                    <div class="nav_li_er">
                        <h2 class="nav_t_bz">我们是谁</h2>
                        <a href="<?php echo $this->url('about');?>" class="nav_b_t">关于</a>
                    </div>
                    <div class="nav_fenge">/</div>
                </li>

                <li class="clearfix">
                    <div class="nav_li_er">
                        <h2 class="nav_t_bz">我们拥有什么</h2>
                        <a href="<?php echo $this->url('team');?>" class="nav_b_t">团队</a>
                    </div>
                    <div class="nav_fenge">/</div>
                </li>

                <li class="clearfix">
                    <div class="nav_li_er">
                        <h2 class="nav_t_bz">我们的服务</h2>
                        <a href="<?php echo $this->url('solution');?>" class="nav_b_t">方案</a>
                    </div>
                    <div class="nav_fenge">/</div>
                </li>

                <li class="clearfix">
                    <div class="nav_li_er">
                        <h2 class="nav_t_bz">我们做过什么</h2>
                        <a href="<?php echo $this->url('case');?>" class="nav_b_t">案例</a>
                    </div>
                    <div class="nav_fenge">/</div>
                </li>

                <li class="clearfix">
                    <div class="nav_li_er">
                        <h2 class="nav_t_bz">行业的动态</h2>
                        <a href="<?php echo $this->url('news');?>" class="nav_b_t">新闻</a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="navbar">
            <div class="navbar-inner">
                <a href="javascript:;" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="javascript:;">导航栏</a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li class="active"><a href="<?php echo $this->url('home');?>">首页</a></li>
                        <li><a href="<?php echo $this->url('about');?>">关于（我们是谁）</a></li>
                        <li><a href="<?php echo $this->url('team');?>">团队（我们拥有什么）</a></li>
                        <li><a href="<?php echo $this->url('solution');?>">方案（我们的服务）</a></li>
                        <li><a href="<?php echo $this->url('case');?>">案例（我做过什么）</a></li>
                        <li><a href="<?php echo $this->url('news');?>">新闻（行业动态）</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="logo">
            <a href="<?php echo $this->url('home');?>"><img src="<?php echo $this->asset("images/logo.jpg");?>" /></a>
        </div>
    </div>
</div>

<?php echo $this->block('content', $this->get('content'));?>

<div class="footer w_1200">
    <div class="row-fluid ">
        <div class="span8">
            <div class="row-fluid foot-nav">
                <ul class="span3">
                    <li><a href="/solutions">Server 服务</a></li>
                    <li><a href="/solutions">V祥云平台</a></li>
                    <li><a href="#">V祥云定制</a></li>
                    <li><a href="/solutions">V软开发</a></li>
                    <li><a href="/solutions">宣传册设计</a></li>
                    <li><a href="/solutions">Google推广</a></li>
                    <li><a href="/solutions">专业SEO优化</a></li>
                    <li><a href="/solutions">企业邮箱</a></li>
                   <li><a href="/solutions">APP开发</a></li>
                </ul>
                <ul class="span3">
                    <li><a href="/about">About 了解沃喔</a></li>
                    <li><a href="/about">关于沃喔</a></li>
                    <li><a href="/about">沃喔价值观</a></li>
                    <li><a href="/news">新闻资讯</a></li>
                    <li><a href="/team">团队力量</a></li>
                    <li><a href="/about">加入我们</a></li>
                    <li><a href="/about">联系我们</a></li>
                </ul>
                <ul class="span3">
                    <li><a href="#">其他项目</a></li>
                </ul>
            </div>
            <div class="foot_link">
                <p>Copyright ©http://www.vovool.com/ 浙ICP备13029598号-1 祥云平台</p>
                <p>友情链接&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.vovool.com">沃喔科技</a>&nbsp;<a href="http://www.vovool.com">宁波网站建设</a>&nbsp;<a href="http://www.vovool.com">宁波网页设计</a>&nbsp;<a href="http://www.vovool.com">宁波网站优化</a>&nbsp;<a href="http://www.vovool.com">余姚网站建设</a>&nbsp;<a href="http://www.vovool.com">慈溪网站建设</a>&nbsp;<a href="http://www.sjzkfd.com">杭州网站建设</a>&nbsp;<a href="http://pm.wishtech.com.cn">工程项目管理软件</a>&nbsp;<a href="http://www.xk97.com/">深圳网站建设</a>&nbsp;<a href="http://www.sc7.com">速成网</a>&nbsp;<a href="http://www.kejiaoy.com/">科教云平台</a>&nbsp;<a href="http://www.suntonstyle.com/">株洲网络推广</a></p>
                </div>
        </div>

        <div class="span4 foot-right">
            <div class="f-r-1">
                <div class="news-index-list">
                    <h4>新闻前沿<small> / The News Front</small></h4>
                </div>
                <ul>
                    <?php
                    $archives = $this->entity_query('archive')->inTopChannel('news')->filterEntityCode('news')->published()->recommended()->recently(4)->all();
                    foreach ($archives as $archive) {
                        echo <<<code
<li><a href="{$this->url('news-view', array('archive' => $archive))}">{$archive->title}</a></li>
code;

                    }
                    ?>
                </ul>
            </div>
            <div class="f-r-1">
                <div class="contact-index-list">
                    <h4>联系方式<small> / The Contact</small></h4>
                </div>
                <ul>
               	  <li>地址：宁波市高新区江南路598号九五国际A幢335 </li>
                  <li>邮编：315040</li>
               	  <li>电话：0574-27900053</li>
                  <li>传真：0574-27900051</li>
                  <li>网址：<a href="http://www.vovool.com/">http://www.vovool.com/</a></li>
                  <li>人才招聘：<a href="mailto:servers@vovool.com">servers@vovool.com</a></li>
              </ul>
            </div>
        </div>
    </div>
</div>

<?php $body->end();?>