<html>
<meta http-equiv="Content-Type" content="charset=utf-8" />
<div class="row">
<?php
    include "./lib/dbconn.php";
        
 if(!preg_match("/^5\.2/", PHP_VERSION)) //if(PHP_VERSION != "5.2.12")
	$num = $_GET['num'];

 // select 문 수행
       $sql = "select * from product where num=$num";
 
       $result = mysql_query($sql);
       $row = mysql_fetch_array($result);

        // DB 데이터 출력 시작
        
        //$num = $row[num];
        $name = str_replace(' ', '&nbsp;', $row[name]);
        $price = $row[price];
        $description = str_replace(' ', '&nbsp;', $row[description]);
        //$thumbnail = $row[thumbnail_copied];
        $detail = $row[detail_copied];
              
        if($detail)
                $detail = './data/'.$detail;
        else
                $detail = 'http://placehold.it/900x400';
        
        $go_cart = 'index.php?mode=cart&num=';
         // DB 데이터 출력 끝

?>
        <div class="col-lg-9">
        <div class="card mt-4">
          <img class="card-img-top img-fluid" src="<?=$detail?>" alt="">
          <div class="card-body">
            <h3 class="card-title" id="name"><?=$name?></h3>
            <h4><?=$price?>원</h4>
            <p class="card-text"><?=$description?></p>
            <input type="number" id="amount">
            <button id="confirm_btn">장바구니에 담기</button>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->
<?
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
        let num = <?=$num?>;
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
                insertCart(num, amount.value);
        };   
};
</script>
</html>

