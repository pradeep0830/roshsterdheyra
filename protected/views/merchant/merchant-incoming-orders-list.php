<div class="uk-width-1">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/allincomingorders" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<form id="frm_table_list" method="POST" class="report uk-form uk-form-horizontal merchant-dashboard" >

    <input type="hidden" name="action" id="action" value="getMerchantIncomingOrder">
    <input type="hidden" name="tbl" id="tbl" value="item">
    <table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed sbn_ro">
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