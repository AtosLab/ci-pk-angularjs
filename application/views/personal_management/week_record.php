<div class="p_week_record">
    <h5 class="hotgame_mark">下注记录</h5>
    <div style="text-align:center">
        <label> 记录 </label>
        <div class="row u_block table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>时间</th>
                        <th>笔数</th>
                        <th>输赢</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $row_no = 0;
                    foreach ($others['weekRecordList'] as $item) {
                        echo '<tr>';
                        echo '  <td>'.(++$row_no).'</td>';
                        echo '  <td>'. $item['statDate'] .' '.$item['week'].'</td>';
                        echo '  <td>'. $item['betCount'] .'</td>';
                        echo '  <td>'. $item['rewardRebate'] .'</td>';
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <span class="label btn-danger" style="padding: 8px; border-radius: 5px">总笔数： <span class="badges_m"><?php echo $others['allBetCount']; ?></span></span>
            </div>
            <div class="col-sm-5">
                <span class="label btn-primary" style="padding: 8px; border-radius: 5px">总输赢： <span class="badges_m"><?php echo $others['allRewardRebate']; ?></span></span>
            </div>
        </div>
    </div>
</div>










                </div>
            </div>
        </div>
      </div>

    </div>
    <!-- /.container -->

