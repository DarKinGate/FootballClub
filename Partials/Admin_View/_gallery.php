<?php
require($_SERVER['DOCUMENT_ROOT'] . '/db_connect.php');
?>
<style>
    main{
        display: flex;
        gap: 1rem;
    }
    picture{
        --base-size: 12rem;
        min-width: var(--base-size);
        max-width: calc(var(--base-size) + 2rem);
        min-height: calc(var(--base-size) + 4rem);
        max-height: calc(var(--base-size) + 6rem);
        background-color: #333;
        display: -webkit-box;
        text-align: center;
        overflow: hidden;
        text-overflow: "----";
        -webkit-box-align: center;
        -webkit-box-orient: vertical;
        box-shadow: 0 0 5px 2px var(--dark-gray);
        border-radius: 1rem;
    }
    img[class="gallery_img"]{
        background-color: #999;
        height: 100%;
        width: auto;
        transition: 0.25s;
    }
    img[class="gallery_img"]:hover{
        transform: scale(1.25);
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {

    // Get custom name and create directory
    $custom_name = isset($_POST['custom_name']) ? $_POST['custom_name'] : 'default_name';
    $directory_path = $host.'//gallery/' . $custom_name;
    if (!file_exists($directory_path)) {
        mkdir($directory_path, 0777, true); // Create directory if it doesn't exist
    }

    // Set filenames for original and reduced size images
    $original_name = $directory_path . '/' . $custom_name . '_original.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $reduced_name = $directory_path . '/' . $custom_name . '_reduced.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    // Upload original size image
    $original_path = $original_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $original_path);

    // Create reduced size image
    $reduced_path = $reduced_name;
    $image = imagecreatefromstring(file_get_contents($original_path));
    $new_width = 500; // Set desired width for reduced size image
    $new_height = imagesy($image) / imagesx($image) * $new_width;
    $new_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, imagesx($image), imagesy($image));
    imagedestroy($image);
    imagejpeg($new_image, $reduced_path, 80); // Save reduced size image as JPEG with 80% quality
    imagedestroy($new_image);

    echo 'Images uploaded successfully!';

}
?>

<!-- HTML form for uploading images -->
<form method="post" enctype="multipart/form-data">
    <label for="custom_name">Custom Name:</label>
    <input type="text" id="custom_name" name="custom_name">
    <br>
    <input type="file" name="image" required>
    <button type="submit">Upload</button>
</form>
</picture>
<?php
$dir = $_SERVER['DOCUMENT_ROOT'] . '/gallery'; // replace with your directory name
$files = array_diff(scandir($dir), array('..', '.'));
foreach($files as $file) {
    $subfiles = array_diff(scandir($host . '//gallery/' . $file), array('..', '.'));
    $folder = pathinfo($subfiles[2], PATHINFO_FILENAME);
  $ext = pathinfo($subfiles[2], PATHINFO_EXTENSION);
  $reduced_path = "$dir/$file/$folder.$ext";
  $original_path = "$dir/$file/$folder.$ext";
  if (is_file($reduced_path) && is_file($original_path)) {
    $url_og = 'http://' . $_SERVER["HTTP_HOST"].'/gallery'."/$file/$file"."_original.$ext";
    $url_rs = 'http://' . $_SERVER["HTTP_HOST"].'/gallery'."/$file/$file"."_reduced.$ext";
    echo "<picture><a href=\"$url_og\">";
    echo "<img class=\"gallery_img\" src=\"$url_rs\" alt=\"$file\">";
    echo "</picture></a>";
  }
}
?>
