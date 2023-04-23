<?php
require($_SERVER['DOCUMENT_ROOT'] . '/db_connect.php');
?>
<style>
  main {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
  }

  picture {
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

  img[class="gallery_img"] {
    background-color: #999;
    height: 100%;
    width: auto;
    box-shadow: 0 0 10px 5px black inset;
    transition: 0.25s;
  }

  img[class="gallery_img"]:hover {
    transform: scale(1.25);
  }

  button[name='del'] {
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

  button[name='del']:hover {
    background-color: #333333d8;
    cursor: pointer;
  }

  picture:hover button[name='del'] {
    transform: translatey(0%);
  }

  img[id="delete_ico"] {
    height: 1rem;
    width: auto;
  }

  h3 {
    display: block;
  }

  h4 {
    display: block;
  }

  form>textarea {
    width: 95%;
    resize: none;
    height: 10rem;
    overflow-wrap: break-word;
    text-align: center;
                display: inline-block;
                border-radius: 1rem 1rem 0rem 0rem;
                text-decoration: none;
                line-height: 2rem;
                border: 2px solid var(--light-gray);
                border-top: none;
                font-size: 1.5rem;
                transition: 0.5s;
                background-color: var(--dark-gray);
                color: var(--ligth-gray);
                border-color: #333;
  }

  #lightbox {
    position: absolute;
    z-index: 9999;
    top: 7rem;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
  }

  #lightbox img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 1rem;
  }

  #lightbox-close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    color: #fff;
    text-decoration: none;
  }

  #lightbox-close:hover {
    text-decoration: underline;
  }

  new_upload {
    --base-size: 20rem;
    min-width: var(--base-size);
    max-width: calc(var(--base-size) + 2rem);
    min-height: calc(var(--base-size) + 4rem);
    max-height: auto;
    background-color: #333;
    display: -webkit-box;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    overflow: hidden;
    text-overflow: "----";
    -webkit-box-align: center;
    -webkit-box-orient: vertical;
    box-shadow: 0 0 5px 2px var(--dark-gray);
    border-radius: 1rem;
    transition: 0.25s;
    z-index: -1;
  }
  .drop-container {
  position: relative;
  display: flex;
  gap: 1rem;
  padding: 0rem 0.5rem;
  margin: 1rem 1rem 0rem;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  border-radius: 10px;
  border: 2px dashed #555;
  color: var(--light-gray);
  background-color: var(--very-dark-gray);
  cursor: pointer;
  transition: background .2s ease-in-out, border .2s ease-in-out;
}
.drop-container input{
  position: absolute;
  padding: 2rem;
  padding-bottom: 1.5rem;
  text-align:center !important;
  opacity: 0;
}
.drop-container:hover {
  background: #eee;
  border-color: #111;
}

.drop-container:hover .drop-title {
  color: #222;
}

.drop-title {
  margin-top: 1rem;
  color: var(--light-gray);
  font-size: 1.5rem;
  font-weight: bold;
  text-align: center;
  transition: color .2s ease-in-out;
}
#file-chosen{
  margin-top: 1rem;
  color: var(--light-gray);
  font-size: 1rem;
  font-weight: bold;
  text-align: center;
  transition: color .2s ease-in-out;
  position: relative;
  top: -1rem;
}
#upload_button{
  position:relative;
  width: 96%;
                text-align: center;
                display: inline-block;
                padding: 0.25rem 0.5rem;
                border-radius: 0rem 0rem 1rem 1rem;
                text-decoration: none;
                line-height: 2rem;
                border: 2px solid var(--light-gray);
                border-top: none;
                font-size: 1.5rem;
                transition: 0.5s;
                background-color: var(--dark-gray);
                color: var(--ligth-gray);
                border-color: #333;
                outline: #333;
                margin-bottom: 1rem;
}
error{
  color: red;
  text-align: center;
  font-size: 1.2rem;
}
new_upload>form>label{
  text-align: left;
}
new_upload>form>input{
  text-align: left;
}
#custom_name{
  border-radius: 0rem 0rem 1rem 0rem;
  text-align: center;
  border: 2px dashed #555;
  border-top: none;
  font-size: 1rem;
  color: var(--light-gray);
  background-color: var(--very-dark-gray);
  margin-bottom: 1rem;
  width: 50%;
  position: relative;
  padding: 0.5rem;
  display: none;
}
new_upload>form>label[for="custom_name"]{
  border: 2px dashed #555;
  padding: 0.5rem;
  border-radius: 0rem 0rem 0rem 1rem;
  color: var(--light-gray);
  background-color: var(--very-dark-gray);
  border-top: none;
  border-right: none;
  display: none;
}
#img_title{
  border-radius: 0rem 1rem 1rem 0rem;
  text-align: center;
  border: 2px dashed #555;
  font-size: 1rem;
  color: var(--light-gray);
  background-color: var(--very-dark-gray);
  margin-bottom: 1rem;
  width: 50%;
  position: relative;
  padding: 0.5rem;
}
new_upload>form>label[for="img_title"]{
  border: 2px dashed #555;
  font-size: 1.1rem;
  padding: 0.5rem;
  border-radius: 1rem 0rem 0rem 1rem;
  color: var(--light-gray);
  background-color: var(--very-dark-gray);
  border-right: none;
}
success{
  background-color: var(--light-gray);
  color: var(--very-dark-gray);
  padding: 1rem;
  font-size: 1.2rem;
  border: 1px solid red;
  border-radius: 1rem;
  display: block;
  width: 80%;
  margin-top: 1rem;
}
#close_upload{
  display: block;
  background-color: #111;
  border-radius: 0rem 0rem 0rem 4rem;
  padding: 1rem;
  position: relative;
  left: 40%;
}
.new_picture{
    min-width: calc(var(--base-size) + 2rem);
    min-height: calc(var(--base-size) + 6rem);
}
section[id="display_title"] {
  position:absolute;
  bottom: 0;
  left: 0;
  text-align: center;
  width: 100%;
  padding: 1rem 0;
  font-size: 1.5rem;
  background-color:rgba(51,51,51,0.2);
  color: rgba(0,0,0,0.8);
  text-shadow: 0px 0px 2px #666;
  font-weight: bold;
  font-family:Verdana, Geneva, Tahoma, sans-serif;
  text-decoration: none;
  word-wrap: break-word;
  transform: translateY(100%);
  transition: 0.4s;
}
picture:hover section[id="display_title"]{
  transform: translateY(0%);
}
section[id="display_title"]:hover{
  background-color:rgba(51,51,51,0.8);
}
#lightbox_content{
display: flex;
flex-direction: column;
background-color: #222;
border-radius: 1rem;
align-items: center;
padding: 2rem;
overflow: auto;
}
#highlight_title, #highlight_description{
  font-size: 2rem;
  color: rgba(255,255,255,0.8);
  text-shadow: 0px 0px 2px #333;
  font-weight: bold;
  font-family:Verdana, Geneva, Tahoma, sans-serif;
  text-decoration: none;
  word-wrap: break-word;
}
#highlight_title{
  margin-top: 1rem;
}
#highlight_title::after{
  content: '';
  width: 100%;
  display:block;
  height: 0.1rem;
  background: rgba(255,255,255,0.5);
}
#highlight_description{
  font-size: 1.2rem;
  align-self: baseline;
}
#feedback{
  display: block;
  position: relative;
  justify-content: center;
  align-items: baseline;
  z-index: 8;
}
</style>
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

