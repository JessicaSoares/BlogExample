<?php require_once('../includes/config.php'); 

if(!$user->is_logged_in()){ header('Location: login.php'); }
?>

<?php include("head.php");  ?>
<!-- On page head area--> 
  <title>Add New Article - Techno Smarter Blog</title>
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

  <?php include("header.php"); 

   ?>

<div class="content">
 
    <h1>Add New Article</h1>

    <?php

    //if form has been submitted process it
    if(isset($_POST['submit'])){

 

        //collect form data
        extract($_POST);

        //very basic validations
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
   $stmt = $db->prepare('INSERT INTO techno_blog (articleTitle,articleDescrip,articleContent,articleDate) VALUES (:articleTitle, :articleDescrip, :articleContent, :articleDate)') ;
  



$stmt->execute(array(
    ':articleTitle' => $articleTitle,
    ':articleDescrip' => $articleDescrip,
    ':articleContent' => $articleContent,
    ':articleDate' => date('Y-m-d H:i:s'),
    
));
//add categories
 


    //redirect to index page
    header('Location: index.php?action=added');
    exit;

}catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

    }

    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo '<p class="message">'.$error.'</p>';
        }
    }
    ?>
 <form action="" method="post">

        <h2><label>Article Title</label><br>
        <input type="text" name="articleTitle" style="width:100%;height:40px" value="<?php if(isset($error)){ echo $_POST['articleTitle'];}?>"></h2>

        <h2><label>Short Description(Meta Description) </label><br>
        <textarea name="articleDescrip" cols="120" rows="6"><?php if(isset($error)){ echo $_POST['articleDescrip'];}?></textarea></h2>

        <h2><label>Long Description(Body Content)</label><br>
        <textarea name="articleContent" id="textarea1" class="mceEditor" cols="120" rows='20'><?php if(isset($error)){ echo $_POST['articleContent'];}?></textarea></h2>
        

       
        <button name="submit" class="subbtn">Submit</button>


    </form>



</div>

<?php include("footer.php");  ?>

 