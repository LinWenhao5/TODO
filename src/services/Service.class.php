<?php
class UserService
{
    public function validateLoggedIn($pdo)
    { 
        $result = $pdo->query('SELECT * FROM session')->fetchAll();
        foreach ($result as $data){
            if (isset($_SESSION['token']) && isset($data['token']) && $data['token'] == $_SESSION['token']) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function getUser($status, $pdo)
    {
        if ($status == true) {
            $result = $pdo->query('SELECT * FROM session')->fetchAll();
            foreach ($result as $data){
                if ($data['token'] == $_SESSION['token']) {
                    return $data['user'];
                } else {
                    return false;
                }
            }
        } else {
            return 'Guest';
        }
    }
}

