<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();
?>
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
    <div class="col-xs-12">
    <div class="tabbable">
    <ul id="inbox-tabs" class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1">
        <li class="<?php echo $this->status === $this->status_all ? 'active' : '';?>">
            <a href="<?php echo $this->url('admin-feedback');?>">
                <i class="blue icon-inbox bigger-130"></i>
                <span class="bigger-110">全部</span>
            </a>
        </li>

        <li class="<?php echo $this->status === $this->status_star ? 'active' : '';?>">
            <a href="<?php echo $this->url('admin-feedback', array('status' => $this->status_star));?>">
                <i class="icon-star orange2 bigger-130"></i>
                <span class="bigger-110">标星</span>
            </a>
        </li>

        <li class="<?php echo $this->status === $this->status_unread ? 'active' : '';?>">
            <a href="<?php echo $this->url('admin-feedback', array('status' => $this->status_unread));?>">
                <i class="icon-eye-close green bigger-130 "></i>
                <?php
                if ($this->unread_count > 0) {
                    echo sprintf('<span class="badge badge-danger">%s</span>', $this->unread_count);
                }
                ?>
                <span class="bigger-110">未读</span>
            </a>
        </li>

        <li class="<?php echo $this->status === $this->status_read ? 'active' : '';?>">
            <a href="<?php echo $this->url('admin-feedback', array('status' => $this->status_read));?>">
                <i class="icon-flag-alt bigger-130"></i>
                <span class="bigger-110">未处理</span>
            </a>
        </li>

        <li class="<?php echo $this->status === $this->status_processed ? 'active' : '';?>">
            <a href="<?php echo $this->url('admin-feedback', array('status' => $this->status_processed));?>">
                <i class="icon-flag green bigger-130"></i>
                <span class="bigger-110">已处理</span>
            </a>
        </li>
    </ul>

    <div class="tab-content no-border no-padding">
    <div class="tab-pane in active">
    <div class="message-container">
    <div id="id-message-list-navbar" class="message-navbar align-center clearfix">
        <div class="message-bar">
            <div class="message-infobar" id="id-message-infobar">

            </div>

            <div class="message-toolbar hide">
                <div class="inline position-relative align-left">
                    <a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
                        <span class="bigger-110">标记</span>

                        <i class="icon-caret-down icon-on-right"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">
                        <li>
                            <a href="<?php echo $this->url('admin-feedback-flag', array('status' => $this->status_read));?>" class="batch-action">
                                <i class="icon-eye-open blue"></i>
                                &nbsp; 已读
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo $this->url('admin-feedback-flag', array('status' => $this->status_unread));?>" class="batch-action">
                                <i class="icon-eye-close green"></i>
                                &nbsp; 未读
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="<?php echo $this->url('admin-feedback-star', array('star' => 1));?>" class="batch-action">
                                <i class="icon-star orange2"></i>
                                &nbsp; 标星
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="inline position-relative align-left">
                    <a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-folder-close-alt bigger-110"></i>
                        <span class="bigger-110">操作</span>

                        <i class="icon-caret-down icon-on-right"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">
                        <li>
                            <a href="<?php echo $this->url('admin-feedback-process', array('status' => $this->status_read));?>" class="batch-action">
                                <i class="icon-flag-alt"></i>
                                &nbsp; 未处理
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->url('admin-feedback-process', array('status' => $this->status_processed));?>" class="batch-action">
                                <i class="icon-flag-alt red"></i>
                                &nbsp; 已处理
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="<?php echo $this->url('admin-feedback-delete');?>" class="btn btn-xs btn-message batch-action" data-action="delete">
                    <i class="icon-trash bigger-125"></i>
                    <span class="bigger-110">删除</span>
                </a>
            </div>
        </div>

        <div>
            <div class="messagebar-item-left">
                <label class="inline middle">
                    <input type="checkbox" id="id-toggle-all" class="ace" />
                    <span class="lbl"></span>
                </label>

                &nbsp;
                <div class="inline position-relative">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        <i class="icon-caret-down bigger-125 middle"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter dropdown-100">
                        <li>
                            <a id="id-select-message-all" href="#">全选</a>
                        </li>

                        <li>
                            <a id="id-select-message-none" href="#">全不选</a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a id="id-select-message-unread" href="#">未读</a>
                        </li>

                        <li>
                            <a id="id-select-message-read" href="#">已读</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="messagebar-item-right">
                <div class="inline position-relative">

                </div>
            </div>

            <div class="nav-search minimized">
                <form class="form-search" method="get" action="<?php echo $this->url('admin-feedback');?>">
                    <span class="input-icon">
                        <input type="text" autocomplete="off" class="input-small nav-search-input" placeholder="关键字..." name="keyword" value="<?php echo $this->keyword;?>" />
                        <i class="icon-search nav-search-icon"></i>
                    </span>
                </form>
            </div>
        </div>
    </div>

    <div class="message-list-container">
    <div class="message-list" id="message-list">
        <form method="post" id="feedbackForm" action="">
    <?php
    foreach ($this->feedbacks as $feedback) {
        $unreadCssClass = $feedback->isUnread() ? ' message-unread' : '';

        $starCssClass = $feedback->isStar() ? 'icon-star orange2' : 'icon-star-empty light-grey';
        $startUrl = $this->url('admin-feedback-star', array('id' => $feedback));

        $processCssClass = $feedback->isProcessed() ? 'icon-flag green' : 'icon-flag-alt light-grey';
        $processUrl = $this->url('admin-feedback-process', array('id' => $feedback));

        $createAt = $feedback->getCreatedAt();
        $readUrl = $this->url('admin-feedback-read', array('feedback' => $feedback));
        echo <<<CODES
<div class="message-item{$unreadCssClass}" data-feedback-id="{$feedback->getId()}" data-feedback-url="{$readUrl}">
    <label class="inline">
        <input type="checkbox" class="ace" name="id[]" value="{$feedback->getId()}" />
        <span class="lbl"></span>
    </label>
    <a href="{$processUrl}"><i class="message-star {$processCssClass}"></i></a>
    <a href="{$startUrl}"><i class="message-star {$starCssClass}"></i></a>
    <span class="sender">{$feedback->getName()}</span>
    <span class="time">{$createAt}</span>
    <span class="summary">
        <span class="text">
            {$feedback->getIntention()}
        </span>
    </span>
</div>
CODES;
    }
    ?>
        </form>
    </div>
    </div><!-- /.message-list-container -->

    <div class="message-footer clearfix">
        <div class="pull-left"> 共 <em><?php echo $this->feedbacks->getTotal();?></em> 条反馈 </div>

        <div class="pull-right">
            <?php
            echo $this->paging_widget($this->feedbacks, array(
                    'skin' => 'ace'
                ));
            ?>
        </div>
    </div>

    <div class="hide message-footer message-footer-style2 clearfix">
        <div class="pull-left"> simpler footer </div>

        <div class="pull-right">
            <div class="inline middle"> message 1 of 151 </div>

            &nbsp; &nbsp;
            <ul class="pagination middle">
                <li class="disabled">
																		<span>
																			<i class="icon-angle-left bigger-150"></i>
																		</span>
                </li>

                <li>
                    <a href="#">
                        <i class="icon-angle-right bigger-150"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    </div><!-- /.message-container -->
    </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
    </div><!-- /.tabbable -->
    </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- PAGE CONTENT ENDS -->

