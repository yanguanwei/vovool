<?php $this->extend('layouts/main.html.php');?>

<?php $stylesheets = $this->block('stylesheets')->start();?>
    <link href="<?php echo $this->asset('css/news.css');?>" rel="stylesheet" />
<?php $stylesheets->end();?>

<?php $content = $this->block('content')->start()?>
    <div class="news_jx"></div>

    <div class="w_1200">

        <?php echo $this->render('sections/breadcrumbs.html.php');?>

        <Div class="case_top">
            <h2>News</h2>
        </Div>
    </div>


    <ul class="nav nav-tabs w_1200">
        <?php
        foreach($this->channel->getTop()->getChildren() as $channel) {
            echo sprintf('<li class="%s"><a href="%s">%s</a></li>',
                $channel->getId() == $this->channel->getId() ? 'active' : '',
                $this->url('news', array('channel' => $channel->getName())),
                $channel->getLabel()
            );
        }
        ?>
    </ul>

    <div class="w_1200 tab-content">
    <ul class="row-fluid tab-pane active">
    <?php
    foreach ($this->archives as $archive) {
        $viewUrl = $this->url('news-view', array('archive' => $archive));
        echo <<<CODESET
<li class="row-fluid news_li ">
    <div class="news_l span5">
            <a href="newsview.html">
                <img src="{$this->uploaded_asset($archive->cover)}">
            </a>
            <p>{$archive->formatUpdatedTime('Y-m-d')}</p>
        </div>

        <div class="news_r span7">
            <div class="news_t">
                <a href="newsview.html">{$archive->title}</a>
            </div>
            <div class="news_a">
                <a href="{$viewUrl}">点击阅读全文</a>
            </div>
        </div>
    </li>
CODESET;
    }
    ?>
    </ul>


    </div>

    <div class="w_1200">
        <?php echo $this->paging_widget($this->archives, 'bootstrap');?>
    </div>

<?php $content->end();?>