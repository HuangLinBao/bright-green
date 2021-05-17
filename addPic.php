<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("./db.php"); ?>
<?php require_once("./essential.php"); ?>


<?php
$sql =null;
if (isset($_POST['submit'])) {
    $picture = trim($_POST['img']);
    $name = trim($_POST['name']);
    $type = trim($_POST['type']);
    $category = trim($_POST['category']);

    if ($type == "project") {
        $sql ="INSERT INTO `projects_List`(`project_id`, `project_name`, `project_img`) VALUES (NULL, :project_name, :project_img)";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([
            ':project_name' => $name,
            ':project_img' => $picture
        ]);
        echo "added project";

    }else if($type == "product") {
        $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
        $stmt = $pdo -> prepare($sql);
        $stmt-> execute([
            ':product_name' =>$name,
            ':product_img' => $picture,
            ':category' => $category
        ]);
        echo "added product";
    }
}

$sql= null;



header("Refresh:0.5;url =./dashboard.php");


?>