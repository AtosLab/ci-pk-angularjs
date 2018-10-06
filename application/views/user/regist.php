<div class="main-content-wrap reg-main-bg clearfix">
    <div class="container reg_board">
      <div class="">
        <div class="col-sm-12">
            <div class="reg-title"><h2>会员注册</h2></div>
        </div>
        <hr>
        <div class="col-sm-6 reg_body" style="float: none;  margin: 0 auto;">
          <?php echo form_open('',array('id' => 'dlg_regist_frm')); ?>
            <div class="row">
                <div class="col-sm-3">
                    <p>账户</p>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="txt_regist_user" name="txt_regist_user"  placeholder="6-15位且仅包含英文，数字">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p>密码</p>
                </div>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-sm" id="txt_regist_password" name="txt_regist_password" placeholder="6-15位且必须包含英文和数字">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p>确认密码</p>
                </div>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-sm" id="txt_regist_cpassword" name="txt_regist_cpassword" placeholder="请确认您的密码">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p>推荐人</p>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="daliuser" name="daliuser" placeholder="请输入介绍人(可不填)">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p>QQ号</p>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="qq" name="qq" placeholder="QQ号">
                </div>
            </div>
            <span class="misalert" style="color:#f00; font-size:14px; padding-left:30px; display:none">PC蛋蛋</span>
            <hr>
            <p><button style="width:100%" type="submit" class="btn btn-primary bt_login">立即登录</button></p>
            <div class="col-sm-12">
                <div class="row">
                    <div style="float: none;  margin: 0 auto;">
                        <a href="<?php echo site_url('/user/login'); ?>" >已有账号？ 去登录</a>
                    </div>
                </div>
            </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
    $( "#dlg_regist_frm" ).submit(function( event ) {
        event.preventDefault();

        var url = "<?php echo site_url('/user/registered'); ?>";
        var data = $("#dlg_regist_frm").serializeArray();
        $.ajax({
            type: "POST",
            url: url, 
            data: data,
            success : 
                function(msg) {
                    msg = JSON.parse(msg);
                    if(msg == "注册成功"){
                        window.location.href = "<?php echo site_url(); ?>";
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