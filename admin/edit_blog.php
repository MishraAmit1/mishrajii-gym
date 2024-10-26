<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Fetch the existing blog data
  $query = "SELECT * FROM blogs WHERE id='$id'";
  $result = mysqli_query($conn, $query);
  $blog = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
  // Get the form data
  $title = $_POST['title'];
  $meta = $_POST['meta'];
  $card_text = $_POST['card_text'];
  $blog_content = $_POST['blog_content'];
  $author_info = $_POST['author_info'];

  // Handle the image uploads
  $image = $_FILES['image']['name'];
  $author_image = $_FILES['author_image']['name'];

  // Target directories
  $target_dir = "upload/";
  $target_file_image = $target_dir . basename($image);
  $target_file_author_image = $target_dir . basename($author_image);

  // Move the uploaded files to the target directories
  if (!empty($image)) {
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file_image);
    $image_update = ", image='$image'";
  } else {
    $image_update = "";
  }

  if (!empty($author_image)) {
    move_uploaded_file($_FILES['author_image']['tmp_name'], $target_file_author_image);
    $author_image_update = ", author_image='$author_image'";
  } else {
    $author_image_update = "";
  }

  // Update the blog data in the database
  $query = "UPDATE blogs SET title='$title', meta='$meta', card_text='$card_text', blog_content='$blog_content', author_info='$author_info' $image_update $author_image_update WHERE id='$id'";

  if (mysqli_query($conn, $query)) {
    echo "Blog updated successfully.";
    header("Location: admin_home.php"); // Redirect to the blog list
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}
?>

<?php include './shortcuts/admin_header.php'; ?>
<main>
  <div class="head-title">
    <div class="left">
      <h1>Edit Blog</h1>
      <ul class="breadcrumb">
        <li><a href="#">Edit Blog</a></li>
        <li><i class='fas fa-chevron-right'></i></li>
        <li><a class="active" href="admin_home.php">Home</a></li>
      </ul>
    </div>
  </div>

  <div class="form-container">
    <form action="edit_blog.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
      <label for="title">Title:</label>
      <input type="text" name="title" id="title" value="<?= $blog['title'] ?>" required><br>

      <label for="meta">Meta:</label>
      <input type="text" name="meta" id="meta" value="<?= $blog['meta'] ?>" required><br>

      <label for="card_text">Card Text:</label>
      <textarea name="card_text" id="card_text" required><?= $blog['card_text'] ?></textarea><br>

      <label for="blog_content">Blog Content:</label>
      <textarea name="blog_content" id="blog_content" required><?= $blog['blog_content'] ?></textarea><br>

      <label for="author_info">Author Info:</label>
      <textarea name="author_info" id="author_info" required><?= $blog['author_info'] ?></textarea><br>

      <label for="image">Image:</label>
      <input type="file" name="image" id="image"><br>
      <img src="../admin/upload/<?= $blog['image'] ?>" width="100" alt="Current Image"><br>

      <label for="author_image">Author Image:</label>
      <input type="file" name="author_image" id="author_image"><br>
      <img src="../admin/upload/<?= $blog['author_image'] ?>" width="100" alt="Current Author Image"><br>

      <button type="submit" name="update">Update Blog</button>
    </form>
  </div>
</main>
<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>