<?php include 'inc/session.php';?>

<!DOCTYPE html>
<html style="font-family: Nunito, sans-serif;">
<?php include'inc/connect.php'; ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System |Criminal Record</title><link rel="icon" href="assets/img/logo.png">
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
                <?php include'inc/toggle.php';?>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">




            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <!--acc-->    
                            <?php include'inc/nav.php';?>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
          
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Criminal Record&nbsp;</p>
                        </div>
                        <div class="col-md-6 col-xl-12 offset-md-3 offset-xl-0">
                       
                        <div id="faqlist" class="accordion accordion-flush">

                        <?PHP


// select products.id, products.title, productimages.imageurl
// from products
// join productimages on products.id = productimages.productid
// ORDER BY products.id LIMIT 10

                       
              $query="SELECT
              *
          FROM
              person";
              $result=mysqli_query($conn,$query);
              
              $rows=mysqli_num_rows($result); 


    

              if ($rows>0) {
              $x=1;
                while ($rows=mysqli_fetch_array($result)) {    
              ?>

        <div class="accordion-item">

            <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#content-accordion-<?php echo $x?>">#<?php echo $x; ?> <?php echo $rows['firstname'].' '.$rows['lastname'];?></button></h2>
            <div id="content-accordion-<?php echo $x?>" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <p class="accordion-body">
                <div class="col">&nbsp;&nbsp;<a class="btn btn-primary"href="addcriminal.php?value=<?php echo $rows['person_id']?>">Add</a></div>
                <hr>
            
                 <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                            <th>#</th> 
                            <th>Docket No.</th>    
                            <th>Description</th>
                                <th>year</th>
                                <th><i></i>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                 

                 $id=$rows['person_id'];
                 $query1="SELECT
                 *
             FROM
                 docket where person_id ='$id' ORDER BY year ASC";
                 $result1=mysqli_query($conn,$query1);
                 
                 $rows1=mysqli_num_rows($result1);
 
                  if ($rows1>0) {
                   $x=1;
                       while ($rows1=mysqli_fetch_array($result1)) { 
                           $t=$rows1['docket_id'];
                     ?>
                  
                            <tr>
                            <td><?php echo $x;?></td>
                                <td>CSZAR<?php echo $rows1['docket_id'];?></td>
                                <td><?php echo $rows1['crime_type'];?></td>
                                <td><?php echo $rows1['year'];?></td>
                                <td>
                                <p><a  href="editrec.php?value=<?php echo $rows1['docket_id']; ?>"><i class="fas fa-edit" style="font-size: 16px;color: blue;"></i></a>&nbsp;
                                <a onclick="deleteProfile();"><i class="fas fa-trash" style="font-size: 13px;color: red;"></i></a>
                                </p>
                                </td>              
                            </tr>
                            <?php

                            $x++;
                      }
                    }
                 
                 ?>
              
                        </tbody>
                    </table>
                </div>
                 
                 
                 

                </p>
            </div>
        </div>
        <?php
                                       
              $x++;    
                }
              }else{
                ?>
                <h3 style="text-align:center;color: rgb(75,2,59);font-size:14px">No record(s)</h3>
                <?php
              } ?>
                       
        


                      
       
    </div>
</div>
			
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto"></div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="../assets/js/DataTable---Fully-BSS-Editable.js"></script>
    <script src="../assets/js/theme.js"></script>

 
</body>
<script>
  //show a confirmation and redirect to the delete profile script
  function deleteProfile() {
    if (confirm("Do you really want to delete the record?")) {
        location.href = 'inc/deleterec.php?value=<?php echo $t;?>';
    }
}
</script>
</html>