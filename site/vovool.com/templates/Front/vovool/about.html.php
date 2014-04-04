<?php $this->extend('layouts/main.html.php');?>

<?php $stylesheets = $this->block('stylesheets')->start();?>
<link href="<?php echo $this->asset('css/about.css');?>" rel="stylesheet" />
<!-- 必要样式 -->
<link rel="stylesheet" type="text/css" href="<?php echo $this->asset('css/style_common.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->asset('css/style1.css');?>" />
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<?php $stylesheets->end();?>

<?php $content = $this->block('content')->start();?>
<div class="about_jx"></div>
<div class="w_1200">
    <?php echo $this->render('sections/breadcrumbs.html.php');?>
</div>

<div class="w_1200">
    <div class="row-fluid">
        <div class="span8">
            <Div class="about_top">
                <h2>About Us</h2>
            </Div>
            <div class="about_center">
                <img src="<?php echo $this->asset("images/about_us_img.jpg");?>" >
                <p>            	沃喔网络起步于上海，是上海偃月信息科技有限公司开发外地市场，设立在宁波高新区的分部。公司拥有完善的培训机制，励志成为互联网行业的“黄埔军校”。</p>
                <p>宁波建立开始于2013年，由一群曾在互联网摸爬滚打多年的小伙伴组成的小家庭，他们意识到在市场竞争激烈的今天，诸多中小企业在为广告、网络推广及市场广告日益增多而发愁。</p>
                <p>他们一致认为，在业内用整合营销新思路新方法来实现现今企业的企业网络营销是传统企业发展的必然趋势。</p>
                <p>宁波高新区沃喔网络科技有限公司是国内首家专注于提供高品质网站综合解决方案的高新技术企业。专业从事互联网应用服务、网站建设、企业邮箱、域名空间、网站SEO推广、平面广告等。我们在成长的过程中不断的积累资源，技术优势得到大幅提升，同时取得了瞩目的成绩。10年专业网站建设经验，成功服务了上千家客户！</p>
            </div>

            <Div class="Personnel_top">
                <h2>Personnel recruitment</h2>
            </Div>
            <div class="Personnel_center">
                <img src="images/ren_cai_img.jpg" >
                <div class="Personnel_p">
                <h2>销售顾问</h2>
                <h3>职位描述:</h3>
                <p>负责搜集新客户的资料并进行沟通，开发新客户;</p>
                <p>通过电话与客户进行有效沟通了解客户需求，提供合理化的建议和解决方案，并寻找销售机会提高销售业绩;</p>
                <p>负责客户的维护，指导客户熟练掌握公司产品的使用和操作技巧，解答客户常见问题;</p>
                <p>维护老客户的业务，建立良好的长期合作关系，并挖掘客户的最大潜力;</p>
                <p>通过规范和良好的服务提升公司品牌形象;</p>
                <p>福利待遇：底薪+绩效+提成+奖金+旅游。</p>
                </div>
                <div class="Personnel_p">
                <h2>网页设计师</h2>
                <h3>岗位职责:</h3>
                <p>熟悉网站建设流程，具备独立进行网站项目的整体版式、风格设计能力;</p>
                <p>精通Photoshop，Flash，DW等网页设计美工软件，有相关工作经验者优先;</p>
                <p>熟练掌握DIV+CSS的运用与制作，熟悉各种主流浏览器的兼容性调整;</p>
                <p>熟悉HTML/CSS/Javascript等并能熟练手工编辑修改HTML源代码;</p>
                <p>具有良好的美术功底以及良好的创意构思能力，对色彩敏感，具有把握不同风格页面的良好能力;</p>
                <p>良好的组织观念和团队合作精神、敬业精神，工作积极主动，细致专注，能承受工作压力；</p>
                <p>Flash动画设计能力强，能制作精美的flash广告banner等</p>
                <h3>任职资格:</h3>
                <p>相关专业优秀毕业生优先</p>
                <p>反应敏捷、表达能力强,具有较强的沟通能力及交际技巧,具有亲和力</p>
                <p>有责任心,能承受较大的工作压力</p>
                <p>有团队协作精神,善于挑战</p>
                </div>
                <div class="Personnel_p">
                <h2>电商设计师</h2>
                <h3>岗位职责：</h3>
                <p>负责公司项目店铺的设计、改版、更新，产品广告进行设计、编辑、美化等工作;</p>
                <p>对项目申报活动产品进行美工设计;</p>
                <p>负责项目及店铺内的广告和专题的设计;</p>
                <h3>任职资格:</h3>
                <p>美术、平面设计相关专业优先，专科及以上学历</p>
                <p>有网页设计及平面设计工作经验者优先;</p>
                <p>有扎实的美术功底、良好的创意思维和理解能力，能及时把握客户需求;</p>
                <p>精通Photoshop、Dreamweaver等设计软件，对图片渲染和视觉效果有较好认识。</p>
                </div>
                <div class="Personnel_p">
                <h2>PHP程序员</h2>
                <h3>岗位职责：</h3>
                <p>完成软件系统代码的实现，编写代码注释和开发文档;</p>
                <p>辅助进行系统的功能定义，程序设计;</p>
                <p>根据设计文档或需求说明完成代码编写，调试，测试和维护;</p>
                <p>分析并解决软件开发过程中的问题;</p>
                <p>协助测试工程师制定测试计划，定位发现的问题;</p>
                <p>配合项目经理完成相关任务目标。</p>
                <h3>任职资格：</h3>
                <p>计算机或相关专业专科学历以上;</p>
                <p>有软件开发经验者佳;</p>
                <p>熟悉面向对象思想，精通编程，调试和相关技术;</p>
                <p>熟悉应用服务器的安装、调试、配置及使用;</p>
                <p>具备需求分析和系统设计能力，以及较强的逻辑分析和独立解决问题能力;</p>
                <p>能熟练阅读中文、英文技术文档</p>
                <p>富有团队精神，责任感和沟通能力，应届毕业生也可。</p>
                </div>
            </div>

            <Div class="contact_top">
                <h2>Contact Us</h2>
            </Div>
            <div class="contact_center">
                <img src="<?php echo $this->asset("images/contact_us_img.jpg");?>">
                <div class="contact_cen">
                    <p>宁波沃喔网络科技有限公司</p>
                    <p>Ningbo Vow Network Technology Co.,Ltd.</p>
                    <p>地址：宁波市高新区江南路598号九五国际A幢335</p>
                    <p>邮编：315040</p>
                    <p>电话：0574-27900053</p>
                    <p>传真：0574-27900051</p>
                    <p>网址：<a href="http://www.vovool.com/">http://www.vovool.com/</a></p>
                    <p>人才招聘：<a href="#">servers@vovool.com</a></p>
                </div>
            </div>

        <!--引用百度地图API-->
            <style type="text/css">
    html,body{margin:0;padding:0;}
    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
  <!--百度地图容器-->
  <div style="width:95%;height:250px;border:#ccc solid 1px; margin-bottom:20px;" id="dituContent"></div>

