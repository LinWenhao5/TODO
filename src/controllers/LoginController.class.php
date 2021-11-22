<?php
class LoginController
{
    function index ()
    {
        include ('../views/Login.html');
    }


    function json($status, $pdo, $event)
    {
        if ($status == false) {
            if ($_SESSION['page'] == 'create') {    
                $arr = [
                    'title' => 'Sign up', 
                    'request' => 'login', 
                    'value' => 'back'
                ];
            } 
            if ($_SESSION['page'] == 'login') {
                $arr = [
                    'title' => 'Sign in', 
                    'request' => 'create', 
                    'value' => 'Sign up'
                ];
            }
            echo json_encode($arr);
        } else {
            header('Location: /Todo/index');
        }
    }

    function Login() {
        $_SESSION['page'] = "login";
        header('Location: /Login/index/');
    }

    function create($status)
    {
        $_SESSION['page'] = "create";
        header('Location: /Login/index/');
    }

    function check($status, $pdo)
    {
        if ($_POST['request'] == 'Sign in') 
        {
            $sql = 'SELECT * FROM user';
            $result = $pdo->query($sql)->fetchAll();
            foreach ($result as $data){
                if ($_POST['username'] == $data['username'] && $_POST['password'] == $data['password']) {
                    header('Location: /Todo/index');
                    $token = bin2hex(random_bytes(100));
                    $_SESSION['token'] = $token;
                    $stmt= $pdo->prepare("UPDATE session SET token=?, user=? WHERE id=1");
                    $stmt->execute([$_SESSION['token'], $data['username']]);
                } else {
                    echo 'Invalid account or password!';
                    header("refresh:1;url=/Login/index");
                }
            }
        } else {
            $sql = "INSERT INTO user (username, password) VALUES (?,?)"; 
            $pdo->prepare($sql)->execute([$_POST['username'], $_POST['password']]);
            header("location: /Login/index");
        }
    }

    function Logout($status,$pdo)
    {
        unset($_SESSION['token']);
        $sql = "UPDATE session SET token=?, user=? WHERE id=1";
        $pdo->prepare($sql)->execute(['empty', 'empty']);
        header('Location: /Home/index');
    }
}
?>