<?php
require($_SERVER['DOCUMENT_ROOT'] . '/db_connect.php');
?>
<style>
    main{
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    picture{
        --base-size: 12rem;
        min-width: var(--base-size);
        max-width: calc(var(--base-size) + 2rem);
        min-height: calc(var(--base-size) + 4rem);
        max-height: calc(var(--base-size) + 6rem);
        background-color: #333;
        display: -webkit-box;
        position: relative;
        text-align: center;
        overflow: hidden;
        text-overflow: "----";
        -webkit-box-align: center;
        -webkit-box-orient: vertical;
        box-shadow: 0 0 5px 2px var(--dark-gray);
        border-radius: 1rem;
        transition: 0.25s;
    }
    img[class="gallery_img"]{
        background-color: #999;
        height: 100%;
        width: auto;
        box-shadow: 0 0 10px 5px black inset;
        transition: 0.25s;
    }
    img[class="gallery_img"]:hover{
        transform: scale(1.25);
    }
    button[name='del']{
        position: absolute;
        z-index: 1;
        width: 100%;
        left: 0px;
        transform: translatey(-100%);
        padding: 0.5rem;
        transition: 0.25s;
        background-color: #33333370;
        font-size: 1rem;
        border: none;
    }
    button[name='del']:hover{
        background-color: #333333d8;
    }
    picture:hover button[name='del']{
        transform: translatey(0%);
    }
    img[id="delete_ico"]{
        height: 1rem;
        width: auto;
    }
    h3{
        display: block;
    }
    h4{
        display: block;
    }
</style>
<picture>
<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del'])) {
$dir_path = "$host/gallery/uploads/$_POST[del]";
if(is_dir($dir_path)){
    if (is_dir($dir_path)) {
        $files = glob($dir_path . '/*');
        foreach($files as $file) {
            if(is_file($file)) {
                unlink($file);
            }
        }
    }
    rmdir($dir_path);
    $del_name = $_POST['del'];
    $sql = "DELETE FROM `gallery` WHERE `gallery`.`img_custom_name` = $del_name";
if ($conn->query($sql) === FALSE) {
  echo "Error creating table: " . $conn->error;
}
}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    // Get custom name and create directory
    $c_name = $_POST['custom_name'] ? $_POST['custom_name'] : pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
    $custom_name = htmlspecialchars($c_name, ENT_QUOTES, 'UTF-8');
    $directory_path = $host.'/gallery/uploads/' . $custom_name;
    if (!file_exists($directory_path)) {
        mkdir($directory_path, 0777, true); // Create directory if it doesn't exist
    }

    // Set filenames for original and reduced size images
    if($_POST['custom_name']){$name = $custom_name;}else{$name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);}
    $original_name = $directory_path . '/' . $name . '_original.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $reduced_name = $directory_path . '/' . $name . '_reduced.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    // Upload original size image
    $original_path = $original_name;
    if(is_file($original_path)){
      echo "Image with that name already exists on the server! Please choose different name or put custom name";
    } else {
    if(!$_POST['custom_name'] == null){
      move_uploaded_file($_FILES['image']['tmp_name'], $original_path);
    } else {
      move_uploaded_file($_FILES['image']['tmp_name'], $original_path);
      
    }

// Create reduced size image
$reduced_path = $reduced_name;
$image = imagecreatefromstring(file_get_contents($original_path));
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
imagejpeg($new_image, $reduced_path, 80); // Save reduced size image as JPEG with 80% quality
imagedestroy($new_image);

echo 'Images uploaded successfully!';
$img_title = isset($_POST['img_title']) ? $_POST['img_title'] : 'default_name';
$img_desc = isset($_POST['img_description']) ? $_POST['img_description'] : 'default_name';
$title = htmlspecialchars($img_title, ENT_QUOTES, 'UTF-8');
$description = htmlspecialchars($img_desc, ENT_QUOTES, 'UTF-8');
$sql = "INSERT INTO `gallery` (`ID`, `img_custom_name` , `img_url_og`, `img_url_rs`, `img_title`, `img_description`) VALUES (NULL, '$custom_name' , '$original_name', '$reduced_name', '$title', '$description');";
if ($conn->query($sql) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

}}

?>

<!-- HTML form for uploading images -->
<form method="post" enctype="multipart/form-data">
  <input type="file" name="image" required>
    <label for="custom_name">Custom Name:</label>
    <input type="text" id="custom_name" name="custom_name" placeholder="(Optional)"><br>
    <label for="custom_name" required>Title:</label>
    <input type="text" id="img_title" name="img_title"><br>
    <label for="custom_name">Description:</label>
    <input type="text" id="img_description" name="img_description">
    <br>
    <button type="submit">Upload</button>
</form>
</picture>
<?php
$dir = $_SERVER['DOCUMENT_ROOT'] . '/gallery/uploads'; // replace with your directory name
$files = array_diff(scandir($dir), array('..', '.'));
foreach($files as $file) {
    $subfiles = array_diff(scandir($host . '//gallery/uploads/' . $file), array('..', '.'));
    $folder = pathinfo($subfiles[2], PATHINFO_FILENAME);
  $ext = pathinfo($subfiles[2], PATHINFO_EXTENSION);
  $reduced_path = "$dir/$file/$folder.$ext";
  $original_path = "$dir/$file/$folder.$ext";
  if (is_file($reduced_path) && is_file($original_path)) {
    $url_og = 'http://' . $_SERVER["HTTP_HOST"].'/gallery/uploads'."/$file/$file"."_original.$ext";
    $url_rs = 'http://' . $_SERVER["HTTP_HOST"].'/gallery/uploads'."/$file/$file"."_reduced.$ext";
    $delete_png = 'http://' . $_SERVER['HTTP_HOST'] . '/gallery/assets/trash.png';
    echo "<picture id='$file'>";
    echo "<button onclick=\"deletePicture('$file')\" type='submit' name='del' value='$file'><img id='delete_ico' src=\"$delete_png\" alt=\"Delete\"></button>";
    echo "<a href=\"$url_og\">";
    echo "<img class=\"gallery_img\" src=\"$url_rs\" alt=\"$file\">";
    echo "</picture></a>";
  }
}
?>
<script>
function deletePicture(filename) {
  if (confirm(`Are you sure you want to delete ${filename}?`)) {
    fetch('<?php echo 'http://' . $_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'] ?>', {
      method: 'POST',
      body: new URLSearchParams({
        del: `${filename}`
      })
    }).then(response => {
        document.querySelector(`#${filename}`).style.display = "none";
    }).catch(error => {
      // There was a network error
      alert(`There was a network error deleting ${filename}.`);
    });
  }
}
</script>