<?php
class TodoController
{
    public function index ()
    {
        if ($_SESSION['page'] == 'login') {
            $_SESSION['page'] = "In progress";
        }
        if ($_SESSION['page'] == "In progress") {
            include ('../views/todo.html');
        }
        if ($_SESSION['page'] == "Completed") {
            include ('../views/todo.html');
        }
        if ($_SESSION['page'] == "edit")
        {
            include ('../views/edit.html');
        }
    }

    public function json($status, $pdo ,$event, $user)
    {
        if ($_SESSION['page'] == "In progress") {
            $sql = 'SELECT * FROM things WHERE status = true AND user="' . $user . '" ORDER BY num';
            $result = $pdo->query($sql)->fetchAll();
            echo json_encode($result);
        }
        if ($_SESSION['page'] == "Completed") {
            $result = $pdo->query('SELECT * FROM things WHERE status = false AND user="' . $user . '" ORDER BY num')->fetchAll();
            echo json_encode($result);
        }
        if ($_SESSION['page'] == "edit") {
            $result = $pdo->query('SELECT * FROM things WHERE id=' .  $_SESSION['event'])->fetchAll();
            echo json_encode($result);
        }
    }

    public function add($status, $pdo ,$event, $user)
    {
        $sql = "INSERT INTO things (description, user, status) VALUES (?,?,?)"; 
        $pdo->prepare($sql)->execute([$_POST['event'], $user, true]);
        $result = $pdo->query('SELECT * FROM things WHERE status = true AND user="' . $user . '"')->fetchAll();
        header('Location: /Todo/index');
    }

    public function complete($status, $pdo, $event, $user)
    {
        $sql = "UPDATE things SET status=? WHERE id=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([false, $event]);
        $_SESSION['page'] = "Completed";
        header('Location: /Todo/index');
    }

    public function In_progress()
    {
        $_SESSION['page'] = "In progress";
        header('Location: /Todo/index');
    }

    public function delete($status, $pdo, $event, $user)
    {
        $sql = "DELETE FROM things WHERE id=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$event]);
        $result = $pdo->query('SELECT * FROM things WHERE status = false AND user="' . $user . '"')->fetchAll();
        header('Location: /Todo/index');
    }

    public function edit_page($status, $pdo, $event, $user)
    {
        $_SESSION['page'] = "edit";
        $_SESSION['edit'] = $event;
        header('Location: /Todo/index/' . $event);
    }

    public function edit($status, $pdo, $event, $user)
    {
        $sql = "UPDATE things SET description=?, num=? WHERE id=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$_POST['text'], $_POST['new_id'], intval($_POST['id'])]);
        $_SESSION['page'] = "In progress";
        header('Location: /Todo/index');
    }

}
?>