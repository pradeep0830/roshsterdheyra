

<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/driver-add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>

<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/driverlist" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>

</div>

<?php 
if (isset($_GET['id'])){
	if (!$data=Yii::app()->functions->GetDriver($_GET['id'])){
		echo "<div class=\"uk-alert uk-alert-danger\">".
		Yii::t("default","Sorry but we cannot find what your are looking for.")."</div>";
		return ;
	}
}
?>                                   
<?php 
//if($team_list= Driver::teamList( Driver::getUserType(),Driver::getUserId() ) ){
if($team_list= Driver::teamListNormal( 'admin',Yii::app()->functions->getAdminId()) ){
$team_list=Driver::toList($team_list,'team_id','team_name',
Driver::t("Please select a team from a list") );
}
?>
<div class="spacer"></div>

<form class="uk-form uk-form-horizontal forms" id="forms">
<!-- <?php echo CHtml::hiddenField('action','driverAdd')?>
<?php echo CHtml::hiddenField('id',isset($_GET['id'])?$_GET['id']:"");?>
<?php if (!isset($_GET['id'])):?> -->
    <?php echo CHtml::hiddenField('action','driverAdd')?>
    <?php echo CHtml::hiddenField('id','')?>
    <?php echo CHtml::hiddenField('profile_photo','')?>
<?php echo CHtml::hiddenField("redirect",Yii::app()->request->baseUrl."/admin/driver-add")?>
<!-- <?php endif;?> -->


<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","First Name")?></label>
  <?php 
  echo CHtml::textField('first_name',
  isset($data['first_name'])?$data['first_name']:""
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required"))
  ?>
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Last Name")?></label>
  <?php 
  echo CHtml::textField('last_name',
  isset($data['last_name'])?$data['last_name']:""
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required"))
  ?>
</div>

<div class="uk-form-row"> 
  <label class="uk-form-label"><?php echo t("Profile Photo")?></label>
  <a href="javascript:;" id="sau_upload_file" 
   class="button uk-button" data-progress="sau_progress" data-preview="image_preview" data-field="profile_photo">
    <?php echo t("Browse")?>
  </a>
</div>
<div class="sau_progress"></div>

<div class="image_preview">
 <?php 
 $image=isset($data['profile_photo'])?$data['profile_photo']:'';
 if(!empty($image)){
 	echo '<img src="'.FunctionsV3::getImage($image).'" class="uk-thumbnail" id="logo-small"  />';
 	echo CHtml::hiddenField('profile_photo',$image);
 	echo '<br/>';
 	echo '<a href="javascript:;" class="sau_remove_file" data-preview="image_preview" >'.t("Remove image").'</a>';
 }
 ?>
</div>	

<div style="height:20px;"></div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Email")?></label>
  <?php 
  echo CHtml::textField('email',
  isset($data['email'])?$data['email']:""
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required"))
  ?>
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Phone Number")?></label>
  <?php 
  echo CHtml::textField('phone',
  isset($data['phone'])?$data['phone']:""
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required"))
  ?>
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Username")?></label>
  <?php 
  echo CHtml::textField('username',
  isset($data['username'])?$data['username']:""
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required"))
  ?>
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Phone Number")?></label>
  <?php 
  echo CHtml::passwordField('password',
  isset($data['password'])?$data['password']:""
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required"))
  ?>
</div>

<div class="uk-form-row">
    <label class="uk-form-label"><?php echo Driver::t("Assign to Team")?></label>

    <?php 
    echo CHtml::dropDownList('team_id_driver_new','',(array)$team_list,array(
        'class'=>'team_id_driver_new',
        //'required'=>true
    ));
    ?>
    
</div>

<div class="uk-form-row">   
    <label class="uk-form-label"><?php echo Driver::t("Transport Type")?></label>
    <?php 
        echo CHtml::dropDownList('transport_type_id','',
        Driver::transportType()
        ,array(
        ));
    ?>
</div>
            
<div class="uk-form-row">
    <label class="uk-form-label"><?php echo Driver::t("Transport Description (Year,Model)")?></label>
    <?php echo CHtml::textField('transport_description')?>
</div> 


<div class="uk-form-row">
    <label class="uk-form-label"><?php echo Yii::t("default","Licence Plate")?></label>
    <?php echo CHtml::textField('licence_plate','',array(
    'class'=>'uk-form-width-medium',
    ))?>
</div>

<div class="uk-form-row">
    <label class="uk-form-label"><?php echo Yii::t("default","Color")?></label>
    <?php echo CHtml::textField('color','',array(
        'class'=>'uk-form-width-medium',
    ))?>
</div>
        
<div class="uk-form-row">
    <label class="uk-form-label"><?php echo Driver::t("Status")?></label>
    <?php 
        echo CHtml::dropDownList('status','',Driver::driverStatus(),array(
            'required'=>true
        ));
    ?>
</div>
	
<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>

</form>