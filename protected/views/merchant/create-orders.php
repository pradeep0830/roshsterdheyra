<?php
/*POINTS PROGRAM*/
$merchant_id=Yii::app()->functions->getMerchantID();
/*if (FunctionsV3::hasModuleAddon("pointsprogram")){
    unset($_SESSION['pts_redeem_amt']);
    unset($_SESSION['pts_redeem_points']);
}

$merchant_photo_bg=getOption($merchant_id,'merchant_photo_bg');
if ( !file_exists(FunctionsV3::uploadPath()."/$merchant_photo_bg")){
    $merchant_photo_bg='';
}*/

/*RENDER MENU HEADER FILE*/

/*GET MINIMUM ORDER*/

/*dump($distance);
dump($distance_type_raw);
dump($data['minimum_order']);*/

$min_fees=FunctionsV3::getMinOrderByTableRates($merchant_id,
    $distance,
    $distance_type_raw,
    $data['minimum_order']
);

//dump($min_fees);

/*ADD MERCHANT INFO AS JSON */
$cs = Yii::app()->getClientScript();
$cs->registerScript(
    'merchant_information',
    "var merchant_information =".json_encode($merchant_info)."",
    CClientScript::POS_HEAD
);

$now=date('Y-m-d');
$now_time='';

$todays_day = date("l");

$checkout=FunctionsV3::isMerchantcanCheckout($merchant_id);
$menu=Yii::app()->functions->getMerchantMenu($merchant_id , isset($_GET['sname'])?$_GET['sname']:'' , $todays_day );
//dump($menu);
//die();

//dump($checkout);

echo CHtml::hiddenField('is_merchant_open',isset($checkout['code'])?$checkout['code']:'' );

/*hidden TEXT*/
echo CHtml::hiddenField('restaurant_slug',$data['restaurant_slug']);
echo CHtml::hiddenField('merchant_id',$merchant_id);
echo CHtml::hiddenField('is_client_login',Yii::app()->functions->isClientLogin());

echo CHtml::hiddenField('website_disbaled_auto_cart',
    Yii::app()->functions->getOptionAdmin('website_disbaled_auto_cart'));

$hide_foodprice=Yii::app()->functions->getOptionAdmin('website_hide_foodprice');
echo CHtml::hiddenField('hide_foodprice',$hide_foodprice);

echo CHtml::hiddenField('accept_booking_sameday',getOption($merchant_id
    ,'accept_booking_sameday'));

echo CHtml::hiddenField('customer_ask_address',getOptionA('customer_ask_address'));

echo CHtml::hiddenField('merchant_required_delivery_time',
    Yii::app()->functions->getOption("merchant_required_delivery_time",$merchant_id));

/** add minimum order for pickup status*/
$merchant_minimum_order_pickup=Yii::app()->functions->getOption('merchant_minimum_order_pickup',$merchant_id);
if (!empty($merchant_minimum_order_pickup)){
    echo CHtml::hiddenField('merchant_minimum_order_pickup',$merchant_minimum_order_pickup);

    echo CHtml::hiddenField('merchant_minimum_order_pickup_pretty',
        displayPrice(baseCurrency(),prettyFormat($merchant_minimum_order_pickup)));
}

$merchant_maximum_order_pickup=Yii::app()->functions->getOption('merchant_maximum_order_pickup',$merchant_id);
if (!empty($merchant_maximum_order_pickup)){
    echo CHtml::hiddenField('merchant_maximum_order_pickup',$merchant_maximum_order_pickup);

    echo CHtml::hiddenField('merchant_maximum_order_pickup_pretty',
        displayPrice(baseCurrency(),prettyFormat($merchant_maximum_order_pickup)));
}

/*add minimum and max for delivery*/
//$minimum_order=Yii::app()->functions->getOption('merchant_minimum_order',$merchant_id);
$minimum_order=$min_fees;
if (!empty($minimum_order)){
    echo CHtml::hiddenField('minimum_order',unPrettyPrice($minimum_order));
    echo CHtml::hiddenField('minimum_order_pretty',
        displayPrice(baseCurrency(),prettyFormat($minimum_order))
    );
}
$merchant_maximum_order=Yii::app()->functions->getOption("merchant_maximum_order",$merchant_id);
if (is_numeric($merchant_maximum_order)){
    echo CHtml::hiddenField('merchant_maximum_order',unPrettyPrice($merchant_maximum_order));
    echo CHtml::hiddenField('merchant_maximum_order_pretty',baseCurrency().prettyFormat($merchant_maximum_order));
}

