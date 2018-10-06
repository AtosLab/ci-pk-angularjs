<div class="container">
  <?php echo form_open('', array('id' => 'plain_login_frm')); ?>
    <div class="login_panel">
      <div class="col-sm-12">
        <span>会员登录</span>
      </div>
      <hr>
      <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3">
                <p>账户</p>
            </div>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="txt_login_user" placeholder="请输入账户">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <p>密码</p>
            </div>
            <div class="col-sm-9">
                <input type="password" class="form-control form-control-sm" name="txt_login_password" placeholder="请输入密码">
            </div>
        </div>
        <span class="misalert" style="color:#f00; font-size:14px; padding-left:30px; display:none">PC蛋蛋</span>
        <hr>
        <p><button style="width:100%" type="submit" class="btn btn-primary bt_login">立即登录</button></p>
        <div class="col-sm-12">
            <div class="row">
                <div class="custom-control custom-checkbox col-sm-5">
                    <input type="checkbox" class="custom-control-input" id="plain_login_check_rmb" checked>
                    <label class="custom-control-label" for="plain_login_check_rmb">记住密码</label>
                </div>
                <div class="col-sm-6 login_other_links col-sm-7">
                    <a data-v-38173b6f="" href="https://s=1" >忘记密码？</a> | <a href="<?php echo site_url('/user/regist'); ?>">注册</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $( "#plain_login_frm" ).submit(function( event ) {
        event.preventDefault();

        var url = "<?php echo site_url('/user/logindo'); ?>";
        var data = $("#plain_login_frm").serializeArray();
        $.ajax({
            type: "POST",
            url: url, 
            data: data,
            success : 
                function(msg) {
                    msg = JSON.parse(msg);
                    if(msg == "success"){
                        window.location.href = "<?php echo site_url(); ?>";
                    }
                    else
                    {
                        $('.misalert').text(msg);
                        $('.misalert').show();
                    }
                }
        });
        
    });
</script>