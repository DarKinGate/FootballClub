<?php
require($_SERVER['DOCUMENT_ROOT'] . '/db_connect.php');
?>
<style><?php require($_SERVER['DOCUMENT_ROOT'] . '/styles/gallery_style.css') ?></style>
<new_upload id="new_upload">
  <label for="upload_new_picture" id="close_upload">Close</label>
  <?php
  $result = '';
  // Check if form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del'])) {
    $dir_path = "$host/gallery/uploads/$_POST[del]";
    if (is_dir($dir_path)) {
      if (is_dir($dir_path)) {
        $files = glob($dir_path . '/*');
        foreach ($files as $file) {
          if (is_file($file)) {
            unlink($file);
          }
        }
      }
      rmdir($dir_path);
      $sql = "DELETE FROM `gallery` WHERE `gallery`.`img_custom_name` = '$_POST[del]'";
      if ($conn->query($sql) === FALSE) {
        echo "Error: " . $conn->error;
      }
    }
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']) && $_FILES['image']['name'] != null) {
    // Get custom name and create directory
    $c_name = $_POST['custom_name'] ? $_POST['custom_name'] : pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
    $custom_name = htmlspecialchars($c_name, ENT_QUOTES, 'UTF-8');
    $directory_path = $host . '/gallery/uploads/' . $custom_name;
    if (!file_exists($directory_path)) {
      mkdir($directory_path, 0777, true); // Create directory if it doesn't exist
    }

    // Set filenames for original and reduced size images
    if ($_POST['custom_name']) {
      $name = $custom_name;
    } else {
      $name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
    }
    $original_name = $directory_path . '/' . $name . '_original.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $reduced_name = $directory_path . '/' . $name . '_reduced.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    // Upload original size image
    $original_path = $directory_path . '/' . $name . '_original.*';
    if (glob($original_path)) {
      $result = '<error>Image with that name already exists! <br><br> Please choose different name</error>';
    } else {
      move_uploaded_file($_FILES['image']['tmp_name'], $original_name);

      // Create reduced size image
      $reduced_path = $reduced_name;
      $image = imagecreatefromstring(file_get_contents($original_name));
      $new_height = 300; // Set desired height for reduced size image
      $max_width = 250; // Set maximum width for reduced size image
      $min_width = 100; // Set minimum width for reduced size image
      $original_width = imagesx($image);
      $original_height = imagesy($image);
      $aspect_ratio = $original_width / $original_height;

      // Set new width to fill the container
      if ($aspect_ratio > 1) { // horizontal image
        $new_width = $max_width;
      } else { // vertical image
        $new_width = round($new_height * $aspect_ratio);
      }

      // Make sure new width doesn't exceed max or drop below min
      if ($new_width > $max_width) {
        $new_width = $max_width;
        $new_height = round($new_width / $aspect_ratio);
      } else if ($new_width < $min_width) {
        $new_width = $min_width;
        $new_height = round($new_width / $aspect_ratio);
      }

      // Crop image to fill the container
      $src_x = round(($original_width - $new_width) / 2);
      $src_y = round(($original_height - $new_height) / 2);
      $new_image = imagecreatetruecolor($new_width, $new_height);
      imagecopyresampled($new_image, $image, 0, 0, $src_x, $src_y, $new_width, $new_height, $new_width, $new_height);
      imagedestroy($image);
      imagejpeg($new_image, $reduced_name, 80); // Save reduced size image as JPEG with 80% quality
      imagedestroy($new_image);

      $result = '<success>Images uploaded successfully!</success>';
      $img_title = isset($_POST['img_title']) ? $_POST['img_title'] : 'default_name';
      $img_desc = isset($_POST['img_description']) ? $_POST['img_description'] : 'default_name';
      $title = htmlspecialchars($img_title, ENT_QUOTES, 'UTF-8');
      $description = htmlspecialchars($img_desc, ENT_QUOTES, 'UTF-8');
      $url_og = 'http://' . $_SERVER["HTTP_HOST"] . '/gallery/uploads' . "/$custom_name/$custom_name" . "_original." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
      $url_rs = 'http://' . $_SERVER["HTTP_HOST"] . '/gallery/uploads' . "/$custom_name/$custom_name" . "_reduced." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
      $sql = "INSERT INTO `gallery` (`ID`, `img_custom_name` , `img_url_og`, `img_url_rs`, `img_title`, `img_description`) VALUES (NULL, '$custom_name' , '$url_og', '$url_rs', '$title', '$description');";
      if ($conn->query($sql) === FALSE) {
        echo "Error creating table: " . $conn->error;
      }
    }
  }

  ?>
<section id="feedback"><?php echo $result ?></section>
  <!-- HTML form for uploading images -->
  <form method="post" enctype="multipart/form-data">
  <label for="images" class="drop-container">
    <input type="file" name="image" id="images" accept="image/*">
    <span class="drop-title">Click or Drag and Drop</span>
    <span id="file-chosen"></span>
  </label>
  <label for="custom_name" id="label_custom_name">Custom Name:</label>
    <input type="text" id="custom_name" name="custom_name" placeholder="Custom Name"><br>
    <label for="img_title" required>Title:</label>
    <input type="text" id="img_title" name="img_title"><br>
    <textarea type="text" id="img_description" name="img_description" placeholder="Description"></textarea>
    <br>
    <button id="upload_button" type="submit">Upload</button>
  </form>
</new_upload>

<label for="upload_new_picture" id="label_cbox_upload" style="height: fit-content;"><picture class='new_picture'>+<input type="checkbox" name="upload_new" id="upload_new_picture" hidden></picture></label>
  <?php
  $sql = "SELECT * FROM `gallery`";
  $result = mysqli_query($conn, $sql);
  $delete_png = 'http://' . $_SERVER['HTTP_HOST'] . '/gallery/assets/trash.png';
  while ($rows = mysqli_fetch_array($result)) {
  ?>
    <picture id='<?php echo $rows['img_custom_name'] ?>' style="background:url(<?php echo $rows['img_url_rs'] ?>)">
      <button onclick="showConfirm('<?php echo $rows['img_custom_name'] ?>')" type="submit" name="del" value="<?php echo $rows['img_custom_name'] ?>"><img id='delete_ico' src="<?php echo $delete_png ?>" alt="Delete"></button>
      <a href="<?php echo $rows['img_url_og']; ?>" class="lightbox">
        <img class="gallery_img" src="<?php echo $rows['img_url_rs'] ?>" alt="<?php echo $rows['img_custom_name'] ?>">
        <section id="display_title"><?php echo $rows['img_title'];; ?></section>
        <section id="display_description" hidden><?php echo $rows['img_description'];; ?></section>
    </picture></a>
  <?php } ?>
  <div id = "confirm_delete" hidden>
<warning></warning>
   <div class="close">
      <button onclick = ""> Yes </button>
      <button onclick = "closeConfirm()"> No </button>
   </div>
</div>
<script>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Partials/scripts/gallery.js') ?>
  </script>