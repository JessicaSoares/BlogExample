<?php
include("head.php");  
define("ROW_PER_PAGE",2);
require('includes/config.php'); 
include("header.php");
?>
<html>
<body>
<nav>
       <img src="https://tw1.lancheadmin.com/sistema/images/logoicm2.png">
        <ul>

            <li>
                <a href="#sobre"> Sobre</a>
            </li>
            <li>
                <a href="#serviços"> Serviços</a>
            </li>
            <li>
                <a href="#fotos"> Fotos</a>
            </li>
            <li>
                <a href="#contato">Contato</a>
            </li>
        </ul>
    </nav>
<?php	
	$search_keyword = '';
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
	$sql = 'SELECT * FROM techno_blog WHERE articleTitle LIKE :keyword OR articleDescrip LIKE :keyword OR articleDate LIKE :keyword ORDER BY articleId DESC ';
	
	/* Pagination Code starts */
	$per_page_html = '';
	$page = 1;
	$start=0;
	if(!empty($_POST["page"])) {
		$page = $_POST["page"];
		$start=($page-1) * ROW_PER_PAGE;
	}
	$limit=" limit " . $start . "," . ROW_PER_PAGE;
	$pagination_statement = $db->prepare($sql);
	$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pagination_statement->execute();

	$row_count = $pagination_statement->rowCount();
	if(!empty($row_count)){
		$per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
		$page_count=ceil($row_count/ROW_PER_PAGE);
		if($page_count>1) {
			for($i=1;$i<=$page_count;$i++){
				if($i==$page){
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
				} else {
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
				}
			}
		}
		$per_page_html .= "</div>";
	}
	
	$query = $sql.$limit;
	$pdo_statement = $db->prepare($query);
	$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
?>
<div class="card">
<form name='frmSearch' action='' method='post'>


<div style='text-align:right;margin:20px 0px;'><input type='text' name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'></div>
<table class='tbl-qa'>
  <thead>
  
  
  </a>
	<tr>
	  <th class='table-header' width='20%'>Title</th>
	  <th class='table-header' width='20%'>Description</th>
	  <th class='table-header' width='20%'>Date</th>
      <th class='table-header' width='20%'>sds</th> 

	</tr>
  </thead>
  <tbody id='table-body'>
	<?php
	if(!empty($result)) { 
		foreach($result as $row) {

	?>
	  <tr class='table-row'>
          
		<td><?php echo $row['articleTitle']; ?> </td>   
		<td><?php echo $row['articleDescrip']; ?></td>
		<td><?php echo $row['articleDate']; ?></td>
        <td><?php echo '<p><button class="readbtn"><a href="show.php?id='.$row['articleId'].'">Read More</a></button></p>'; ?></td>          
   


	  </tr>
    <?php
		}
	}
	?>

</div>
  </tbody>
</table>
<?php echo $per_page_html; ?>
</form>
</div>
</div>

</body>
</html>



