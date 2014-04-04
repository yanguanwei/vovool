<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();
?>
<div class="row">
    <div class="col-xs-12">
        <p>
            <?php
            foreach ($this->archiveContents as $code => $info) {
                echo sprintf(
                    '<a href="%s" class="btn btn-light btn-app"><i class="icon-%s bigger-230"></i> %s %s</a>',
                    $info['url'], $info['icon'], $info['label'], $info['count'] > 0 ? '<span class="badge badge-pink">+'.$info['count'].'</span>' : ''
                );
            }
            ?>
        </p>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
<?php //echo $this->treeTableWidget;?>
    </div>
</div>
<?php
$content->end();
?>