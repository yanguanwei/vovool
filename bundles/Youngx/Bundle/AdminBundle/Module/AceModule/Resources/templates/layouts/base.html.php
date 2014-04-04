<?php $this->extend('layouts/html.php@Kernel');?>

<?php $this->block('title', '网络营销专家-沃喔科技', 2); ?>

<?php
$head = $this->block('head')->start();
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php $head->end();?>

<?php $stylesheets = $this->block('stylesheets')->start(-1024);?>
<link href="<?php echo $this->asset('//Bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo $this->asset('//css/font-awesome.min.css')?>"  />

<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo $this->asset('//css/font-awesome-ie7.min.css')?>" />
<![endif]-->

<!-- page specific plugin styles -->

<!-- fonts -->

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

<!-- ace styles -->

<link rel="stylesheet" href="<?php echo $this->asset('/css/ace.min.css')?>" />
<link rel="stylesheet" href="<?php echo $this->asset('/css/ace-rtl.min.css')?>" />
<link rel="stylesheet" href="<?php echo $this->asset('/css/ace-skins.min.css')?>" />
<link rel="stylesheet" href="<?php echo $this->asset('//Admin/common.css')?>"  />
<!--[if lte IE 8]>
<link rel="stylesheet" href="<?php echo $this->asset('/css/ace-ie.min.css')?>" />
<![endif]-->

<!-- inline styles related to this page -->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>
<script src="<?php echo $this->asset('//js/html5shiv.js')?>"></script>
<script src="<?php echo $this->asset('//js/respond.min.js')?>"></script>
<![endif]-->
<?php $stylesheets->end();?>

<?php $javascripts = $this->block('javascripts')->start(-1024);?>
<!--[if !IE]> -->

<script src="<?php echo $this->asset('//jQuery/jquery-2.0.3.min.js')?>"></script>

<!-- <![endif]-->

<script src="<?php echo $this->asset('//Kernel/youngx.js')?>"></script>

<!--[if IE]>
<script src="<?php echo $this->asset('//jQuery/jquery-1.10.2.min.js')?>"></script>
<![endif]-->

<!--[if !IE]> -->

<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo $this->asset('//jQuery/jquery-2.0.3.min.js')?>'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo $this->asset('//jQuery/jquery-1.10.2.min.js')?>'>"+"<"+"/script>");
</script>
<![endif]-->

<script src="<?php echo $this->asset('//Bootstrap/js/bootstrap.min.js')?>"></script>

<?php $javascripts->end();?>