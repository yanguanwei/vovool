<?php
$this->extend('layouts/main.html.php');

$content = $this->block('content')->start();
?>
<div class="alert alert-warning">
    <p>
        <strong><?php echo $this->tips?></strong>
    </p>
    <p><?php echo $this->message;?><p>
    <br />
    <form method="<?php echo $this->actionMethod;?>" action="<?php echo $this->actionUrl?>">
        <?php echo sprintf('<input type="hidden" name="returnUrl" value="%s" />', $this->cancelUrl); ?>
        <?php
        foreach ($this->data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    echo sprintf('<input type="hidden" name="%s" value="%s" />', "{$key}[{$k}]", $v);
                }
            } else {
                echo sprintf('<input type="hidden" name="%s" value="%s" />', $key, $value);
            }
        }
        ?>
        <p>
            <button class="btn btn-sm btn-success" type="submit"><?php echo $this->translate('Confirm');?></button>
            <?php if ($this->cancelUrl):?>
            <a class="btn btn-sm" href="<?php echo $this->cancelUrl;?>"><?php echo $this->translate('Cancel')?></a>
            <?php endif;?>
        </p>
    </form>
</div>
<?php
$content->end();
?>