<label for="upload_new_picture" id="label_cbox_upload"><picture class='new_picture'><input type="checkbox" name="upload_new" id="upload_new_picture" hidden></picture></label>
  <?php
  $sql = "SELECT * FROM `gallery`";
  $result = mysqli_query($conn, $sql);
  $delete_png = 'http://' . $_SERVER['HTTP_HOST'] . '/gallery/assets/trash.png';
  while ($rows = mysqli_fetch_array($result)) {
  ?>
    <picture id='<?php echo $rows['img_custom_name'] ?>' style="background:url(<?php echo $rows['img_url_rs'] ?>)">
      <button onclick="delete_picture('<?php echo $rows['img_custom_name'] ?>')" type="submit" name="del" value="<?php echo $rows['img_custom_name'] ?>"><img id='delete_ico' src="<?php echo $delete_png ?>" alt="Delete"></button>
      <a href="<?php echo $rows['img_url_og']; ?>" class="lightbox">
        <img class="gallery_img" src="<?php echo $rows['img_url_rs'] ?>" alt="<?php echo $rows['img_custom_name'] ?>">
        <section id="display_title"><?php echo $rows['img_title'];; ?></section>
        <section id="display_description" hidden><?php echo $rows['img_description'];; ?></section>
    </picture></a>
  <?php } ?>
  <script>
    // Get all elements with class "lightbox"
    var lightboxElements = document.querySelectorAll('.lightbox');

    // Add click event to each lightbox element
    lightboxElements.forEach(function(element) {
      element.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        var imageSrc = this.getAttribute('href');
        var title = this.children[1].innerHTML;
        var desc = this.children[2].innerHTML;
        // Create and append the lightbox HTML
        var lightbox = document.createElement('div');
        lightbox.id = 'lightbox';
        lightbox.innerHTML = '<div id="lightbox_content"><img src="' + imageSrc + '"><br>' +
         '<section id="highlight_title">' +
          title + '</section>' +
          '<br>' + '<section id="highlight_description">' +
          desc + '</section></div>' +
          '<a href="#" id="lightbox-close">Close</a>';
        document.body.appendChild(lightbox);
        // Add click event to close button
        var closeButton = document.getElementById('lightbox-close');
        closeButton.addEventListener('click', function() {
          lightbox.remove();
        });
        // Add click event to close lightbox when clicking outside the image
        lightbox.addEventListener('click', function(event) {
          if (event.target === this) {
            lightbox.remove();
          }
        });
        // Add event listener to close lightbox on ESC key press
        document.addEventListener('keydown', function(event) {
          if (event.key === 'Escape') {
            lightbox.remove();
          }
        });
      });
    });


    function delete_picture(filename) {
      if (confirm(`Are you sure you want to delete ${filename}?`)) {
        fetch('<?php echo 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'] ?>', {
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

    // choose upload file
    const actualBtn = document.getElementById('images');
    const custName = document.getElementById('custom_name');
const fileChosen = document.getElementById('file-chosen');
const cnamelabel = document.getElementById('label_custom_name');
const upload_new = document.getElementById('upload_new_picture');
const new_upload = document.getElementById('new_upload');
const label_cbox = document.getElementById('label_cbox_upload');

actualBtn.addEventListener('change', function(){
  fileChosen.textContent = 'Chosen Image: ' + this.files[0].name;
  custName.value = actualBtn.files[0].name.split('.')[0];
  custName.style.display = 'inline-block';
  cnamelabel.style.display = 'inline-block';
})
upload_new.addEventListener('change',function(){
  if(upload_new.checked == true){
    new_upload.style.zIndex = 4;
  } else {
    new_upload.style.zIndex = -1;
  }
})
  </script>