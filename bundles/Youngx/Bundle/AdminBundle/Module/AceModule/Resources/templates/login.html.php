<?php $this->extend('layouts/base.html.php');?>

<?php $this->block('body-class', 'login-layout'); ?>

<?php $body = $this->block('body')->start();?>
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1" >
                <div class="login-container">
                    <div class="center">
                        <h1 style=" padding: 5px 0;">
                            <img src="<?php echo $this->asset('//Admin/images/logo.png');?>" />
                            <span class="white">沃喔网络</span>
                        </h1>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative" style="height: 340px;">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="icon-coffee green"></i>
                                        欢迎使用，请登录
                                    </h4>

                                    <div class="space-6"></div>

                                    <?php $this->render('messages.html.php');?>
                                    <?php
                                    $username =  $this->form->getField('username');
                                    $password =  $this->form->getField('password');
                                    $rememberMe =  $this->form->getField('rememberMe');
                                    ?>
                                    <?php $form = $this->form_widget($this->form, 'ace')->start();?>
                                        <fieldset>
                                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="<?php echo $this->translate('Username')?>" name="<?php echo $username->inputName();?>" value="<?php echo $username->value()?>" />
                                    <i class="icon-user"></i>
                                </span>
                                            </label>

                                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="password" class="form-control" placeholder="<?php echo $this->translate('Password')?>" name="<?php echo $password->inputName();?>" />
                                    <i class="icon-lock"></i>
                                </span>
                                            </label>

                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <label class="inline">
                                                    <input type="checkbox" class="ace" name="<?php echo $rememberMe->inputName();?>" <?php echo $rememberMe->value() ? 'checked="checked"' : '';?> />
                                                    <span class="lbl"> <?php echo $this->translate('Remember Me');?></span>
                                                </label>

                                                <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="icon-key"></i>
                                                    <?php echo $this->translate('Login');?>
                                                </button>
                                            </div>

                                            <div class="space-4"></div>
                                        </fieldset>
                                    <?php echo $form->end();?>

                                </div><!-- /widget-main -->

                                <div class="toolbar clearfix">
                                    <div>
                                        <a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
                                            <i class="icon-arrow-left"></i>
                                            忘记密码？
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /widget-body -->
                        </div><!-- /login-box -->

                        <div id="forgot-box" class="forgot-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header red lighter bigger">
                                        <i class="icon-key"></i>
                                        取回密码
                                    </h4>

                                    <div class="space-6"></div>
                                    <p>
                                        请输入您的邮箱地址，以获取密码修改链接
                                    </p>

                                    <form action="" method="post">
                                        <fieldset>
                                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="email" class="form-control" placeholder="Email" />
                                    <i class="icon-envelope"></i>
                                </span>
                                            </label>

                                            <div class="clearfix">
                                                <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                                    <i class="icon-lightbulb"></i>
                                                    提交
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div><!-- /widget-main -->

                                <div class="toolbar center">
                                    <a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                                        返回登录
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </div>
                            </div><!-- /widget-body -->
                        </div><!-- /forgot-box -->
                    </div><!-- /position-relative -->

                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div><!-- /.main-container -->
<?php $body->end();?>

<?php $body = $this->block('body')->start(1025);?>
<script type="text/javascript">
    function show_box(id) {
        jQuery('.widget-box.visible').removeClass('visible');
        jQuery('#'+id).addClass('visible');
    }
</script>
<?php $body->end();?>