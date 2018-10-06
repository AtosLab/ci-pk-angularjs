
<div class="p_week_record">
    <h5 class="hotgame_mark">存款记录</h5>
    <div style="text-align:center">
        <label> 记录 </label>
        <div class="row u_block table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>时间</th>
                        <th>金额</th>
                        <th>状态</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $row_no = 0;
                    foreach ($others['data'] as $item) {
                        echo '<tr>';
                        echo '  <td>'.(++$row_no).'</td>';
                        echo '  <td>'. $item['rechTime'] .'</td>';
                        echo '  <td>'. $item['rechMoney'] .'</td>';
                        echo '  <td>'. $others['arrRechStatus'][$item['status']] .'</td>';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

                </div>
            </div>
        </div>
      </div>

    </div>
    <!-- /.container -->