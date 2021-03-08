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

<?php include("header.php");  ?>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<?php include("header.php");  ?>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<div class="container">
    <div class="row clearfix">
    	<div class="col-md-12 table-responsive">
			<table class="table table-bordered table-hover table-sortable" id="tab_logic">
				<thead>
					<tr >
						<th class="text-center">
							Título
						</th>
						<th class="text-center">
							Data
						</th>
						<th class="text-center">
							Editar
						</th>
    					<th class="text-center">
							Deletar
						
        			
						</th>
					
                    
				




   
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
                    <button ame="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'class="delbtn" >    <a href="javascript:delpost('<?php echo $row['articleId'];?>','<?php echo $row['articleTitle'];?>')" >Deletar </a > </button >
                </td>
              
					</tr>
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
