<?php $this->extend('layouts/main.html.php');?>

<?php $stylesheets = $this->block('stylesheets')->start();?>
    <link href="<?php echo $this->asset('css/case.css');?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $this->asset('css/colorbox.css')?>" />
<?php $stylesheets->end();?>

<?php $javascripts = $this->block('javascripts')->start();?>
    <script src="<?php echo $this->asset('js/jquery.colorbox.js');?>"></script>
    <script>
        $(document).ready(function(){
            //Examples of how to assign the Colorbox event to elements
            $(".group1").colorbox({rel:'group1'});
            $(".group2").colorbox({rel:'group2', transition:"fade"});
            $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
            $(".group4").colorbox({rel:'group4', slideshow:true});
            $(".ajax").colorbox();
            $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
            $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
            $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
            $(".inline").colorbox({inline:true, width:"50%"});
            $(".callbacks").colorbox({
                onOpen:function(){ alert('onOpen: colorbox is about to open'); },
                onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
                onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
                onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
                onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
            });

            $('.non-retina').colorbox({rel:'group5', transition:'none'})
            $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});

            //Example of preserving a JavaScript event for inline calls.
            $("#click").click(function(){
                $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                return false;
            });
        });
    </script>
<?php $javascripts->end();?>

<?php $content = $this->block('content')->start();?>
    <div class="case_jx"></div>

    <div class="w_1200">
        <?php echo $this->render('sections/breadcrumbs.html.php');?>

        <Div class="case_top">
            <h2>Cases</h2>
        </Div>
    </div>

    <div class="w_1200 case_cen">
        <ul class="clearfix phone_case">
            <?php
            foreach ($this->archives as $archive) {
                echo <<<code
<li class="case_30">
                <a title="{$archive->title}" class="group3" href="{$this->uploaded_asset($archive->cover)}">
                <img src="{$this->uploaded_asset($archive->cover, 366, 255)}">
                </a>
            </li>
code;
            }
            ?>
        </ul>
    </div>

<?php $content->end();?>