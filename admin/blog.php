<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}
?>
<?php include './shortcuts/admin_header.php'; ?>
<main>
  <div class="head-title">
    <div class="left">
      <h1>All Trainers</h1>
      <ul class="breadcrumb">
        <li><a href="#">All Trainers</a></li>
        <li><i class='fas fa-chevron-right'></i></li>
        <li><a class="active" href="admin_home.php">Home</a></li>
      </ul>
    </div>
    <a href="add_trainers_member.php" class="btn-download">
      <span class="text">Add Blog ➕</span>
    </a>
  </div>

  <div class="table-data">
    <div class="order">
      <div class="head">
        <h3>Recent Blogs</h3>
        <i class='bx bx-search'></i>
        <i class='bx bx-filter'></i>
      </div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Date</th>
            <th>Image</th>
            <th>Card Text</th>
            <th>Author Image</th>
            <th>Blog Content</th>
            <th>Author Info</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM blogs";
          $query_run = mysqli_query($conn, $query);
          if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $row) {
          ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['meta'] ?></td>
                <td><?php echo '<img src="../admin/upload/' . $row['image'] . '" width="200px" height="200px" alt="image">' ?></td>
                <td><?= $row['card_text'] ?></td>
                <td><?php echo '<img src="../admin/upload/' . $row['author_image'] . '" width="200px" height="200px" alt="image">' ?></td>
                <td><?= $row['blog_content'] ?></td>
                <td><?= $row['author_info'] ?></td>

                <td>
                  <a href="edit_blog.php?id=<?= $row['id'] ?>" class="status btn-bg-color-edit">Edit</a><br><br>
                  <a href="delete_blog.php?id=<?= $row['id'] ?>" class="status btn-bg-color-delete" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                </td>
              <?php
            }
          } else {
              ?>
              <tr>
                <td colspan="5">No records found</td>
              </tr>
            <?php
          }
            ?>
        </tbody>

      </table>
    </div>

  </div>
</main>
<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>
</main>
<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>