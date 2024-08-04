<?php
session_start();
if (isset($_SESSION["userid"]))
    $userid = $_SESSION["userid"];
else
    $userid = "";
if (isset($_SESSION["username"]))
    $username = $_SESSION["username"];
else
    $username = "";
if (isset($_SESSION["userlevel"]))
    $userlevel = $_SESSION["userlevel"];
else
    $userlevel = "";
if (isset($_SESSION["userpoint"]))
    $userpoint = $_SESSION["userpoint"];
else $userpoint = "";
?>
<body>
<div id="top">
    <h2>
        <a href="index.php">Travel In Korea</a>
    </h2>

    <ul id = "top_menu">
        <li><?=$userid?>(<?=$username?>)님 반갑습니다😄</li>
        <li><a href="member_me.php">마이 페이지</a></li>
        <li><a href="first_page.php">로그아웃</a></li>
    </ul>
</div>

<div id="menu_bar">
    <ul>
        <li><a href="recommend_site.php">국내 추천 여행지</a></li>
        <li><a href="local_festival.php">지역 축제 일정</a></li>
        <li><a href="post_site.php">여행 공유 게시판</a></li>
    </ul>
</div>

<div id="header_img">
    <img src="./img/festival.jpg">
</div>
</body>