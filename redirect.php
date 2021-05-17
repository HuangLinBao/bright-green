<?php session_start(); ?>
<?php require_once("./db.php"); ?>
<?php require_once("./essential.php"); ?>
<?php require_once("./dashboard.php"); ?>

<?php
$sql = null;
if (isset($_POST['submit'])) {
    if ($password != $confirm_password) {
        $errFlag = True;
    }
    if (empty($_POST['gender'])) {
        $errFlag = True;
    }
    
    if (!isset($errFlag)) {
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        if (empty($_POST['role'])) {
    
            $sql = "INSERT INTO `accounts` (`userID`, `first_name`, `last_name`, `full_name`, `username`, `email`, `user_password`, `phone_number`, `birthday`, `gender`, `role`) VALUES (NULL, :f_name, :l_name, :full_name, :username, :email, :user_password, :phone_number, :birthday, :gender, :role) ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':f_name' => $first_name,
                ':l_name' => $last_name,
                ':full_name' => $full_name,
                ':username' => $username,
                ':email' => $email,
                ':user_password' => $hash,
                ':phone_number' => $phone_Num,
                ':birthday' => $birthday,
                ':gender' => $gender,
                ':role' => "Employee"
    
    
            ]);
        } else if (!empty($_POST['role'])) {
    
            $sql = "INSERT INTO `accounts` (`userID`, `first_name`, `last_name`, `full_name`, `username`, `email`, `user_password`, `phone_number`, `birthday`, `gender`, `role`) VALUES (NULL, :f_name, :l_name, :full_name, :username, :email, :user_password, :phone_number, :birthday, :gender, :role) ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':f_name' => $first_name,
                ':l_name' => $last_name,
                ':full_name' => $full_name,
                ':username' => $username,
                ':email' => $email,
                ':user_password' => $hash,
                ':phone_number' => $phone_Num,
                ':birthday' => $birthday,
                ':gender' => $gender,
                ':role' => $role
            ]);
        }
    
        $sql = "INSERT INTO `employees`(`emp_id`, `emp_full_name`, `position`, `office`, `age`, `start_date`, `salary`, `gender`, `email`, `phone_number`) VALUES (NULL, :emp_full_name, :position, :office, :age, :start_date, :salary, :gender, :email, :phone_number)";
        $stmt = $pdo->prepare($sql);
        $stmt -> execute([
            ':emp_full_name' => $full_name,
            ':position' => $position,
            ':office' => $office,
            ':age' => $age,
            ':start_date' => $start_date,
            ':salary' => $salary,
            ':gender' => $gender,
            ':email' => $email,
            ':phone_number' => $phone_Num
        ]);
    
        $sql = null;
    }
}



header("Refresh:0.5;url =./dashboard.php");

?>