<?php $this->extend('layouts/main.html.php');?>

<?php $stylesheets = $this->block('stylesheets')->start();?>
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo $this->asset('css/ie/main-ie.css');?>" />
    <![endif]-->
<link href="<?php echo $this->asset('css/index.css');?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo $this->asset('css/colorbox.css')?>" />
<?php $stylesheets->end();?>
<?php $javascripts = $this->block('javascripts')->start();?>
    <script src="<?php echo $this->asset('js/jquery.colorbox.js');?>"></script>
    <script>
        $(document).ready(function(){
            //Examples of how to assign the Colorbox event to elements
            $(".group1").colorbox({rel:'group1'});
            $(".group2").colorbox({rel:'group2', transition:"fade"});
            $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
            $(".group4").colorbox({rel:'group4', slideshow:true});
            $(".ajax").colorbox();
            $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
            $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
            $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
            $(".inline").colorbox({inline:true, width:"50%"});
            $(".callbacks").colorbox({
                onOpen:function(){ alert('onOpen: colorbox is about to open'); },
                onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
                onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
                onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
                onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
            });

            $('.non-retina').colorbox({rel:'group5', transition:'none'})
            $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});

            //Example of preserving a JavaScript event for inline calls.
            $("#click").click(function(){
                $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                return false;
            });
        });
    </script>
<?php $javascripts->end();?>

<?php $content = $this->block('content')->start()?>

    <div class="w_1200 banner">
        <div class="container-fluid">
            <div id="carousel1" class="carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                        <a href="<?php echo $this->url('solution');?>"><img src="<?php echo $this->asset("images/banner1.jpg");?>" alt=""></a>
                        <div class="carousel-caption">
                            <h4>个性定制网站</h4>
                            <p>Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>

                    <div class="item">
                        <a href="<?php echo $this->url('solution');?>"><img src="<?php echo $this->asset("images/banner2.jpg");?>" alt=""></a>
                        <div class="carousel-caption">
                            <h4>画册设计</h4>
                            <p> Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>

                    <div class="item">
                        <a href="<?php echo $this->url('solution');?>"><img src="<?php echo $this->asset("images/banner3.jpg");?>" alt=""></a>
                        <div class="carousel-caption">
                            <h4>OA办公系统开发</h4>
                            <p>Egestas eget quam. Donec id elit non mi porta gravida at eget metus. </p>
                        </div>
                    </div>
                </div>
                <a href="#carousel1" data-slide="prev" class="left carousel-control top50">‹</a>
                <a href="#carousel1" data-slide="next" class="right carousel-control top50">›</a>
            </div>


        </div>
    </div>

    <div class="w_1200 clearfix">

        <div class="news-index">
            <div class="container-fluid">
                网站建设、网站优化推广、系统开发，沃喔科技您身边的网络营销专家！ 始终致力于为中小企业提供网络营销解决方案，开发了基于“云平台”的信息化服务模式，并定义为“祥云平台”，以网站建设为切入点，向成长型企业提供域名服务、网站设计、网站制作、企业邮箱、网络推广等一站式信息化整体解决方案。其主要产品“V祥云平台”、“V定制”、“V软开发”“专业设计”、“优化推广”。沃喔科技专注于客户服务，全面推出了面向客户的服务品质承诺——服务水平协议（Service Level Agreement），为客户创造价值。
            </div>
        </div>

        <div class="case clearfix">
            <div class="case-head">
                <h1>案例前沿<small> / The Case Front</small></h1>
            </div>
            <div class="row-fluid case-center">
                <?php
                $i = 0;
                foreach ($this->cases as $case) {
                    echo <<<code
<div class="span6 row-fluid">
                    <div class="span6">
                        <a title="{$case->title}" class="group3" href="{$this->uploaded_asset($case->cover)}"><img src="{$this->uploaded_asset($case->cover, 366, 255)}"></a>
                    </div>
                    <div class="span6 case-li-t">
                        <h2>{$case->title}</h2>
                        <div class="case-li-p">
                        <p>{$case->description}</p>
                        </div>
                    </div>
                </div>
code;
                    $i++;
                    if ($i % 2 == 0) {
                        echo '</div><div class="row-fluid case-center">';
                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php $content->end();?>