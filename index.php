<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Notes Application PHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="//cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
<style>
  #navimg{
    height: 3rem;
    margin: 0 20px 0 0;
  }
  .addnotebtn{
    text-align: center;
  }
  body{
    background-color: rgb(238, 242, 242);
  }
  .end{
    width: 100%;
    height: 3rem;
    padding: 20px auto;
    background-color: black;
    color: white;
    text-align: center;
  }
  .container{
    border-radius: 25px;
  }
</style>
</head>

<body>
  <!-- Edit modal 
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditModal">
    EditModal
  </button>
-->
<div class="header">
  <nav class="navbar navbar-expand-lg bg-body-tertiary navbar1" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/notesapplication/index.php?"><img src="img1.png" alt="" id="navimg" ><b>NotesWallah</Notes.Save></b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              List
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">ContactUS</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</div>

  <!-- Edit Modal -->
  <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="index.php?update=true " method="post">
            <h2 style="text-align: center;">Edit This Notes</h2>
            <input type="hidden" id="rowid" name="rowid">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Note Key Point</label>
              <input type="text" id="keypointedit" name="keypointedit" class="form-control" aria-describedby="emailHelp"
                required >
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Note Description</label>
              <textarea type="text" class="form-control" id="descedit" name="descedit" rows="5" required></textarea>
            </div>
            <button value="Submit" style="width: 100%; align-items: center;">Update Value</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="redirect()">OK</button>
        </div>
      </div>
    </div>
  </div>
  <?php
  $updatevalue=false;
  $deletevalue=false;
  
  //ON TOP
  $server="localhost:4306";
  $user="root";
  $pass="";
  $db="NotesapplicationDB";
  
  $conn=mysqli_connect($server,$user,$pass,$db);
  if(!$conn)
  {
      echo"<br>Database not Connected<br>";
      die("NOT Connected DB");
  }

  if(isset($_GET['delete']))
  {
    //$deletevalue=true;
    $delrow=$_GET['delete'];
    $sql="delete from notes WHERE `id` = '$delrow' ";
    $result1=mysqli_query($conn,$sql);

    if($result1)
    {
      $deletevalue=true;
    }


  }

  if($_SERVER['REQUEST_METHOD']=="POST")
  {
    
    if(isset($_POST['rowid']))
    {
      //Update Value
      $id=$_POST['rowid'];
      $ukey=$_POST['keypointedit'];
      $udesc=$_POST['descedit'];
    

      $sql1="UPDATE `notes` SET `keypoint` =' $ukey', `description` = '$udesc' WHERE `id` = '$id' ;";
      
      
      $result1=mysqli_query($conn,$sql1);
      if($result1)
      {
        $updatevalue=true;
      }
      else{
        echo "Not Updated";
      }

      $updatedrows = mysqli_affected_rows($conn);
      
    }
    else{
      //Normal Value
      $key=$_POST['keypoint'];
      $desc=$_POST['Description'];
      $sql="INSERT INTO `notes` (`keypoint`, `description`) VALUES ( '$key', '$desc')";
      $result=mysqli_query($conn,$sql);
      
      
      if($result)
      {
        echo "<div class='alert alert-success' role='alert'>
          Data Inserted Successfully
        </div>";
      }
      else{
        echo "<div class='alert alert-danger' role='alert'>
          Failed! Data Not Inserted 
        </div>";
      }
    }

  }
  ?>
  <?php
  if($updatevalue)
  {
    echo "<div class='alert alert-success' role='alert'>
      Data Updated Successfully
    </div>";
  }
  if($deletevalue)
  {
    echo "<div class='alert alert-success' role='alert'>
      Data Deleted 
    </div>";
  }

  ?>
  <div class="page">
    
    <div class="main">
      <div class="container ">
        <form action="index.php" method="post">
          <h2 style="text-align: center;">Add Notes</h2>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Key Point</label>
            <input type="text" id="keypoint" name="keypoint" class="form-control" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Description</label>
            <textarea type="text" class="form-control" id="Description" name="Description" rows="5" required></textarea>
          </div>
          <div class="addnotebtndiv" style="display: flex; align-items: center; justify-content: center;">

            <button type="submit" class="btn btn-primary addnotebtn">Add Note</button>
          </div>

        </form>
      </div>
      <div class="container">

        <!--PHP-->


        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">Sr.No.</th>
              <th scope="col">Key Point</th>
              <th scope="col">Description</th>
              <th scope="col">Date&Time</th>
              <th scope="col">ID</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
        //below add notes
        $sql="select * from notes";
        $result=mysqli_query($conn,$sql);
        if(!$result)
        {
        echo"NO Data";
        }
        $countrecords=0;
        while($row=mysqli_fetch_assoc($result))
        {
            //echo "<br>ID :".$row['id']."<br>Key Point :".$row['keypoint']."<br>Description :".$row['description']."<br>Date&Time :".$row['time'];
        
            $countrecords++;
            echo " <tr>
              <td>".$countrecords."</td>
              <td>".$row['keypoint']."</td>
              <td>".$row['description']."</td>
              <td>".$row['time']."</td>
              <td>".$row['id']."</td>
              <td><button class='edit btn btn-sm btn-primary' style='margin: 0 0 0 0;' >Edit</button><button id=d".$row['id']." class='delete btn btn-sm btn-primary' style='margin: 0 0 0 5%; background-color: rgb(234, 34, 34);' >Delete</button>  
            </tr>";
          }
        ?>



          </tbody>
          <hr>
        </table>


      </div>

    </div>
    <div class="footer">
      <div class="end">
        <p>CopyRight@2024</p>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
  <script>
    let table = new DataTable('#myTable');
  </script>
  <script>
    let edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach(element => {
      element.addEventListener('click', (e) => {
        console.log("EDIT", e.target.parentNode.parentNode);
        tr = e.target.parentNode.parentNode;
        keypoint = tr.getElementsByTagName("td")[1].innerText;
        desc = tr.getElementsByTagName("td")[2].innerText;
        id = tr.getElementsByTagName("td")[4].innerText;
        console.log(id);
        keypointedit.value = keypoint;
        descedit.value = desc;
        rowid.value = id;
        $('#EditModal').modal('toggle');
      }
      )
    });

    let deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach(element => {
      element.addEventListener('click', (e) => {
        console.log("Delete", e.target.parentNode.parentNode);
        tr = e.target.parentNode.parentNode;
        d_id = tr.getElementsByTagName("td")[4].innerText;
        
        fresult = confirm("Are You Sure ");
        if (fresult) {
          window.location="/notesapplication/index.php?delete=" + d_id;

        }
        else {

        }

        //$('#EditModal').modal('toggle');
      }

      )
    });

    function redirect(){
      window.location="/notesapplication/index.php?" ;    }
  </script>
</body>

</html>