<?php 
    if(isset($_SESSION['user']))
        echo '<script>location.href="index.php?controller=giaovien&action=index";</script>';
    
    if(isset($_POST['user'])){
        
        $user = $_POST['user'];
        $check = (new User())->getUserByUsernameAndPassword($user['username'], $user['password']);
        if(empty($check)){
            echo '<script>alert("Sai tài khoản hoặc mật khẩu");</script>';
        }
        else{
            $_SESSION['user'] = $check;
            echo '<script>location.href="index.php?controller=giaovien&action=index";</script>';
        }
    }
?>

<div class="container" style="max-width: 500px">
    <form method="post" action="">
        <h2>Form login</h2>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="user[username]" value="" id="username" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="user[password]" value="" id="password" class="form-control"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Đăng nhập" class="btn btn-primary"/>
            <p>
                Chưa có tài khoản, <a href="index.php?controller=login&action=register">Đăng ký</a> ngay
            </p>
        </div>
    </form>
</div>