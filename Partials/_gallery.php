<style><?php require($_SERVER['DOCUMENT_ROOT'] . '/styles/gallery_style.css') ?></style>
<?php
$dir = $_SERVER['DOCUMENT_ROOT'] . '/gallery'; // replace with your directory name
$sql = "SELECT * FROM `gallery`";
$result = mysqli_query($conn, $sql);
while ($rows = mysqli_fetch_array($result)) {
?>
  <picture id='<?php echo $rows['img_custom_name'] ?>' style="background:url(<?php echo $rows['img_url_rs'] ?>)">
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
  </script>