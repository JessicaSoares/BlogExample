<?php require('includes/config.php'); 

$stmt = $db->prepare('SELECT articleId,articleDescrip,articleTitle, articleContent, articleDate FROM techno_blog WHERE articleId = :articleId');
$stmt->execute(array(':articleId' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['articleId'] == ''){
    header('Location: ./');
    exit;
}
?>

<?php include("head.php");  ?>

    <title><?php echo $row['articleTitle'];?>-Techno Smarter</title>
  <meta name="description" content="<?php echo $row['articleDescrip'];?>">    
<meta name="keywords" content="Article Keywords">

<?php include("header.php");  ?>
<div class="container">
<div class="content">


<?php
            echo '<div>';
                echo '<h1>'.$row['articleTitle'].'</h1>';

                echo '<p>Posted on '.date('jS M Y', strtotime($row['articleDate'])).'</p>';
                
                echo '<p>'.$row['articleContent'].'</p>';    

            echo '</div>';
        ?>
       
   </div>
     </div>
<?php include("footer.php");  ?> 