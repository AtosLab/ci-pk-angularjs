    <!-- Navigation -->
    <nav class="c_second_nav navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url().'/assets/img/logo.png' ?>" width=50%></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link navsub" href="#">购彩大厅</a>
              <div  class="lobbyBox" style="display: none;">
                <div class="lobby" style="border: 1px solid #888">
                  <div class="row">
                    <div class="col-sm-4 lobby_item">
                      <img src="<?php echo base_url().'/assets/img/g_mssc.png' ?>" width="25px">
                      <a style="color: rgba(208,2,27,.67);"> 极速赛车</a><br>
                      <span style="font-size:14px">极速赛车</span>
                    </div>
                    <div class="col-sm-4 lobby_item">
                      <img src="<?php echo base_url().'/assets/img/g-bjpk10.png' ?>" width="25px">
                      <a style="color: rgba(208,2,27,.67);"> 北京PK10</a><br>
                      <span style="font-size:14px">北京PK10</span>
                    </div>
                    <div class="col-sm-4 lobby_item">
                      <img src="<?php echo base_url().'/assets/img/g-ssc.png' ?>" width="25px">
                      <a style="color: rgba(208,2,27,.67);" href="<?php echo base_url().'game/lottery1'; ?>"> 重庆时时彩</a><br>
                      <span style="font-size:14px">重庆时时彩</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 lobby_item">
                      <img src="<?php echo base_url().'/assets/img/g-xyft.png' ?>" width="25px">
                      <a style="color: rgba(208,2,27,.67);"> 幸运飞艇</a><br>
                      <span style="font-size:14px">幸运飞艇</span>
                    </div>
                    <div class="col-sm-4 lobby_item">
                      <img src="<?php echo base_url().'/assets/img/g-msssc.png' ?>" width="25px">
                      <a style="color: rgba(208,2,27,.67);"> 极速时时彩</a><br>
                      <span style="font-size:14px">极速时时彩</span>
                    </div>
                    <div class="col-sm-4 lobby_item">
                      <img src="<?php echo base_url().'/assets/img/g-pcdd.png' ?>" width="25px">
                      <a style="color: rgba(208,2,27,.67);"> PC蛋蛋</a><br>
                      <span style="font-size:14px">PC蛋蛋</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 lobby_item">
                      <img src="<?php echo base_url().'/assets/img/g-hkc.png' ?>" width="25px">
                      <a style="color: rgba(208,2,27,.67);"> 香港六合彩</a><br>
                      <span style="font-size:14px">香港六合彩</span>
                    </div>
                    <div class="col-sm-4 lobby_item">
                      <img src="<?php echo base_url().'/assets/img/g-klsf.png' ?>" width="25px">
                      <a style="color: rgba(208,2,27,.67);"> 快乐十分</a><br>
                      <span style="font-size:14px">快乐十分</span>
                    </div>
                    <div class="col-sm-4 lobby_item">
                      <img src="<?php echo base_url().'/assets/img/g-hfc.png' ?>" width="25px">
                      <a style="color: rgba(208,2,27,.67);"> 更多彩票</a><br>
                      <span style="font-size:14px">更多彩票</span>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">开奖结果</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">活动中心</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">任务中心</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="#">手机APP</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'personal_center'; ?>">用户中心</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

<style>
  .c_second_nav .navbar-nav li > a:hover {
      background: rgba(255,186,0,.8);
      border-radius: 10px;
  }
</style>

<script>
  $(".navsub").hover(function(){
    // $(".lobbyBox").css("display", "block");
    $( ".lobbyBox" ).slideUp( 10 ).delay( 0 ).fadeIn( 100 );
    }, function(){
    // $(".lobbyBox").css("display", "none");
    $(".lobbyBox").hover(function(){
      $(".lobbyBox").css("display", "block");
      
      }, function(){
        $( ".lobbyBox" ).slideUp( 300 ).delay( 10 ).fadeOut( 1400 );
      // $(".lobbyBox").css("display", "none");
      // $( ".lobbyBox" ).slideUp( 300 ).delay( 10 ).fadeOut( 1400 );
    });
    
  });

 
</script>