<head>
    <meta charset="utf-8">
    <title>進貨訂單管理系統</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <style>
        .searchTable {background-color: #FFAC7D;}
        #itemTable ,#itemTable td{border: solid 1px gray;padding: 0px;}
    </style>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Page-2.css" media="screen">
</head>
<body>
    <a href="homepage.php"><img src="https://i.pinimg.com/originals/e2/5c/43/e25c43c6a65bdca84c72f0c58524fcd6.png" style="width: 30px;"></img> </a>
    <h2 class="u-align-center u-clearfix u-valign-middle u-text u-text-1">進貨訂單管理</h2>
    <form  class="searchTable" action="purchaseOrder.php" method="POST" name="query">
        <table>
            <tr>
                <td>
                    <!-- 查種類別=&nbsp
                    <select>
                        <option>紅茶</option>
                        <option>綠茶</option>
                        <option>青茶</option>
                    </select> -->
                    &nbsp&nbsp&nbsp&nbsp茶種名稱=&nbsp<input type="text" size="10" name="t_name">&nbsp&nbsp
                    訂單日期=&nbsp <input class="date" size="10" name="date_begin">&nbsp~&nbsp<input class="date" size="10" name="date_end">
                </td>
                <td>
                    <input type="submit" value="查詢" name="search">
                </td>
                <td>
                    <input type="submit" value="清除">
                </td>
            </tr>
        </table>
    </form>

    <section class="u-align-center u-clearfix u-section-1" id="sec-a1df">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-table u-table-responsive u-table-1">
          <table class="u-table-entity u-table-entity-1">
            <colgroup>
              <col width="11.7%">
              <col width="12.4%">
              <col width="10.4%">
              <!-- <col width="10.9%"> -->
              <col width="9.7%">
              <col width="14.9%">
              <col width="15.000000000000002%">
              <col width="15.200000000000003%">
            </colgroup>
            <thead class="u-custom-font u-font-courier-new u-palette-4-base u-table-header u-table-header-1">
              <tr style="height: 59px;">
                <th class="u-table-cell">採購編號<br>
                </th>
                <th class="u-table-cell">茶種名稱</th>
                <th class="u-table-cell">數量<br>
                </th>
                <!-- <th class="u-table-cell">單價<br> -->
                </th>
                <th class="u-table-cell">總價</th>
                <th class="u-table-cell">購買時間</th>
                <th class="u-table-cell">採購人員編號</th>
                <th class="u-table-cell">產地</th>
              </tr>
            </thead>
            <tbody class="u-table-body">
            <?php
                session_start();
                require_once("dbconnect.inc");
                
                if (isset($_SESSION["purchase_search"]))
                    $sql = $_SESSION["purchase_search"];
                $result = mysqli_query($link,$sql);               
                
                if(!$result){
                    echo ("Error: ".mysqli_error($link));
                    exit();
                }else{
                    $total_price = 0;
                    while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<tr style='height: 55px;'>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["purchase_id"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_type"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_num"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_price"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["tea_date"]."</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>34251</td>";
                        echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$rows["location"]."</td>";
                        echo "</tr>";
                        $total_price = $total_price + $rows["tea_price"];
                    }
                    $t_num = mysqli_num_rows($result);
                    echo "<tr style='height: 47px;' class='u-table-footer u-table-footer-1'>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'></td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>All tea</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$t_num."</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>Your Total</td>";
                    echo "<td class='u-border-1 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell'>".$total_price."</td>";
                    echo "</tr>";
                }

                mysqli_free_result($result);
                // require_once("dbclose.inc");

              ?>
          </table>
        </div>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-section-2" id="sec-e399">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <h2 class="u-text u-text-1">新增訂單</h2>
        <div class="u-form u-form-1">
        <form action="purchaseOrder.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px" source="email" name="form">
            <input type="hidden" id="siteId" name="siteId" value="165608">
            <input type="hidden" id="pageId" name="pageId" value="165609">
            <div class="u-form-group u-form-group-5">
                <label for="text-a175" class="u-form-control-hidden u-label"></label>
                <input type="text" placeholder="訂單編號" id="text-a175" name="order_id" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div>
            <div class="u-form-group u-form-group-4">
                <label for="text-6448" class="u-form-control-hidden u-label"></label>
                <select name="teaName" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5" value="茶種">
                    <option>茶種</option>
                    <option>紅茶</option>
                    <option>綠茶</option>
                    <option>青茶</option>
                    <option>烏龍茶</option>
                    <option>古早味紅茶</option>
                    <option>古早味綠茶</option>
                    <option>高山茶</option>
                    <option>台灣茶</option>
                </select>
            </div>
            <div class="u-form-group u-form-group-5">
                <label for="text-a175" class="u-form-control-hidden u-label"></label>
                <input type="number" placeholder="數量" id="text-a175" name="teaNum" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div>
            <div class="u-form-group u-form-group-5">
              <label for="text-a175" class="u-form-control-hidden u-label"></label>
              <input type="number" placeholder="總價格" id="text-a175" name="teaPrice" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-5">
            </div>
            <div class="u-form-group u-form-group-4">
              <label for="text-6448" class="u-form-control-hidden u-label"></label>
              <input type="text" placeholder="產地" id="text-6448" name="location" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-4">
            </div>
            <div class="u-form-group u-form-message">
              <label for="message-3b9a" class="u-form-control-hidden u-label">Message</label>
              <textarea placeholder="其他備註" rows="4" cols="50" id="message-3b9a" name="message" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-6"></textarea>
            </div>
            <div class="u-align-center u-form-group u-form-submit">
              <!-- <a href="#" class="u-btn u-btn-submit u-button-style">訂單送出<br>
              </a> -->
              <input type="submit" value="訂單送出" class="u-btn u-btn-submit u-button-style" name="send">
            </div>
            <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
            <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
            <input type="hidden" value="" name="recaptchaResponse">
          </form>
          <?php
            // $p_id = "";      
            // $t_num = "";
            // $t_name_ch = "";
            // $t_price = "";
            // $location = "";
            
            // if (isset($_POST["send"])) {
            //   $t_num = $_POST["teaNum"];
            //   $t_name_ch = $_POST["teaName"];
            //   $t_price = $_POST["teaPrice"];
            //   $location = $_POST["location"];
            //   $p_id = $_POST["order_id"];

            //   require_once("dbconnect.inc");

            //   $sql = " SELECT * FROM purchase WHERE purchase_id = '$p_id' ";
            //   $result = mysqli_query($link, $sql);
            //   if(!$result){              
            //     echo ("Same order id !");
            //     echo ("Error: ".mysqli_error($link));
            //     // exit();
            //   }else{
            //     $date = date('Y-m-d');
            //     $insert_sql = "INSERT INTO purchase (tea_type, tea_num, tea_price, tea_date, location, purchase_id) 
            //                   VALUES ('$t_name_ch', '$t_num', '$t_price', '$date', '$location', '$p_id');";
            //     // $_SESSION["member_add.php"] = $insert_sql;
            //     // mysqli_query($link, $insert_sql);
            //     if ($link->query($insert_sql) === TRUE) {
            //       echo "New record created successfully";
            //       echo "<meta http-equiv='refresh' content='0'>";
            //     } else {
            //       echo "Error: " . $insert_sql . "<br>" . $link->error;
            //     }
            //   }
            // }
            // require_once("dbclose.inc");
          ?>
        </div>
      </div>
    </section>
        </div>
      </div>
    </section>
</body>
<script>
    $('.date').datepicker({dateFormat: 'yy-mm-dd'});
</script>