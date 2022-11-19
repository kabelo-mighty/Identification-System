<?php include 'inc/session.php';?>

<!DOCTYPE html>
<html style="font-family: Nunito, sans-serif;">
<?php include'inc/connect.php'; ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System |Citizen People</title><link rel="icon" href="assets/img/logo.png">
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
                            <p class="text-primary m-0 fw-bold">Assigned Police&nbsp;</p>
                        </div>
                        <div class="card-body" style="font-size: 12px;">
                            <div class="table-responsive table mb-0 pt-3 pe-2">
                                <table class="table table-sm my-0 mydatatable">
                                        <thead>
                                            <tr>
                                            <th>No.</th>
                                                <th>Name & Surname</th>
                                                <th>Id Number</th>
                                                <th>Gender</th>
                                          
                                                <th>Phone</th>
                                                <th>Email</th>
                                             
                                                <th>Account status</th>
                                                <th>Employment Status</th>
                                                <th>Employment Type</th>
                                              
                                                
												<th><i class="fa fa-cogs"></i>&nbsp;Action</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?PHP
              $query="SELECT * from person where employee_type='Police'";
              $result=mysqli_query($conn,$query);
              
              $rows=mysqli_num_rows($result); 
              if ($rows>0) {
                  $x=1;
                while ($rows=mysqli_fetch_array($result)) {    
              ?> 

              <?php 
              
              if($rows['confirmed_acc'] == '1')
              {
                  $delivered='<span style="background: #17e305;color: rgb(255,255,255);border-radius: 6px;padding-right: 3px;padding-left: 3px;padding-bottom: 2px;padding-top: -1px;">Confirmed</span>';

              }else
              {

                $delivered='<span style="background: red;color: rgb(255,255,255);border-radius: 6px;padding-right: 3px;padding-left: 3px;padding-bottom: 2px;padding-top: -1px;">not confirmed</span>';
              }

              if($rows['employee_type'] == 'Police')
              {
                  $police='<span style="background: #17e305;color: rgb(255,255,255);border-radius: 6px;padding-right: 3px;padding-left: 3px;padding-bottom: 2px;padding-top: -1px;">Police</span>';

              }else
              {

                $police='<span style="background: red;color: rgb(255,255,255);border-radius: 6px;padding-right: 3px;padding-left: 3px;padding-bottom: 2px;padding-top: -1px;">Default</span>';
              }

              
              ?>
                                            <tr>
                                                <td><?php echo $x;?> </td>
                                                <td><?php echo $rows['firstname'].' '.$rows['lastname'];?></td>
                                                <td><?php echo $rows['id_number'];?></td>
                                                <td><?php echo $rows['gender'];?></td>
                                    
                                                <td><?php echo $rows['phone'];?></td>
                                                <td><?php echo $rows['email'];?></td>
                                              
                                                <td><?php echo $delivered;?></td>
                                                <td><?php echo $police;?></td>
                                                <td>
                                                <select onChange="window.location.href =this.value" style="border-radius: 0px;background: rgb(247,249,252);border-style: none;color: rgb(80,94,108);" name="" id="">
                                                    <option value="">Select</option>
                                                 
                                                    <option value="notpolice.php?url=<?php echo $rows['person_id']?>">Unassign-default</option>
                                                </select>
                                                
                                                </td>
												 
                                               
                                                <td>
                                                <p><a href="viewpolice.php?value=<?php echo $rows['person_id']; ?>"><i class="fas fa-eye" style="font-size: 16px;color: blue;"></i></a></p>
                                            </td>
                                          
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
                        <div class="card-body"></div>
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

</html>