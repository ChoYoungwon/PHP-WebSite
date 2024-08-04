<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>recommend_site</title>
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" type="text/css" href="./css/recommend.css">
    <style>
        .date-picker-container {
            position: fixed;
            right: 2px;
            top: 15%;
            width: 15%;
            height: fit-content;
            background-color: #fff;
            margin 0;
            padding 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .date-picker-container input {
            padding: 10px;
            margin: 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
        }
        .date-picker-container button {
            padding: 10px 20px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .date-picker-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
    <?php include "header3.php"; ?>
</header>
<div class="date-picker-container">
    <h2>축제 날짜 선택</h2>
    <form action="local_festival.php" method="GET">
        <label for="start-date">시작 날짜:</label>
        <input type="date" id="start-date" name="start-date" required>
        <br>
        <label for="end-date">종료 날짜:</label>
        <input type="date" id="end-date" name="end-date" required>
        <br>
        <button type="submit">완료</button>
    </form>
</div>

<div id="site_list">
    <?php
    if (isset($_GET['start-date']) && isset($_GET['end-date'])) {
        $start = $_GET['start-date'];
        $end = $_GET['end-date'];
        $count = 0;
        if (!empty($start) && !empty($end)) {
            $con = mysqli_connect('localhost', 'user1', '12345', 'project');
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_set_charset($con, "utf8");
            for ($i = 0; $i < 20; $i++) {
                $offset = $i;
                $sql = "SELECT 축제명, 축제내용, 제공기관명, 시작일자, 종료일자, DATEDIFF(시작일자, CURDATE()) AS 차이  
                        FROM local_festival1 
                        WHERE 종료일자 > CURDATE() 
                        AND 시작일자 >= '$start' 
                        AND 종료일자 <= '$end'
                        ORDER BY 차이 
                        LIMIT 1 OFFSET $offset";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    if (!empty($row['축제명'])) {
                        echo "<ul>";
                        echo "<li id='head'>축제 명</li>";
                        echo "<li id='show'>{$row['축제명']}</li>";
                        echo "<li id='name'>축제 내용</li>";
                        echo "<li>{$row['축제내용']}</li>";
                        echo "<li id='name'>제공 기관명</li>";
                        echo "<li>{$row['제공기관명']}</li>";
                        echo "<li id='name'>시작일자</li>";
                        echo "<li>{$row['시작일자']}</li>";
                        echo "<li id='name'>종료일자</li>";
                        echo "<li>{$row['종료일자']}</li>";
                        echo "</ul>";
                    }
                    else {
                        $count += 1;
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }
            if ($count == 20)
            {
                echo "<h2 id='nope'> 결과 없음 </h2>";
            }
            mysqli_close($con);
        }
    }
    ?>
</div>
<footer>
    <?php include "footer.php"; ?>
</footer>
</body>
</html>
