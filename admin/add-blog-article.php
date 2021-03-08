<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>New Blog Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once('../includes/config.php'); 

if(!$user->is_logged_in()){ header('Location: login.php'); }
?>

<?php include("head.php");  ?>
<!-- On page head area--> 
  <title>Aicionar nova postagem</title>
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



<div class="page-header">
    <h1>Nova postagem</h1>
</div>

<!-- New Blog Post - START -->
<div class="container">

    <form action="" method="post">
        <h4 class="text-center">Adicionar nova postagem</h4>
        <div class="col-md-12">
            <div class="form-group">
           

                <input type="text" class="form-control" placeholder="Titulo"  name="articleTitle" value="<?php if(isset($error)){ echo $_POST['articleTitle'];}?>"> 


               
            
            <textarea class="form-control" placeholder="Descrição"  name="articleDescrip"<?php if(isset($error)){ echo $_POST['articleDescrip'];}?> id="editor" cols="30" rows="10"></textarea>    
          
           
            <textarea class="form-control"  placeholder="texto"  name="articleContent"  id="textarea1"  <?php if(isset($error)){ echo $_POST['articleContent'];}?> id="editor" cols="30" rows="10"></textarea>    
            </div> 
            <div class="form-group">
                <button name="submit" class="btn btn-primary" id="submit">Submit new post</button>
            </div>
        </div>
 
    </form>
</div>

<style>
    #row_style {
        margin-top: 30px;
    }

    #submit {
        display: block;
        margin: auto;
    }
</style>

<!-- you need to include the shieldui css and js assets in order for the charts to work -->
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>

<script>
    $(function () {
        $("#editor").shieldEditor({
            height: 260
        });
    })
</script>
<!-- New Blog Post - END -->

</div>



</body>
</html>

