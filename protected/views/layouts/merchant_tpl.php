<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>

<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/admin.css" rel="stylesheet" />

<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />

<link rel="shortcut icon" href="<?php echo  Yii::app()->request->baseUrl; ?>/favicon.ico" />

<!--START Google FOnts-->
<link href='//fonts.googleapis.com/css?family=Open+Sans|Podkova|Rosario|Abel|PT+Sans|Source+Sans+Pro:400,600,300|Roboto' rel='stylesheet' type='text/css'>
<!--END Google FOnts-->

<!--FONT AWESOME-->
<!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!--END FONT AWESOME-->

<!--UIKIT-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.3.1/dist/css/uikit.min.css" />
    <!--<link href="<?php /*echo Yii::app()->request->baseUrl; */?>/assets/vendor/uikit/css/uikit.almost-flat.min.css"
          rel="stylesheet"/>-->
<!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/css/uikit.gradient.min.css" rel="stylesheet" />-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/css/addons/uikit.addons.min.css" rel="stylesheet" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/css/addons/uikit.gradient.addons.min.css" rel="stylesheet" />
<!--UIKIT-->

<!--COLOR PICK-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/colorpick/css/colpick.css" rel="stylesheet" />
<!--COLOR PICK-->

<!--ICHECK-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/iCheck/skins/all.css" rel="stylesheet" />
<!--ICHECK-->

<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/chosen/chosen.css" rel="stylesheet" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/fancybox/source/jquery.fancybox.css" rel="stylesheet" />

<!--STARTS JQPLOT-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/jqplot/jquery.jqplot.min.css" rel="stylesheet">
<!--END JQPLOT-->

<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css" rel="stylesheet">

<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/intel/build/css/intlTelInput.css" rel="stylesheet">

<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/rupee/rupyaINR.css" rel="stylesheet" />

<?php if($this->map_provider=="mapbox" && $this->global_action_name=="merchant"):?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/leaflet/leaflet.css" rel="stylesheet" />
<?php endif;?>
<style type="text/css">
    button.uk-button.uk-button-warning {
        background: #FF9800 !important;
        color: #FFF;
    }
    button.uk-button.uk-button-success {
        background: #4CAF50 !important;
        color: #FFF;
    }
    .uk-label-pending{
        background-color: #EF6C00;
        color: #fff;
    }
    .uk-label-successful{
        background-color: #32d296;
        color: #fff;
    }
    .uk-label-accepted{
        background-color: #CDDC39;
        color: #fff;
    }
    .uk-label-Preparing{
        background-color: #004D40;
        color: #fff;
    }
    .uk-label-inprogress{
        background-color: #C51162;
        color: #fff;
    }
    div.uk-button-group > a {
        margin: 0px !important;
        padding: 0 8px !important;
    }
</style>
</head>
<body id="merchant">

