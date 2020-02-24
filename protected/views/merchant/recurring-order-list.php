
<!--<div class="uk-width-1"></div>-->

<div uk-grid>
    <div class="uk-width-1-4 left">
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/recurringorders/Do/Add" class="uk-button uk-button-default"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/recurringorders" class="uk-button uk-button-default"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
    </div>
    <div class="uk-width-3-4 boundary-align">
        <div class="uk-margin-small right">
            <button class="uk-button uk-button-primary uk-float-left" type="button"><span uk-icon="settings"></span> Advance Filter</button>
            <div uk-dropdown="pos: bottom-justify; boundary: .boundary-align; boundary-align: true">
                <ul class="uk-nav uk-dropdown-nav">
                    <form class="uk-form-horizontal uk-margin-small uk-grid-small" method="POST" id="advanceFilter" onsubmit="return false;">
                        <input type="hidden" name="action" id="action" value="advanceFilterOption">
                        <input type="hidden" name="tbl" id="tbl" value="item">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-select">Select Order Status</label>
                            <div class="uk-form-controls">
                                <?php
                                    $status_list=Yii::app()->functions->orderStatusList();
                                    echo CHtml::dropDownList('status',' ',(array)$status_list,array(
                                    'class'=>"uk-select",'id'=>"form-horizontal-select"
                                ))?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-select">Select trans Type</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" id="form-horizontal-select" name="trans_type">
                                    <option value=""> Select trans type</option>
                                    <option value="delivery">Delivery</option>
                                    <option value="pickup">Pick-up</option>recurringOrder
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-select">Select Payment Method</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" id="form-horizontal-select" name="method">
                                    <option value="">Select Payment</option>
                                    <option value="cod">Cash On Delivery</option>
                                    <option value="payu">Payu</option>
                                    <option value="paypal">Paypal</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-select">Select Platform</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" name="platform" id="form-horizontal-select">
                                    <option value="">Select Platform</option>
                                    <option value="mobileapp2">Mobile</option>
                                    <option value="web">Web</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin right">
                            <div class="uk-form-controls">
                                <button class="uk-button uk-button-primary" onclick="display_advance_filter();">Apply</button>
                            </div>
                        </div>
                    </form>
                </ul>
            </div>
    </div>
</div>

<form id="frm_table_list" method="POST" class="report uk-form uk-form-horizontal merchant-dashboard" >
<input type="hidden" name="action" id="action" value="recurringOrder">
<input type="hidden" name="tbl" id="tbl" value="item">
<table id="table_list" class="uk-table uk-table-divider uk-table-striped uk-table-condensed sbn_ro">
  <!--<caption>Merchant List</caption>-->
   <thead>
        <tr> 
            
            <th width="1%"><?php echo Yii::t('default',"Ref#")?></th>
            <th width="10%"><?php echo Yii::t('default',"Delivery Date")?></th>  
            <th width="8%"><?php echo Yii::t('default',"Name")?></th>
            <th width="6%"><?php echo Yii::t('default',"Contact")?></th>
            <th width="15%"><?php echo Yii::t('default',"Item")?></th>         
            <th width="10%"><?php echo Yii::t('default',"P/T/P")?></th>
            <th width="10%"><?php echo Yii::t('default',"Price")?></th>
            <!--<th width="3%"><?php //echo Yii::t('default',"Tax")?></th>
            <th width="3%"><?php //echo Yii::t('default',"Total W/Tax")?></th>-->
            <th width="3%"><?php echo Yii::t('default',"Status")?></th>
            <th width="3%"></th>
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>
<div class="clear"></div>
</form>