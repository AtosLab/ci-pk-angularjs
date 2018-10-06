<?php //var_dump($user); exit; ?>
<div class="container">
    <div class="login_panel" style="padding: 30px 20px 24px 20px;">
        <div class="row fpart">
            <div class="col-sm-4">
                <a href="#/PersonalCenter/personalInfo?query=true" class="">
                    <img src="<?php echo base_url().'/assets/img/head6.png' ?>" alt="" width=100%>
                </a>
            </div>
            <div class="col-sm-8">
                <div class="info-box">
                    <span class="user-name"><?php echo $user['username']; ?></span><br>
                    <span>余额: <span style="color: #f00"><?php echo $user['coin']; ?></span></span><br>
                    <span><button class="btn btn-danger">充值</button><span>&nbsp</span><button class="btn btn-primary">提现</button><span>
                </div>
            </div>
        </div>
        <div class="level-info">
            <!-- <div class=""> -->
                <div class="level-icon slevel01"></div>
                <div class="progress slevel02" style="width:80%; margin:1px; float:right">
                    <div class="progress-bar progress-bar-striped progress-bar-animated loged-progress-bar ivu-tooltip" style="width: 60%;">
                        <div class="ivu-tooltip-rel">
                            <span class="progress-inner"></span>
                        </div>
                        <!-- <div class="ivu-tooltip-popper" style="position: absolute; will-change: top, left; display: none; top: 15px; left: 113px;" x-placement="bottom">
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
                        </div> -->
                    </div>
                </div>
            <!-- </div> -->
        </div>
        <span>推荐游戏</span>
        <div class="row">
            <ul class="sp_game_list">
                <li>
                    <span class="arrow" style="width:20px"> > <i class="ivu-icon ivu-icon-ios-arrow-right"></i></span>
                    <span class="lottery-logo" style="width:60px"><img src="<?php echo base_url().'/assets/img/sp_game.png' ?>" width=30% alt=""></span>
                    <span title="加拿大28" class="name">加拿大28</span>
                    <span title="官方玩法(高赔率1%-3%回水)" class="room">官方玩法(高赔率1%-3%回水)官方玩法(高赔率1%-3%回水)</span>
                    <span class="status status-red" style="background-color:#c22; color:#fff;">推荐游戏</span><br>
                </li>
                <li>
                    <span class="arrow" style="width:20px"> > <i class="ivu-icon ivu-icon-ios-arrow-right"></i></span>
                    <span class="lottery-logo" style="width:60px"><img src="<?php echo base_url().'/assets/img/sp_game.png' ?>" width=30% alt=""></span>
                    <span title="加拿大28" class="name">加拿大28</span>
                    <span title="官方玩法(高赔率1%-3%回水)" class="room">官方玩法(高赔率1%-3%回水)官方玩法(高赔率1%-3%回水)</span>
                    <span class="status status-red" style="background-color:#c22; color:#fff;">推荐游戏</span><br>
                </li>
                <li>
                    <span class="arrow" style="width:20px"> > <i class="ivu-icon ivu-icon-ios-arrow-right"></i></span>
                    <span class="lottery-logo" style="width:60px"><img src="<?php echo base_url().'/assets/img/sp_game.png' ?>" width=30% alt=""></span>
                    <span title="加拿大28" class="name">加拿大28</span>
                    <span title="官方玩法(高赔率1%-3%回水)" class="room">官方玩法(高赔率1%-3%回水)官方玩法(高赔率1%-3%回水)</span>
                    <span class="status status-red" style="background-color:#c22; color:#fff;">推荐游戏</span><br>
                </li>
                <li>
                    <span class="arrow" style="width:20px"> > <i class="ivu-icon ivu-icon-ios-arrow-right"></i></span>
                    <span class="lottery-logo" style="width:60px"><img src="<?php echo base_url().'/assets/img/sp_game.png' ?>" width=30% alt=""></span>
                    <span title="加拿大28" class="name">加拿大28</span>
                    <span title="官方玩法(高赔率1%-3%回水)" class="room">官方玩法(高赔率1%-3%回水)官方玩法(高赔率1%-3%回水)</span>
                    <span class="status status-red" style="background-color:#c22; color:#fff;">推荐游戏</span><br>
                </li>
                
            </ul>
        </div>
    </div>
</div>