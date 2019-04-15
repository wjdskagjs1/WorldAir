<meta http-equiv="Content-Type" content="charset=utf-8" />
<div class="row">
        <div class="col-lg-9">
			<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
			  <ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			  </ol>
			  <div class="carousel-inner" role="listbox">
				<div class="carousel-item active">
				  <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
				</div>
				<div class="carousel-item">
				  <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
				</div>
				<div class="carousel-item">
				  <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
				</div>
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
                
<?php
    include "./lib/dbconn.php";
 
 // select 문 수행
    if ($sort == "desc")          // 성적순 정렬(내림차순)
       $sql = "select * from product order by num desc";
    else if ($sort == "asc")   // 성적순 정렬(오름차순)
       $sql = "select * from product order by num";
    else 
       $sql = "select * from product";
 
    $result = mysql_query($sql);
        
        $count = 0;

 // DB 데이터 출력 시작
    while ($row = mysql_fetch_array($result))
    {
        $num = $row[num];
        $name = str_replace(' ', '&nbsp;', $row[name]);
        $price = $row[price];
        $description = str_replace(' ', '&nbsp;', $row[description]);
        $thumbnail = $row[thumbnail_copied];
        //$detail = $row[detail_copied];
              
        if($thumbnail)
            $thumbnail = './data/'.$thumbnail;    
        else
            $thumbnail = 'http://placehold.it/700x400';    
            
        $go_detail = 'index.php?mode=detail&num=';
?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="<?=$go_detail.$num?>"><img class="card-img-top" src="<?=$thumbnail?>" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="<?=$go_detail.$num?>"><?=$name?></a>
                        <? if($userpriv){?>
                        <a href="<?="./admin/product_enroll.php?mode=modify&num=".$num?>">수정</a>
                        <?}?>
                </h4>
                <h5><?=$price?>원</h5>
                <p class="card-text"><?=$description?></p>
              </div>
              <div class="card-footer">
                <input type="number" id="num" value="<?=$num?>" hidden>
                <input type="number" id="amount">
                <button id="confirm_btn">장바구니에 담기</button>
              </div>
            </div>
          </div>
<?
	$count = $count + 1;
            if($count % 3 == 0)
                    echo '<br>';
     }
 // DB 데이터 출력 끝
 
     mysql_close();                   // DB 접속 끊기
 ?>
</div>
<script type="text/javascript">
function insertCart(n, amt){
        $.ajax({
                url: "./shop/insert_cart.php",
                type: "GET",
                data: {num: n, amount: amt}
        }).done(function(json) {// HTTP 요청이 성공하면 요청한 데이터가 done() 메소드로 전달됨.
            if (confirm("장바구니에 상품이 담겼습니다\n장바구니로 가시겠습니까?"))
                    location.href="./index.php?mode=cart";
        });
}
window.onload = function () {
        let userid = "<?=$userid?>";
        const num = document.getElementById("num");
        const amount = document.getElementById("amount");
        const confirm_btn = document.getElementById("confirm_btn");
        
        confirm_btn.onclick = function (){
                if(!userid){
                        if (confirm("장바구니를 사용하려면 로그인 해야합니다.\n로그인 하시겠습니까?"))
                                location.href="./sign/login_register.php?mode=login";

                        return false;
                }
                if(!amount.value){
                        alert("한 개 이상의 상품을 담아주세요.");
                        return false;
                }
                insertCart(num.value, amount.value);
        };   
};
</script>