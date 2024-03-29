<?php
$this->extend('layouts/base.html.php');
?>

<?php $stylesheets = $this->block('stylesheets')->start();?>
<script src="<?php echo $this->asset('/js/ace-extra.min.js')?>"></script>
<?php $stylesheets->end();?>

<?php $javascript = $this->block('javascripts')->start(-10);?>
<script src="<?php echo $this->asset('/js/ace-elements.min.js')?>"></script>
<script src="<?php echo $this->asset('/js/ace.min.js');?>"></script>
<?php $javascript->end();?>

<?php
$body = $this->block('body')->start();
?>
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="navbar-container" id="navbar-container">
    <div class="navbar-header pull-left">
        <a href="<?php echo $this->url('admin');?>"><img src="<?php echo $this->asset('//Admin/images/logo.png');?>" /></a>
        <!--<a href="#" class="navbar-brand">
            <small><i class="icon-leaf"></i> Ace Admin</small>

        </a>--><!-- /.brand -->
    </div>
    <!-- /.navbar-header -->

    <div class="navbar-header pull-right" role="navigation">
        <ul class="nav ace-nav">

<li class="light-blue">
    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
        <img class="nav-user-photo" src="<?php echo $this->asset('/avatars/user.jpg');?>" alt="Jason's Photo"/>
								<span class="user-info">
									<small><?php echo $this->translate('Welcome,')?></small>
									<?php echo $this->user()->getUserName();?>
								</span>

        <i class="icon-caret-down"></i>
    </a>

    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

        <li>
            <a href="<?php echo $this->url('admin-user-password');?>">
                <i class="icon-key"></i>
                修改密码
            </a>
        </li>

        <li class="divider"></li>

        <li>
            <a href="<?php echo $this->url('admin-logout')?>">
                <i class="icon-off"></i>
                退出
            </a>
        </li>
    </ul>
</li>
</ul>
<!-- /.ace-nav -->
</div>
<!-- /.navbar-header -->
</div>
<!-- /.container -->
</div>

<div class="main-container" id="main-container">
<script type="text/javascript">
    try {
        ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
</script>

<div class="main-container-inner">
<a class="menu-toggler" id="menu-toggler" href="#">
    <span class="menu-text"></span>
</a>

<div class="sidebar" id="sidebar">
<script type="text/javascript">
    try {
        ace.settings.check('sidebar', 'fixed')
    } catch (e) {
    }
</script>

<div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
        <button class="btn btn-success">
            <i class="icon-signal"></i>
        </button>

        <button class="btn btn-info">
            <i class="icon-pencil"></i>
        </button>

        <a class="btn btn-warning" href="<?php echo $this->url('admin-user');?>">
            <i class="icon-group"></i>
        </a>

        <a class="btn btn-danger" href="<?php echo $this->url('admin-settings');?>">
            <i class="icon-cogs"></i>
        </a>
    </div>

    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
        <span class="btn btn-success"></span>

        <span class="btn btn-info"></span>

        <span class="btn btn-warning"></span>

        <span class="btn btn-danger"></span>
    </div>
</div>
<!-- #sidebar-shortcuts -->
<?php echo $this->block('ace-sidebar');?>
<!-- /.nav-list -->

<div class="sidebar-collapse" id="sidebar-collapse">
    <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
</div>

<script type="text/javascript">
    try {
        ace.settings.check('sidebar', 'collapsed')
    } catch (e) {
    }
</script>
</div>

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try {
                ace.settings.check('breadcrumbs', 'fixed')
            } catch (e) {
            }
        </script>

        <?php echo $this->block('ace-breadcrumbs')?>

        <!-- #nav-search -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <div class="pull-right" style="margin-right: 10%;">
                <?php
                $subMenus = array();
                if ($this->menu->getOption('submenu', false) && $this->menu->isAccessible()) {
                    foreach ($this->menu->getSubMenus() as $name => $menu) {
                        if (!$menu->getOption('is_submenu', false) || !$menu->isAccessible()) {
                            continue;
                        }
                        $subMenus[$name] = array(
                            'url' => $this->replace_url($name),
                            'label' => $menu->getLabel()
                        );
                    }
                }

                $subMenus = array_merge($subMenus, $this->get('submenus', array()));
                if ($subMenus) {
                    echo '<ul class="nav nav-pills">';
                    foreach ($subMenus as $menuInfo) {
                        echo sprintf('<li><a href="%s">%s</a></li>', $menuInfo['url'], $menuInfo['label']);
                    }
                    echo '</ul>';
                }
                ?>
            </div>

            <h1 style="margin-top: 5px;">
                <?php
                $subtitle = $this->has('subtitle') ? $this->subtitle : $this->translate($this->menu()->getLabel());
                if ($subtitle) {
                    if (is_string($subtitle)) {
                        echo $subtitle;
                    } else if (is_array($subtitle)) {
                        echo array_shift($subtitle);
                        foreach ($subtitle as $title) {
                            echo '<small><i class="icon-double-angle-right"></i> '.$title.'</small>';
                        }
                    }
                }
                ?>
            </h1>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php $this->render('messages.html.php');?>
                <?php echo $this->block('content', $this->get('content'));?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.page-content -->
</div>
<!-- /.main-content -->

<div class="ace-settings-container" id="ace-settings-container">
    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
        <i class="icon-cog bigger-150"></i>
    </div>

    <div class="ace-settings-box" id="ace-settings-box">
        <div>
            <div class="pull-left">
                <select id="skin-colorpicker" class="hide">
                    <option data-skin="default" value="#438EB9">#438EB9</option>
                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                </select>
            </div>
            <span>&nbsp; Choose Skin</span>
        </div>

        <div>
            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar"/>
            <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
        </div>

        <div>
            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar"/>
            <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
        </div>

        <div>
            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs"/>
            <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
        </div>

        <div>
            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl"/>
            <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
        </div>

        <div>
            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container"/>
            <label class="lbl" for="ace-settings-add-container">
                Inside
                <b>.container</b>
            </label>
        </div>
    </div>
</div>
<!-- /#ace-settings-container -->
</div>
<!-- /.main-container-inner -->

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>
</div><!-- /.main-container -->
<?php
$body->end();
?>