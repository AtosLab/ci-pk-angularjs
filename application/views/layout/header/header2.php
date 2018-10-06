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
                <a class="nav-link">客服中心</a>
            </li>
            <!-- <em class="left_right_pd">|</em>
            <li class="nav-item">
                <a class="nav-link"><span class="icon img-peson"><em class="red-dot"></em></span>英雄榜</a>
            </li> -->
            <em class="left_right_pd">|</em>
            <li class="nav-item">
                <a class="nav-link"><span class="icon img-mes"><em class="red-dot"></em></span> 平台公告</a>
            </li>
            <em class="left_right_pd">|</em>
            <li class="nav-item">
                <a class="nav-link"><span class="icon img-person"><em class="red-dot"></em></span> <?php echo $user['username']; ?></a>
            </li>
            <li class="nav-item">
                <div class="row">
                    <a class="nav-link">余额:</a>
                    <a class="nav-link" style="float:left; padding-left:10px!important"><?php echo $user['coin']; ?></a>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link btn-danger" data-toggle="modal" data-target="#modal_dlg_login">充值</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-primary" data-toggle="modal" data-target="#modal_dlg_signup">提现</a>
            </li>
            <em class="left_right_pd">|</em>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('/user/logout'); ?>">退出</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>