<?php $content->end();?>

<?php $javascripts = $this->block('javascripts')->start(-1);?>
<script src="<?php echo $this->asset('//jQuery/jquery.hotkeys.min.js')?>"></script>
<script src="<?php echo $this->asset('//jQuery/ui/1.10.3/jquery-ui-1.10.3.custom.min.js')?>"></script>
<script src="<?php echo $this->asset('//jQuery/ui/jquery.ui.touch-punch.min.js')?>"></script>
<script src="<?php echo $this->asset('//jQuery/jquery.slimscroll.min.js')?>"></script>
<?php $javascripts->end();?>

<?php $javascripts = $this->block('javascripts')->start();?>
<script type="text/javascript">
jQuery(function($){

    $('.message-toolbar a.batch-action').click(function() {
        var form =$('#feedbackForm');

        if (form.find('input:checked').length == 0) {
            alert('没有项被选择！');
            return false;
        }

        var action = $(this).data('action');
        if (action === 'delete') {
            if (!confirm('您确定要删除吗')) {
                return false;
            }
        }

        form.attr('action', $(this).attr('href'));
        form.submit();
        return false;
    });

    //basic initializations
    $('.message-list .message-item input[type=checkbox]').removeAttr('checked');
    $('.message-list').delegate('.message-item input[type=checkbox]' , 'click', function() {
        $(this).closest('.message-item').toggleClass('selected');
        if(this.checked) Inbox.display_bar(1);//display action toolbar when a message is selected
        else {
            Inbox.display_bar($('.message-list input[type=checkbox]:checked').length);
            //determine number of selected messages and display/hide action toolbar accordingly
        }
    });

    //check/uncheck all messages
    $('#id-toggle-all').removeAttr('checked').on('click', function(){
        if(this.checked) {
            Inbox.select_all();
        } else Inbox.select_none();
    });

    //select all
    $('#id-select-message-all').on('click', function(e) {
        e.preventDefault();
        Inbox.select_all();
    });

    //select none
    $('#id-select-message-none').on('click', function(e) {
        e.preventDefault();
        Inbox.select_none();
    });

    //select read
    $('#id-select-message-read').on('click', function(e) {
        e.preventDefault();
        Inbox.select_read();
    });

    //select unread
    $('#id-select-message-unread').on('click', function(e) {
        e.preventDefault();
        Inbox.select_unread();
    });

    //display second message right inside the message list
    $('.message-list .message-item .text, .message-list .message-item .sender').on('click', function(){
        var message = $(this).closest('.message-item');

        //if message is open, then close it
        if(message.hasClass('message-inline-open')) {
            message.removeClass('message-inline-open').find('.message-content').hide();
            return;
        } else if (message.find('.message-content').length > 0) {
            message.addClass('message-inline-open');
            message.find('.message-content').show();
            return;
        }

        $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');

        $.ajax({
            url: message.data('feedback-url'),
            dataType: 'json',
            success: function(response) {
                $('.message-container').find('.message-loading-overlay').remove();
                var feedback = youngx.parseJsonResponse(response);
                if (feedback) {
                    message
                        .addClass('message-inline-open')
                        .append('<div class="message-content" />');
                    var content = message.find('.message-content:last').html(renderMessageContent(message, feedback));
                    content.find('.message-body').slimScroll({
                        height: 100,
                        railVisible:true
                    });
                }
            }
        });
    });

    var renderMessageContent = function(messageItem, feedback) {
      var content = $('<div>'+
          '<div class="message-header clearfix">'+
          '<div class="pull-left">'+
          '<span class="blue bigger-125">'+ feedback.intention +'</span>'+
      '<div class="space-4"></div>'+
      '<a href="'+ feedback.starUrl +'" class="action-star"><i class="message-star '+ (feedback.is_star ? 'icon-star orange2' : 'icon-star-empty light-grey') +' mark-star"></i></a>'+
        '<span class="sender">'+ feedback.name +'</span>'+
        '&nbsp;&nbsp;&nbsp;<i class="icon-time bigger-110 orange middle"></i>'+
        '<span class="time">&nbsp;' + feedback.created_at + '</span>'+
          '&nbsp;&nbsp;&nbsp;<i class="icon-mail-forward bigger-110 orange middle"></i>'+
        '<span class="time">&nbsp;' + feedback.email + '</span>'+
          '&nbsp;&nbsp;&nbsp;<i class="icon-mobile-phone bigger-110 orange middle"></i>'+
          '<span class="time">&nbsp;' + feedback.phone + '</span>'+
          '&nbsp;&nbsp;&nbsp;<i class="icon-comments-alt bigger-110 orange middle"></i>'+
          '<span class="time">&nbsp;' + feedback.qq + '</span>'+
        '</div>'+
        '<div class="action-buttons pull-right">'+
        '<a href="'+ feedback.processUrl +'" class="action-process">'+
            '<i class="'+ (feedback.is_processed ? 'icon-flag green' : 'icon-flag-alt light-grey') + ' icon-only bigger-130"></i>'+
        '</a>'+
        '<a href="'+ feedback.deleteUrl +'" class="action-delete">'+
            '<i class="icon-trash red icon-only bigger-130"></i>'+
        '</a>'+
        '</div>'+
        '</div>'+
        '<div class="hr hr-double"></div>'+
        '<div class="message-body">'+ feedback.content +'</div>' +
        '<div class="hr hr-double"></div>'+
       '</div>'
      );

        content.find('.action-delete').click(function() {
            youngx.ajaxConfirm('您确定要删除吗？', $(this).attr('href'), function() {
                messageItem.remove();
            });

            return false;
        });

        content.find('.action-star').click(function() {
            var $this = $(this).find('i');
            $.get( $(this).attr('href'), function() {
                if ($this.hasClass('icon-star')) {
                    $this.removeClass('icon-star').removeClass('orange2').addClass('icon-star-empty light-grey')
                } else {
                    $this.removeClass('icon-star-empty').removeClass('light-grey').addClass('icon-star orange2')
                }
            });

            return false;
        });

        content.find('.action-process').click(function() {
            var $this = $(this).find('i');
            $.get( $(this).attr('href'), function() {
                if ($this.hasClass('icon-flag')) {
                    $this.removeClass('icon-flag').removeClass('green').addClass('icon-flag-alt light-grey')
                } else {
                    $this.removeClass('icon-flag-alt').removeClass('light-grey').addClass('icon-flag green')
                }
            });

            return false;
        });

        return content;
    };

    var Inbox = {
        //displays a toolbar according to the number of selected messages
        display_bar : function (count) {
            if(count == 0) {
                $('#id-toggle-all').removeAttr('checked');
                $('#id-message-list-navbar .message-toolbar').addClass('hide');
                $('#id-message-list-navbar .message-infobar').removeClass('hide');
            }
            else {
                $('#id-message-list-navbar .message-infobar').addClass('hide');
                $('#id-message-list-navbar .message-toolbar').removeClass('hide');
            }
        }
        ,
        select_all : function() {
            var count = 0;
            $('.message-item input[type=checkbox]').each(function(){
                this.checked = true;
                $(this).closest('.message-item').addClass('selected');
                count++;
            });

            $('#id-toggle-all').get(0).checked = true;

            Inbox.display_bar(count);
        }
        ,
        select_none : function() {
            $('.message-item input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');
            $('#id-toggle-all').get(0).checked = false;

            Inbox.display_bar(0);
        }
        ,
        select_read : function() {
            $('.message-unread input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');

            var count = 0;
            $('.message-item:not(.message-unread) input[type=checkbox]').each(function(){
                this.checked = true;
                $(this).closest('.message-item').addClass('selected');
                count++;
            });
            Inbox.display_bar(count);
        }
        ,
        select_unread : function() {
            $('.message-item:not(.message-unread) input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');

            var count = 0;
            $('.message-unread input[type=checkbox]').each(function(){
                this.checked = true;
                $(this).closest('.message-item').addClass('selected');
                count++;
            });

            Inbox.display_bar(count);
        }
    }

    //show message list (back from writing mail or reading a message)
    Inbox.show_list = function() {
        $('.message-navbar').addClass('hide');
        $('#id-message-list-navbar').removeClass('hide');

        $('.message-footer').addClass('hide');
        $('.message-footer:not(.message-footer-style2)').removeClass('hide');

        $('.message-list').removeClass('hide').next().addClass('hide');
        //hide the message item / new message window and go back to list
    }
});
</script>

<?php $javascripts->end();?>