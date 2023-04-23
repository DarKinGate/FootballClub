var confirmDiv = document.getElementById("confirm_delete");
   
// function to show confirm box
function showConfirm(name) {
   confirmDiv.style.display = "flex";
   confirmDiv.children[0].innerHTML = `Are you sure you want to delete <${name} style="color:red">${name}?</${name}>`;
   confirmDiv.children[1].children[0].attributes.onclick.value = "delete_picture('" + `${name}` + "')";
}

// function to hide confirm box
function closeConfirm() {
   confirmDiv.style.display = "none";
}

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
     fetch('<?php echo 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'] ?>', {
       method: 'POST',
       body: new URLSearchParams({
         del: `${filename}`
       })
     }).then(response => {
       document.querySelector(`#${filename}`).style.display = "none";
       confirmDiv.style.display = "none";
     }).catch(error => {
       // There was a network error
       alert(`There was a network error deleting ${filename}.`);
     });
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