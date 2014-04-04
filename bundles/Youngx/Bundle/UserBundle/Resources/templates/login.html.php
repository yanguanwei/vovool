<?php echo $this->extend('layouts/base.html.php@Ace');?>

<?php $body = $this->block('body')->start();?>

<form action="" method="post" id="<?php echo $this->form->getFormId()?>">

</form>

<?php $body->end();?>