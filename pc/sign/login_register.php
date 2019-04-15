<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title></title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="./js/menu.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="./css/member_css.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#login-form" class="active" id="login-form-link">로그인</a>
							</div>
							<div class="col-xs-6">
								<a href="#register-form" id="register-form-link">회원 가입</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="./lib/login.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="userid" id="userid-login" tabindex="1" class="form-control" placeholder="아이디" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password-login" tabindex="2" class="form-control" placeholder="비밀번호">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> 기억하기</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="로그인">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">비밀번호 찾기</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="./lib/register.php" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="userid" id="userid-register" tabindex="1" class="form-control" placeholder="아이디">
                                        <span id="useridError" class="red">&nbsp;</span>
									</div>
                                    <div class="form-group">
										<input type="password" name="password" id="password-register" tabindex="2" class="form-control" placeholder="비밀번호">
                                        <span id="passwordError" class="red">&nbsp;</span>
									</div>
                                    <div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="비밀번호 확인">
                                        <span id="confirm-passwordError" class="red">&nbsp;</span>
									</div>
                                    <div class="form-group">
										<input type="text" name="nickname" id="nickname" tabindex="1" class="form-control" placeholder="닉네임">
                                        <span id="nicknameError" class="red">&nbsp;</span>
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="이메일">
                                        <span id="emailError" class="red">&nbsp;</span>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="가입">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php
if(!preg_match("/^5\.2/", PHP_VERSION))
	$mode=$_GET['mode'];

if($mode==login){
 echo '<script>
 		$("#login-form").delay(0).fadeIn(0);
 		$("#register-form").fadeOut(0);
		$("#register-form-link").removeClass("active");
		$("#login-form-link").addClass("active");
 </script>' ;
}
if($mode==register){
 echo '<script>
 		$("#register-form").delay(0).fadeIn(0);
 		$("#login-form").fadeOut(0);
		$("#login-form-link").removeClass("active");
		$("#register-form-link").addClass("active");
 </script>' ;
}
?>
<script>
        // 페이지가 완전히 적재되면 초기화를 실행한다.
        window.onload = function init() {
            // "onsubmit" 핸들러를 부착한다.
            document.getElementById("register-form").onsubmit = validateForm;
            // "onsubmit" 핸들러를 부착한다.
            document.getElementById("logint-form").onsubmit = validateForm2;
            // "onclick" 핸들러를 "reset" 버튼에 부착한다.
            document.getElementById("reset").onclick = clearDisplay;
            // "userid"필드로 키보드 포커스를 보낸다.
            document.getElementById("userid").focus();
        }

        function validateForm() {
            return (isNotEmpty("userid-register", "아이디를 입력하시오!")
                 && isLengthMinMax("password-register", "패스워드의 길이가 짧습니다!", 4, 14)
                 && verifyPassword("password-register", "confirm-password", "패스워드가 다릅니다.!"))
                 && isNotEmpty("nickname", "닉네임을 입력하시오!")
                 && isValidEmail("email", "올바른 이메일을 입력하시오!");
                 
        }
    function validateForm2() {
            return (isNotEmpty("userid-login", "아이디를 입력하시오!")
                    &&isNotEmpty("password-login", "패스워드를 입력하시오!"));
                 
        }

        // 입력 값이 비어 있지 않으면 true를 반환한다.
        function isNotEmpty(inputId, errorMsg) {
            var inputElement = document.getElementById(inputId);
            var errorElement = document.getElementById(inputId + "Error");
            //alert(errorElement.value);
            var inputValue = inputElement.value.trim();
            var isValid = (inputValue.length != 0);  // 부울형
            showMessage(isValid, inputElement, errorMsg, errorElement);
            return isValid;
          }

      // 만약 "isValid"가 거짓이면 errorMsg를 출력한다.
      function showMessage(isValid, inputElement, errorMsg, errorElement) {
          if (!isValid) {
              if (errorElement != null) {
                  errorElement.innerHTML = errorMsg;
              } else {
                  alert(errorMsg);
              }
              if (inputElement != null) {
                  inputElement.className = "error"
                  inputElement.focus();
              }
          } else {
              if (errorElement != null) {
                  errorElement.innerHTML = ""
              }
              if (inputElement != null) {
                  inputElement.className = ""
              }
          }
      }

      // 입력의 길이가 minLength와 maxLength 사이에 있으면 true를 반환한다.
      function isLengthMinMax(inputId, errorMsg, minLength, maxLength) {
          var inputElement = document.getElementById(inputId);
          var errorElement = document.getElementById(inputId + "Error");
          var inputValue = inputElement.value.trim();
          var isValid = (inputValue.length >= minLength) && (inputValue.length <= maxLength);
          showMessage(isValid, inputElement, errorMsg, errorElement);
          return isValid;
      }

      // 유효한 이메일 주소인지를 검증한다.
      function isValidEmail(inputId, errorMsg) {
          var inputElement = document.getElementById(inputId);
          var errorElement = document.getElementById(inputId + "Error");
          var inputValue = inputElement.value;
          var atPos = inputValue.indexOf("@");
          var dotPos = inputValue.lastIndexOf(".");
          var isValid = (atPos > 0) && (dotPos > atPos + 1) && (inputValue.length > dotPos + 2);
          showMessage(isValid, inputElement, errorMsg, errorElement);
          return isValid;
      }

      // 패스워드를 검증한다.
      function verifyPassword(pwId, verifiedPwId, errorMsg) {
          var pwElement = document.getElementById(pwId);
          var verifiedPwElement = document.getElementById(verifiedPwId);
          var errorElement = document.getElementById(verifiedPwId + "Error");
          var isTheSame = (pwElement.value == verifiedPwElement.value);
          showMessage(isTheSame, verifiedPwElement, errorMsg, errorElement);
          return isTheSame;
      }

      // 디스플레이를 리셋한다.
      function clearDisplay() {
          var elms = document.getElementsByTagName("*");  // all tags
          for (var i = 0; i < elms.length; i++) {
              if ((elms[i].id).match(/Error$/)) {  // no endsWith() in JS?
                  elms[i].innerHTML = ""
              }
              if (elms[i].className == "error") {  // assume only one class
                  elms[i].className = ""
              }
          }
          document.getElementById("userid").focus();
      }
  </script>
  </html>