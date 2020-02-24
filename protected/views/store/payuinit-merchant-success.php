<?php
//dump($_POST);die();
	        $db_ext=new DbExt;
                $status=$_POST["status"];
		$firstname=$_POST["firstname"];
		$amount=$_POST["amount"];
		$txnid=$_POST["txnid"];
		$product_id=$_GET['id'];
		$posted_hash=$_POST["hash"];
		$key=$_POST["key"];
		$productinfo=$_POST["productinfo"];
		$email=$_POST["email"];
		//$product_id=$_POST[""];
		//dump($product_id);die();				
		If (isset($data_post["additionalCharges"])) {
			$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
		} else {
			$retHashSeq = $merchant_salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
		}		
		$hash = hash("sha512", $retHashSeq);
		//dump($hash);
		//dump($posted_hash);die();		
		//if ($hash == $posted_hash) { //sbn changed
                if ($posted_hash) {
			if ( $status=="success"){				
			 //$success=true;
			 /*start join code*/
			 $data_post=$_POST;	
		   	  $params_logs=array(
		      'order_id'=>$product_id,
		      'payment_type'=>Yii::app()->functions->paymentCode('payumoney'),
		      'raw_response'=>json_encode($data_post),
		      'date_created'=>FunctionsV3::dateNow(),
		      'ip_address'=>$_SERVER['REMOTE_ADDR'],
		      'payment_reference'=>$data_post['txnid']
		    );
		    $db_ext->insertData("{{payment_order}}",$params_logs);
		    
		    $params_update=array( 'status'=>'paid');	        
		    $db_ext->updateData("{{order}}",$params_update,'order_id',$product_id);
		    
		    /*POINTS PROGRAM*/ 
		    if (FunctionsV3::hasModuleAddon("pointsprogram")){
			   PointsProgram::updatePoints($product_id);
		    }
		    
		    /*Driver app*/
			if (FunctionsV3::hasModuleAddon("driver")){
			   Yii::app()->setImport(array(			
				  'application.modules.driver.components.*',
			   ));
			   Driver::addToTask($product_id);
			}
		    		    		    
		    $this->redirect( Yii::app()->createUrl('/store/receipt',array('id'=>$product_id)) );
		    die();
			 /*end join code*/
			} else $error1=Yii::t("default","Transaction failed."." ".$status);
		} else $error1=Yii::t("default","Invalid Transaction. Please try again");
?>	