<div class="header_wrap">
  <div class="left">
   <a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant"><h1><?php echo Yii::t("default","Merchant")?></h1></a>
  </div>
    
  <?php $merchant_info=(array)Yii::app()->functions->getMerchantInfo();?>  
  <?php $merchant_user_type = $_SESSION['kr_merchant_user_type'];?>
    <?php
    $merchant_user_data=json_decode($_SESSION['kr_merchant_user']);
    $merchant_users_id=$merchant_user_data[0]->merchant_user_id;
    ?>
    
  <div class="right">  
  
	<div data-uk-dropdown="{mode:'click'}" class="uk-button-dropdown">
	<button class="uk-button"><i class="fa fa-user">
	 </i> 
	  <?php echo Yii::app()->functions->getMerchantUserName()?> <i class="uk-icon-caret-down">
	 </i>
	</button>
	<div class="uk-dropdown" >
	<ul class="uk-nav uk-nav-dropdown">	   
        <?php //if (isset($merchant_info[0]->user_access)):?>
        <?php if($merchant_user_type=="merchant_user"):?>
	    <li><a href="<?php echo websiteUrl()."/merchant/profile"?>"><i class="fa fa-user"></i> <?php echo t("Profile")?></a></li>
	    <?php else :?>
	    <li><a href="<?php echo websiteUrl()."/merchant/Merchant"?>"><i class="fa fa-user"></i> <?php echo t("Profile")?></a></li>
	    <?php endif;?>
	    <li>
	      <a href="<?php echo Yii::app()->request->baseUrl."/merchant/login/logout/true"?>">
	       <i class="fa fa-sign-out"></i> <?php echo Yii::t("default","Logout")?>
	      </a>
	    </li>	    
	</ul>
	</div>
	</div>
    
  </div> <!--END RIGHT-->
    
  <div class="right">
    <?php //$merchant_info=(array)Yii::app()->functions->getMerchantInfo();?>
    <?php if (is_array($merchant_info) && count($merchant_info)>=1):?>
     <h4 class="uk-h3"><?php echo Yii::t("default","Merchant Name")?>: 
     <?php     
     if (strlen($merchant_info[0]->restaurant_name)>=15){
     	echo stripslashes(( substr($merchant_info[0]->restaurant_name,0,15)."..." ));  
     } else echo stripslashes(($merchant_info[0]->restaurant_name));      
      ?>
     <a class="merchant-status" href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/MerchantStatus" ></a>
     </h4>
    <?php endif;?>
  </div> 
  <!--close store
    <div class="right">
        <h4 class="uk-h3"><?php echo Yii::t("default", "Close Store") ?>?
            <?php
            echo CHtml::checkBox('merchant_close_store',
                Yii::app()->functions->getOption('merchant_close_store', $merchant_id) == "yes" ? true : false
                , array(
                    'class' => "icheck",
                    'value' => "yes"
                ))
            ?>
            <a href="javascript:;" data-uk-tooltip="{pos:'bottom-left'}"
               title="<?php echo Yii::t("default", "Check this box to close your store.") ?>"><i
                        class="fa fa-info-circle"></i>
            </a>
        </h4>
    </div>
   close store-->
    <!--disable order
    <div class="right">
        <h4 class="uk-h3"><?php echo Yii::t("default", "Disabled Ordering") ?>?
            <?php
            echo CHtml::checkBox('merchant_disabled_ordering',
                Yii::app()->functions->getOption('merchant_disabled_ordering',$merchant_id)=="yes"?true:false
                ,array(
                    'class'=>"icheck",
                    'value'=>"yes"
                ))
            ?>
            <a href="javascript:;" data-uk-tooltip="{pos:'bottom-left'}"
               title="<?php echo Yii::t("default", "Check this box to disable orders.") ?>"><i
                        class="fa fa-info-circle"></i>
            </a>
        </h4>
    </div>
   disable order-->
  <!--RIGHT-->
  <div class="right">
  <div class="notice-wrap"></div>
  <h4 class="uk-h3"><?php echo Yii::t("default","Published Merchant")?>?
  <?php 
  echo CHtml::checkBox('is_ready',false,array(
    'class'=>"icheck is_ready"
  ))
  ?>
  <a href="javascript:;" data-uk-tooltip="{pos:'bottom-left'}" title="<?php echo Yii::t("default","Check this box to published your merchant, if this box is not check your merchant will not show on search result.")?>" ><i class="fa fa-info-circle"></i>
</a>
  </h4>
  </div>
    
  <div class="right">
  <a target="_blank" class="uk-button uk-button-primary uk-button-small"
  href="<?php echo Yii::app()->request->baseUrl."/menu-".$merchant_info[0]->restaurant_slug;?>">
  <i class="fa fa-cutlery"></i> <?php echo t("View")?></a>
  </div>
  
  <?php if ( $merchant_info[0]->is_commission==2):?>
  <div class="right">
  <h3 class="uk-button uk-button-success"><?php echo t("Your balance")?>: 
  <span class="merchant_total_balance commission_loader"></span>
  </h3>
  </div>
  <?php endif;?>
  
  <div class="clear"></div>
</div> <!--END header_wrap-->

<div class="main_wrapper">
     <?php if($merchant_user_type=="merchant_user" && $merchant_users_id==2):?>
        <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
            <nav class="uk-navbar-container" uk-navbar style="width: 100%;background: #0D47A1;">
                <div class="uk-navbar-center sbn-m-user-nav">
                    <?php  $this->widget('zii.widgets.CMenu', Yii::app()->functions->merchantMenu());?>                 
                </div>
            </nav>
        </div>
    <?php else: ?>
         <div class="left_panel left">
             <div class="menu">
                 <?php $this->widget('zii.widgets.CMenu', Yii::app()->functions->merchantMenu());?>
             </div>
         </div>
    <?php endif; ?>

  <div class="left main_content">
     <div class="inner">
       <div class="breadcrumbs">
        <div class="inner uk-container">
          <h2 class="uk-h2"><?php echo !empty($this->crumbsTitle)?$this->crumbsTitle:'&nbsp;';?></h2>
          <?php Widgets::smsBalance();?>
          <?php Widgets::FaxBalance();?>
          <?php Widgets::languageBar("merchant",true);?>
        </div>
       </div> <!--breadcrumbs-->
       
       <div class="content_wrap">
         <?php echo $content;?>
       </div>
       
     </div> <!--INNER-->
  </div>
  <div class="clear"></div>
</div> <!--END main_wrapper-->

<?php echo CHtml::hiddenField("currentController","merchant")?>

