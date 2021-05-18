<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("./db.php"); ?>
<?php require_once("./essential.php"); ?>


<?php
$this_time = date ("d/m/Y h:i A");
$sql = null;
$err_flag =null;
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    echo $name;
    $email = trim($_POST['email']);
    $number = trim($_POST['number']);
    $subject = trim($_POST['subject']);
    $msg = trim($_POST['msg']);

    if ($number == '' || $email == '' || $name == '') {
        $err_flag = true;
    }

    else {

        $sql = "INSERT INTO `messages`(`msg_id`, `subject`, `sender_name`, `email`, `phone_num`, `msg`, `date_sent`) VALUES (NULL, :subject, :sender_name, :email, :phone_num, :msg, :date_sent)";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([
            ':subject' => $subject,
            ':sender_name' => $name,
            ':email' => $email,
            ':phone_num' => $number,
            ':msg' => $msg,
            ':date_sent' => $this_time
        ]);
        echo "success";
    }

}

if (isset($err_flag)) {
    echo "error";
}


$sql = null;

header("Refresh:0.5;url =./index.php");

?>