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
        box-shadow: 0 0 5 2 black inset;
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