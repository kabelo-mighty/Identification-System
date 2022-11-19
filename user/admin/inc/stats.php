
        <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>South Africans</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>  <?php 
                                
                                $query="select count(*) as count from person where country ='South Africa'";
                                $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
                                $row=mysqli_fetch_array($result);
                                
                                echo $row['count'];
                                ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-check fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Non South Africans</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span> <?php 
                                
                                $query="select count(*) as count from person where country!='South Africa'";
                                $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
                                $row=mysqli_fetch_array($result);
                                
                                echo $row['count'];
                                ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-check fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>face added</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span> <?php 
                                
                                $query="select count(*) as count from face_identification";
                                $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
                                $row=mysqli_fetch_array($result);
                                
                                echo $row['count'];
                                ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-camera fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Police</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span> <?php 
                                
                                $query="select count(*) as count from person where employee_type='Police'";
                                $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
                                $row=mysqli_fetch_array($result);
                                
                                echo $row['count'];
                                ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-check fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
