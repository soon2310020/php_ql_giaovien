<?php 
    if(isset($_POST['register'])){
        
        $user = $_POST['register'];

        $check = (new User())->getUserByUsernameAndPassword($user['username'], $user['password']);

        $check = (new User())->getUserByUsername($user['username']);

        if(!empty($check)){
            echo '<script>alert("Tài khoản đã có trong hệ thống");</script>';
        }
        else{
            if(trim($user['username']) == '' || trim($user['password']) == '' || $user['password'] != $user['password_confirm']){
                echo '<script>alert("Thông tin đăng ký không phù hợp");</script>';
            }
            else{
                
                $status = (new User())->insertRegister($user['username'],$user['password']);

                //echo '<script>alert("'.$status.'");</script>';

                if($status){

                    $now = date("Y-m-d H:i:s");

                    $check = (new User())->getUserByUsername($user['username']);

                    $themgiaovien = (new GiaoVien())->ThemGiaoVien($check['maUser'], "Chưa thiết lập", "null", "Chưa thiết lập",$check['maUser']);

                    echo '<script>alert("Đăng ký thành công");location.href="index.php?controller=login&action=login";</script>';
                }
                else
                    echo '<script>alert("Đăng ký không thành công");</script>';
            }
        }
    }
?>

<div class="container" style="max-width: 500px">
    <form method="post" action="">
        <h2>Form register</h2>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="register[username]" value="" id="username" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="register[password]" value="" id="password" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="password-confirm">Nhập lại password</label>
            <input type="password" name="register[password_confirm]" value="" id="password-confirm" class="form-control"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Đăng ký" class="btn btn-primary"/>
            <p>
                Đã có tài khoản, <a href="index.php?controller=login&action=login">Đăng nhập</a> ngay
            </p>
        </div>
    </form>
</div>