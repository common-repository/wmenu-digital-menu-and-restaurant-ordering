<?php
/*
Plugin Name: wMenu Digital Menu and Restaurant Ordering
Plugin URI:  http://www.wmenu.com
Description: This pluging embeds wMenu - Digital Menu & Ordering software in to your page.
Version:     1.13 - 14-11-2016
Author:      Pennan Consulting AB
Author URI:  http://wmenu.com
License:     GPL2 etc
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Copyright Pennan Consulting AB (email : info@wmenu.com)
wMenu is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
wMenu is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with wMenu. If not, see (http://link to your plugin license).
*/

function wMenuIframe($attr) {
    $a = shortcode_atts( array(
			'site' => 'http://dc.wmenu.com',
			'pctop' => '',
			'pcleft' => '',
			'pcbottom' => '',
			'pcright' => '',
			'pcwidth' => '',
			'pcheight' => '',
			'mobtop' => '',
			'mobleft' => '',
			'mobbottom' => '',
			'mobright' => '',
			'mobwidth' => '',
			'mobheight' => '',
			'display' => '',
			'mobdisplay' => '',
			'position' => '',
			'adminpc' => 30,
			'adminmob' => 46,
			'background'=> 'rgba(0,0,0,0.7)'
		), $attr );

 $site=$a['site'];
 $pctop=$a['pctop'];
 $pcleft=$a['pcleft'];
 $pcbottom=$a['pcbottom'];
 $pcright=$a['pcright'];
 $pcwidth=$a['pcwidth'];
 $pcheight=$a['pcheight'];
 $mobtop=$a['mobtop'];
 $mobleft=$a['mobleft'];
 $mobbottom=$a['mobbottom'];
 $mobright=$a['mobright'];
 $mobwidth=$a['mobwidth'];
 $mobheight=$a['mobheight'];
 $display=$a['display'];
 $mobdisplay=$a['mobdisplay'];
 $position=$a['position'];
 $adminpc=$a['adminpc'];
 $adminmob=$a['adminmob'];
 $background=$a['background'];

 $imgTransp =plugins_url("img/Transp.png", __FILE__);
 $imgExit =plugins_url("img/ExitTransp.png", __FILE__);
 $imgIphone =plugins_url("img/iphoneWhite1.png", __FILE__);
 $imgIphoneBlack =plugins_url("img/iphone6Png.png", __FILE__);
 
 $adminmode=0;
 if(is_admin_bar_showing())
     $adminmode=1;

return "

<div id='wMenuDiv' style=\"position:relative;display:inline-block; width:0px; height:0px;\"></div>

<style type'text/css'>
.w3-animate-zoom {-webkit-animation:animatezoom 0.6s;animation:animatezoom 0.6s}
@-webkit-keyframes animatezoom{from{-webkit-transform:scale(0)} to{-webkit-transform:scale(1)}}
@keyframes animatezoom{from{transform:scale(0)} to{transform:scale(1)}}

.wcontainercss {

			}
.wiframecss {
			    width: 100%;
			    height: 100%;
			    border: none;
			    position:absolute;
			    top:0px;
			    left:0px;
                overflow-x:hidden !important;
			}

</style>

<script> 

 
var Params={
			    PcTop:\"$pctop\",
			    PcLeft:\"$pcleft\",
			    PcBottom:\"$pcbottom\",
			    PcRight:\"$pcright\",
			    PcWidth:\"$pcwidth\",
			    PcHeight:\"$pcheight\",
			    MobTop:\"$mobtop\",
			    MobLeft:\"$mobleft\",
			    MobBottom:\"$mobbottom\",
			    MobRight:\"$mobright\",
			    MobWidth:\"$mobwidth\",
			    MobHeight:\"$mobheight\",
			    Display:\"$display\",
			    MobDisplay:\"$mobdisplay\",
			    Position:\"$position\",
			    AdminPc: $adminpc ,
			    AdminMob: $adminmob,
			    Background:\"$background\",
			    AdminMode:$adminmode,
			    Site:\"$site\" 
			};
  

			    //====== WordPress plugin ==========
			    //---------------- Utilities
    var ScrWidth = 0, ScrHeight = 0;
    function GetScrSize() {
        try {
            if (typeof (window.innerWidth) == 'number') {
			    //Non-IE
                ScrWidth = window.innerWidth;
                ScrHeight = window.innerHeight;

			} else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
			    //IE 6+ in 'standards compliant mode'
                ScrWidth = document.documentElement.clientWidth;
                ScrHeight = document.documentElement.clientHeight;
			} else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
			    //IE 4 compatible
                ScrWidth = document.body.clientWidth;
                ScrHeight = document.body.clientHeight;
			}
			} catch (Error) {
 
			}
			}
 
    function _AttachEvent(element, eventName, eventHandler) {

        if (element.addEventListener) {  // all browsers except IE before version 9
            element.addEventListener(eventName, eventHandler, false);
			}
			else {
            if (element.attachEvent) {   // IE before version 9
                element.attachEvent(eventName, eventHandler);
			}
			}
			}
			    //----------------- Find device 
    var devType='Mobile';
    if (navigator.userAgent.indexOf('Windows NT') != -1 || navigator.userAgent.indexOf('Macintosh') != -1)
        devType = 'PC';
			else
        devType = 'Mobile';
 
    GetScrSize();

			    //----- Container and iFrame - desktop display
    var stylePc='vertical-align:top; position:relative; display:inline-block; width:80%; border:3px solid #aaa;';
    var stylePcAbs=' position:absolute; display:inline-block; width:80%; border:3px solid #aaa;';
    var templPc=
                   '<img style=\"width:65%;\" src=\"$imgTransp\" alt=\"?\" />'+ 
                   '<div style=\"position:absolute; top:0%; right:-40px;  width:30px; height:30px; \">'+
                         '<img  style=\"position:absolute; top:0%; left:0%; width:100%; height:100%; overflow:hidden;\" src=\"$imgExit\" alt=\"?\" />'+
                       '</div>'+
                   '<iframe  class=\"wiframecss\" style=\"border:0px; position:absolute; top:0%; left:0%; width:100%; height:100%; \" src=\"http://dc.wmenu.com?embade=1&mustconfirmexit=0\" />';      
    
			    //----- Container and iFrame - mobile display on desktop
    var styleMob='vertical-align:top; position:relative; float;left; display:inline-block; width:80%;  border:2px solid #aaa;';
     var styleMobAbs=' position:absolute; float;left; display:inline-block; width:80%;  border:2px solid #aaa;';
    var templMob=
                    '<img style=\"width:170%;\" src=\"$imgTransp\" alt=\"?\" />'+  
                    '<div style=\" position:absolute; top:-1%; right:-20%;  width:35px; height:35px;\">'+
                         '<img  style=\"position:absolute; top:0%; left:0%; width:100%; height:100%; overflow:hidden;\" src=\"$imgExit\" alt=\"?\" />'+
                       '</div>'+
                    '<iframe  class=\"wiframecss\"  style=\"border:0px; width:100%; height:100%; \" src=\"http://dc.wmenu.com/?mobile=1&mustconfirmexit=0\" />';

			    //----- Container and iFrame - iphone6 display on desktop
    var styleIphone='vertical-align:top; position:relative; float:left; display:inline-block; width:25%;';
    var styleIphoneAbs=' position:absolute; float:left; display:inline-block; width:25%;';
    var templIphone=
                        '<img style=\"width:180%;\" src=\"$imgTransp\" alt=\"?\" />'+ 
                        '<div style=\" position:absolute; top:-1%; right:-20%;  width:35px; height:35px;\">'+
                            '<img  style=\"position:absolute; top:0%; left:0%; width:100%; height:100%; overflow:hidden;\" src=\"$imgExit\" alt=\"?\" />'+
                           '</div>'+
                         '<img style=\"position:absolute;top:0%; left:0%; width:100%; height:100%; overflow:hidden;\" src=\"$imgIphoneBlack\" alt=\"?\" />'+ 
                         '<iframe   class=\"wiframecss\" style=\"border:0px; top:10%; left:7%; width:86%; height:77%;\" src=\"http://dc.wmenu.com?mobile=1&mustconfirmexit=0\" />';
    var templIphoneWhite=
                        '<img style=\"width:180%;\" src=\"$imgTransp\" alt=\"?\" />'+ 
                        '<div style=\" position:absolute; top:-1%; right:-20%;  width:35px; height:35px;\">'+
                            '<img  style=\"position:absolute; top:0%; left:0%; width:100%; height:100%; overflow:hidden;\" src=\"$imgExit\" alt=\"?\" />'+
                           '</div>'+
                         '<img style=\"position:absolute;top:0%; left:0%; width:100%; height:100%; overflow:hidden;\" src=\"$imgIphone\" alt=\"?\" />'+ 
                         '<iframe   class=\"wiframecss\" style=\"border:0px; top:11.5%; left:5%; width:92%; height:76%;\" src=\"http://dc.wmenu.com?mobile=1&mustconfirmexit=0\" />';


    function CtrlIframe(param){
        if (param) {
            for (key in param)
                this[key] = param[key];
			}


        var AnimClass=this.AnimClass?this.AnimClass:'w3-animate-zoom';

        var Display=this.Display?this.Display:'auto';
        var templ='';
          
        var cont=document.createElement('div');

        if(devType=='Mobile'){
            cont.style.border='';
			}
                        
			    //----------------- URL
        var url=this.Site?this.Site:'http://dc.wmenu.com';

        if(url.indexOf('http://')!=0)
            url='http://'+url;

		url=url+'?embade=1&mustconfirmexit=0';
			    //if(Display=='mobile' || Display=='iphone')
			    //    url=url+'&mobile=1';
       
        var bd=document.getElementsByTagName('body')[0]; 
        var backH=ScrHeight>bd.clientHeight?ScrHeight:bd.clientHeight;        
			    //------------------ Position 
        var Position=this.Position?this.Position:'relative';


			    //============================ RELATIVE POSITION
        if(Position=='relative'){  
            var whost=document.getElementById('wMenuDiv').parentElement;
            var whostW=whost.clientWidth;
                      
            url=url+'&embadexitbtn=0';
			    //---------------------- MOBILE DEVICE - relative pos.
            if(devType=='Mobile'){
                if(this.MobDisplay=='iphone' || this.MobDisplay=='iphoneblack'){
                       cont.innerHTML=this.MobDisplay=='iphone'?templIphoneWhite:templIphone;
                       cont.setAttribute('style',styleIphone);
                       var divIframe=cont.children[3];
                       var divImgSize=cont.children[0];   
                       var divBtnExit=cont.children[1];
			        } 
			        else{
                        cont.innerHTML=templMob;
                        cont.setAttribute('style',styleMob);
                        var divIframe=cont.children[2];
                        var divImgSize=cont.children[0];   
                        var divBtnExit=cont.children[1];
			        }
                this.Width=this.MobWidth?this.MobWidth:'100%';
                cont.style.width=this.Width;
                this.Height=this.MobHeight?this.MobHeight:((whostW*1.8)+'px');
                cont.style.height=this.Height;
                this.MobTop=this.MobTop?this.MobTop:'0%';
                cont.style.marginTop=this.MobTop;
                this.MobLeft=this.MobLeft?this.MobLeft:'0%';
                cont.style.marginLeft=this.MobLeft;
                this.MobBottom=this.MobBottom?this.MobBottom:'0%';
                cont.style.marginBottom=this.MobBottom;
                this.MobRight=this.MobRight?this.MobRight:'0%';
                cont.style.marginRight=this.MobRight;
			}
			else
			{
			    //--------------------- PC COMPUTER - relative pos. 
              if(Display=='iphone' || Display=='iphoneblack'){
                url=url+'&mobile=1';
                cont.setAttribute('style',styleIphone);
                
                cont.innerHTML=(Display=='iphoneblack'?templIphone:templIphoneWhite);            
                var divIframe=cont.children[3];
                var divImgSize=cont.children[0];  
                var divBtnExit=cont.children[1]; 
                this.Width=this.PcWidth?this.PcWidth:'45%';
                cont.style.width=this.Width;
                this.Height=this.PcHeight?this.PcHeight:((whostW*0.45*1.8)+'px');
                cont.style.height=this.Height;
                
			}else
                  if(Display=='mobile' || whostW<1100){
                    url=url+'&mobile=1';
                    cont.setAttribute('style',styleMob);
                    cont.innerHTML=templMob;                    
                    var divIframe=cont.children[2];
                    var divImgSize=cont.children[0];   
                    var divBtnExit=cont.children[1];
			}
			else
			{       cont.setAttribute('style',stylePc); 
                            cont.innerHTML=templPc;                                      
                            var divImgSize=cont.children[0]; 
                            var divBtnExit=cont.children[1];
                            var divIframe=cont.children[2];
			}
                    this.Width=this.PcWidth?this.PcWidth:'45%';
                    cont.style.width=this.Width;
                    this.Height=this.PcHeight?this.PcHeight:((whostW*0.45*1.8)+'px');
                    cont.style.height=this.Height;  
                    
                    this.Top=this.PcTop?this.PcTop:'0%';
                    cont.style.marginTop=this.Top;

                    this.Left=this.PcLeft?this.PcLeft:'0%';
                    cont.style.marginLeft=this.Left;

                    this.Bottom=this.PcBottom?this.PcBottom:'0%';
                    cont.style.marginBottom=this.Bottom;

                    this.Right=this.PcRight?this.PcRight:'0%';
                    cont.style.marginRight=this.Right;
			}
            divBtnExit.style.display='none';
            cont.style.position='relative';
            divIframe.setAttribute('src',url);
            whost.appendChild(cont);
            		
			}
			else
			{
			    //============================ ABSOLUTE POSITION

                var wMenuBack=document.createElement('div');
			    var backGr=this.Background?this.Background:'rgba(0,0,0,0.7)';
                cont.style.position='absolute'; 


			    //---------------------- MOBILE PHONE / TABLET - absolute pos. - it is a simple link.
            if(devType=='Mobile'){
                url=url+'&mobile=1';
                location.assign(url);
			}
			else
			{
                 url=url+'&embadexitbtn=0';
                 cont.className=AnimClass;
			    //--------------------- PC COMPUTER - absolute pos.
               if(Display=='iphone' || Display=='mobile'){
                         url=url+'&mobile=1';
                         var defWidth='25';
                         var defH=ScrWidth*(defWidth/100)*1.8;
                         var defLeft=(100/2)-defWidth;                         
                          if(Display=='iphone' || Display=='iphoneblack'){
                            cont.setAttribute('style',styleIphoneAbs);
                            cont.style.position='absolute'; 
                            cont.innerHTML=(Display=='iphoneblack'?templIphone:templIphoneWhite);                       
                            var divIframe=cont.children[3];
                            var divImgSize=cont.children[0];  
                            var divBtnExit=cont.children[1]; 
                            this.Width=this.PcWidth?this.PcWidth:defWidth+'%';
                            cont.style.width=this.Width;
                            this.Height=this.PcHeight?this.PcHeight:defH+'px';
                            cont.style.height=this.Height;
                
			}else
                              if(Display=='mobile' || whostW<1100){
                                cont.setAttribute('style',styleMobAbs);
                                cont.setAttribute('style',styleMob);
                                cont.innerHTML=templMob;                    
                                var divIframe=cont.children[2];
                                var divImgSize=cont.children[0];   
                                var divBtnExit=cont.children[1];
                                this.Width=this.PcWidth?this.PcWidth:defWidth+'%';
                                cont.style.width=this.Width;
                                this.Height=this.PcHeight?this.PcHeight:defH+'px';
                                cont.style.height=this.Height;
			}
                    this.PcTop=this.PcTop?this.PcTop:'4%';
                    cont.style.top=this.PcTop;
                    this.PcLeft=this.PcLeft?this.PcLeft:'37.5%';
                    cont.style.left=this.PcLeft;

			}
			else
			{       cont.setAttribute('style',stylePcAbs); 
                    cont.innerHTML=templPc;                                      
                    var divImgSize=cont.children[0]; 
                    var divBtnExit=cont.children[1];
                    var divIframe=cont.children[2];
                    this.Width=this.PcWidth?this.PcWidth:'80%';
                    cont.style.width=this.Width;
           
                    this.Height=this.PcHeight?this.PcHeight:((ScrHeight*0.9)+'px');
                    cont.style.height=this.Height;
                    this.PcTop=this.PcTop?this.PcTop:'5%';
                    cont.style.top=this.PcTop;
                    this.PcLeft=this.PcLeft?this.PcLeft:'10%';
                    cont.style.left=this.PcLeft;
			}
               
			}
            
            divIframe.setAttribute('src',url);
            cont.style.position='absolute';
            cont.style.zIndex='50000';
             _AttachEvent(wMenuBack, 'click',closeWmenuIframe);
 		     wMenuBack.setAttribute('style','z-index:50000; position:fixed;top:0px; left;0px; width:100%; height:'+backH+'px; background:rgba(0,0,0,0.7)'); // Transparent back over home Site
			 wMenuBack.style.background=backGr;
             bd.appendChild(wMenuBack);       
             wMenuBack.appendChild(cont);	
			}

 function closeWmenuIframe(){
     bd.removeChild(wMenuBack);
     window.history.back();
			}
			}

  new CtrlIframe(Params);

