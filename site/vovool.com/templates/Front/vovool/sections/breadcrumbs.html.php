<ul class="breadcrumb">
    <?php
    $breadcrumbs = $this->menu->getBreadcrumbs();
    $n = count($breadcrumbs);
    foreach ($breadcrumbs as $i => $item) {
        echo sprintf(
            '<li class="%s"><a href="%s">%s</a> %s</li>',
            $i == $n - 1 ? 'active' : '',
            $item['url'], $item['label'],
            $i < $n - 1 ? '<span class="divider">/</span> ' : ''
        );
    }
    ?>
</ul>