<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(121.620968,29.894619);//定义一个中心点坐标
        map.centerAndZoom(point,17);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
    var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
    map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
    var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:0});
    map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
    var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
    map.addControl(ctrl_sca);
    }
    
    //标注点数组
    var markerArr = [{title:"宁波沃喔网络科技有限公司",content:"Ningbo&nbsp;Vow&nbsp;Network&nbsp;Technology&nbsp;Co.,Ltd.<br/>地址：宁波市高新区江南路598号九五国际A幢335<br/>邮编：315040<br/>电话：0574-27900053<br/>传真：0574-27900051<br/>网址：http://www.vovool.com/<br/>人才招聘：servers@vovool.com",point:"121.622306|29.89321",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
         ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
            var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
            var iw = createInfoWindow(i);
            var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
            marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
            });
            
            (function(){
                var index = i;
                var _iw = createInfoWindow(i);
                var _marker = marker;
                _marker.addEventListener("click",function(){
                    this.openInfoWindow(_iw);
                });
                _iw.addEventListener("open",function(){
                    _marker.getLabel().hide();
                })
                _iw.addEventListener("close",function(){
                    _marker.getLabel().show();
                })
                label.addEventListener("click",function(){
                    _marker.openInfoWindow(_iw);
                })
                if(!!json.isOpen){
                    label.hide();
                    _marker.openInfoWindow(_iw);
                }
            })()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }
    
    initMap();//创建和初始化地图
</script>
        <!--结束百度地图API-->
        </div>

        <div class="span4">
            <Div class="photo_top">
                <h2>Photoes</h2>
            </Div>
            <div  class="photo_cen">
                <div class="view view-first">
                    <img src="<?php echo $this->asset("images/img12.jpg");?>" />
                    <div class="mask">
                        <h2>章丽</h2>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my heart.</p>
                    </div>
                </div>
                <div class="view view-first">
                    <img src="<?php echo $this->asset("images/img10.jpg");?>" />
                    <div class="mask">
                        <h2>代文颖</h2>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my heart.</p>
                    </div>
                </div>
                <div class="view view-first">
                    <img src="<?php echo $this->asset("images/img13.jpg");?>" />
                    <div class="mask">
                        <h2>徐顺达</h2>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my heart.</p>
                    </div>
                </div>
                <div class="view view-first">
                    <img src="<?php echo $this->asset("images/img16.jpg");?>" />
                    <div class="mask">
                        <h2>叶晨晨</h2>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my heart.</p>
                    </div>
                </div>
                <div class="view view-first">
                    <img src="<?php echo $this->asset("images/img15.jpg");?>" />
                    <div class="mask">
                        <h2>吴洪坤</h2>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my heart.</p>
                    </div>
                </div>
                <div class="view view-first">
                    <img src="<?php echo $this->asset("images/img14.jpg");?>" />
                    <div class="mask">
                        <h2>ToruLynn</h2>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my heart.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<?php $content->end();?>