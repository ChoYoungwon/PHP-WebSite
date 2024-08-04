<div id="local">
    <?php
    $festival_name = array();
    $start_day = array();
    $finish_day = array();
    $location = array();
    $con = mysqli_connect("localhost", "user1", "12345", "project");
    mysqli_set_charset($con, "utf8");
    for ($i = 0; $i < 15; $i++)
    {
        $offset = $i;
        $sql = "select 축제명, 시작일자, 제공기관명, 종료일자, DATEDIFF(시작일자, CURDATE()) AS 차이  
                     from local_festival1 
                     where 종료일자 > CURDATE()
                     ORDER BY 차이  
                     limit 1 offset $offset";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $festival_name[$i] = $row['축제명'];
            $location[$i] = $row['제공기관명'];
            $start_day[$i] = $row['시작일자'];
            $finish_day[$i] = $row['종료일자'];
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
    echo "<a> 진행중인 지역 축제 LIST (2024년 ~ ) </a>";
    echo "<table>";
    echo "<tr id='f_column'>";
    echo "<th>지역 축제명</th>";
    echo "<th>제공기관명</th>";
    echo "<th>축제시작일자</th>";
    echo "<th>축제종료일자</th>";
    echo "</tr>";
    for ($i = 0; $i <count($festival_name); $i++)
    {
        echo "<tr>";
        echo "<td>$festival_name[$i]</td>";
        echo "<td>$location[$i]</td>";
        echo "<td>$start_day[$i]</td>";
        echo "<td>$finish_day[$i]</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</div>

<div id="top10">
        <?php
            $rank = array();
            $view = array();
            $con = mysqli_connect("localhost", "user1", "12345", "project");
            mysqli_set_charset($con, "utf8");
            for ($i = 0; $i < 10; $i++)
            {
                $offset = $i;
                $sql = "select SRCHWRD_NM, SCCNT_SM_VALUE  from top10_trend limit 1 offset $offset";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $rank[$i] = $row['SRCHWRD_NM'];
                    $view[$i] = $row['SCCNT_SM_VALUE'];
                } else {
                    echo "Error: " . mysqli_error($con);
                }
                $_SESSION["site"][$i] = $rank[$i];
            }
            echo "<ul>";
            echo "<li id='head'>국내 여행 TOP10 트랜드<br>(바로가기)</li>";
            for ($i = 0; $i < count($rank); $i++ )
            {
                $r = $i +1;
                echo "<li id='list'><a href='recommend_site.php?table=" . mb_substr($rank[$i], 0, 2, 'utf8'). "'>
                        {$r}등 : {$rank[$i]} &nbsp;<a id='t'>(검색량 : {$view[$i]}회)</a></a></li>";
            }
            echo "</ul>";
            mysqli_close($con);
        ?>
</div>

 <div id="local2">
     <?php
     $festival_name = array();
     $start_day = array();
     $finish_day = array();
     $location = array();
     $con = mysqli_connect("localhost", "user1", "12345", "project");
     mysqli_set_charset($con, "utf8");
     for ($i = 0; $i < 15; $i++)
     {
         $offset = $i;
         $sql = "select 축제명, 제공기관명, 시작일자, 종료일자, DATEDIFF(시작일자, CURDATE()) AS 차이  
                     from local_festival1 
                     where 종료일자 > CURDATE() and 시작일자 > CURDATE()
                     ORDER BY 차이  
                     limit 1 offset $offset";
         $result = mysqli_query($con, $sql);
         if ($result) {
             $row = mysqli_fetch_assoc($result);
             $festival_name[$i] = $row['축제명'];
             $location[$i] = $row['제공기관명'];
             $start_day[$i] = $row['시작일자'];
             $finish_day[$i] = $row['종료일자'];
         } else {
             echo "Error: " . mysqli_error($con);
         }
     }
     echo "<a> 진행 예정 지역 축제 LIST (현재 ~ ) </a>";
     echo "<table>";
     echo "<tr id='f_column'>";
     echo "<th>지역 축제명</th>";
     echo "<th>제공기관명</th>";
     echo "<th>축제시작일자</th>";
     echo "<th>축제종료일자</th>";
     echo "</tr>";
     for ($i = 0; $i <count($festival_name); $i++)
     {
         echo "<tr>";
         echo "<td>$festival_name[$i]</td>";
         echo "<td>$location[$i]</td>";
         echo "<td>$start_day[$i]</td>";
         echo "<td>$finish_day[$i]</td>";
         echo "</tr>";
     }
     echo "</table>";
     ?>
 </div>
