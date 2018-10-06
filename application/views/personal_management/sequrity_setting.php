<div class="p_change_pass">
    <h5 class="hotgame_mark">安全设置</h5>
    <hr>
    <div class="row">
        <div class="col-sm-4">登录密码 <span class="icon img-lock" style=""></span></div>
        <div class="col-sm-6" style="color: #999;">登录账号需要用的密码</div>
        <div class="col-sm-2"><a class="login_pass_cbt" style="color:#007bff;" data-toggle="modal" data-target="#modal_dlg_change_login_pass">重置</a></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">支付密码 <span class="icon img-lock" style=""></span></div>
        <div class="col-sm-6" style="color: #999;">在账号资金变动时需要输入的密码</div>
        <div class="col-sm-2"><a class="money_pass_cbt" style="color:#007bff;" data-toggle="modal" data-target="#modal_dlg_change_money_pass">重置</a></div>
    </div>
    <hr>
</div>


    <div class="modal fade" id="modal_dlg_change_login_pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <?php echo form_open('', array('id' => 'dlg_change_login_pass_frm')); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">登录密码重置</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p>旧密码</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="OldLoginPwd" placeholder="请输入6-15位且必须包含英文和数字的密码">
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
                            <input type="password" class="form-control" name="NewLoginPwd" placeholder="请输入6-15位且必须包含英文和数字的密码">
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
                            <input type="password" class="form-control" name="NewLoginPwdRpt" placeholder="请输入确认密码">
                        </div>
                    </div>

                    <span class="misalert4" style="display:none; color:#f00; padding-left:50px"></span>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
              <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_dlg_change_money_pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <?php echo form_open('', array('id' => 'dlg_change_money_pass_frm')); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">支付密码重置</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="row">
                        <div class="col-sm-3">
                            <p>旧密码</p>
                        </div>
                        <div class="col-sm-9">
                          <?php
                            if($others['hasFundPwd'])
                                echo '<input type="password" class="form-control" name="oldFundPwd" placeholder="6位数字旧密码">';
                            else
                                echo '<input type="password" class="form-control" name="loginPwd" placeholder="6位数字旧密码">';
                          ?>
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
                            <input type="password" class="form-control" name="newFundPwd" placeholder="6位数字新密码">
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
                            <input type="password" class="form-control" name="newFundPwdRpt" placeholder="请输入确认密码">
                        </div>
                    </div>
                    
                    <span class="misalert4" style="display:none; color:#f00; padding-left:50px"></span>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
              <?php echo form_close(); ?>
            </div>
        </div>
    </div>







<script type="text/javascript">
    $( "#dlg_change_login_pass_frm" ).submit(function( event ) {
        event.preventDefault();

        var url = "<?php echo site_url('/personal_center/setPasswddo'); ?>";
        var data = $("#dlg_change_login_pass_frm").serializeArray();
        $.ajax({
            type: "POST",
            url: url, 
            data: data,
            success : 
                function(msg) {
                    msg = JSON.parse(msg);
                    if(msg == "success"){
                        $('#modal_dlg_change_login_pass').modal('toggle');
                        location.href = location.href;
                    }
                    else
                    {
                        $(".misalert4").text(msg);
                        $(".misalert4").show();
                    }
                }
        });
        
    });

    $( "#dlg_change_money_pass_frm" ).submit(function( event ) {
        event.preventDefault();

        var url = "<?php echo site_url('/personal_center/setCoinPwddo'); ?>";
        var data = $("#dlg_change_money_pass_frm").serializeArray();
        $.ajax({
            type: "POST",
            url: url, 
            data: data,
            success : 
                function(msg) {
                    msg = JSON.parse(msg);
                    alert(msg);
                    if(msg == "success"){
                        $('#modal_dlg_change_money_pass').modal('toggle');
                        location.href = location.href;
                    }
                    else
                    {
                        $("#modal_dlg_change_money_pass .misalert4").text(msg);
                        $("#modal_dlg_change_money_pass .misalert4").show();
                    }
                }
        });
        
    });

    // $("").click(function(){
        
    // });

</script>




                </div>
            </div>
        </div>
      </div>

    </div>
    <!-- /.container -->
