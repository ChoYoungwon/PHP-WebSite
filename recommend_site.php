<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>recommend_site</title>
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./css/recommend.css">
</head>
<body>
<header>
    <?php include "header2.php";?>
</header>
<div id="site">
    <?php
        $site_rank=array();
        for ($i = 0; $i < count($_SESSION["site"]); $i++)
        {
            if(isset($_SESSION["site"][$i]))
            {
                 $site_rank[$i] = mb_substr($_SESSION["site"][$i], 0, 2, "utf8");
            }
        }
        echo "<table>";
        $j = 0;
        echo "<tr>";
        while ($j < 5) {
            echo '<td><a href="recommend_site.php?table='.urlencode($site_rank[$j]).'">' . htmlspecialchars($site_rank[$j]).'</a></td>';
            $j++;
        }
        echo "</tr>";
        echo "<tr>";
        while ($j < 10) {
            if($site_rank[$j] != '전주') {
                echo '<td><a href="recommend_site.php?table=' . urlencode($site_rank[$j]) . '">' . htmlspecialchars($site_rank[$j]) . '</a></td>';
            }
            $j++;
        }
        echo "</tr>";
        echo "</table>";
    ?>
</div>
<div id="site_list">
    <?php
        if(isset($_GET["table"])) {
            $table = $_GET["table"];
            $con = mysqli_connect('localhost', 'user1', '12345', 'project');
            mysqli_set_charset($con, "utf8");
            for ($i = 0; $i < 20; $i++) {
                $offset = $i;
                $sql = "SELECT 관광지명, 관광지소개, 수용인원수, 관광지소개, 소재지도로명주소, 관리기관전화번호 
                    FROM sights 
                    WHERE 소재지도로명주소 LIKE '%{$table}%' 
                    ORDER BY 수용인원수 DESC  
                    LIMIT 1 OFFSET $offset";

                $result = mysqli_query($con, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                } else {
                    echo "Error: " . mysqli_error($con);
                }
                if (!empty($row['관광지명']))
                {
                    echo "<ul>";
                    echo "<li id='head'>관광지 명</li>";
                    echo "<li id='show' >{$row['관광지명']}</li>";
                    echo "<li id='name'>관광지 소개</li>";
                    echo "<li>{$row['관광지소개']}</li>";
                    echo "<li id='name'>수용 인원 수</li>";
                    echo "<li>{$row['수용인원수']}</li>";
                    echo "<li id='name'>소재지 도로명 주소</li>";
                    echo "<li>{$row['소재지도로명주소']}</li>";
                    echo "<li id='name'>관리기관 전화번호</li>";
                    echo "<li>{$row['관리기관전화번호']}</li>";
                    echo "</ul>";
                }
            }
            mysqli_close($con);
        }
    ?>
</div>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>