<?php 
$website_date_picker_format=yii::app()->functions->getOptionAdmin('website_date_picker_format');
if (!empty($website_date_picker_format)){
	echo CHtml::hiddenField('website_date_picker_format',$website_date_picker_format);
}
$website_time_picker_format=yii::app()->functions->getOptionAdmin('website_time_picker_format');
if ( !empty($website_time_picker_format)){
	echo CHtml::hiddenField('website_time_picker_format',$website_time_picker_format);
}
?>
</body>

<!--*****************************************
NOTIFICATION PLAYER STARTS HERE
*****************************************-->
<?php 
$enabled_alert_sound=Yii::app()->functions->getOption("enabled_alert_sound",$merchant_id);
$merchant_booking_alert=Yii::app()->functions->getOption("merchant_booking_alert",$merchant_id);
?>
<input type="hidden" id="alert_off" name="alert_off" value="<?php echo $enabled_alert_sound?>">
<?php echo CHtml::hiddenField("booking_alert",$merchant_booking_alert);?>
<?php //if ( $enabled_alert_sound==""):?>
<div style="display:none;">
<div id="jquery_jplayer_1"></div>
<div id="jp_container_1">
<a href="#" class="jp-play">Play</a>
<a href="#" class="jp-pause">Pause</a>
</div>
</div>
<?php //endif;?>
<!--*****************************************
NOTIFICATION PLAYER END HERE
*****************************************-->

<!--PRELOADER-->
<div class="main-preloader">
   <div class="inner">
   <div class="ploader"></div>
   </div>
</div> 
<!--PRELOADER-->


<script src="//code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>  
<!--<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jquery-1.10.2.min.js" type="text/javascript"></script>  -->

<?php $js_lang=Yii::app()->functions->jsLanguageAdmin(); ?>
<?php $js_lang_validator=Yii::app()->functions->jsLanguageValidator();?>
<script type="text/javascript">
var js_lang=<?php echo json_encode($js_lang)?>;
var jsLanguageValidator=<?php echo json_encode($js_lang_validator)?>;
</script>


<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/DataTables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/DataTables/fnReloadAjax.js" type="text/javascript"></script>


<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/JQV/form-validator/jquery.form-validator.min.js" type="text/javascript"></script>

<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jquery.ui.timepicker-0.0.8.js" type="text/javascript"></script>

<!--<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/js/uploader.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/ajaxupload/fileuploader.js" type="text/javascript"></script>-->
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/SimpleAjaxUploader.min.js" type="text/javascript"></script>


<!--UIKIT-->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.3.1/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.3.1/dist/js/uikit-icons.min.js"></script>
<script src="<?php /*echo Yii::app()->request->baseUrl; */?>/assets/vendor/uikit/js/uikit.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/js/addons/notify.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/js/addons/sticky.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/js/addons/sortable.min.js"></script>
<!--UIKIT-->

<!--ICHECK-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/iCheck/icheck.js"></script>
<!--ICHECK-->

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/chosen/chosen.jquery.min.js"></script>

<!--Google Maps-->
<?php $apikey=getOptionA('google_geo_api_key');?>
<?php if (!empty($apikey)):?>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&key=<?php echo $apikey?>"></script>
<?php else :?>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&"></script>
<?php endif;?>
<!--END Google Maps-->

<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/fancybox/source/jquery.fancybox.js"></script>
<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jQuery.print.js"></script>-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jquery.printelement.js"></script>

<!--START JQPLOT-->
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jqplot/jquery.jqplot.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jqplot/excanvas.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jqplot/plugins/jqplot.barRenderer.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jqplot/plugins/jqplot.categoryAxisRenderer.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jqplot/plugins/jqplot.pointLabels.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jqplot/plugins/jqplot.json2.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<!--END JQPLOT-->

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jQuery.jPlayer.2.6.0/jquery.jplayer.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/intel/build/js/intlTelInput.js?ver=2.1.5"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jquery.creditCardValidator.js"></script>

<?php if($this->map_provider=="mapbox" && $this->global_action_name=="merchant"):?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/leaflet/leaflet.js?ver=1" type="text/javascript"></script>  
<?php endif;?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/admin.js?ver=1" type="text/javascript"></script>  

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/merchant.js?ver=1" type="text/javascript"></script>

<?php if($merchant_user_type=="merchant_user" && $merchant_users_id==2):?>
    <script type="text/javascript">
        $("#yw0").addClass("uk-navbar-nav");
        $(".inner").removeClass('inner');
        $(".content_wrap").addClass('uk-container');
    </script>
    <style type="text/css">
        ul#yw0 > li > a > i {
            padding-right: 9px;
            color: #FFF;
            font-size: 16px;
        }
        ul#yw0 > li > a{
            color:#FFF !important;
            font-weight: bold;
        }
    </style>
<?php endif; ?>
</html>