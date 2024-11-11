<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Login </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/team.jpg" alt="IMG">
                </div>
                <!--=====TIÊU ĐỀ======-->
                <form class="login100-form validate-form">
                    <span class="login100-form-title">
                        <b>LOGIN SYSTEM</b>
                    </span>
                    <!--=====FORM INPUT TÀI KHOẢN VÀ PASSWORD======-->
                    <form action="">
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" placeholder="Username" name="username"
                                id="username">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-user'></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input">
                            <input autocomplete="off" class="input100" type="password" placeholder="Password"
                                name="current-password" id="password-field">
                            <span toggle="#password-field" class="bx fa-fw bx-hide field-icon click-eye"></span>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-key'></i>
                            </span>
                        </div>

                        <!--=====ĐĂNG NHẬP======-->
                        <div class="container-login100-form-btn">
                            <input type="button" value="Login" id="submit" onclick="validate()" />
                        </div>
                    </form>
                    
                </form>
            </div>
        </div>
    </div>
    <!--Javascript-->
    <script src="/js/main.js"></script>
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script type="text/javascript">
        //show - hide mật khẩu
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        $(".click-eye").click(function () {
            $(this).toggleClass("bx-show bx-hide");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        /* =========================================== */
/* =========================================== */
function validate() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password-field").value;
    //Đặt 1 Admin ảo để đăng nhập quản trị
    if (username == "admin" && password == "123456") {
        swal({
            title: "",
            text: "Hello Admin",
            icon: "success",
            close: true,
            button: false,
          });
        window.location = "doc/index.php";
        return true;
       
    }
    //Nếu không nhập gì mà nhấn đăng nhập thì sẽ báo lỗi
    if (username == "" && password == "") {
        swal({
            title: "",
            text: "Please complete all information...",
            icon: "error",
            close: true,
            button: "Retry",
          });
         
        return false;
       
    }
    //Nếu không nhập mật khẩu mà đúng tài khoản 
    if (username == "admin" && password == "") {
        swal({
            title: "",
            text: "Bạn chưa nhập mật khẩu...",
            icon: "warning",
            close: true,
            button: "Thử lại",
          });
        return false;
    }
    //Nếu không nhập tài khoản sẽ báo lỗi
    if (username == null || username == "") {
        swal({
            title: "",
            text: "Tài khoản đang để trống...",
            icon: "warning",
            close: true,
            button: "Thử lại",
          });
        return false;
    }
    //Nếu không nhập mật khẩu sẽ báo lỗi
    if (password == null || password == "") {
        swal({
            title: "",
            text: "Mật khẩu đang để trống...",
            icon: "warning",
            close: true,
            button: "Thử lại",
          });
        return false;
    }
    //Nếu trống toàn bộ thì báo lỗi
    else {
        swal({
            title: "",
            text: "Sai thông tin đăng nhập hãy kiểm tra lại...",
            icon: "error",
            close: true,
            button: "Thử lại",
          });
        return true;
    };
}

/*  PHẦN NỘI DUNG KHÔI PHỤC MẬT KHẨU   */

/* =========================================== */
/* =========================================== */
//  function validate() {
//      var email = document.getElementById("email").value;
//     if (email == null || email == "") {
//        swal("Bạn Chưa Nhập Email", "Vui Lòng Kiểm Tra", "warning");
//        return false;
//    }
//}
function RegexEmail(emailInputBox) {
    var emailStr = document.getElementById(emailInputBox).value;
    var emailRegexStr = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var isvalid = emailRegexStr.test(emailStr);
    if (!isvalid) {
        swal({
            title: "",
            text: "Bạn vui lòng nhập đúng định dạng email...",
            icon: "error",
            close: true,
            button: "Thử lại",
          });
        
        emailInputBox.focus;
    } else {
        swal({
            title: "",
            text: "Chúng tôi vừa gửi cho bạn email hướng dẫn đặt lại mật khẩu vào địa chỉ cho bạn",
            icon: "success",
            close: true,
            button: "Đóng",
          });
        emailInputBox.focus;
        window.location = "#";

    }
}

    </script>
</body>

</html>