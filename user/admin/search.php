<?php include 'inc/session.php';?>
<!DOCTYPE html>
<html style="font-family: Nunito, sans-serif;">
<?php include'inc/connect.php'; ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Search</title><link rel="icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
</head>

<body id="page-top" >
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#"><i class="fa fa-eye"></i>
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span>is system</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <?php include'inc/toggle.php';
                $search=$_POST['search']; 
                ?>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">


        <div id="content">
    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
        <div class="container-fluid"><button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3" type="button"><i class="fas fa-bars"></i></button>
            <ul class="navbar-nav flex-nowrap ms-auto">
                <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                    <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="me-auto navbar-search w-100">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..." />
                                <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                            </div>
                        </form>
                    </div>
                </li>
                <div class="d-none d-sm-block topbar-divider"></div>
                <li class="nav-item dropdown no-arrow">
                <?php include'inc/nav.php';?>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Altered Search</h3>
        <div class="row padMar" style="padding-bottom: 17px;">
    <div class="col padMar">
    <form action="search.php" method="post">
      <div class="input-group"><input class="form-control autocomplete" type="text" name="search" required="" placeholder="Search here" /><button class="btn btn" type="submit" style="background: rgb(52,91,204);color: rgb(255,255,255);"><i class="fa fa-search"></i></button></div>
     
</form></div>
</div>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Search Input: <?php echo $search; ?></p>
            </div>
            <div class="card-body" style="font-size: 12px;">
                <div class="table-responsive">
                    <table class="table" id="tab">
                    <thead>
                                            <tr>
                                            <th>No.</th>
                                                <th>Name & Surname</th>
                                                <th>Id Number</th>
                                                <th>Gender</th>
                                                <th>Date of Birth</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Next Of keen(Name & Surname)</th>
                                                <th>Next of keen phone</th>
                                                <th>Next of keen Email</th>
                                                <th>House no</th>
                                                <th>Street</th>
                                                <th>Suburb</th>
                                                <th>City</th>
                                                <th>Province</th>
                                                <th>Zip Code</th>
                                                <th>Country</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?PHP

                                       
              $query="SELECT * from person where 
              (firstname LIKE '%".$search."%') OR (lastname LIKE '%".$search."%') OR (id_number LIKE '%".$search."%')OR (gender LIKE '%".$search."%')
              OR (dateOfbirth LIKE '%".$search."%') OR (phone LIKE '%".$search."%') OR (email LIKE '%".$search."%') OR (keen_firstname LIKE '%".$search."%')
              OR (keen_lastname LIKE '%".$search."%') OR (keen_phone LIKE '%".$search."%') OR (Keen_email LIKE '%".$search."%') OR (house_no LIKE '%".$search."%')
              OR (street_name LIKE '%".$search."%') OR (suburb LIKE '%".$search."%') OR (city LIKE '%".$search."%') OR (province LIKE '%".$search."%') OR (zip_code LIKE '%".$search."%')";
              $result=mysqli_query($conn,$query);
              
              $rows=mysqli_num_rows($result); 
              if ($rows>0) {
                  $x=1;
                while ($rows=mysqli_fetch_array($result)) {
              ?>
                                            < <tr>
                                                <td><?php echo $x;?> </td>
                                                <td><?php echo $rows['firstname'].' '.$rows['lastname'];?></td>
                                                <td><?php echo $rows['id_number'];?></td>
                                                <td><?php echo $rows['gender'];?></td>
                                                <td><?php echo $rows['dateOfbirth'];?></td>
                                                <td><?php echo $rows['phone'];?></td>
                                                <td><?php echo $rows['email'];?></td>
                                                <td><?php echo $rows['keen_firstname'].' '.$rows['keen_lastname'];?></td>
                                                <td><?php echo $rows['keen_phone'];?></td>
                                                <td><?php echo $rows['keen_email'];?></td>
                                                <td><?php echo $rows['house_no'];?></td>
                                                <td><?php echo $rows['street_name'];?></td>
                                                <td><?php echo $rows['suburb'];?></td>
                                                <td><?php echo $rows['city'];?></td>
                                                <td><?php echo $rows['province'];?></td>
                                                <td><?php echo $rows['zip_code'];?></td>
                                                <td><?php echo $rows['country'];?></td>
												 <td>
                                                
                                            </tr>
                                            <?php
                                            $x++;
                  
                }
                ?>
                                        </tbody>
                                        <?php
              }else{
                ?>
                <h3 style="text-align:center;color: rgb(75,2,59);font-size:14px">No record(s)</h3>
                <?php
              } ?>
                                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align: center;margin-top: 20px;">
        <div class="btn-group" role="group">
        <button class="btn btn-primary" type="button" onclick="$('table').wordExport({font:20});" ><i class="fa fa-file-word-o"></i> Word</button>
        <button class="btn btn-primary" type="button" onclick="$('table').tblToExcel();"><i class="fa fa-file-excel-o"></i> Excel</button>
        <button class="btn btn-primary" type="button" onclick="$('table').table2csv();"><i class="fa fa-file-text"></i> Csv</button>
        <button class="btn btn-primary" type="button" onclick="myApp.printTable()"><i class="fa fa-print"></i> Print</button></div>
    </div>
</div>


<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/theme.js"></script>
</body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="table2csv.js"></script>
<script src="jspdf.js"></script>
<script src="jspdf/libs/base64.js"></script>
<script src="jspdf/libs/sprintf.js"></script>
<script src="jquery.base64.js"></script>
<script src="tableExport.js"></script>
<script src="jquery.tableToExcel.js"></script>
<script src="FileSaver.js"></script> 
<script src="jquery.wordexport.js"></script>
</html>
<script>
    var myApp = new function () {
        this.printTable = function () {
            var tab = document.getElementById('tab');
            var win = window.open('', '', 'height=700,width=700');
            win.document.write(tab.outerHTML);
            win.document.close();
            win.print();
        }
    }
</script>