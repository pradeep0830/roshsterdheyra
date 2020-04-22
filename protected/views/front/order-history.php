<?php 
$yii_session_token=session_id();		
$csrfTokenName = Yii::app()->request->csrfTokenName;
$csrfToken = Yii::app()->request->csrfToken;
$cancel_order_enabled = getOptionA('cancel_order_enabled');
//dump($_SESSION);die();
?>

<div class="box-grey rounded section-order-history" style="margin-top:0;">

<div class="bottom10">
<?php echo FunctionsV3::sectionHeader('Your Recent Order'); 
function searchForId($sts, $reshs) {
  foreach ($reshs as $key => $val) {
      if ($val['status'] === $sts) {
          return $val['driver_id'];
      }
  }
  return null;
}
?>
</div>
<?php if (is_array($data) && count($data)>=1):?>

<?php $payment_list=FunctionsV3::PaymentOptionList();?>

   <table class="table table-striped">
     <tbody>
     <?php foreach ($data as $val):?>     
      <tr class="tr_mobile">
        <td>
        <div class="mytable">
         <div class="mycol" style="width: 10%;"><i style="font-size: 30px;" class="ion-android-arrow-dropright"></i></div>
         <div class="mycol ">
           
           <a href="javascript:;" class="view-receipt-front" data-id="<?php echo $val['order_id']?>" >
             <p><?php echo t("Order")?># <?php echo $val['order_id']?></p>
           </a>
           
           <a href="<?php echo Yii::app()->createUrl('/ajax/viewreceipt',array(
             'order_id'=>$val['order_id'],
             'post_type'=>'get',
             'yii_session_token'=>$yii_session_token,
             "$csrfTokenName"=>$csrfToken           
           ))?>"
           class="view-receipt-mobile"  >
             <p><?php echo t("Order")?># <?php echo $val['order_id']?></p>
           </a>
           
            <p><?php echo t("Placed on");?> 
            <?php //echo Yii::app()->functions->translateDate(prettyDate($val['date_created']))?></p>
            <?php echo FunctionsV3::prettyDate($val['date_created'])?></p>
                                    
                        
            <?php if(FunctionsV3::canCancelOrderNew($val['request_cancel'],$val['date_created'],$val['status'],$val['order_locked'],$val['request_cancel_status'],$cancel_order_enabled)):?>
               <?php if($val['request_cancel']==1):?>
                  <div class="pending_for_review label label-success"><?php echo t("Pending for review")?></div>
               <?php else :?>
                  <a href="javascript:;" class="orange-button request_cancel_order <?php echo "order_id_".$val['order_id_token']?>" data-id="<?php echo $val['order_id_token']?>"><?php echo t("Cancel this order")?></a>
               <?php endif;?> 
            <?php endif;?>            
            
            <?php if ($val['request_cancel_status']!='pending'):?>
              <p>
              <span class="text-muted"><?php echo t("Request Cancel")?>: </span>
              <?php if ($val['request_cancel_status']=="approved"):?>
              <span class="text-success"><?php echo $val['request_cancel_status']?></span>
              <?php else :?>
              <span class="text-danger"><?php echo $val['request_cancel_status']?></span>
              <?php endif;?>
              </p>              
            <?php endif;?>
            
         </div>
       </div>
        </td>
        
        <td>        
        <a class="add-to-cart" href="javascript:;" data-id="<?php echo $val['order_id']?>" >    
        <p><?php echo clearString($val['merchant_name'])?></p>    
        </a>
        </td>
        
        <td> 
        <p><?php echo t("TOTAL")?></p>
        <p><?php echo FunctionsV3::prettyPrice($val['total_w_tax'])?></p>         
        </td>
        
        <td>
          <p><?php echo t("PAYMENT")?></p>
		  <p><?php 
		  /*if (array_key_exists($val['payment_type'],$payment_list)){  
		     echo $payment_list[$val['payment_type']];
		  } else echo $val['payment_type'];*/
		  echo FunctionsV3::prettyPaymentTypeTrans($val['trans_type'],$val['payment_type'])
		  ?></p>
        </td>
        
        <td>

          <a href="javascript:;" class="view-order-history" data-id="<?php echo $val['order_id'];?>">
          <p class="green-text top10 "><?php echo t($val['status'])?></p>                    
          </a>
          
          <?php if($val['review_count']<=0):?>
          <?php if(FunctionsV3::canReviewOrder($val['status'])):?>
          <a class="green-button inline-block" style="margin-top:10px;" href="<?php echo Yii::app()->createUrl('store/add_review',array(
            'order_token'=>$val['order_id_token']
          ))?>"><?php echo t("Add review")?></a>
          <?php endif;?>
          <?php endif;?>
          <!--start recurring html part-->
          <?php if ($val['recurring_id']>0):?>
              <div style="border-top:1px solid #CCC; margin-top:6px; padding-top:4px;">
                <small class="text-info"><?php echo t("Recurring Order")?>: </small>
                <?php if($val['status']=="acknowledged" || $val['status']=="accepted" || $val['status']=="pending" || $val['status']=="paid"): ?>
                  <a href="javascript:;" class="shift-my-order" data-id="<?php echo $val['order_id'];?>" data-recurring="<?php echo $val['recurring_id'] ?>">
                      <p class="blue-text top10 ">Shift my order</p>                    
                  </a>
                <?php endif; ?>
              </div>              
            <?php endif;?>
            <!--end recurring html part-->

        </td>
          <?php if ( $reshs=FunctionsK::orderHistory($val['order_id'])):             
            ?>
              <?php if(searchForId("acknowledged",$reshs)):?>
                  <td>
                      <!--start chat functions-->
                      <a href="<?php echo Yii::app()->createUrl('store/chat-driver',array(
                          'token'=>$_SESSION['kr_client']['token'],
                          'name'=>$_SESSION['kr_client']['first_name']." ".$_SESSION['kr_client']['last_name'],
                          'contact_phone'=>$_SESSION['kr_client']['contact_phone'],
                          'order_token'=>$val['order_id_token'],
                          'order_id'=>$val['order_id'],
                          'merchant_id'=>$val['merchant_id'],
                          'client_id'=>$val['client_id'],
                          'otp'=>$val['otp'],
                          'delivery_date'=>$val['delivery_date'],
                          'driver_id'=>searchForId("acknowledged",$reshs)
                      ))?>" class="btn black-button btn-sm">
                          <i class="fa fa-comments fa-lg sbn" aria-hidden="true"></i> live chat
                      </a>
                      <!--end chat functions-->
                  </td>
              <?php endif;?>
          <?php endif;  ?>

      </tr>      
            
      <tr class="order-order-history show-history-<?php echo $val['order_id']?>"> 
        <td colspan="6">
         <?php if ( $resh=FunctionsK::orderHistory($val['order_id'])):?>     
         <table class="table table-striped" >
           <thead>
             <tr>
             <th><?php echo t("Date/Time")?></th>
             <th><?php echo t("Status")?></th>
             <th><?php echo t("Remarks")?></th>
             </tr>
           </thead>
           <tbody>
           <?php foreach ($resh as $valh):?>
           
           <?php 
           $remarks = $valh['remarks'];
           if(!empty($valh['remarks2']) && !empty($valh['remarks_args']) ){
           	   $remarks_args = json_decode($valh['remarks_args'],true);
           	   if(is_array($remarks_args) && count($remarks_args)>=1){
           	      $remarks = Yii::t("driver",$valh['remarks2'],$remarks_args);            	   
           	   }
           }
           ?>
           
           <tr style="font-size:12px;">
             <td><?php                       
              echo FormatDateTime($valh['date_created'],true);
              ?></td>
             <td><?php echo t($valh['status'])?></td>
             <td><?php echo $remarks?></td>
           </tr>
           <?php endforeach;?>
         </tbody>
         </table>
         <?php else :?>
         <p class="text-danger small-text"><?php echo t("No history found")?></p>
         <?php endif;?>
        </td>
      </tr>      
      
      <?php endforeach;?>
     </tbody>
   </table>
<?php else :?>
   <p class="text-danger"><?php echo t("No order history")?></p>
<?php endif;?>


</div> <!--box-grey-->
