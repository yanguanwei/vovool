<?php
foreach ($this->flash_messages() as $type => $messages):
    foreach ($messages as $message):
    ?>
        <div class="alert alert-block alert-<?php echo ($type=='error'?'danger':$type);?>">
            <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
            </button>
            <?php echo $message;?>
        </div>
        <?php
    endforeach;
endforeach;
?>