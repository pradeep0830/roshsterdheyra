<style type="text/css">
    .app-chat{
        border-radius: 5px;
        border: 1px solid #dedede;
        background-color: white;
        box-shadow: 0px 0px 5px 1px #ccc;
        margin-bottom: 30px;
    }
    .circle {
        border-radius: 50%;
    }
</style>
<div class="container" style="margin-top: 20px">
    <div class="chat-application">
        <div class="app-chat">
            <div class="content-area content-right">
                <div class="app-wrapper">
                    <div class="card card card-default scrollspy border-radius-6 fixed-width">
                        <div class="card-content chat-content p-0">
                            <!-- Content Area -->
                            <div class="chat-content-area animate fadeUp">
                                <!-- Chat header -->
                                <div class="chat-header" style="padding: 15px 25px 15px 25px;">
                                    <div class="row valign-wrapper">
                                        <div class="col-md-3 media-image online pr-0">
                                            <img src="/assets/images/avatar.jpg" alt=""
                                                 class="circle z-depth-2 responsive-img">
                                        </div>
                                        <div class="col-md-7">
                                            <p class="m-0 blue-grey-text text-darken-4 font-weight-700"><?php echo $drv_data[0]['driver_full_name'] ?></p>
                                            <h5 class="m-0 chat-text truncate" style="font-size:20px;font-weight: 600; text-transform: capitalize;"><?php echo $client_d[0]['full_name']; ?></h5><p class="m-0 chat-text truncate" style="font-size:18px; margin-top: -9px;"><?php echo $client_d[0]['contact_phone']; ?></p>
                                        </div>
                                    </div>
                                    <span class="option-icon">
                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                                        <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <!--/ Chat header -->

                                <!-- Chat content area -->
                                <div class="chat-area">
                                    <div class="chats">
                                        <div class="chats">
                                            <?php
                                            if(is_array($data)):
                                                foreach ($data as $chat_data){ ?>
                                                    <div class="chat <?php if($chat_data['sender_userid']==$_REQUEST['driver_id']){echo "chat-right";} ?>">
                                                        <div class="chat-body">
                                                            <div class="chat-text">
                                                                <p><?php echo $chat_data['message']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Chat content area -->

                                <!-- Chat footer <-->
                                <div class="chat-footer">
                                    <form onsubmit="enter_chat();" action="javascript:void(0);" class="chat-input">
                                        <input type="hidden" id="order_id" value="<?php echo $_REQUEST['order_id'] ?>">
                                        <input type="hidden" id="client_id" value="<?php echo $_REQUEST['client_id'] ?>">
                                        <input type="hidden" id="merchant_id" value="<?php echo $_REQUEST['merchant_id'] ?>">
                                        <input type="hidden" id="driver_id" value="<?php echo $_REQUEST['driver_id'] ?>">

                                        <input type="text" placeholder="Type message here.." class="message mb-0">
                                        <a class="btn green-button send" onclick="enter_chat();">Send</a>
                                    </form>
                                </div>
                                <!--/ Chat footer -->
                            </div>
                            <!--/ Content Area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="content-overlay"></div>
