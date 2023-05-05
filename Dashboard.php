<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- Link to the MDI CSS file -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <!-- Import the MDI font files using @font-face -->
    <style>
    @font-face {
        font-family: 'Material Design Icons';
        font-style: normal;
        font-weight: 400;
        src: url('https://cdn.materialdesignicons.com/5.4.55/fonts/materialdesignicons-webfont.woff2?v=5.4.55') format('woff2'),
            url('https://cdn.materialdesignicons.com/5.4.55/fonts/materialdesignicons-webfont.woff?v=5.4.55') format('woff');
    }
    </style>
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>HRIS | Dashboard</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>

    <style>
    .sidebars ul li{
        list-style: none;
        text-decoration:none;
        width: 287px;
        margin-left:-16px;
        line-height:30px;
       
    }

    .sidebars ul li .hoverable{
        height:55px;
    }

    .sidebars ul{
        height:100%;
    }

    .sidebars .first-ul{
        line-height:60px;
        height:100px;
    }

    .sidebars ul li ul li{
        width: 100%;
    }

    .card-body{
        width: 99.8%;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
    }

    .card-header{
        width: 99.8%;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
    }
</style> 

<!------------------------------------Message alert------------------------------------------------->
<?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            '.$msg.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
?>
<!------------------------------------End Message alert------------------------------------------------->

<!------------------------------------Message alert------------------------------------------------->
<?php
        if (isset($_GET['error'])) {
            $err = $_GET['error'];
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            '.$err.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
?>
<!------------------------------------End Message alert------------------------------------------------->

<!-------------------------------------------Modal of Announce Start Here--------------------------------------------->
<div class="modal fade" id="announcement_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
       <form action="Data Controller/Announcement/insert_announce.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="company" class="form-label">Title</label>
                            <input type="text" name="announce_title" class="form-control" id="announce_title_id" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="announce_by" class="form-label">Name</label>
                            <input type="text" name="announce_by" class="form-control" id="announce_by_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="date_announcement" class="form-label">Date</label>
                            <input type="date" name="announce_date" class="form-control" id="announce_date_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="text_description" class="form-label">Description</label>
                            <textarea class="form-control" name="announce_description" id="announce_description_id"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="text_description" class="form-label">File Attachment</label>
                            <input type="file" name="file_upload" class="form-control" id="inputfile" >
                        </div>

                    </div><!--Modal body Close tag--->
                    <div class="modal-footer">
                <button type="submit" name="add_announcement" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </form>

      </div>
    </div>
  </div>
</div>
<!-------------------------------------------Modal of Announce End Here---------------------------------------------> 

<!---------------------------------------Download Modal Start Here -------------------------------------->
<div class="modal fade" id="download_announcement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Download PDF File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/DTR Correction/download_dtr.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="table_id_announce" id="id_table_announce">
        <input type="hidden" name="table_name_announce" id="name_table_announce">
        <h3>Are you sure you want download the PDF File?</h3>
      </div>
      <div class="modal-footer">
        <button type="submit" name="yes_dl" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!---------------------------------------Download Modal End Here --------------------------------------->

<!-------------------------------------------Modal of View Summary Start Here--------------------------------------------->
<div class="modal fade" id="view_summary" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Attachment</th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include 'config.php';

                            $query = "SELECT * FROM announcement_tb";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['announce_date']?></td>
                                <td><?php echo $row['announce_title']?></td>
                                <td><?php echo $row['description']?></td>
                                <?php if(!empty($row['file_attachment'])): ?>
                                <td>
                                <button type="button" class="btn btn-outline-success downloadbtn" data-bs-toggle="modal" data-bs-target="#download_announcement">Download</button>
                                </td>
                                <?php else: ?>
                                <td>None</td> <!-- Show an empty cell if there is no file attachment -->
                                <?php endif; ?>
                                <td><?php echo $row['name']?></td>
                            </tr>
                        </tbody>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div><!---Modal Body Close Tag-->

    </div>
  </div>
</div>
<!-------------------------------------------Modal of View Summary End Here--------------------------------------------->

    <div class="main-panel mt-5" style="margin-left: 65%;">
        <div class="content-wrapper mt-4">
            <div class="card md" style="max-width: 35rem; height: 390px;">
                <div class="card-header"  style="background-color: #A9A9E3;">
                    <h3 class="mb-0 d-inline-block">Announcement</h3>
                    <i class="mdi mdi-arrow-down-drop-circle float-right mt-1" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#announcement_modal">Add Announcment</a>
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#view_summary">View Summary</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                       include 'config.php';

                       $query = "SELECT * FROM announcement_tb";
                       $result = mysqli_query($conn, $query);
                       while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <h3><?php echo $row['announce_title']?></h3>
                    <p><span style="color: #7F7FDD; font-style: Italic;"><?php echo $row['name']?></span> - <?php echo $row['announce_date']?></p>
                    <p><?php echo $row['description']?></p>
                    <?php
                       }
                    ?>
                </div>
            </div>
        </div>
    </div><!---Main Panel Close Tag-->


<!------------------------------------Script para lumabas ang download modal------------------------------------------------->
<script>
     $(document).ready(function(){
               $('.downloadbtn').on('click', function(){
                 $('#download_announcement').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#id_table_announce').val(data[0]);
                   $('#name_table_announce').val(data[2]);
               });
             });
</script>
<!---------------------------------End ng Script para lumabas ang download modal------------------------------------------>

<!---------------------------- Script para lumabas ang warning message na PDF File lang inaallow------------------------------------------>
<script>
  document.getElementById('inputfile').addEventListener('change', function(event) {
    var fileInput = event.target;
    var file = fileInput.files[0];
    if (file.type !== 'application/pdf') {
      alert('Please select a PDF file.');
      fileInput.value = ''; // Clear the file input field
    }
  });
</script>
<!--------------------End ng Script para lumabas ang Script para lumabas ang warning message na PDF File lang inaallow--------------------->




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="bootstrap js/template.js"></script>
<!-- Custom js for this page-->
<script src="bootstrap js/data-table.js"></script>
<!-- End custom js for this page-->
    <script src="main.js"></script>
</body>
</html>