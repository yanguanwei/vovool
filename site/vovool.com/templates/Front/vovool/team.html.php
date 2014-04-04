<?php $this->extend('layouts/main.html.php');?>

<?php $stylesheets = $this->block('stylesheets')->start();?>
    <link href="<?php echo $this->asset('css/team.css');?>" rel="stylesheet" />
    <link href="<?php echo $this->asset('css/team_js.css');?>" rel="stylesheet" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo $this->asset('css/ie/team.css')?>" />
    <![endif]-->
<?php $stylesheets->end();?>

<?php $javascripts = $this->block('javascripts')->start();?>
    <script type="text/javascript" src="<?php echo $this->asset('js/lateral-eye.js')?>"></script>
    <script type="text/javascript" src="<?php echo $this->asset('js/jquery.jkey-1.1.js')?>"></script>
<?php $javascripts->end();?>

<?php $content = $this->block('content')->start()?>

    <div class="team_jx"></div>

    <div class="w_1200">
        <?php echo $this->render('sections/breadcrumbs.html.php');?>
        <Div class="team_top">
            <h2>Teams</h2>
        </Div>
    </div>

    <ul class="the-team clearfix" style="width:1135px;">
        <li>
            <figure id="eye_andor_baranyi" class="eye">Andor</figure>
            <strong class="name">Andor</strong>
        </li>
        <li>
            <figure id="eye_angela_borsan" class="eye">Angela</figure>
            <strong class="name">Angela</strong>
        </li>
        <li>
            <figure id="eye_attila_szasz" class="eye">Attila</figure>
            <strong class="name">Attila</strong>
        </li>
        <li>
            <figure id="eye_bogdan_haifa" class="eye">Bogdan</figure>
            <strong class="name">Bogdan</strong>
        </li>
        <li>
            <figure id="eye_bogdan_sala" class="eye">Bogdan</figure>
            <strong class="name">Bogdan</strong>
        </li>
        <li>
            <figure id="eye_bogdan_stanescu" class="eye">Bogdan</figure>
            <strong class="name">Bogdan</strong>
        </li>
        <li>
            <figure id="eye_bogus" class="eye">Bogus</figure>
            <strong class="name">Bogus</strong>
        </li>
        <li>
            <figure id="eye_botond_raduly" class="eye">Botond</figure>
            <strong class="name">Botond</strong>
        </li>
        <li>
            <figure id="eye_calin_tritean" class="eye">C&#259;lin</figure>
            <strong class="name">C&#259;lin</strong>
        </li>
        <li>
            <figure id="eye_ciprian_herman" class="eye">Ciprian</figure>
            <strong class="name">Ciprian</strong>
        </li>
        <li>
            <figure id="eye_ciprian_morar" class="eye">Ciprian</figure>
            <strong class="name">Ciprian</strong>
        </li>
        <li>
            <figure id="eye_cristian_cojita" class="eye">Cristian</figure>
            <strong class="name">Cristian</strong>
        </li>
        <li>
            <figure id="eye_mesaros" class="eye">Cristian</figure>
            <strong class="name">Cristian</strong>
        </li>
        <li>
            <figure id="eye_cristian_zdrobe" class="eye">Cristian</figure>
            <strong class="name">Cristian</strong>
        </li>
        <li>
            <figure id="eye_cristina_moldovan" class="eye">Cristina</figure>
            <strong class="name">Cristina</strong>
        </li>
        <li>
            <figure id="eye_csaba_tekse" class="eye">Csaba</figure>
            <strong class="name">Csaba</strong>
        </li>
        <li>
            <figure id="eye_dory_ciceu" class="eye">Doru</figure>
            <strong class="name">Doru</strong>
        </li>
        <li>
            <figure id="eye_dragos_bucevschi" class="eye">Drago&#537;</figure>
            <strong class="name">Drago&#537;</strong>
        </li>
        <li>
            <figure id="eye_erika_lacatus" class="eye">Erika</figure>
            <strong class="name">Erika</strong>
        </li>
        <li>
            <figure id="eye_filip_chereches" class="eye">Filip</figure>
            <strong class="name">Filip</strong>
        </li>
        <li>
            <figure id="eye_gabriel_lacatus" class="eye">Gabriel</figure>
            <strong class="name">Gabriel</strong>
        </li>

        <li>
            <figure id="eye_you" class="eye">You?</figure>
            <strong class="name">You?</strong>
        </li>
    </ul>

    <div class="w_1200">
        <div class="row-fluid">
            <div class="span6">
                <div class="team_center">
                    <h2>客户经理</h2>
                    <p>客户经理在整个合作过程中都会全程跟随，他们将全权代表我们为您处理商务合作商的问题，并调动内部资源为您服务。</p>
                    <img src="images/team_03.jpg">
                </div>
                <div class="team_center">
                    <h2>品牌顾问</h2>
                    <p>国内最优秀的网站设计公司之一，拥有丰富的品牌顾问资源与服务经验。品牌顾问通过品牌分析，对比以及原油的品牌资源规范的导入，保证了我们为您提供的网络数字化产品符合您的整体品牌形象与品牌战略

                        。</p>
                    <img src="images/team_10.jpg">
                </div>
                <div class="team_center">
                    <h2>信息架构与产品设计顾问</h2>
                    <p>我们的信息架构师是整个网站设计、开发项目的核心，拥有丰富的技术、视觉、品牌知识和经验。从技术实施的层面对整个系统与项目进行规划和要求，配合客户经理与您沟通需求并整理、设计成框架性产品从而指导整个项目团队的开发进程。</p>
                    <img src="images/team_14.jpg">
                </div>

            </div>

            <div class="span6">
                <div class="team_center">
                    <h2>交互设计师</h2>
                    <p>我们认为网络真正建立的是人与人之间的沟通，我们的交互设计师通过广泛的用户研究以及自身的创造力从功能和视觉上给予网站良好的互动性，有效的提升网站的使用价值</p>
                    <img src="images/team_06.jpg">
                </div>
                <div class="team_center">
                    <h2>视觉设计师</h2>
                    <p>在IA与交互设计师共同完成了一个网站的骨骼后，界面视觉设计师将用自己的专业与创造力赋予网站的血肉与灵魂，他们为您完成最终视觉的表现与创意，让网站具有非凡的视觉感受，并在VI与策略指导下最终让整个网站创造地延续您的品牌。</p>
                    <img src="images/team_11.jpg">
                </div>
                <div class="team_center">
                    <h2>前端技术工程师</h2>
                    <p>精通各种WEB前端技术，在视觉设计部分完成后，前端技术工程师结合XHTML、Javascript、Ajax、Flash等各种技术将视觉实现成可视化的具有交互功能的网站页面，并保证我们为客户提供网站兼容各种浏览器使用，符合W3C国际标准。</p>
                    <img src="images/team_15.jpg">
                </div>
                <div class="team_center">
                    <h2>技术开发工程师</h2>
                    <p>他们是真正的幕后英雄，像武侠小说里的大侠，悄无声息地使用高超技艺为您事先了数据库设计，程序与功能开发，为您最终提供一套优秀的管理系统程序来让您轻松简易地对网站实现信息管理并让新生的网站在您的服务器上健壮地奔跑。</p>
                    <img src="images/team_18.jpg">
                </div>
            </div>

        </div>
    </div>
<?php $content->end();?>