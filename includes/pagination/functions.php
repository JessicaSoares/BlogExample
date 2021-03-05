
<?php 
//connection File 
require_once('includes/config.php'); ?>

<?php 
//include head file for language preference 
include("head.php");  ?>
    <title>Techno Smarter Blog</title>

    <?php 
//header content //navbar 
    include("header.php");  ?>

<div class="container">
<div class="content">
 
        <?php
            try {   
                    //selecting data by id 
               $stmt = $db->query('SELECT articleId, articleTitle,articleDescrip, articleDate FROM techno_blog ORDER BY articleId DESC');

                while($row = $stmt->fetch()){
                    
                    echo '<div>';
                        echo '<h1><a href="show.php?id='.$row['articleId'].'">'.$row['articleTitle'].'</a></h1>';
                             echo '<hr>';
                      //Display the date 
                     echo '<p>Posted on '.date('jS M Y', strtotime($row['articleDate'])).'</p>';


                        echo '<p>'.$row['articleDescrip'].'</p>';                
                        echo '<p><button class="readbtn"><a href="show.php?id='.$row['articleId'].'">Read More</a></button></p>';                
                    echo '</div>';

                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        ?>

        
</div>

</div>

<?php //footer content 
include("footer.php");  ?>

 