    <!-- Page Content -->
    <div class="container">
        <div class="row info_top_panel">
            <div class="col-sm-4 part1">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="#/PersonalCenter/personalInfo?query=true" class="">
                            <img src="<?php echo base_url().'/assets/img/head6.png' ?>" alt="">
                        </a>
                    </div>
                    <div class="col-sm-8">
                        <div class="info-box">
                            <p class="user-name"><?php echo $user['username']; ?></p>
                            <p class="user-num"></p>
                            <div class="level-info">
                                <!-- <div class=""> -->
                                    <div class="level-icon slevel01"></div>
                                    <div class="progress slevel02" style="float:right; width:70%; margin:1px">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated loged-progress-bar ivu-tooltip" style="width: 60%;">
                                            <div class="ivu-tooltip-rel">
                                                <span class="progress-inner"></span>
                                            </div>
                                            <div class="ivu-tooltip-popper" style="position: absolute; will-change: top, left; display: none; top: 15px; left: 113px;" x-placement="bottom">
                                                <div class="ivu-tooltip-content">
                                                    <div class="ivu-tooltip-arrow"></div>
                                                    <div class="ivu-tooltip-inner">
                                                        <div >
                                                            <p >VIP等级:<strong class="c-red">黄铜</strong>(0 / 4999)</p>
                                                            <p >再获得<em class="c-red">4999</em>成长值即可升级</p>
                                                            <p class="btn"><a href="#/PersonalCenter/vipLevel" class="">如何升级</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <!-- <p class="link-box">
                                <div class="ivu-tooltip">
                                    <div class="ivu-tooltip-rel">
                                        <span class="icon icon-tel"></span>
                                    </div>
                                    <div class="ivu-tooltip-popper" style="position: absolute; will-change: top, left; display: none; top: 108px; left: 159px;" x-placement="bottom">
                                        <div class="ivu-tooltip-content">
                                            <div class="ivu-tooltip-arrow"></div>
                                            <div class="ivu-tooltip-inner">电话</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ivu-tooltip">
                                    <div class="ivu-tooltip-rel">
                                        <span class="icon icon-msg"></span>
                                    </div>
                                    <div class="ivu-tooltip-popper" style="position: absolute; will-change: top, left; top: 108px; left: 157px; display: none;" x-placement="bottom">
                                        <div class="ivu-tooltip-content">
                                            <div class="ivu-tooltip-arrow"></div>
                                            <div class="ivu-tooltip-inner">邮箱</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ivu-tooltip">
                                    <div class="ivu-tooltip-rel">
                                        <span class="icon icon-wx"></span>
                                    </div>
                                    <div class="ivu-tooltip-popper" style="position: absolute; will-change: top, left; top: 108px; left: 179px; display: none;" x-placement="bottom">
                                        <div class="ivu-tooltip-content">
                                            <div class="ivu-tooltip-arrow"></div>
                                            <div class="ivu-tooltip-inner">微信</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ivu-tooltip">
                                    <div class="ivu-tooltip-rel">
                                        <span data-v-1a07104a="" class="icon icon-bank"></span>
                                    </div>
                                    <div class="ivu-tooltip-popper" style="position: absolute; will-change: top, left; display: none; top: 108px; left: 225px;" x-placement="bottom">
                                        <div class="ivu-tooltip-content">
                                            <div class="ivu-tooltip-arrow"></div>
                                            <div class="ivu-tooltip-inner">银行卡</div>
                                        </div>
                                    </div>
                                </div>
                                <div data-v-1a07104a="" class="ivu-tooltip">
                                    <div class="ivu-tooltip-rel">
                                        <span data-v-1a07104a="" class="icon icon-qq"></span>
                                    </div>
                                    <div class="ivu-tooltip-popper" style="position: absolute; will-change: top, left; display: none; top: 108px; left: 247px;" x-placement="bottom">
                                        <div class="ivu-tooltip-content">
                                            <div class="ivu-tooltip-arrow"></div>
                                            <div class="ivu-tooltip-inner">QQ</div>
                                        </div>
                                    </div>
                                </div>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 part2">
                <div class="row">
                    <div class="col-sm-3">
                        <span>账号可用余额</span>
                        <br>
                        <span class="sc_count"><?php echo $user['coin']; ?></span>
                    </div>
                    <div class="col-sm-4">
                        <span>全部余额: <span>0</span></span>
                        <br>
                        <span class="sc_count">锁定余额: <span>0</span></span>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-danger"><span>充值</span></button><br>
                        <button class="btn btn-primary" style="margin-top:5px"><span>提现</span></button>
                    </div>
                    <div class="col-sm-3">
                        <a>
                            <div class="icon-jing icon" style=""></div><br>
                            <span style="font-size:15px">查看交易记录&gt;</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 part3">
                <span class="icon icon-dl"></span>
                <div><span>上次登录时间</span><br><span style="font-size:15px"><?php echo $user['updateTime']; ?></span></div>
            </div>

        </div>
      <!-- /.row -->
      <div class="row info_middle_panel">
        <div class="col-sm-12" style="border-bottom: 1px solid #e7e7e7;">
            <h4 class="public-title" style="padding-top:20px">管理中心<span> Manage Center</span></h4>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3 part-left">
                    <div class="nav-side-menu">
                        <div class="menu-list">
                            <ul id="menu-content" class="menu-content collapse out">
                                <li>
                                    <a href="<?php echo site_url('/personal_center/user_info'); ?>"><span class="icon icon-fk"></span> 个人资料 <span class="icon icon-arrowr"></span></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('/personal_center/sequrity_setting'); ?>"><span class="icon icon-aq"></span> 安全设置 <span class="icon icon-arrowr"></span></a>
                                </li>
                                <!-- <li>
                                    <a href="<?php echo site_url('/personal_center/notice'); ?>"><span class="icon icon-fk"></span> 信息中心 <span class="icon icon-arrowr"></span></a>
                                </li> -->

                                <li data-toggle="collapse" data-target="#money" class="collapsed">
                                    <a href="#"><span class="icon icon-jy"></span> 资金管理 <span class="icon icon-arrowr"></span></a>
                                </li>  
                                <ul class="sub-menu collapse" id="money">
                                    <li><a href="<?php echo site_url('/personal_center/deposit'); ?>">存款</a></li>
                                    <li><a href="<?php echo site_url('/personal_center/withdraw'); ?>">取款</a></li>
                                    <li><a href="<?php echo site_url('/personal_center/trans_in'); ?>">存款记录</a></li>
                                    <li><a href="<?php echo site_url('/personal_center/trans_out'); ?>">取款记录</a></li>
                                </ul>
                                <li>
                                    <a href="<?php echo site_url('/personal_center/card_manager'); ?>"><span class="icon icon-jy"></span> 银行账号 <span class="icon icon-arrowr"></span></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('/personal_center/daily_record'); ?>"><span class="icon icon-tz"></span> 今日已结 <span class="icon icon-arrowr"></span></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('/personal_center/week_record'); ?>"><span class="icon icon-tz"></span> 下注记录 <span class="icon icon-arrowr"></span></a>
                                </li>
                                <li>
                                    <a href="mqqwpa://im/chat?chat_type=wpa&uin=qqqqqq&version=1&src_type=web&web_src=com" target="_blank"><span class="icon icon-td"></span> 客服 <span class="icon icon-arrowr"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    

                    

                    

                    

                <!-- </div>
            </div>
        </div>
      </div>

    </div> -->
    <!-- /.container -->

