<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $this->block('title', $this->get('title'))->separate(' | ');?></title>

    <?php
    echo $this->block('head')
        ->add($this->block('stylesheets'), 1024)
        ->add($this->block('style-codes'));
    ?>

</head>

<body class="<?php echo $this->block('body-class')->separate(' ');?>">

<?php
echo $this->block('body', $this->get('content', ''))
    ->add($this->block('javascripts'))
    ->add($this->block('javascript-codes'))
    ->add($this->block('jquery-codes'));
?>

</body>
</html>