$is_ok_delivered=1;
if (is_numeric($merchant_delivery_distance)){
    if ( $distance>$merchant_delivery_distance){
        $is_ok_delivered=2;
        /*check if distance type is feet and meters*/
        //if($distance_type=="ft" || $distance_type=="mm" || $distance_type=="mt"){
        if($distance_type=="ft" || $distance_type=="mm" || $distance_type=="mt" || $distance_type=="meter"){
            $is_ok_delivered=1;
        }
    }
}

echo CHtml::hiddenField('is_ok_delivered',$is_ok_delivered);
echo CHtml::hiddenField('merchant_delivery_miles',$merchant_delivery_distance);
echo CHtml::hiddenField('unit_distance',$distance_type);
echo CHtml::hiddenField('from_address', FunctionsV3::getSessionAddress() );

echo CHtml::hiddenField('merchant_close_store',getOption($merchant_id,'merchant_close_store'));
/*$close_msg=getOption($merchant_id,'merchant_close_msg');
if(empty($close_msg)){
	$close_msg=t("This restaurant is closed now. Please check the opening times.");
}*/
echo CHtml::hiddenField('merchant_close_msg',
    isset($checkout['msg'])?$checkout['msg']:t("Sorry merchant is closed."));

echo CHtml::hiddenField('disabled_website_ordering',getOptionA('disabled_website_ordering'));
echo CHtml::hiddenField('web_session_id',session_id());

echo CHtml::hiddenField('merchant_map_latitude',$data['latitude']);
echo CHtml::hiddenField('merchant_map_longtitude',$data['lontitude']);
echo CHtml::hiddenField('restaurant_name',$data['restaurant_name']);


echo CHtml::hiddenField('current_page','menu');

if ($search_by_location){
    echo CHtml::hiddenField('search_by_location',$search_by_location);
}

echo CHtml::hiddenField('minimum_order_dinein',FunctionsV3::prettyPrice($minimum_order_dinein));
echo CHtml::hiddenField('maximum_order_dinein',FunctionsV3::prettyPrice($maximum_order_dinein));

/*add meta tag for image*/
Yii::app()->clientScript->registerMetaTag(
    Yii::app()->getBaseUrl(true).FunctionsV3::getMerchantLogo($merchant_id)
    ,'og:image');

$remove_delivery_info=false;
if($data['service']==3 || $data['service']==6 || $data['service']==7 ){
    $remove_delivery_info=true;
}

/*CHECK IF MERCHANT SET TO PREVIEW*/
$is_preview=false;
if ($food_viewing_private==2){
    if (isset($_GET['preview'])){
        if($_GET['preview']=='true'){
            if(!isset($_GET['token'])){
                $_GET['token']='';
            }
            if (md5($data['password'])==$_GET['token']){
                $is_preview=true;
            }
        }
    }
    if($is_preview==false){
        $menu='';
        $enabled_food_search_menu='';
    }
}
?>

