

<table class="table table-sm my-0 mydatatable">
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
                                                <th>House no</th>
                                                <th>Street</th>
                                                <th>Suburb</th>
                                                <th>City</th>
                                                <th>Province</th>
                                                <th>Zip Code</th>
												<th><i class="fa fa-cogs"></i>&nbsp;Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?PHP
              $query="SELECT p.firstname as pf, p.lastname as pl,p.id_number as pd,p.gender as pg,p.dateOfbirth as pdob,p.phone as pp,p.email as pe,n.firstname as nf,n.lastname as nl,n.phone as np, 
              a.house_no as ah,a.street_name as ast,a.suburb as asu,a.city as ac,a.province as ap,a.zip_code as az from person p,address a,next_keen n where  a.person_id=p.person_id and n.person_id=p.person_id and n.person_id=p.person_id";
              $result=mysqli_query($conn,$query);
              
              $rows=mysqli_num_rows($result); 
              if ($rows>0) {
                  $x=1;
                while ($rows=mysqli_fetch_array($result)) {
              ?>
                                            <tr>
                                                <td><?php echo $x;?> </td>
                                                <td><?php echo $rows['pf'].' '.$rows['pl'];?></td>
                                                <td><?php echo $rows['pd'];?></td>
                                                <td><?php echo $rows['pg'];?></td>
                                                <td><?php echo $rows['pdob'];?></td>
                                                <td><?php echo $rows['pp'];?></td>
                                                <td><?php echo $rows['pe'];?></td>
                                                <td><?php echo $rows['nf'].' '.$rows['nl'];?></td>
                                                <td><?php echo $rows['np'];?></td>
                                                <td><?php echo $rows['ah'];?></td>
                                                <td><?php echo $rows['ast'];?></td>
                                                <td><?php echo $rows['asu'];?></td>
                                                <td><?php echo $rows['ac'];?></td>
                                                <td><?php echo $rows['ap'];?></td>
                                                <td><?php echo $rows['az'];?></td>
												 <td>
                                                <p><a href="#"><i class="fas fa-edit" style="font-size: 16px;color: rgb(78,223,92);"></i></a>&nbsp; &nbsp;<a href="#"><i class="fas fa-trash" style="font-size: 16px;color: rgb(255,45,17);"></i></a></p>
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