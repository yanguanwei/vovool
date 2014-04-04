<?php $this->extend('layouts/main.html.php');?>

<?php $stylesheets = $this->block('stylesheets')->start();?>
    <link href="<?php echo $this->asset('css/newsview.css');?>" rel="stylesheet" />
<?php $stylesheets->end();?>

<?php $content = $this->block('content')->start()?>

    <div class="news_jx"></div>

    <div class="w_1200">

        <?php echo $this->render('sections/breadcrumbs.html.php');?>

        <Div class="case_top">
            <h2>News</h2>
        </Div>

        <div class="news_view">
            <h2 class=" page-header"><?php echo $this->archive->title;?></h2>
            <div class="news_view_cen">
                <div>
                    <?php echo $this->archive->content;?>
                </div>
            </div>
        </div>
    </div>

    <div class="news_view_foot page-header w_1200">
        <h2>点击查看其他文章</h2>
        <h2>ˇ</h2>
        <div class="row-fluid">
        <?php
        $prevArchive = $this->archive->getPrevArchive();
        $prevArchiveUrl = $prevArchive ? $this->url('news-view', array('archive' => $prevArchive)) : 'javascript:;';
        $prevArchiveTitle = $prevArchive ? $prevArchive->title : '没有了';

        $nextArchive = $this->archive->getNextArchive();
        $nextArchiveUrl = $nextArchive ? $this->url('news-view', array('archive' => $nextArchive)) : 'javascript:;';
        $nextArchiveTitle = $nextArchive ? $nextArchive->title : '没有了';
        ?>
        <div class="pagerl span6"><a href="<?php echo $prevArchiveUrl;?>">上一篇：<?php echo $prevArchiveTitle;?></a></div>
        <div class="pagerr span6"><a href="<?php echo $nextArchiveUrl;?>">下一篇：<?php echo $nextArchiveTitle;?></a></div>
        </div>
    </div>

<?php $content->end();?>