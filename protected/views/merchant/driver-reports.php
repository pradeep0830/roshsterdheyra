<style type="text/css">
    .amcharts-chart-div{
        min-height: 350px !important;
    }
</style>
<div class="">
    <div class="row uk-text-center uk-grid">
        <div class="col-md-3 uk-width-1-4">
            <?php echo CHtml::hiddenField('chart_type','task_completion')?>
            <!-- <input type="hidden" name="action" id="action" value="recurringOrder"> -->
            <?php echo CHtml::hiddenField('chart_type_option','time')?>
            <div class="uk-margin uk-text-left">
                <label class="uk-form-label"><?php echo Driver::t("Time") ?></label>
                <?php
                echo CHtml::dropDownList('time_selection','',array(
                    "week"=>Driver::t("Past Week"),
                    "month"=>Driver::t("Past Month"),
                    "custom"=>Driver::t("Custom Date"),
                ),array(
                    'class'=>"uk-form-control uk-select"
                ))?>
            </div>
            <div class="custom_selection top20 uk-text-left">
                <div class="uk-margin">
                    <label class="uk-form-label"><?php echo Driver::t("Start Date")?></label>
                    <?php echo CHtml::textField('start_date',$start_date,array(
                        'class'=>"form-control datetimepicker1 uk-input"
                    ))?>
                </div>
                <div class="uk-margin">
                    <lable class="top20 uk-form-label"><?php echo Driver::t("End Date")?></lable>
                    <?php echo CHtml::textField('end_date',$end_date,array(
                        'class'=>"form-control datetimepicker1 uk-input"
                    ))?>
                </div>
            </div> <!--custom_selection-->
            <div class="uk-margin uk-text-left">
                <label class="top20 uk-form-label"><?php echo Driver::t("Team") ?></label>
                <?php
                echo CHtml::dropDownList('team_selection','',(array)$team_list,array(
                    'class'=>"form-control uk-select"
                ))
                ?>
            </div>
            <div class="uk-margin uk-text-left">
                <label class="top20 uk-form-label"><?php echo Driver::t("Driver") ?></label>
                <select name="driver_selection" id="driver_selection" class="driver_selection form-control uk-select">
                    <?php if(is_array($all_driver) && count($all_driver)>=1):?>
                        <option value="all"><?php echo Driver::t("All Driver")?></option>
                        <?php foreach ($all_driver as $val):?>
                            <option class="<?php echo "team_opion option_".$val['team_id']?>" value="<?php echo $val['driver_id']?>">
                                <?php echo $val['first_name']." ".$val['last_name']?>
                            </option>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
            </div>
            <!-- <h4 class="top20"><?php echo Driver::t("Task Performance")?></h4>
        <p>
        <a href="javascript:;" class="view_charts" data-id="task_completion" >
          <?php echo Driver::t("Task Completion")?>
        </a>
        </p>
        <p>
        <a href="javascript:;" class="view_charts" data-id="task_punctuality" >
          <?php echo Driver::t("Task Punctuality")?>
        </a>
        </p>-->

        </div> <!--col-->
        <div class="col-md-9 uk-width-3-4">
            <div class="report_div"></div>
            <div class="row top30">
                <div class="col-md-3 col-xs-offset-5">
                    <!-- <div class="btn-group">
                        <a href="javascript:;" data-id="time" class="btn btn-primary uk-button-primary uk-button change_charts"><?php echo Driver::t("Time")?></a>
                        <a href="javascript:;" data-id="agent" class="btn btn-primary uk-button-primary uk-button change_charts"><?php echo Driver::t("Agent")?></a>
                    </div> -->
                </div>
            </div>

        </div> <!--col-->
    </div> <!--row-->

    <!-- <table class="table top30 table-hover table-striped uk-table uk-table-divider">
     <thead>
      <tr>
       <th><?php /*echo Driver::t("Date")*/?></th>
       <th><?php /*echo Driver::t("Successful Tasks")*/?></th>
       <th><?php /*echo Driver::t("Cancelled Tasks")*/?></th>
       <th><?php /*echo Driver::t("Failed Tasks")*/?></th>
       <th><?php /*echo Driver::t("Total Tasks")*/?></th>
      </tr>
     </thead>
    </table>-->

    <div class="table_charts uk-margin-top"></div>

</div> <!--inner-->
<?php

//$cs->registerCssFile('../protected/modules/driver/assets/driver.js');
?>