<div class="sections section-menu">
    <div class="uk-container-large">
        <div class="row">

            <div class="col-md-8  menu-left-content">

                <div class="tabs-wrapper" id="menu-tab-wrapper">
                    <ul id="tabs">
                        <li class="active">
                            <span><?php echo t("Menu")?></span>
                            <i class="ion-fork"></i>
                        </li>
                    </ul>

                    <ul id="tab">

                        <!--MENU-->
                        <li class="active" id="menu_left_content" >
                            <div class="row">
                                <div class="col-md-4 col-xs-4 category-list">
                                    <div class="theiaStickySidebar">
                                        <?php
                                        $this->renderPartial('/front/menu-category',array(
                                            'merchant_id'=>$merchant_id,
                                            'menu'=>$menu,
                                            'show_image_category'=>getOption($merchant_id, 'merchant_show_category_image')
                                        ));
                                        ?>
                                    </div>
                                </div> <!--col-->
                                <div class="col-md-8 col-xs-8 " id="menu-list-wrapper">
                                    <?php if($enabled_food_search_menu==1):?>
                                        <form method="GET" class="frm-search-food">
                                            <?php
                                            if($is_preview==true){
                                                if(isset($_GET['preview'])){
                                                    echo CHtml::hiddenField('preview','true');
                                                }
                                                if(isset($_GET['token'])){
                                                    echo CHtml::hiddenField('token',$_GET['token']);
                                                }
                                            }
                                            ?>
                                            <div class="search-food-wrap">
                                                <?php echo CHtml::textField('sname',
                                                    isset($_GET['sname'])?$_GET['sname']:''
                                                    ,array(
                                                        'placeholder'=>t("Search"),
                                                        'class'=>"form-control search_foodname required"
                                                    ))?>
                                                <button type="submit"><i class="ion-ios-search"></i></button>
                                            </div>
                                            <?php if (isset($_GET['sname'])):?>
                                                <a href="<?php echo Yii::app()->createUrl('store/menu-'.$data['restaurant_slug'])?>">
                                                    [<?php echo t("Clear")?>]
                                                </a>
                                                <div class="clear"></div>
                                            <?php endif;?>
                                        </form>
                                    <?php endif;?>
                                    <?php
                                    $admin_activated_menu=getOptionA('admin_activated_menu');
                                    $admin_menu_allowed_merchant=getOptionA('admin_menu_allowed_merchant');
                                    if ($admin_menu_allowed_merchant==2){
                                        $temp_activated_menu=getOption($merchant_id,'merchant_activated_menu');
                                        if(!empty($temp_activated_menu)){
                                            $admin_activated_menu=$temp_activated_menu;
                                        }
                                    }

                                    $merchant_tax=getOption($merchant_id,'merchant_tax');
                                    if($merchant_tax>0){
                                        $merchant_tax=$merchant_tax/100;
                                    }

                                    switch ($admin_activated_menu)
                                    {
                                        case 1:
                                            $this->renderPartial('/front/menu-merchant-2',array(
                                                'merchant_id'=>$merchant_id,
                                                'menu'=>$menu,
                                                'disabled_addcart'=>$disabled_addcart
                                            ));
                                            break;

                                        case 2:
                                            $this->renderPartial('/front/menu-merchant-3',array(
                                                'merchant_id'=>$merchant_id,
                                                'menu'=>$menu,
                                                'disabled_addcart'=>$disabled_addcart
                                            ));
                                            break;

                                        default:
                                            $this->renderPartial('/front/menu-merchant-1',array(
                                                'merchant_id'=>$merchant_id,
                                                'menu'=>$menu,
                                                'disabled_addcart'=>$disabled_addcart,
                                                'tc'=>$tc,
                                                'merchant_apply_tax'=>getOption($merchant_id,'merchant_apply_tax'),
                                                'merchant_tax'=>$merchant_tax>0?$merchant_tax:0,
                                            ));
                                            break;
                                    }
                                    ?>
                                </div> <!--col-->
                            </div> <!--row-->
                        </li>
                        <!--END MENU-->

                        <!--OPENING HOURS-->
                        <?php if ($theme_hours_tab==""):?>
                            <li>
                                <?php
                                $this->renderPartial('/front/merchant-hours',array(
                                    'merchant_id'=>$merchant_id
                                )); ?>
                            </li>
                        <?php endif;?>
                        <!--END OPENING HOURS-->
                    </ul>
                </div>

            </div> <!-- menu-left-content-->

            <?php if (getOptionA('disabled_website_ordering')!="yes"):?>
                <div id="menu-right-content" class="col-md-4  menu-right-content <?php echo $disabled_addcart=="yes"?"hide":''?>" >
                    <div class="theiaStickySidebar">
                        <div class="box-grey rounded  relative">
                            <!--CART-->
                            <div class="inner line-top relative">

                                <i class="order-icon your-order-icon"></i>

                                <p class="bold center"><?php echo t("Your Order")?></p>

                                <div class="item-order-wrap"></div>

                                <!--VOUCHER STARTS HERE-->
                                <?php //Widgets::applyVoucher($merchant_id);?>
                                <!--VOUCHER STARTS HERE-->

                                <!--MAX AND MIN ORDR-->
                                <?php if ($minimum_order>0):?>
                                    <div class="delivery-min">
                                        <p class="small center"><?php echo Yii::t("default","Subtotal must exceed")?>
                                            <?php echo displayPrice(baseCurrency(),prettyFormat($minimum_order,$merchant_id))?>
                                    </div>
                                <?php endif;?>

                                <?php if ($merchant_minimum_order_pickup>0):?>
                                    <div class="pickup-min">
                                        <p class="small center"><?php echo Yii::t("default","Subtotal must exceed")?>
                                            <?php echo displayPrice(baseCurrency(),prettyFormat($merchant_minimum_order_pickup,$merchant_id))?>
                                    </div>
                                <?php endif;?>

                                <?php if($minimum_order_dinein>0):?>
                                    <div class="dinein-min">
                                        <p class="small center"><?php echo Yii::t("default","Subtotal must exceed")?>
                                            <?php echo FunctionsV3::prettyPrice($minimum_order_dinein)?>
                                    </div>
                                <?php endif;?>

                                <a href="javascript:;" class="clear-cart">[<?php echo t("Clear Order")?>]</a>

                            </div> <!--inner-->
                            <!--END CART-->

                            <!--DELIVERY OPTIONS-->
                            <div class="inner line-top relative delivery-option center">
                                <?php
                                echo CHtml::textField('contact_phone','',array('class'=>"form-control",'data-id'=>'contact_phone','placeholder'=>"phone number"));
                               // echo CHtml::dropDownList('payment_method','',array('card','cash'),array('class'=>"form-control",'data-id'=>'contact_phone','placeholder'=>"phone number"));
                                echo CHtml::hiddenField('delivery_type',"pickup");
                               /* echo CHtml::dropDownList('delivery_type',$now,
                                    (array)Yii::app()->functions->DeliveryOptions($merchant_id),array(
                                        'class'=>'grey-fields'
                                    ))*/
                                ?>
                                <select class="form-control" name="payment_method" id="payment_method">
                                    <option value="">--Select payment method--</option>
                                    <option value="cash">Cash</option>
                                    <option value="card">Debit/Credit Card</option>
                                </select>

                                <?php
                                echo CHtml::hiddenField('delivery_date',$now);
                                /*if($website_use_date_picker==2){
                                    echo CHtml::dropDownList('delivery_date','',
                                        (array)FunctionsV3::getDateList($merchant_id)
                                        ,array(
                                            'class'=>'grey-fields date_list'
                                        ));
                                } else {
                                    echo CHtml::hiddenField('delivery_date',$now);
                                    echo CHtml::textField('delivery_date1',
                                        FormatDateTime($now,false),array('class'=>"j_date grey-fields",'data-id'=>'delivery_date'));
                                }*/
                                ?>
                                <hr>
                                <?php if ( $checkout['code']==1):?>
                                    <a href="javascript:;" class="orange-button medium checkout uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom"><?php echo $checkout['button']?></a>
                                <?php else :?>
                                    <?php if ( $checkout['holiday']==1):?>
                                        <?php echo CHtml::hiddenField('is_holiday',$checkout['msg'],array('class'=>'is_holiday'));?>
                                        <p class="text-danger"><?php echo $checkout['msg']?></p>
                                    <?php else :?>
                                        <p class="text-danger"><?php echo $checkout['msg']?></p>
                                        <p class="small">
                                            <?php echo Yii::app()->functions->translateDate(date('F d l')."@".timeFormat(date('c'),true));?></p>
                                    <?php endif;?>
                                <?php endif;?>

                            </div> <!--inner-->
                            <!--END DELIVERY OPTIONS-->

                        </div> <!-- box-grey-->
                    </div> <!--end theiaStickySidebar-->

                </div> <!--menu-right-content-->
            <?php endif;?>

        </div> <!--row-->
    </div> <!--container-->
</div> <!--section-menu-->
<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/assets/vendor/noty-2.3.7/js/noty/jquery.noty.js', CClientScript::POS_END);
$cs->registerScriptFile('https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', CClientScript::POS_END);
$cs->registerScriptFile('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', CClientScript::POS_END);
$cs->registerScriptFile('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', CClientScript::POS_END);
$cs->registerScriptFile('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', CClientScript::POS_END);
$cs->registerScriptFile('/assets/js/sbn.js', CClientScript::POS_END);
$cs->registerScriptFile('/assets/js/back-store.js', CClientScript::POS_END);
$cs->registerScriptFile('/assets/js/store-v3.js', CClientScript::POS_END);
$cs->registerScriptFile('/assets/js/sticky.js', CClientScript::POS_END);
$cs->registerCssFile('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css');
$cs->registerCssFile('/assets/css/store.css');
$cs->registerCssFile('/assets/css/store-v2.css');
$cs->registerCssFile('/assets/vendor/ionicons-2.0.1/css/ionicons.css');
$cs->registerCssFile('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
?>