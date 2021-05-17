<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("./db.php"); ?>
<?php require_once("./essential.php"); ?>


<?php
$output_dir_proj = "./img/projects";
$output_dir_chands = "./img/products/chands";
$output_dir_down = "./img/products/down_light";
$output_dir_flood = "./img/products/flood";
$output_dir_ground = "./img/products/ground_light";
$output_dir_pendant = "./img/products/pendant";
$output_dir_recessed = "./img/products/recessed";
$output_dir_road = "./img/products/road";
$output_dir_solar = "./img/products/solar";
$output_dir_spot = "./img/products/spot";
$output_dir_strip = "./img/products/strip";
$output_dir_track = "./img/products/track";
$output_dir_wallr = "./img/products/wall_recessed";
$output_dir_walls = "./img/products/wall_surface";
$sql = null;
if (isset($_POST['submit'])) {
    $imgDate =  time();
    $picture = str_replace(' ', '-', strtolower($_FILES['img']['name'][0]));
    $ImageType      = $_FILES['img']['type'][0];
    $ImageExt = substr($picture, strrpos($picture, '.'));
    $ImageExt       = str_replace('.', '', $ImageExt);
    $picture = preg_replace("/\.[^.\s]{3,4}$/", "", $picture);
    $pic_name = $picture . "-" . $imgDate . "." . $ImageExt;
    $retProj[$pic_name] = $output_dir_proj . $pic_name;
    $retCahnds[$pic_name] = $output_dir_chands . $pic_name;
    $retDown[$pic_name] = $output_dir_down . $pic_name;
    $retFlood[$pic_name] = $output_dir_flood . $pic_name;
    $retGround[$pic_name] = $output_dir_ground . $pic_name;
    $retPendant[$pic_name] = $output_dir_pendant . $pic_name;
    $retRecessed[$pic_name] = $output_dir_recessed . $pic_name;
    $retRoad[$pic_name] = $output_dir_road . $pic_name;
    $retSolar[$pic_name] = $output_dir_solar . $pic_name;
    $retSpot[$pic_name] = $output_dir_spot . $pic_name;
    $retStrip[$pic_name] = $output_dir_strip . $pic_name;
    $retTrack[$pic_name] = $output_dir_track . $pic_name;
    $retWallr[$pic_name] = $output_dir_wallr . $pic_name;
    $retWalls[$pic_name] = $output_dir_walls . $pic_name;
    $name = trim($_POST['name']);
    $type = trim($_POST['type']);
    $category = trim($_POST['category']);


    if (!file_exists($output_dir_proj)) {
        @mkdir($output_dir_proj, 0777);
    }

    if (!file_exists($output_dir_prods)) {
        @mkdir($output_dir_prods, 0777);
    }





    if ($type == "project") {
        if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_proj . "/" . $pic_name)) {

            $sql = "INSERT INTO `projects_List`(`project_id`, `project_name`, `project_img`) VALUES (NULL, :project_name, :project_img)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':project_name' => $name,
                ':project_img' => $output_dir_proj . "/" . $pic_name
            ]);
            echo "added project";
        }
    } else if ($type == "product") {

        switch ($category) {
            case 'chandeliers':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_chands . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_chands . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;

            case 'down_Light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_down. "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_down . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;

            case 'flood_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_flood . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_flood . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;
            case 'ground_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_ground . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_ground . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;

            case 'pendant_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_pendant . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_pendant . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;

            case 'recessed_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_recessed . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_recessed . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;
            case 'road_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_road . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_road . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;
            case 'solar_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_solar . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_solar . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;
            case 'spot_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_spot . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_spot . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;
            case 'strip_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_strip . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_strip . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;
            case 'track_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_track . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_track . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;
            case 'wall_recessed_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_wallr . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_wallr . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;
            case 'wall_surface_light':
                if (move_uploaded_file($_FILES["img"]["tmp_name"][0], $output_dir_walls . "/" . $pic_name)) {
                    $sql = "INSERT INTO `products_list`(`id`, `product_name`, `product_img`, `category`) VALUES (NULL, :product_name, :product_img, :category)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt-> execute([
                        ':product_name' =>$name,
                        ':product_img' => $output_dir_walls . "/" . $pic_name,
                        ':category' => $category
                    ]);
                }
                break;
            

            default:
        
                break;
        }






     
        echo "added product";
    }
}

$sql = null;



header("Refresh:0.5;url =./dashboard.php");


?>