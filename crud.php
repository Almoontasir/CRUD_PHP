<?php
$insert = false;
$delete = false;
$update = false;
$servername = "localhost";
$username = "root";
$password ="";
$database = "notes";
//create a connection
try{

    $conn = mysqli_connect($servername,$username,$password,$database);
   
}
//Die if connection was not successful
catch(mysqli_sql_exception $e){
        die("Sorry we are faild to connect: ".mysqli_connect_error());
}
if(isset($_GET['delet']))
{
    $sno = $_GET['delet'];
   
    $sql = "DELETE FROM `notes` WHERE `notes`.`slno` = $sno";
    try{
   
        mysqli_query($conn,$sql);
        $delete = true;
      
     }
     catch(mysqli_sql_exception $e){
    
         echo "The record was not delete because of this error-> " . mysqli_error($conn);   
     }

}
if($_SERVER['REQUEST_METHOD'] =='POST')
{
    if(isset($_POST['snoEdit']))
    {
       
        $sl = $_POST['snoEdit'];
        $title = $_POST['titleEdit'];
        $desc = $_POST['descEdit'];
        $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$desc' WHERE `notes`.`slno`= '$sl'";
        try{
   
            mysqli_query($conn,$sql);
            $update = true;
            
         }
         catch(mysqli_sql_exception $e){
        
             echo "The record was not update  because of this error-> " . mysqli_error($conn);   
         }
        
    }
    else
    {

        
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $sql = "INSERT INTO `notes` ( `title`, `description`) VALUES ('$title','$desc')";
   
    try{
   
       mysqli_query($conn,$sql);
       $insert = true;
       
    }
    catch(mysqli_sql_exception $e){
   
        echo "The record was not insert  because of this error-> " . mysqli_error($conn);   
    }
}
    
}
?>


<!-- html star  -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>crud operations</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
     <style>
        .p{
            position: sticky;
            top:0px;
        }
    </style>
</head>

<body>
    <!-- edit modal  -->
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal -->
    </button>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal body  -->
                <div class="modal-body">
                    <form class="mt-3" action="/php/harry/crud.php" method="post">
                        <input type="hidden" id="snoEdit" name="snoEdit">
                        <div class="mb-3 ">
                            <label for="titleEdit" class="form-label">Add title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                                aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="descEdit" class="form-label">Notes description</label>
                            <textarea class="form-control" id="descEdit" name="descEdit" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <!-- modal body  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit modal  -->

    <!-- nav bar  -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
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
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- nav bar  -->
    <!-- for alert  -->
    <?php
        if($insert)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> your entry sumbited succesfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>
    <?php
        if($update)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> your updation sumbited succesfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>
    <?php
        if($delete)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> your data deleted succesfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>
    <!-- for alert  -->
    <!-- form  -->
    <div class="container mt-3">
        <h3>Insert your notes</h3>
        <form class="mt-3" action="/php/harry/crud.php" method="post">
            <div class="mb-3 ">
                <label for="title" class="form-label">Add title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Notes description</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- form  -->
    <!-- control -->
    <div class="container my-5">
        <!-- table  -->
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">SL.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
    $sql = "SELECT * FROM `notes`";
    $result = mysqli_query($conn,$sql);
    $s=0;
    while($row = mysqli_fetch_assoc($result))
    {
        $s +=1;
        echo " <tr>
        <td scope='row'> $s</td>
        <td scope='row'>". $row['title']."</td>
        <td scope='row'>". $row['description']."</td>
        <td scope='row'> <button class='btn btn-sm btn-primary edit' id = ".$row['slno'].">Edit</button> <button class='btn btn-sm btn-primary delete' id = d".$row['slno'].">Delete</button></td>
       
      </tr>";
        // echo $row['slno'] ." title is ". $row['title']." description is ".$row['description']." time is ".$row['tstamp'];
    }
    ?>

            </tbody>
        </table>
        <!-- table  -->

    </div>

    <!-- control -->

    <!-- end  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                // console.log("edit ",);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[1].innerText;
                description = tr.getElementsByTagName("td")[2].innerText;
                titleEdit.value = title;
                descEdit.value = description;
                snoEdit.value = e.target.id;
                // console.log(e.target.id);
                $('#editModal').modal('toggle');


            }
            )

        })
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                // console.log("edit ",);
                sno = e.target.id.substr(1);
               
                if (confirm("Press a button!")) {

                    window.location = `/php/harry/crud.php?delet=${sno}`;
                }
                else {
                    console.log("NO");
                }



            }
            )
        })
    </script>
</body>

</html>

</html>