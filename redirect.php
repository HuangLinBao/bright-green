<?php session_start(); ?>
<?php require_once("./db.php"); ?>
<?php require_once("./essential.php"); ?>
<?php require_once("./dashboard.php"); ?>


<?php 
$sql = null;
$errFlag = null;

console_log("hi");
$first_name = trim($_POST['firstName']);
$last_name = trim($_POST['lastName']);
$full_name = $first_name . " " . $last_name;
console_log($first_name);
console_log($last_name);
console_log($full_name);
$username = trim($_POST['username']);
$birthday = trim($_POST['birthday']);
$age = calculateAge($birthday);
$gender = trim($_POST['gender']);
console_log($username);
console_log($birthday);
console_log($age);
console_log($gender);
$role = trim($_POST['role']);
$email = trim($_POST['email']);
$phone_Num = trim($_POST['phone']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);
console_log($role);
console_log($email);
console_log($phone_Num);
console_log($password);
console_log($confirm_password);
$office = trim($_POST['office']);
$salary = trim($_POST['salary']) . "AED";
$position = trim($_POST['position']);
console_log($office);
console_log($salary);
console_log($position);
$start_date = $today;
console_log($start_date);


?>


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