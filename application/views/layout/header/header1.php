    <!-- Top First Navigation ::::::::::     This is showed before login -->
    <nav class="c_first_nav navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link"><span class="icon img-tel" style=""></span> 手机客户端</a>
            </li>
            <em class="left_right_pd">|</em>
            <li class="nav-item">
                <a class="nav-link">帮助中心</a>
            </li>
        </ul>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link">您好，欢迎来到畅赢娱乐城!</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link btn-danger" data-toggle="modal" data-target="#modal_dlg_login">登录</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-primary" data-toggle="modal" data-target="#modal_dlg_signup">注册</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-warning" data-toggle="modal" data-target="#modal_dlg_login">游客试玩</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-dark" data-toggle="modal" data-target="#modal_dlg_login">客服中心</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- Modal -->
    <div class="modal fade" id="modal_dlg_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">会员登录</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <?php echo form_open('', array('id' => 'dlg_login_frm')); ?>
                    <div class="row">
                        <div class="col-sm-2">
                            <p>账户</p>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="txt_login_user" placeholder="请输入账户">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">&nbsp</div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-sm-8">账户不能为空</div>
                    </div> -->
                    <div class="row">
                        <div class="col-sm-2">
                            <p>密码</p>
                        </div>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="txt_login_password" placeholder="请输入密码">
                        </div>
                    </div>
                    <span class="misalert2" style="display:none; color:#f00; padding-left:50px"></span>
                    <hr>
                    <p><button style="width:100%" type="button col-sm-12" class="btn btn-primary bt_login">立即登录</button></p>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="custom-control custom-checkbox col-sm-6">
                                <input type="checkbox" class="custom-control-input" id="dlg_login_check_rmb" checked>
                                <label class="custom-control-label" for="dlg_login_check_rmb">记住密码</label>
                            </div>
                            <div class="col-sm-6 login_other_links">
                                <a data-v-38173b6f="" href="https://s=1" target="_blank">忘记密码？</a> | <a href="<?php echo site_url('/user/regist'); ?>">注册</a>
                            </div>
                        </div>
                    </div>
                  <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_dlg_signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">会员注册</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <?php echo form_open('',array('id' => 'dlg_regist_frm')); ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <p>账户</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txt_regist_user" name="txt_regist_user" placeholder="6-15位且仅包含英文，数字">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">&nbsp</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p>密码</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="txt_regist_password" name="txt_regist_password" placeholder="6-15位且必须包含英文和数字">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">&nbsp</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p>确认密码</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="txt_regist_cpassword" name="txt_regist_cpassword" placeholder="请确认您的密码">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">&nbsp</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p>推荐人</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="daliuser" name="daliuser" placeholder="请输入介绍人(可不填)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">&nbsp</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p>QQ号</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="qq" name="qq" placeholder="QQ号">
                        </div>
                    </div>
                    <span class="misalert3" style="display:none; color:#f00; padding-left:50px"></span>
                    <hr>
                    <p><button style="width:100%" id="btnRegister" type="button col-sm-12" class="btn btn-primary bt_login">立即注册</button></p>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="login_other_links" style="text-align:center">
                                <a data-v-38173b6f="" href="<?php echo site_url('/user/login'); ?>" >已有账户？去登录</a>
                            </div>
                        </div>
                    </div>
                  <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $( "#dlg_login_frm" ).submit(function( event ) {
        event.preventDefault();

        var url = "<?php echo site_url('/user/logindo'); ?>";
        var data = $("#dlg_login_frm").serializeArray();
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
                        $(".misalert2").text(msg);
                        $(".misalert2").show();
                    }
                }
        });
        
    });
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
                        $(".misalert3").text(msg);
                        $(".misalert3").show();
                    }
                }
        });
        
    });
</script>