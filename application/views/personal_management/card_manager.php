<div class="p_cardmanager">
    <h5 class="hotgame_mark">银行账号</h5>
    <div class="backyello">
        <div class="before_d_card" >
            <span>您还没有绑定银行卡，</span>
            <?php
                if($others['hasFullname'])
                    echo '<button class="btn btn-danger" data-toggle="modal" data-target="#modal_dlg_card_plus">立即绑定</button>';
                else
                    echo '<button class="btn btn-danger" data-toggle="modal" data-target="#modal_dlg_realname">立即绑定</button>';
            ?>
        </div>
    </div>
</div>





    <div class="modal fade" id="modal_dlg_card_plus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <?php echo form_open('', array('id' => 'dlg_card_plus_frm')); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">绑定银行卡</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-3">
                            <p>开户银行</p>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control form-control-sm" name='bankId'>
                              <?php 
                                foreach ($others['bank_list'] as $item) {
                                    echo '<option value="'. $item['id'] .'">'. $item['name'] .'</option>';
                                }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">&nbsp</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p>持卡人</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" name="subAddress" placeholder="请输入持卡人姓名">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">&nbsp</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p>银行卡号</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" name="cardNo" placeholder="请输入银行卡号">
                        </div>
                    </div>
                    
                    <span class="misalert5" style="display:none; color:#f00; padding-left:50px"></span>
                    

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
              <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_dlg_realname" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <?php echo form_open('', array('id' => 'dlg_realname_frm')); ?>
                <div class="modal-header">
                    <h5 class="modal-title">绑定银行卡</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p>请务必填写真实姓名(<span>填写后不可修改</span>)</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="" class="form-control form-control-sm" id="txt_realname" name="txt_realname" placeholder="请输入持卡人姓名">
                        </div>
                    </div>                 
                    <span class="misalert5" style="display:none; color:#f00; padding-left:50px"></span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
              <?php echo form_close(); ?>
            </div>
        </div>
    </div>


                </div>
            </div>
        </div>
      </div>

    </div>
    <!-- /.container -->

<script type="text/javascript">
    $( "#dlg_realname_frm" ).submit(function( event ) {
        event.preventDefault();

        var url = "<?php echo site_url('/personal_center/setFullNamedo'); ?>";
        var rname = $("#txt_realname").val();
        $.ajax({
            type: "POST",
            url: url, 
            data: {fullName: rname },
            success : 
                function(msg) {
                    msg = JSON.parse(msg);
                    if(msg == "success"){
                        $('#modal_dlg_realname').modal('toggle');
                        $('#modal_dlg_card_plus').modal('show');
                    }
                    else
                    {
                        $(".misalert5").text(msg);
                        $(".misalert5").show();
                    }
                }
        }); 
    });
    $( "#dlg_card_plus_frm" ).submit(function( event ) {
        event.preventDefault();

        var url = "<?php echo site_url('/personal_center/bindBankdo'); ?>";
        var data = $("#dlg_card_plus_frm").serializeArray();
        $.ajax({
            type: "POST",
            url: url, 
            data: data,
            success : 
                function(msg) {
                    msg = JSON.parse(msg);
                    if(msg == "success"){
                        $('#modal_dlg_card_plus').modal('toggle');
                        location.href = location.href;
                    }
                    else
                    {
                        $(".misalert5").text(msg);
                        $(".misalert5").show();
                    }
                }
        }); 
    });
</script>