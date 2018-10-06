<div class="p_deposit">
	<h5 class="hotgame_mark">存款</h5>
	<div class="col-sm-12" style="text-align:center" >
	<?php echo form_open(site_url('/personal_center/onlinePaydo'), array('id' => 'onlinepay_frm')); ?>
		<div class="item item-input col-sm-6" style="float: none;  margin: 0 auto; padding-top:50px">
			<input type="text" name="amount" placeholder="请填写存款金额" required class="reset-field form-control-sm form-control">
		</div>
		<p class="item-warn" style="font-size:12px; color:#e00">单笔最低10元最高5000元，如无法支付请降低额度。支付成功自动到账，无需提交存款信息</p><br>
		<label class="item item-select">
			<select name="rechId" required class="form-control form-control-sm">
				
				<?php
					echo '<option value="">选择支付账户</option>';
					foreach ($others['rechTypeList'] as $item) {
						echo '<option value="'.$item['id'].'">'.'微信支付'.$item['order'].'</option>';
					}
				?>
			</select>
			<input type="hidden" name="payId" value="<?php echo $others['rechTypeList'][0]['payCode']; ?>" />
		</label><hr>
		<input type="submit" value="开始充值" class=" col-sm-3 form-control form-control-sm btn btn-danger" />

	<?php echo form_close(); ?>
	</div>
</div>





                </div>
            </div>
        </div>
      </div>

    </div>
    <!-- /.container -->