<? 
@session_start();
@include( "../lib/get_session.php" );
//$userpriv = true;


include "../lib/dbconn.php";

	if ($mode=="modify")
	{
	// select 문 수행
       $sql = "select * from product where num=$num";
 
    $result = mysql_query($sql);
	$row = mysql_fetch_array($result);

 // DB 데이터 출력 시작

        $num = $row[num];
        $name = $row[name];
        $price = $row[price];
        $description = $row[description];
        
        $origin_thumbnail = $row[thumbnail];
        $origin_detail = $row[detail];
            
        $thumbnail = $row[thumbnail_copied];
        $detail = $row[detail_copied];
        
        $go_cart = 'index.php?mode=cart&num=$num';
	}
?>
<html>
<head> 
<meta charset="utf-8">
<script>
  function check_input()
   {
      if (!document.board_form.name.value)
      {
          alert("제품명을 입력하세요!");    
          document.board_form.name.focus();
          return;
      }
      if (!document.board_form.price.value)
      {
          alert("가격을 입력하세요!");    
          document.board_form.price.focus();
          return;
      }

      if (!document.board_form.description.value)
      {
          alert("설명을 입력하세요!");    
          document.board_form.description.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>

<body>
<div id="wrap">


  <div id="content">

	<div id="col2">

		<div class="clear"></div>

		<div id="write_form_title">
			<img src="../img/write_form_title.gif">
		</div>

		<div class="clear"></div>

<?
	if($mode=="modify")
	{

?>
		<form  name="board_form" method="post" action="product_insert.php?mode=modify&num=<?=$num?>" enctype="multipart/form-data"> 
<?
	}
	else
	{
?>
		<form  name="board_form" method="post" action="product_insert.php" enctype="multipart/form-data"> 
<?
	}
?>
		<div id="write_form">
			<div class="write_line"></div>
<?
	if( $userpriv && ($mode != "modify") )
	{
?>
				<div class="col3"><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</div>
<?
	}
?>						
			
			<div class="write_line"></div>
			<div id="write_row1"><div class="col1"> 이름   </div>
			<div class="col2"><input type="text" name="name" value="<?=$name?>" ></div>
			
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 가격   </div>
			<div class="col2"><input type="number" name="price" value="<?=$price?>" ></div>
            
			<div class="write_line"></div>
			<div id="write_row3"><div class="col1"> 설명   </div>
			<div class="col2">
                    <textarea rows="15" cols="79" name="description"><?=$description?></textarea>
            </div>
            
                    <br>
			<div class="write_line"></div>
			<div id="write_row4"><div class="col1"> 썸네일(700x400 권장)   </div>
			                     <div class="col2"><input type="file" name="upfile[]"></div>
			</div>
			<div class="clear"></div>
<? 	if ($mode=="modify" && $origin_thumbnail)
	{
?>
			<div class="delete_ok"><?=$origin_thumbnail?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>
                    <br>
			<div class="write_line"></div>
			<div id="write_row5"><div class="col1"> 큰 이미지(900x400 권장)  </div>
			                     <div class="col2"><input type="file" name="upfile[]"></div>
			</div>
<? 	if ($mode=="modify" && $origin_detail)
	{
?>
			<div class="delete_ok"><?=$origin_detail?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>
		</div>

                    <br>
		<div id="write_button"><a href="#"><img src="../img/ok.png" onclick="check_input()"></a>&nbsp;
								<a href="../index.php?mode=list"><img src="../img/list.png"></a>
		</div>

		</form>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
