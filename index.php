<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>My travels</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="wrapper">
  <div id="header">
    <h1>WELCOME TO MY TRAVEL</h1>
  
 </div>
<!-- end header -->
 <div id = " wrapp-maincontent">
  <div id="content">
  
    <h2>Giới thiệu</h2>
    <p> Mình luôn cảm thấy du lịch là một trải nghiệm tuyệt vời, không chỉ để khám phá những địa danh mới mà còn để tìm hiểu về con người, văn hóa và lối sống ở những nơi khác nhau. Mỗi chuyến đi đều mang lại cho mình những cảm xúc khác biệt, từ sự háo hức khi khám phá vùng đất mới đến cảm giác thư giãn, tự do khi hòa mình vào thiên nhiên. Mình mong muốn có thể chia sẻ niềm đam mê này với mọi người, để mọi người cùng tìm thấy những khoảnh khắc đáng nhớ, những phút giây thư giãn, tận hưởng cuộc sống tươi đẹp này.</p>
  </div>
 
 <!-- end main content -->

  <div id="mytrips">
    <h2>Trải nghiệm</h2>
    <p> Những nơi tôi đã đặt chân đến!</p>
  <ul>
    <?php
    $sql = "SELECT * FROM places";
    $result = $conn->query($sql);
    if ($result->num_rows > 0):
      while($place = $result->fetch_assoc()):
    ?>
      <li>
        <a href="place.php?id=<?= $place['id'] ?>">
          <strong><?= htmlspecialchars($place['name']) ?></strong>
        </a>: <?= htmlspecialchars($place['tomtat']) ?>
      </li>
    <?php
      endwhile;
    else:
      echo "<li>Chưa có địa điểm nào.</li>";
    endif;
    ?>
  </ul>
  </div>
  </div>
  
  <div id= "footer">
    <p>&copy; 2025 Trang Web Của Tôi</p>
  </div>
  <!-- end footer -->
</div>
</body>
</html>
