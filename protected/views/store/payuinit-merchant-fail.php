<?php
$this->renderPartial('/front/banner-receipt',array(
   'h1'=>t("Payment Failed"),
   //'h1'=>Yii::app()->functions->getClientFullName(),
   'sub_text'=>t("Your Transactions failed")
));

$db_ext=new DbExt;
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="";

// Salt should be same Post Request 

If (isset($data_post["additionalCharges"])) {
			$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
		} else {
			$retHashSeq = $merchant_salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
		}
	$hash = hash("sha512", $retHashSeq);
  
       //if ($hash != $posted_hash) {
       if($posted_hash){	
		
		/*start join code*/
			 $data_post=$_POST;	
		   	  $params_logs=array(
		      'order_id'=>$_GET["id"],
		      'payment_type'=>Yii::app()->functions->paymentCode('payumoney'),
		      'raw_response'=>json_encode($data_post),
		      'date_created'=>FunctionsV3::dateNow(),
		      'ip_address'=>$_SERVER['REMOTE_ADDR'],
		      'payment_reference'=>$data_post['txnid']
		    );
		    $db_ext->insertData("{{payment_order}}",$params_logs);
		    
		    $params_update=array( 'status'=>'payment_failed');	        
		    $db_ext->updateData("{{order}}",$params_update,'order_id',$_GET["id"]);
		    
		    /*POINTS PROGRAM*/ 
		    if (FunctionsV3::hasModuleAddon("pointsprogram")){
			   PointsProgram::updatePoints($_GET["id"]);
		    }
		    
		    /*Driver app*/
			if (FunctionsV3::hasModuleAddon("driver")){
			   Yii::app()->setImport(array(			
				  'application.modules.driver.components.*',
			   ));
			   Driver::addToTask($_GET["id"]);
			}
		    		    		    
		    //$this->redirect( Yii::app()->createUrl('/store/receipt',array('id'=>$product_id)) );
		    //die(); ?>
			<div class="sections section-grey2 section-profile">
			  <div class="container">

			  <div class="row">
			  <div class="col-md-8 ">
				<h3>Your order status is <?php echo $status; ?></h3>
				<h4>Your transaction id for this transaction is <?php echo $txnid; ?> You may try making the payment by clicking the link below.</h4>
				</div>
			</div></div></div>
		  <?php
			 /*end join code*/

	       
		   } else {
        echo "Invalid Transaction. Please try again";
		 }
 ?>
