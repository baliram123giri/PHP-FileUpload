<?php
      // check if data is comming
      if(isset($_POST['submitbtn'])) {
            // // echo "Yes";
            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
            // echo "<pre>";
            // var_dump();
            // echo "</pre>";
          //1. Db connection Open
          $conn = mysqli_connect("localhost", "root", '',"file_upload_db") or die ("could not be connect");
          //2. Build the Query
          // always filterd / santized the data
           $name = mysqli_real_escape_string($conn, $_POST['fname']);
           $photo_name = mysqli_real_escape_string($conn, $_FILES['photo']['name']);
           $photo_name = rand(10,10000).$photo_name;
        //$photo = mysqli_real_escape_string($conn, $_POST['photo']);
        // Please Move From Temporay loaction to Uploads Direcory
        // Source temprory location 
        // destination = permenant location
        $source = $_FILES['photo']['tmp_name'];
        $destination = './uploads/'.$photo_name;
        move_uploaded_file($source, $destination);
            $sql = "INSERT INTO users_tbl(`name`, `photo`) VALUES('$name','$photo_name')";
          //3. Excute the query
            mysqli_query($conn, $sql) or die(mysqli_error($conn));
          //4. Display the query
          echo"File Uploaded SuccessFully...";
            //5. Db Connection close
          mysqli_close($conn);
      }
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
  
 <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="w-50 m-auto mt-5" method="POST" enctype="multipart/form-data">
  <div class="mb-3" >
    <label for="name" class="form-label">Full Name</label>
    <input name="fname" type="text" class="form-control" id="name" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="photo" class="form-label">Photo</label>
    <input name="photo" type="file" class="form-control" id="photo">
  </div>
  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" name="submitbtn" class="btn btn-primary">Submit</button>
</form>
</body>
</html>