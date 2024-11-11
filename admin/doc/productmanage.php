<?php
require_once './data/productdata.php';
require_once './connec/myconnection.php';
$product = new Product();
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
      <li><a class="app-nav__item" href="../index.php"><i class='bx bx-log-out bx-rotate-180'></i> </a>

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
      <li><a class="app-menu__item active" href="#"><i
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
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="#"><b>List of customers</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">
                  <a class="btn btn-add btn-sm" href="addproduct.php" title="Thêm"><i class="fas fa-plus"></i>
                  Create product</a>
              </div>
            </div>
            <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0"
              id="sampleTable">
              <thead>
                <tr>
                  <th width="10">ID</th>
                  <th width="150">Name</th>
                  <th width="20">Amount</th>
                  <th width="100">Price</th>
                  <th width="100">Image</th>
                  <th>Description</th>
                  <th width="100">Edit</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  $result=$product->showAllProduct($conn);
                        while($row = $result->fetch_assoc()){
                  ?>
                <tr>
                  <td><?php echo $row["pro_id"];?></td>
                  <td><?php echo $row["pro_name"]; ?></td>
                  <td><?php echo $row["amount"]; ?></td>
                  <td><?php echo $row["price"]; ?></td>
                  <td><img src="<?php echo $row['image']; ?>" width="100"/></td>
                  <td><?php echo $row["description"]; ?></td>
                  <<td class="table-td-center">
                      <a class="btn btn-primary btn-sm trash" 
                         href="deleteproduct.php?action=remove&id=<?php echo $row["pro_id"];?>">
                          <i class="fas fa-trash-alt"></i></a>
                    <a class="btn btn-primary btn-sm edit"
                       href="editproduct.php?action=edit&id=<?php echo $row["pro_id"];?>">
                      <i class="fas fa-edit"></i>
                    </a>
                  </td>
                </tr>
                        <?php }?>
              </tbody>
            </table>
          </div>
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
    //     //Sao chép dữ liệu
    //     var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

    // copyTextareaBtn.addEventListener('click', function(event) {
    //   var copyTextarea = document.querySelector('.js-copytextarea');
    //   copyTextarea.focus();
    //   copyTextarea.select();

    //   try {
    //     var successful = document.execCommand('copy');
    //     var msg = successful ? 'successful' : 'unsuccessful';
    //     console.log('Copying text command was ' + msg);
    //   } catch (err) {
    //     console.log('Oops, unable to copy');
    //   }
    // });


    //Modal
    $("#show-emp").on("click", function () {
      $("#ModalUP").modal({ backdrop: false, keyboard: false })
    });
  </script>
</body>

</html>