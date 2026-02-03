<?php
include 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Địa điểm không hợp lệ.");
}

$place_id = (int)$_GET['id'];

// Lấy thông tin địa điểm
$stmt = $conn->prepare("SELECT * FROM places WHERE id = ?");
$stmt->bind_param("i", $place_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die("Địa điểm không tồn tại.");
}

$place = $result->fetch_assoc();
$stmt->close();

// Lấy bình luận cho địa điểm này
// Cần cập nhật bảng comments để liên kết comment với place_id (bước tiếp theo)

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($place['name']) ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1><?= htmlspecialchars($place['name']) ?></h1>
  <p><?= nl2br(htmlspecialchars($place['description'])) ?></p>
  <?php if ($place['image'] && file_exists('images/' . $place['image'])): ?>
    <img src="images/<?= htmlspecialchars($place['image']) ?>" alt="<?= htmlspecialchars($place['name']) ?>" style="max-width:400px;">
  <?php endif; ?>

  <h2>Bình luận về địa điểm này</h2>

  <form action="comment.php" method="POST">
    <input type="hidden" name="place_id" value="<?= $place['id'] ?>">
    <input type="text" name="name" placeholder="Tên của bạn" required><br><br>
    <textarea name="message" placeholder="Chia sẻ trải nghiệm..." required></textarea><br><br>
    <button type="submit">Gửi bình luận</button>
  </form>

  <?php
  // Lấy bình luận theo place_id
  $stmt = $conn->prepare("SELECT * FROM comments WHERE place_id = ? ORDER BY created_at DESC");
  $stmt->bind_param("i", $place_id);
  $stmt->execute();
  $comments = $stmt->get_result();

  if ($comments->num_rows > 0):
    while($row = $comments->fetch_assoc()):
  ?>
    <div class="comment">
      <strong><?= htmlspecialchars($row['name']) ?></strong> (<?= $row['created_at'] ?>)<br>
      <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
    </div>
  <?php
    endwhile;
  else:
    echo "<p>Chưa có bình luận nào.</p>";
  endif;
  $stmt->close();
  $conn->close();
  ?>
</body>
</html>
