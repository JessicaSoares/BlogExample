<?php 
//include connection file 

require_once('../includes/config.php');
require_once('./header.php');

//check login or not 
if(!$user->is_logged_in()){ header('Location: login.php'); }


if(isset($_GET['delpost'])){ 

    $stmt = $db->prepare('DELETE FROM techno_blog WHERE articleId = :articleId') ;
    $stmt->execute(array(':articleId' => $_GET['delpost']));

    header('Location: index.php?action=deleted');
    exit;
} 

?>

<?php include("head.php");  ?>

  <title>Admin Page </title>
  <script language="JavaScript" type="text/javascript">
  function delpost(id, title)
  {
      if (confirm("Are you sure you want to delete '" + title + "'"))
      {
          window.location.href = 'index.php?delpost=' + id;
      }
  }
  </script>
  <?php include("header.php");  ?>

<div class="content">
<?php 
    //show message from add / edit page
    if(isset($_GET['action'])){ 
        echo '<h3>Post '.$_GET['action'].'.</h3>'; 
    } 
    ?>

    <table>
    <tr>
        <th>Article Title</th>
        <th>Posted Date</th>
        <th>Update</th>
         <th>Delete</th>
    </tr>
    <?php
        try {

            $stmt = $db->query('SELECT articleId, articleTitle, articleDate FROM techno_blog ORDER BY articleId DESC');
            while($row = $stmt->fetch()){
                
                echo '<tr>';
                echo '<td>'.$row['articleTitle'].'</td>';
                echo '<td>'.date('jS M Y', strtotime($row['articleDate'])).'</td>';
                ?>

                <td>
                     <button class="editbtn" > <a href="edit-blog-article.php?id=<?php echo $row['articleId'];?>" >Edit </a >  </button ></td> <td>
                    <button class="delbtn" >    <a href="javascript:delpost('<?php echo $row['articleId'];?>','<?php echo $row['articleTitle'];?>')" >Delete </a > </button >
                </td>
                
                <?php 
                echo '</tr>';

            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    ?>
    </table>

    <p> <button class="editbtn"><a href='add-blog-article.php'>Add New Article</a></button></p>       
</p></div>




<?php include("footer.php");  ?>
