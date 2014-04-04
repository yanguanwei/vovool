<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

if ($this->parentDirUrl) {
    echo sprintf('<p><a href="%s">返回上一级目录..</a></p>', $this->parentDirUrl);
}

echo $this->table_widget($this->listView);
?>
<ul>
    <?php
    /*
    if ($this->parentDirUrl) {
        echo sprintf('<li><a href="%s">返回上一级目录..</a></li>', $this->parentDirUrl);
    }
    foreach ($this->directory as $info) :
        if (!$info->isDot()) {
            if ($info->isDir()) {
                echo sprintf('<li class=""><a href="%s">%s</a></li>',
                    $this->url('admin-theme-assets', array('theme' => $this->theme->getId(), 'path' => ltrim("{$this->path}/{$info->getFilename()}", '/'))),
                    $info->getFilename()
                );
            } else {
                $p = strrpos($info->getFilename(), '.');
                if ($p) {
                    if (in_array(strtolower(substr($info->getFilename(), $p+1)), array('js', 'css'))) {
                        $assetViewUrl = $this->url('admin-theme-assets-edit', array('theme' => $this->theme->getId(), 'path' => ltrim("{$this->path}/{$info->getFilename()}", '/')));
                    }
                }

                if (!isset($assetViewUrl)) {
                    $assetViewUrl = $this->theme_asset($this->theme->getName(), "{$this->path}/{$info->getFilename()}", 'Front');
                }

                echo sprintf('<li class=""><a href="%s">%s</a></li>',
                    $assetViewUrl,
                    $info->getFilename()
                );
            }
        }
    endforeach;
    */
    ?>

</ul>

<?php
$content->end();