<?php
session_start();
require_once './admin/doc/connec/myconnection.php';
if(empty($_SESSION['username'])&&$_SERVER["REQUEST_METHOD"]=="POST"){
    echo '<script>alert("Username does not exist!!!");</script>';
    echo '<script>alert("login or sign in to continue!!!");</script>';
}
else
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_SESSION['username'];
    $sql="select * from account";
    $kt=true;
    $result=$conn->query($sql);
    while($row=$result->fetch_assoc()){
        if($username==$row["username"]){
            $kt=false;
            break;
        }
    }
    if($kt==true){
        echo '<script>alert("Username does not exist!!!");</script>';
    }else{
        $sql="select * from cart where username='$username'";
        $result=$conn->query($sql);
        if($result->num_rows==0){echo '<script>alert("cart is empty!!!");</script>';}
        else{
            $name=$_POST["name"];
            $email=$_POST["email"];
            $address=$_POST["address"];
            $sql="select * from cart where username='$username'";
            $result=$conn->query($sql);
            $total=0;
            $product="";
            $amount="";
            while($row=$result->fetch_assoc()){
                $id=$row['pro_id'];
                $sql1="select * from product where pro_id='$id'";
                $result1=$conn->query($sql1);
                $row1=$result1->fetch_assoc();
                $total+=$row["amount"]*$row1["price"];
                $product=$id;
                $amount=$row['amount'];
            }
            $total+=2;
            $date= date("Y-m-d");
            $sql="INSERT INTO `orderfreshshop`(`username`, `pro_id`, `amount`, `order_date`, `total_pay`, `address`) "
                    . "VALUES ('$username','$product','$amount','$date','$total','$address')";
            if($conn->query($sql)){echo '<script>alert("Order Success!!!");</script>';}
            $sql="DELETE FROM `cart` WHERE username='$username'";
            $conn->query($sql);
        }
    }
    $username1="";
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Checkout</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					
                    <div class="right-phone-box">
                        <p>Call US :- <a href="#"> +11 900 800 100</a></p>
                    </div>
                    <div class="our-link">
                        <ul>
                            <li><a href="#"><i class="fa fa-user s_color"></i> My Account</a></li>
                            <li><a href="#"><i class="fas fa-location-arrow"></i> Our location</a></li>
                            <li><a href="#"><i class="fas fa-headset"></i> Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="login-box">
                                            <?php
                                                        if(empty($_SESSION["username"])){
                                                            echo"<a class='btn hvr-hover' href='login.php'>Login</a>";
                                                        }else{
                                                            $id=$_SESSION["username"];
                                                            echo '<a class="btn hvr-hover" href="logout.php">'.$id.'</a>';
                                                        }?>
					</div>
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT80
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 50%! Shop Now
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT30
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 50%! Shop Now 
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="dropdown active">
                            <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">SHOP</a>
                            <ul class="dropdown-menu">
				<li><a href="shop.php">Sidebar Shop</a></li>
                                <li><a href="cart.php">Cart</a></li>
                                <li><a href="checkout.php">Checkout</a></li>
                                <li><a href="account.php">My Account</a></li>
                                <li><a href="wishlist.php">Wishlist</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li class="side-menu"><a href="#">
						<i class="fa fa-shopping-bag"></i>
                            <span class="badge"><?php
                            if(!isset($_SESSION["username"])){echo"";}
                                else{
                                    $id=$_SESSION["username"];
                                    $sql="select * from cart where username='$id'";
                                    $result=$conn->query($sql);
                                    echo $result->num_rows;
                                }
                            ?></span></span>
							<p>My Cart</p>
					</a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        <?php
                                if(!isset($_SESSION["username"])){echo"<tr>No result</tr>";}
                                else{
                                    $id=$_SESSION["username"];
                                    $sql="select * from cart where username='$id'";
                                    $result=$conn->query($sql);
                                    $total=0;
                                    if($result->num_rows<1){echo"<tr><td>No result <td></tr>";}
                                    else{
                                        while($row=$result->fetch_assoc()){
                                            $proid=$row["pro_id"];
                                            $sql1="select * from product where pro_id='$proid'";
                                            $re=$conn->query($sql1);
                                            $row1=$re->fetch_assoc();
                                            $total=$total+($row1['price']*$row['amount']);
                                            ?>
                        <li>
                            <a href="#" class="photo"><img src="<?php echo"admin/doc/".$row1['image']; ?>" class="cart-thumb" alt="" /></a>
                            <h6><a href="#"><?php echo $row1["pro_name"];?></a></h6>
                            <p><?php echo$row['amount'];?> - <span class="price">$<?php echo$row1['price'];?></span></p>
                        </li>
                        <?php
                                        }
                                    }
                                }
                                ?>
                        <li class="total">
                            <a href="cart.php" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: $<?php echo$total; ?></span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <form class="needs-validation"  method="POST">
            <div class="container">

                <div class="row">
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="checkout-address">
                            <div class="title-left">
                                <h3>Billing address</h3>
                            </div>
                                <div class="row">
                                    <div class="col-md-12 mb-12">
                                        <label for="firstName">Full name *</label>
                                        <input type="text" class="form-control" placeholder="" value="" required name="name">
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="email">Email Address *</label>
                                    <input type="email" class="form-control" placeholder="" required name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="address">Address *</label>
                                    <input type="text" class="form-control"  placeholder="" required name="address">
                                </div>


                                <hr class="mb-4">

                                <hr class="mb-4">
                                <hr class="mb-1"> 
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="row">

                            <div class="col-md-12 col-lg-12">
                                <div class="odr-box">
                                    <div class="title-left">
                                        <h3>Shopping cart</h3>
                                    </div>

                                    <div class="rounded p-2 bg-light">
                                        <?php
                                    if(!isset($_SESSION["username"])){echo"<tr>No result</tr>";}
                                    else{
                                        $id=$_SESSION["username"];
                                        $sql="select * from cart where username='$id'";
                                        $result=$conn->query($sql);
                                        $total=0;
                                        if($result->num_rows<1){echo"<tr><td>No result <td></tr>";}
                                        else{
                                            while($row=$result->fetch_assoc()){
                                                $proid=$row["pro_id"];
                                                $sql1="select * from product where pro_id='$proid'";
                                                $re=$conn->query($sql1);
                                                $row1=$re->fetch_assoc();
                                                $total+=$row['amount']*$row1['price'];
                                                ?>
                                        <div class="media mb-2 border-bottom">
                                            <div class="media-body"> <a href="detail.html"> <?php echo $row1["pro_name"];?></a>
                                                <div class="small text-muted">Price: $<?php echo$row1['price'];?> 
                                                    <span class="mx-2">|</span> Qty: <?php echo$row['amount'];?> 
                                                    <span class="mx-2">|</span> Subtotal: $<?php echo $row['amount']*$row1['price'];?></div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="order-box">
                                    <div class="title-left">
                                        <h3>Your order</h3>
                                    </div>
                                    <div class="d-flex">
                                        <div class="font-weight-bold">Product</div>
                                        <div class="ml-auto font-weight-bold">Total</div>
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex">
                                        <h4>Sub Total</h4>
                                        <div class="ml-auto font-weight-bold"> $ <?php
                                        if(empty($_SESSION["username"])) {echo 0;}
                                        else{
                                        echo$total;}?></div>
                                    </div>

                                    <hr class="my-1">


                                    <div class="d-flex">
                                        <h4>Shipping Cost</h4>
                                        <div class="ml-auto font-weight-bold"> $2 </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex gr-total">
                                        <h5>Grand Total</h5>
                                        <div class="ml-auto h5"> $ <?php
                                        if(empty($_SESSION["username"])) {echo 0;}
                                        else{
                                        echo$total+2;}?> </div>
                                    </div>
                                    <hr> </div>
                            </div>
                            <button class="btn hvr-hover" type="submit" >Place Order</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <!-- End Cart -->   

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-01.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-02.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-03.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-04.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-06.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-07.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-08.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-09.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->


    <!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-sm-12">
						<div class="footer-top-box">
							<h3>Business Time</h3>
							<ul class="list-time">
								<li>Monday - Friday: 08.00am to 05.00pm</li> <li>Saturday: 10.00am to 08.00pm</li> <li>Sunday: <span>Closed</span></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-md-12 col-sm-12">
						<div class="footer-top-box">
							<h3>Newsletter</h3>
							<form class="newsletter-box">
								<div class="form-group">
									<input class="" type="email" name="Email" placeholder="Email Address*" />
									<i class="fa fa-envelope"></i>
								</div>
								<button class="btn hvr-hover" type="submit">Submit</button>
							</form>
						</div>
					</div>
					<div class="col-lg-4 col-md-12 col-sm-12">
						<div class="footer-top-box">
							<h3>Social Media</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							<ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
						</div>
					</div>
				</div>
				<hr>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About Freshshop</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> 
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p> 							
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Our Sitemap</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Delivery Information</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 3756 <br>Preston Street Wichita,<br> KS 67213 </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2018 <a href="#">ThewayShop</a> Design By :
            <a href="https://html.design/">html design</a></p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js."></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>