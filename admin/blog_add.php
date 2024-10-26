<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

if (isset($_POST['submit'])) {
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
  move_uploaded_file($_FILES['image']['tmp_name'], $target_file_image);
  move_uploaded_file($_FILES['author_image']['tmp_name'], $target_file_author_image);

  // Insert the data into the database
  $query = "INSERT INTO blogs (title, meta, image, card_text, blog_content, author_image, author_info) 
            VALUES ('$title', '$meta', '$image', '$card_text', '$blog_content', '$author_image', '$author_info')";

  if (mysqli_query($conn, $query)) {
    echo "Blog created successfully.";
    header("Location: admin_home.php"); // Redirect to admin dashboard or blog list
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}
?>
?>
<?php include './shortcuts/admin_header.php'; ?>
<main>
  <div class="head-title">
    <div class="left">
      <h1>Add New Trainer</h1>
      <ul class="breadcrumb">
        <li><a href="#">Add Trainer</a></li>
        <li><i class='fas fa-chevron-right'></i></li>
        <li><a class="active" href="admin_home.php">Home</a></li>
      </ul>
    </div>
  </div>
  <div class="form-container">
    <h2 class="form-title">Add Trainer</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <div>
        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image" required>
      </div>
      <div>
        <label for="title">Blog Title:</label>
        <input type="text" name="title" id="title" required>
      </div>
      <div>
        <label for="meta">Blog Meta (e.g., Date, Author):</label>
        <input type="text" name="meta" id="meta" required>
      </div>
      <div>
        <label for="card_text">Card Text:</label>
        <textarea name="card_text" id="card_text" required></textarea>
      </div>
      <div>
        <label for="blog_content">Blog Content:</label>
        <textarea name="blog_content" id="blog_content" required></textarea>
      </div>
      <div>
        <label for="author_image">Author Image:</label>
        <input type="file" name="author_image" id="author_image" required>
      </div>
      <div>
        <label for="author_info">Author Info:</label>
        <textarea name="author_info" id="author_info" required></textarea>
      </div>
      <div>
        <button type="submit" name="submit">Create Blog</button>
      </div>
    </form>

  </div>
</main>
<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>