</script>";
			}
 

add_shortcode( 'wmenu', 'wMenuIframe' );


class wMenuWidget_Widget extends WP_Widget
			{
			    /**
                 * @uses apply_filters( 'magic_widgets_name' )
                 */
    public function __construct()
			{
			    // You may change the name per filter.
			    // Use add_filter( 'magic_widgets_name', 'your custom_filter', 10, 1 );
        $widgetname = apply_filters( 'magic_widgets_name', 'wMenuWidget' );
        parent::__construct(
            'wMenuWidget'
        ,   $widgetname
        ,   array( 'description' => 'Pure Markup' )
        ,   array( 'width' => 300, 'height' => 150 )
        );
        }

            /**
             * Output.
             *
             * @param  array $args
             * @param  array $instance
             * @return void
             */
    public function widget( $args, $instance )
        {
        echo $instance['text'];
        }

            /**
             * Prepares the content. Not.
             *
             * @param  array $new_instance New content
             * @param  array $old_instance Old content
             * @return array New content
             */
    public function update( $new_instance, $old_instance )
        {
        return $new_instance;
        }

            /**
             * Backend form.
             *
             * @param array $instance
             * @return void
             */
    public function form( $instance )
        {
        $instance = wp_parse_args( (array) $instance, array( 'text' => '' ) );
    $text     = format_to_edit($instance['text']);
    ?>
            <textarea class="widefat" rows="7" cols="20" id="<?php
                echo $this->get_field_id( 'text' );
            ?>" name="<?php
                echo $this->get_field_name( 'text' );
            ?>"><?php
                echo $text;
            ?></textarea>
            <?php
    /* To enable the preview uncomment the following lines.
     * Be aware: Invalid HTML may break the rest of the site and it
     * may disable the option to repair the input text.

    ! empty ( $text )
        and print '<h3>Preview</h3><div style="border:3px solid #369;padding:10px">'
            . $instance['text'] . '</div>';
    /**/
            ?>
    <?php
            }
            }

    add_action( 'widgets_init', 'register_wMenuWidget_widget', 20 );

    function register_wMenuWidget_widget()
    {
        register_widget( 'wMenuWidget_Widget' );
    }

