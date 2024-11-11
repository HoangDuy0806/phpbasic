<?php
require_once './connec/myconnection.php';
$pro_id="";
$name="";
$amount="";
$price="";
$image="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["pro_id"])){$pro_id=$_POST["pro_id"];}
    if(isset($_POST["name"])){$name=$_POST["name"];}
    if(isset($_POST["amount"])){$amount=$_POST["amount"];}
    if(isset($_POST["price"])){$price=$_POST["price"];}
    if(isset($_POST["description"])){$description=$_POST["description"];}
    $image = $_FILES['image']['name'];
    $target = "../images/".basename($image);
    $sql="UPDATE `product` SET `pro_name`='$name',"
            . "`amount`='$amount',`price`='$price',`image`='$target',`description`='$description' WHERE pro_id='$pro_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Updated!!!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    echo '<script language="javascript">alert("upload image successfully!");</script>';
    }else{
    echo '<script language="javascript">alert("upload image failed!");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Product</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body onload="time()" class="app sidebar-mini rtl">
  <!-- Navbar-->
  <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
      aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


      <!-- User Menu-->
      <li><a class="app-nav__item" href="/index.html"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../images/logo.png" width="50px"
        alt="User Image">
      <div>
        <p class="app-sidebar__user-name"><b>Admin</b></p>
        <p class="app-sidebar__user-designation">Welcome back</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
      
      <li><a class="app-menu__item" href="index.php"><i class='app-menu__icon bx bx-tachometer'></i><span
            class="app-menu__label">Dashboard</span></a></li>
            <li><a class="app-menu__item" href="customermanage.php"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Customer management</span></a></li>
            <li><a class="app-menu__item active" href="productmanage.php"><i
            class='app-menu__icon bx bx-purchase-tag-alt'></i>
            <span class="app-menu__label">Product management</span></a>
      </li>
      <li><a class="app-menu__item" href="ordermanage.php"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Order management</span></a></li>
            <li><a class="app-menu__item" href="contactmanage.php"><i class='app-menu__icon bx bx-calendar-check'></i><span
            class="app-menu__label">Feedback management </span></a></li>
    </ul>
  </aside>
  
<main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item"><a href="#">Update Product</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="tile">

          <h3 class="tile-title">Update Product</h3>
          <div class="tile-body">
            <div class="row element-button">
            </div>
              <?php 
              if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
              $id=$_GET['id'];
              $sql="select * from product where pro_id='$id'";
              $result=$conn->query($sql);
              $row=$result->fetch_assoc();
              ?>
              <form class="row" action="" method="POST" enctype="multipart/form-data">
              <div class="form-group col-md-4">
                <label class="control-label">Product ID</label>
                <input class="form-control" name="pro_id" 
                       type="text" value="<?php echo $id; ?>">
                
              </div>
                <div class="form-group col-md-4">
                <label class="control-label">Name</label>
                <input class="form-control" name="name" 
                       type="text" required value="<?php echo $row["pro_name"];?>">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Amount</label>
                <input class="form-control" name="amount" type="text" required
                       value="<?php echo $row["amount"]; ?>">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Price</label>
                <input class="form-control" name="price" type="text" required
                       value="<?php echo$row["price"]; ?>">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Description </label>
                <input class="form-control" name="description" type="text" required
                       value="<?php echo$row["description"]; ?>">
              </div>
              </div>
                  <div class="form-group col-md-12">
                <label class="control-label">Product Image</label>
                <div id="myfileupload">
                  <input type="file" name="image" />
                </div>
              </div>
              <?php }?>
          </div>
          <button class="btn btn-save" type="submit">Update</button>
          <a class="btn btn-cancel" href="customermanage.php">Cancel</a>
        </div>
      </div>
    </div>

  </main>

    <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!--<script src="js/main.js"></script>-->
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>-->
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
  <script>
  //Thời Gian
    function time() {
      var today = new Date();
      var weekday = new Array(7);
      weekday[0] = "Sunday";
      weekday[1] = "Monday";
      weekday[2] = "Tuesday";
      weekday[3] = "Wednesday";
      weekday[4] = "Thursday";
      weekday[5] = "Friday";
      weekday[6] = "Saturday";
      var day = weekday[today.getDay()];
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      nowTime = h + " : " + m + " : " + s;
      if (dd < 10) {
        dd = '0' + dd
      }
      if (mm < 10) {
        mm = '0' + mm
      }
      today = day + ', ' + dd + '/' + mm + '/' + yyyy;
      tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
      document.getElementById("clock").innerHTML = tmp;
      clocktime = setTimeout("time()", "1000", "Javascript");

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
    }
    //In dữ liệu
    var myApp = new function () {
      this.printTable = function () {
        var tab = document.getElementById('sampleTable');
        var win = window.open('', '', 'height=700,width=700');
        win.document.write(tab.outerHTML);
        win.document.close();
        win.print();
      }
    }
    
    
  </script>
</body>

</html>