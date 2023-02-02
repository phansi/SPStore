<?php 

require('../../API/function.php');
session_start();
if(!isset($_SESSION['user']) || $_SESSION['role'] != 3){
    header('Location: ../../login.php');
    exit();
}


$countUser = count(json_decode(getUser(3)));

$getAcptAppCount = count(json_decode(getApp(1)));
$getUnAcptAppCount = count(json_decode(getApp(0)));
$getCategoriesCount = count(json_decode(getCategories()));



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Dashboard Admin</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
        integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
        
        <style><?php include('../../css/style.css')?></style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <input type="checkbox"  id="nav-toggle">

    <!-- Navbar left * * * * * * * * * * -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <a href="../../index.php"><h2><span class="lab la-accusoft"></span> <span>SPStore</span></h2></a>
        </div>
        <div class="sidebar-menu">  
            <ul>
                <li>
                    <a class="<?php if(isset($_GET['page']) && $_GET['page'] == 'overview' || !isset($_GET['page']) ){echo 'active';}?>" href="?page=overview"><Span class="las la-igloo"></Span>
                        <Span>Overview</Span> </a>
                </li>
                <li>
                    <a class="<?php if(isset($_GET['page']) && $_GET['page'] == 'users'){echo 'active';}?>" href="?page=users"><Span class="las la-users"></Span>
                        <Span>User</Span> </a>
                </li>
                <li>
                    <a class="<?php if(isset($_GET['page']) && $_GET['page'] == 'application'){echo 'active';}?>" href="?page=application"><Span class="las la-shopping-bag"></Span>
                        <Span>Application</Span> </a>
                </li>
                <li>
                    <a class="<?php if(isset($_GET['page']) && $_GET['page'] == 'category'){echo 'active';}?>" href="?page=category"><Span class="las la-receipt"></Span>
                        <Span>Category </Span> </a>
                </li>
        
                <li>
                    <a class="<?php if(isset($_GET['page']) && $_GET['page'] == 'profile'){echo 'active';}?>" href="?page=profile"><Span class="fas fa-id-badge"></Span>
                        <Span>Personal information </Span> </a>
                </li>
        
            
                <li>
                    <a class="<?php if(isset($_GET['page']) && $_GET['page'] == 'security'){echo 'active';}?>" href="?page=security"><Span class="fas fa-shield-alt"></Span>
                        <Span>Security </Span> </a>
                </li>
                <li>
                    <a class="<?php if(isset($_GET['page']) && $_GET['page'] == 'transaction'){echo 'active';}?>" href="?page=transaction"><Span class="fas fa-money-bill-wave"></Span>
                        <Span>Transaction </Span> </a>
                </li>
                <li>
                    <a class="<?php if(isset($_GET['page']) && $_GET['page'] == 'upgradeaccount'){echo 'active';}?>" href="?page=upgradeaccount"><Span class="fas fa-user-plus"></Span>
                        <Span>Upgrade account</Span> </a>
                </li>
              
                <li>
                    <a href="../../logout.php"><Span class="fas fa-sign-out-alt"></Span>
                        <Span> Logout</Span> </a>
                </li>
                
            </ul>
        </div>
    </div>
    <!-- Navbar left * * * * * * * * * * -->



    <!-- Main content * * * * * * * * * * -->
    <div class="main-content">

        <!-- Header * * * * * * * * * * -->
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                Dashboard
            </h2>
            <div class="user-wrapper">
             <?php
                $getuser= json_decode(getinfo($_SESSION['user']));
                 foreach($getuser as $userad) {?>
                <img src="../../dashboard/tmpavatar/<?= $userad->avatar ?>" width="40px" height="40px"alt="" onerror="this.src='../../assets/image/131929641_722702295028651_1023205781934907728_n.jpg.01';" >
                <div>
                    <h6><?= $userad->firstname." ". $userad->lastname ?></h6>
                    <small>User</small>
                    <small>Wallet:<?= $userad->wallet?></small>
                </div>
           
            <?php } 
            ?>
            </div>
        </header>
        <!-- Header * * * * * * * * * * -->

        <!-- Main -->
        <main>


            <!-- Overview -->
     
            <?php if(isset($_GET['page']) && $_GET['page'] == 'overview' || !isset($_GET['page'])) {?>
                <div class="cards">
                    <div class="card-single">
                        <div>
                            <h1><?= $countUser?></h1>
                            <span>Users</span>
                        </div>
                        <div>
                            <span class="las la-users"></span>
                        </div>
                    </div>
               
                    <div class="card-single">
                        <div>
                            <h1><?= $getAcptAppCount?></h1>
                            <span>Application</span>
                        </div>
                        <div>
                            <span class="las la-shopping-bag"></span>
                        </div>
                    </div>
                    
                    <div class="card-single">
                        <div>
                            <h1><?= $getCategoriesCount?></h1>
                            <span>Category</span>
                        </div>
                        <div>
                            <span class="las la-receipt"></span>
                        </div>
                    </div>
                </div>
            <?php }?>
         
            <!-- Overview -->


            <!-- Users -->
            <?php if(isset($_GET['page']) && $_GET['page'] == 'users') {?>
                <?php
                     if (isset($_POST['removeuseremail'])  && isset($_POST['useremail'])){
                        $useremail = $_POST['useremail'];
                        removeusers($useremail);
                   }
                   ?>
                <div class="container">
                    <div class="table-responsive">
                        <table class="table  table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Wallet</th>
                                   
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $getNormalUsers = json_decode(getUser(3));
                                foreach($getNormalUsers as $users) {?>
                                    <tr>
                                        <td><?= $users->firstname." ". $users->lastname ?></td>
                                        <td><?= $users->email ?></td>
                                        <td>User</td>
                                        <td><?= number_format($users->wallet)?> đ</td>
                                        <td>
                                        
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php }?>
            <!-- Users -->


           


            <!-- Application -->
            <?php if(isset($_GET['page']) && $_GET['page'] == 'application') {?>
                <div class="container">
                    <div class="table-responsive">
                        <table class="table  table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">icon</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Version</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Publish date</th>
                                    <th scope="col">Price</th>
                              
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $getApps = json_decode(getApp(1));
                                if (isset($_POST['removeApp'])  && isset($_POST['appID'])){
                                    $appID = $_POST['appID'];
                                    removeApp($appID);
                                }
                                foreach($getApps as $app) {?>
                                    <tr>
                                        <td>
                                            <img src="../tmpfile/<?= $app->icon ?>" alt="" width="50px">
                                        </td>
                                        <td><?= $app->name ?></td>
                                        <td><?= $app->author ?></td>
                                        <td><?= $app->version ?></td>
                                        <td><?= $app->category ?></td>
                                        <td><?=Round( $app->size *10**(-6),2).'MB'?></td>
                                        <td><?= $app->publish ?></td>
                                        <td><?= $app->price ?></td>
                                        <td>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            <?php }?>
            <!-- Application -->



            <!-- Security -->
            <?php if (isset($_GET['page']) && $_GET['page'] == 'security') { ?>
                <div class="container">
                <h1 class="text-center">Security</h1>
                    <?php 

                        $changePasswordError = '';
                        $changePasswordSuccess = '';
                        if(isset($_POST['changePassword']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {

                            $new_password = $_POST['new_password'];
                            $confirm_password = $_POST['confirm_password'];

                            if(empty($new_password)) {
                                $changePasswordError = 'Please enter your new password';
                            } elseif (strlen($new_password) < 6) {
                                $changePasswordError = 'Password must have at least 6 characters';
                            } elseif (empty($confirm_password)) {
                                $changePasswordError = 'Please confirm your password';
                            } else {
                                if ($new_password != $confirm_password) {
                                    $changePasswordError = 'Password does not match';
                                } else {
                                    updatePassword($_SESSION['user'], $confirm_password);
                                    $changePasswordSuccess = 'Update password successfully';
                                };
                            }

                        }
                    ?>

                    <form method="POST">
                        
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-danger"><?= $changePasswordError?></label>
                            <label class="form-label text-success"><?= $changePasswordSuccess?></label>
                        </div>
                        
                        <button type="submit" name="changePassword" class="btn btn-primary">Change password</button>
                    </form>
                </div>
            <?php } ?>
            <!-- Security -->


            <!-- Category -->
            <?php if(isset($_GET['page']) && $_GET['page'] == 'category') {?>

                <div class="container">
                    

              

                    <div class="table-responsive">
                        <table class="table  table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                               
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                     $getCategories = json_decode(getCategories());
                                
                                    foreach($getCategories as $category) {?>
                                    <tr>
                                        <td><?= $category->name ?></td>
                                        <td>
                                  
                                        </td>
                                    </tr>    
                                <?php } 
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            <?php }?>
            <!-- Category -->




<!-- Personal information--->
<?php if(isset($_GET['page']) && $_GET['page'] == 'profile') {
    
    
    $error='';
    $firstname='';
    $lastname='';
    $success='';
    if (isset($_POST['Editprofile'])) {
        
        $firstname = $_POST['firstname'];
        $lastname =$_POST['lastname'];

        $email = $_SESSION['user'];

        $avatar = $_FILES['avatar']['name'];
        $avatarpath = "../../dashboard/tmpavatar/";
        $target_fileavatar =$avatarpath.basename($_FILES["avatar"]["name"]);
      
        if (empty($firstname)) {
            $error = 'Please enter first name !';
            }
            elseif (empty($lastname)) {
           $error = 'Please enter last name !';
            }elseif(empty($avatar)){
                $error = 'Please up avatar!';
            }
            else{
            move_uploaded_file($_FILES["avatar"]["tmp_name"],$target_fileavatar);
            if (editprofile($firstname,$lastname,$email, $avatar) == true) {
             $success = 'Edit success please press F5 to reload your avatar !!';
             $getadmin= json_decode(getUser(1));
            } else {
             $error = 'failed';
        }
    
    };
}
?>
   
   <div class="container">
    <form  method="post"  enctype="multipart/form-data">
        <div class="abcxyz rounded bg-white mt-5 mb-5">
        <div class="row">
        <div class="profile col-md-12 border-right avatar-profile d-flex justify-content-center align-items-center">

        <div class="d-flex flex-column align-items-center text-center p-3 py-3">
             <?php
              $getinfo= json_decode(getinfo($_SESSION['user']));
                 foreach($getinfo as $userad) {?>
                  <img id ="photo"class="rounded-circle mt-5" width="152px" height="152px" src="../../dashboard/tmpavatar/<?= $userad->avatar ?>">
   
                   <span class="font-weight-bold"><?= $userad->firstname." ". $userad->lastname ?></span>
            <?php } 
            ?>
        
            <span class="text-black-50"><?= $_SESSION['user']?></span>
            <span> </span>
        </div>

        <div class="form-group avatar-input ">
        <label id= "uploadBtn"for="avatar"><i class="fas fa-camera camera" ></i></label>
        <input id="file" name="avatar" type="file" id="avatar" accept="image/gif, image/jpeg, image/png, image/bmp, image/jpg">
        
        
        </div>
        </div>
        <script src="../../js/main.js"></script>


        <div class="col-md-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
    
                <div class="row mt-2">
                <?php
                    $getadmin= json_decode(getUser(1));
                  foreach($getadmin as $userad) {?>
                     <div class="col-md-12"><label for="firstname"class="labels">First name </label><input name="firstname" type="text" class="form-control" value="<?= $userad->firstname ?>"></div>
                    <div class="col-md-12"><label for="lastname"class="labels">Last name</label>
                    <input name="lastname"type="text" class="form-control" value="<?= $userad->lastname ?>"></div>
                 <?php } 
                  ?>
                   
                </div>

                <div class="form-group mt-5 text-center">
                <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }elseif(!empty($success)) {
                                echo "<div class='alert alert-success'>$success</div>";
                            }
                        ?>
                    <button type="submit" name="Editprofile" class="btn btn-primary px-5 mr-2">Save</button>
                </div>
            </div>
        </div>

    </div>
        </div>
        </div>
        </div>
        </div>
    </form>
<?php } ?>
<!-- Personal information--->
<script>
    // Add the following code if you want the name of the file appear on select upload
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>



<!-- Transaction--->
<?php if (isset($_GET['page']) && $_GET['page'] == 'transaction') { ?>
                <div class="container">

                    <?php 

                  
                    


                        if(isset($_POST['load']) && isset($_POST['seri'])) {
                                 $seri= $_POST['seri'];
                                $emailnapthe=$_SESSION['user'];
                                $card1=json_decode(getcard1($seri));
                                $card2=json_decode(getcard2($seri));
                                $tientk=json_decode(getUser(1));
                                if(empty($seri))
                                {
                                    $error='Please enter seri number!!';
                                }else{

                                   foreach($card2 as $c2){
                                       $seri2=$c2->seri;
                                       $money2=$c2->value;
                                       
                                       if($seri==$seri2){
                                           $error='Invalid serial number !!';
                                           echo 'Card has expired please reload this page !! ';
                                           exit();
                                       }                               
                                   }
                                   foreach($card1 as $c1){
                                    $seri1=$c1->serialnumber;
                                    $money1=$c1->money;

                                     
                                    if($seri=$seri1 && !empty($seri)){
                                       
                                        nap($seri1,$money1,$_SESSION['user']);
                                        foreach($tientk as $tiencong){
                                            $cong =$tiencong->wallet;
                                            napthe($money1,$_SESSION['user'],$cong);
                                        
                                        }
                                
                                        disablecard($seri1);
                                        $success='Loading successful ';
                                        }
                                    
                                    if($seri!=$seri1){
                                        $error='Thẻ đã xài !!';
                                      
                                    }

                                }
                             
                             
                                }
                    }
                    ?>
                    <form method="POST" enctype="multipart/form-data">
                        <h1 class="text-center">Transaction</h1>
                        <div class="mb-3">
                            <label for="seri" class="form-label">Serial number</label>
                            <input type="number" class="form-control" id="seri" name="seri">
                        </div>


                        <div class="mb-3">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }elseif(!empty($success)){
                                echo "<div class='alert alert-success'>$success</div>";
                            }
                        ?>
                        </div>
                        
                        <button type="submit" name="load" class="btn btn-primary col-md-3">Load</button>
                    </form>
                </div>




                <div class="container">
                <h1 class="text-center">Card loading history </h1>
                    <div class="table-responsive">
                        <table class="table  table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Serialnumber</th>
                                    <th scope="col">Value</th>
                                    <th scope="col">History</th>
                                </tr>
                            </thead>

                            <tbody>
                            
                                <?php
                                  
                                
                                $info = json_decode(getcard22($_SESSION['user']));
                                foreach($info as $cc2) {?>
                                
                                    <tr>
                                       
                                        <td><?= $cc2->seri ?></td>
                                        <td><?= $cc2->value ?></td>
                                        <td><?= $cc2->date ?></td>
                                   
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>

<!-- Transaction--->





<!-- Upgrade account--->
<?php if (isset($_GET['page']) && $_GET['page'] == 'upgradeaccount') { ?>
                <div class="container">

                    <?php 
                    
                        if(isset($_POST['up'])) {
                          
                                $vi =json_decode(getUser(3));
                                
                                foreach($vi as $tk){
                                    $tk1=$tk->wallet;
                                   
                                }
                                if($tk1<500000){
                                    $error='Không đủ tiền để nâng cấp liên hệ admin Phan Si để nhận free thẻ !!';
                                }else{
                                    upgrade($_SESSION['user']);
                                    echo 'Upgrade success,please log out and log back in to use developer functions!!';
                                    exit();
                                }
                    }
                    ?>
                    <form method="POST" enctype="multipart/form-data">
                        <h1 class="text-center">Upgrade Account</h1>
                        

                        <div class="mb-3">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }elseif(!empty($success)){
                                echo "<div class='alert alert-success'>$success</div>";
                            }
                        ?>
                        </div>
                        
                        <button type="submit" name="up" class="btn btn-primary col-md-12 ">Upgrade</button>
                    </form>
                </div>




            <?php } ?>


<!-- Upgrade account---> 

        </main>
 
    <!-- Main content * * * * * * * * * * -->
</body>

</html>