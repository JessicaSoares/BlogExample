<?php require_once('../includes/config.php'); 

if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<?php include("head.php");  ?>
    <title>Update Article - Techno Smarter Blog</title>
    <script src= src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js></script>
  <script>
          tinymce.init({
           mode : "specific_textareas",
    editor_selector : "mceEditor",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
    <?php include("header.php");  ?>

<div class="content">
 
<h2>Edit Post</h2>


    <?php

   
    if(isset($_POST['submit'])){


        //collect form data
        extract($_POST);

        //very basic validation
        if($articleId ==''){
            $error[] = 'This post is missing a valid id!.';
        }

        if($articleTitle ==''){
            $error[] = 'Please enter the title.';
        }

        if($articleDescrip ==''){
            $error[] = 'Please enter the description.';
        }

        if($articleContent ==''){
            $error[] = 'Please enter the content.';
        }
        


        if(!isset($error)){
try {

   

    //insert into database
    $stmt = $db->prepare('UPDATE techno_blog SET articleTitle = :articleTitle,  articleDescrip = :articleDescrip, articleContent = :articleContent WHERE articleId = :articleId') ;
$stmt->execute(array(
    ':articleTitle' => $articleTitle,
    ':articleDescrip' => $articleDescrip,
    ':articleContent' => $articleContent,
    ':articleId' => $articleId,
  
));

    //redirect to index page
    header('Location: index.php?action=updated');
    exit;

} catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

    }

    ?>


    <?php
    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo $error.'<br>';
        }
    }

        try {

           $stmt = $db->prepare('SELECT articleId,articleTitle, articleDescrip, articleContent FROM techno_blog WHERE articleId = :articleId') ;
            $stmt->execute(array(':articleId' => $_GET['id']));
            $row = $stmt->fetch(); 

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    ?>

    <form action='' method='post'>
        <input type='hidden' name='articleId' value="<?php echo $row['articleId'];?>">

           <h2><label>Article Title</label><br>
        <input type='text' name='articleTitle' style="width:100%;height:40px" value="<?php echo $row['articleTitle'];?>"></h2>
        



       <h2><label>Short Description(Meta Description) </label><br>
        <textarea name='articleDescrip' cols='120' rows='6'><?php echo $row['articleDescrip'];?></textarea></h2>

       <h2><label>Long Description(Body Content)</label><br>
        <textarea name='articleContent' id='textarea1' class='mceEditor' cols='120' rows='20'><?php echo $row['articleContent'];?></textarea></h2>
        


       
        <button name='submit' class="subbtn"> Update</button>

    </form>

</div>
  



<?php include("footer.php");  ?>
