<div class="p_week_record">
    <h5 class="hotgame_mark">取款</h5>

    <div class="col-sm-12" style="text-align:center">
        <?php echo form_open('', array('id' => 'dlg_withdraw_frm')); ?>
        <div class="">
            <h3><?php echo $others['user']['username']; ?></h3><hr>
            <p >
                用户余额：<span  style=""><span class="money" style="color:#00f"><?php echo $others['user']['coin']; ?></span> RMB</span>
            </p>
        </div>

        <div class="tab-pane active">
            <div class="item item-input col-sm-4" style="float: none;  margin: 0 auto;">
                <input class="form-control form-control-sm" type="text" id="applymoney" name="applymoney" required placeholder="请填写取款金额">
            </div>
            <span style="font-size:12px; color:#e00">单笔下限100，上限1000000</span>
            <hr>
            </div>
            <div class="item item-input">
                <p><span style="background-color:#31db69; color:#fff; padding:5px"><?php echo $others['bankinfo']['name']. '</span> <span style="background-color:#e4c350; padding:5px; color:#fff">' . $others['bankinfo']['account']. '</span> '.$others['user']['name']; ?></p>
            </div>
            <div class="item item-input col-sm-4" style="float: none;  margin: 0 auto;">
                <input class="form-control form-control-sm" type="password" id="cpassword" name="cpassword" required	maxlength="20" placeholder="请填写取款密码">
            </div><hr>
            <button type="submit" class="btn form-control btn-primary col-sm-3">确认提交</button>
        </div>
        <span class="misalert" style="display:none; color:#f00; padding-left:50px"></span>
        <?php echo form_close(); ?>
    </div>

</div>


                </div>
            </div>
        </div>
      </div>

    </div>
    <!-- /.container -->

<script type="text/javascript">
    $( "#dlg_withdraw_frm" ).submit(function( event ) {
        event.preventDefault();

        var url = "<?php echo site_url('/personal_center/withdrawdo'); ?>";
        var data = $("#dlg_withdraw_frm").serializeArray();
        $.ajax({
            type: "POST",
            url: url, 
            data: data,
            success : 
                function(msg) {
                    msg = JSON.parse(msg);
                    if(msg == "success"){
                        window.location.href = "<?php echo site_url('/personal_center/trans_out'); ?>";
                    }
                    else
                    {
                        $(".misalert").text(msg);
                        $(".misalert").show();
                    }
                }
        });
        
    });
</script>