<?php
include_once "./config/dbconnect.php";


if (isset($_GET['id'])) {
  $blog_id = $_GET['id'];

  // Fetch blog details from the database
  $query = "SELECT * FROM blogs WHERE id = $blog_id";
  $query_run = mysqli_query($conn, $query);

  // Check if the blog exists
  if (mysqli_num_rows($query_run) > 0) {
    $blog = mysqli_fetch_assoc($query_run);
  } else {
    echo "Blog not found!";
    exit;
  }
} else {
  echo "No blog ID provided!";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mishra - Gym</title>
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!--- custom css link -->

  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
  <style>
    .blog-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .blog-title {
      font-size: 2.5em;
      margin-bottom: 0.2em;
    }

    .blog-meta {
      color: black;
      font-size: 0.9em;
    }

    .featured-image img {
      width: 100%;
      height: auto;
      display: block;
      margin-bottom: 20px;
    }

    .blog-content p {
      margin-bottom: 20px;
    }

    .author-bio {
      display: flex;
      align-items: center;
      margin-top: 40px;
      border-top: 1px solid #ddd;
      padding-top: 20px;
    }

    .author-image {
      border-radius: 50%;
      width: 80px;
      height: 80px;
      margin-right: 20px;
    }

    .author-info h3 {
      margin: 0 0 10px;
    }

    .black-color {
      color: black;
    }
  </style>
</head>

<body>
  <?php include('./shortcuts/header.php');  ?>
  <div class="page-header">
    <div class="page-header-content">
      <h4 class="page-title">Pricing</h4>
      <div class="breadcrumb">
        <p><a class="breadcrumb-link" href="index.php">Home</a></p>
        <p class="breadcrumb-separator">/</p>
        <p>Pricing</p>
      </div>
    </div>
  </div>
  <section class="section blog">
    <div class="container">
      <header class="blog-header">
        <h1 class="blog-title"><?php echo $blog['title']; ?></h1>
        <p class="blog-meta"><?php echo $blog['meta']; ?></p>
      </header>

      <figure class="featured-image">
        <img src="admin/upload/<?php echo $blog['image']; ?>" alt="<?php echo $blog['title']; ?>">
      </figure>

      <article class="blog-content">
        <?php echo nl2br($blog['blog_content']); ?>
      </article>

      <section class="author-bio">
        <img src="admin/upload/<?php echo $blog['author_image']; ?>" alt="Author Image" class="author-image">
        <div class="author-info">
          <h3 class="black-color">About the Author</h3>
          <p><?php echo $blog['author_info']; ?></p>
        </div>
      </section>
    </div>
  </section>
  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <i class="fas fa-arrow-up"></i>
  </a>

  <script src="./assets/js/script.js" defer></script>
  <?php include('./shortcuts/footer.php');  ?>
</body>

</html>