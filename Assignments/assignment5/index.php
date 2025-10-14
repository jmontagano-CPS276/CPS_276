<?php
$output = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/classes/Directories.php';
    if (isset($_POST['submit'])) {
        $dir = new Directories(trim($_POST['directoryname']), trim($_POST['filecontent']));
        $output = $dir->newDirAndFile();
    }

}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>File and Directory</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    
  </head>
  <body>
    <div class="container">
      <h1>File and Directory Assignment</h1>
      <p>Enter a folder name and the contents of a file.  Folder names should contain alpha numeric characters only.</p>
      <?php echo $output?>   
          
      <form method="post" action="index.php">
        <div class="form-group">
          <label for="foldername">Folder Name</label>
          <input type="text" class="form-control" id="directoryname" name="directoryname">
        </div>
        <div class="form-group">
          <label for="filecontent">File Content</label>
          <textarea name="filecontent" id="filecontent" class="form-control" cols="20" rows="6"></textarea>
          
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>

      
    </div>

  </body>
</html>