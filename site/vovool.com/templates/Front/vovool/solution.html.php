<?php $this->extend('layouts/main.html.php');?>

<?php $stylesheets = $this->block('stylesheets')->start();?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->asset('css/fangan.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->asset('css/page.css');?>" />
    <link media="screen and (max-width: 768px)" rel="stylesheet" type="text/css" href="<?php echo $this->asset('css/page_phone.css');?>" />
    <link href="<?php echo $this->asset('css/page_minpc.css');?>" type="text/css" rel="stylesheet" media="(min-width: 768px) and (max-width: 1199px)"/>
    <style type="text/css">
        .clearfix:after{content: " ";display:block;clear: both;height: 0;line-height: 0;visibility: hidden;}
        .clearfix{display: inline-block;}
        .clearfix{display: block;}
    </style>
<?php $stylesheets->end();?>

<?php $javascripts = $this->block('javascripts')->start();?>
    <script type="text/javascript">
        $(document).ready(function(){

            var f_main_nav=$("#f_main_nav");
            var f_main_con=$("#f_main_con");

            f_main_nav.find("li").each(function(index){
                $(this).click(function(){
                    if(f_main_con.find("li").eq(index).css("display")=="none"){
                        f_main_con.find("li").fadeOut("fast").eq(index).fadeIn("fast");
                        f_main_nav.find("span").fadeOut("fast").eq(index).fadeIn("fast");
                    }else{
                        f_main_con.find("li").fadeOut("fast").eq(index).fadeOut("fast");
                        f_main_nav.find("span").fadeOut("fast").eq(index).fadeOut("fast");
                    }
                });
            });
            f_main_con.find("a").click(function(){
                $(this).parent().fadeOut("fast");
                f_main_nav.find("span").fadeOut("fast");
            });
        });

        var formErrors = '<?php echo implode('\n', $this->form->errors());?>';
        if (formErrors) {
            alert(formErrors);
        }

        var formSubmittedText = '<?php echo $this->submitted ? '您的需求已提交，我们会尽快回复您。感谢你的支持！' : ''?>';
        if (formSubmittedText) {
            alert(formSubmittedText);
        }
    </script>
<?php $javascripts->end();?>

<?php $content = $this->block('content')->start();?>
    <div class="team_jx"></div>

    <div class="w_1200">
        <?php echo $this->render('sections/breadcrumbs.html.php');?>
        <Div class="scheme_top">
            <h2>scheme</h2>
        </Div>
    </div>

    <div class="w_1200">
        <!--桌面端 -->
        <div class="warp">

            <div id="f_main_nav" class="f_main_nav">
                <ul class="clearfix">
                    <li class="fm1">
                        <p class="fm_info">V祥云平台</p>
                        <span>&nbsp;</span>
                    </li>
                    <li class="fm2">
                        <p class="fm_info">V定制网站</p>
                        <span>&nbsp;</span>
                    </li>
                    <li class="fm3">
                        <p class="fm_info">V软开发</p>
                        <span>&nbsp;</span>
                    </li>
                    <li class="fm4">
                        <p class="fm_info">宣传册设计</p>
                        <span>&nbsp;</span>
                    </li>
                    <li class="fm5">
                        <p class="fm_info">Google推广</p>
                        <span>&nbsp;</span>
                    </li>
                    <li class="fm6">
                        <p class="fm_info">SEO优化</p>
                        <span>&nbsp;</span>
                    </li>
                    <li class="fm7">
                        <p class="fm_info">企业邮箱</p>
                        <span>&nbsp;</span>
                    </li>
                    <li class="fm8">
                        <p class="fm_info">APP开发</p>
                        <span>&nbsp;</span>
                    </li>
                </ul>
            </div>

            <div id="f_main_con" class="f_main_con">
                <ul>
                    <li class="fmc1">
                        <a class="dc_close" title="关闭" href="javascript:void(0);">关闭</a>
                        <div class="fmc_info">
                            <strong>V祥云平台</strong>
                            <p>V祥云平台是基于云计算和搜索引擎技术（SEO）架构为支撑推出的新一代内容管理系统（CMS），整合了企业建站、搜索引擎优化、WAP网站、微博营销、行业网站、日常应用、客户资源分析、站点监测等功能的一站式互联网服务系统。系统拥有独立的知识产权商标（祥云平台®）并获得国家版权中心软件著作权认证。</p>
                        </div>
                    </li>
                    <li class="fmc2">
                        <a class="dr_close" title="关闭" href="javascript:void(0);">关闭</a>
                        <div class="fmc_info">
                            <strong>V定制(多屏融合响应式网站)</strong>
                            <p>兼容所有的终端访问的一站式解决方案</p>
                            <p>所谓响应式网页设计，指可以自动识别屏幕宽度、并做出相应调整的网页设计。简单来说就是同一张网页自动适应不同大小的屏幕，根据屏幕宽度，自动调整布局。</p>
                            <p>HTML5 & CSS3
                                采用了最新的网页设计技术，建立专业网站，兼容pc,安卓 ,iphone更各种终端，适合各种大小界面的屏幕。</p>

                        </div>
                    </li>
                    <li class="fmc3">
                        <a class="de_close" title="关闭" href="javascript:void(0);">关闭</a>
                        <div class="fmc_info">
                            <strong>V软开发</strong>
                            <p>关联ipa，在各大网站点击iTools的ipa一键安装按钮，或者直接在电脑中双击ipa文件就能将其安装到您的设备。</p>
                        </div>
                    </li>
                    <li class="fmc4">
                        <a class="df_close" title="关闭" href="javascript:void(0);">关闭</a>
                        <div class="fmc_info">
                            <strong>宣传册设计</strong>
                            <p>平面设计师依据客户的企业文化，市场推广策略合理安排画册（印刷品）画面的三大构成关系和画面元素的视觉关系使达到企业品牌和产品广而告之的目的。</p>
                        </div>
                    </li>
                    <li class="fmc5">
                        <a class="dx_close" title="关闭" href="javascript:void(0);">关闭</a>
                        <div class="fmc_info">
                            <strong>　　Google推广</strong>
                            <p>谷歌广告也叫Google AdWords</p>
                            <p>AdWords是一种在Google搜索结果页展示的按点击付费的关键字广告。 当您的潜在客户通过一定的关键字进行搜索时，您的广告将展示在搜索页右侧，如下图所示。您可能已经注意到，在搜索页面的左上方也有“赞助商链接”。这是因为这两个广告的平均点击率很高（质量得分很高），作为奖励，我们的系统将它们放置在这个更显眼的特殊位置。</p>
                        </div>
                    </li>
                    <li class="fmc7">
                        <a class="app_close" title="关闭" href="javascript:void(0);">关闭</a>
                        <div class="fmc_info">
                            <strong>SEO优化</strong>
                            <p>SEO（Search Engine Optimization），汉译为搜索引擎优化。seo搜索引擎优化是一种利用搜索引擎的搜索规则来提高目的网站在有关搜索引擎内的排名的方式。SEO目的理解是：为网站提供生态式的自我营销解决方案，让网站在行业内占据领先地位，从而获得品牌收益。SEO包含站外SEO和站内SEO两方面。</p>
                        </div>
                    </li>
                    <li class="fmc6">
                        <a class="clear_close" title="关闭" href="javascript:void(0);">关闭</a>
                        <div class="fmc_info">
                            <strong>企业邮箱</strong>
                            <p>企业邮箱是指以您的域名作为后缀的电子邮件地址。通常一个企业经常有多个员工要使用电子邮件，企业电子邮局可以让集团邮局管理员任意开设不同名字的邮箱，并根据不同的需求设定邮箱的空间，而且可以随时关闭或者删除这些邮箱。</p>
                        </div>
                    </li>
                    <li class="fmc8">
                        <a class="share_close" title="关闭" href="javascript:void(0);">关闭</a>
                        <div class="fmc_info"><strong>APP开发</strong>
                            <p>iOS软件开发 iPhone软件开发 iPad应用开发</p>
                            <p>
                                Android软件开发

                                Android(安卓)手机软件开发
                                Android平板软件开发
                            </p>
                            <p>
                                WP软件开发

                                Windows Phone软件开发
                                Windows平板软件开发
                            </p>
                            <p>
                                Html5开发

                                Html5手机网站建设
                                Html5程序开发
                            </p>
                            <p>
                                App应用推广

                                iOS软件推广
                                Android应用推广
                            </p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
        <!--手机端 -->
    </div>
    <div class="w_1200 biaodan">
        <form action="" method="post">
        <h1 class="page-header">在线需求 <small>Online demand</small></h1>
        <table class="table">
            <thead>
            <tr>
                <td><label for="username">姓名</label>


                </td>
                <td>
                    <input id="name" name="<?php echo $this->form->inputName('name')?>" type="text" class="span3" placeholder="请输入您的姓名">
                </td>
                <td><label for="email">邮箱</label></td>
                <td><input id="email" name="<?php echo $this->form->inputName('email')?>" type="text" class="span3" placeholder="请输入您的邮箱"></td>
            </tr>
            </thead>
            <tr>
                <th><label for="phone">电话</label>
                </th>
                <th>
                    <input id="phone" name="<?php echo $this->form->inputName('phone')?>" type="text" class="span3" placeholder="请尽量输入移动电话">
                </th>
                <td><label for="qq">在线联系</label></td>
                <td><input id="qq" name="<?php echo $this->form->inputName('qq')?>" type="text" class="span3" placeholder="请输入您的QQ号或者MSN"></td>
            </tr>
            <tr>
                <td><label>目的</label></td>
                <td colspan="3">
                    <?php
                    foreach ($this->intentions as $intention) {
                        echo sprintf(
                            '<label class="radio"><input name="%s" type="radio" value="%s">%s</label>',
                            $this->form->inputName('intention_id'),
                            $intention->getId(), $intention->getLabel()
                        );
                    }
                    ?>
            </tr>

            <tr>
                <td colspan="4"><label class="control-label" for="content">需求说明</label></td>
            </tr>
            <tr>
                <td colspan="4"><textarea class="input-xxxlarge" id="content" rows="5" name="<?php echo $this->form->inputName('content');?>"></textarea></td>

            </tr>
        </table>
        <button type="submit" class="tijiao">提交完成</button>
        </form>
    </div>

<?php $content->end();?>