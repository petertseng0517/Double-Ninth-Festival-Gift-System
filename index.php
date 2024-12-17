<?php
// 檢查使用者是否已登入
include("check_session.php");
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/eab8e05fa4.js" crossorigin="anonymous"></script>
  <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <title>花蓮縣重陽敬老禮金比對系統</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/starter-template/">
	
	
 
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
	  body{		  
       background: -webkit-linear-gradient(-180deg, rgb(203, 232, 255), rgb(227, 243, 255));
       background: linear-gradient(-180deg, rgb(203, 232, 255), rgb(227, 243, 255));		  
	  }
	  p {
    margin-top: 0;
    margin-bottom: 1rem;
    font-size: 25px;
}

a {
   
    font-size: 30px;
    line-height: 2;
	text-decoration: dashed;
}
.py-md-5 {

    text-align-last: center;
}
.d-flex {
    display: block;
}
.mb-4 {
    width: 100%;
}


    </style>



<script>
    function openDialogWindow() {
      // 设置对话框窗口的宽度和高度
      var width = 500;
      var height = 400;

      // 计算窗口在屏幕中居中显示的位置
      var left = (window.innerWidth - width) / 2;
      var top = (window.innerHeight - height) / 2;

      // 打开对话框窗口
      window.open('std.php', 'Dialog', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left + ',resizable=yes,scrollbars=yes,status=no,menubar=no,toolbar=no');
    }


    function openDialogWindow_edu() {
      // 设置对话框窗口的宽度和高度
      var width = 500;
      var height = 400;

      // 计算窗口在屏幕中居中显示的位置
      var left = (window.innerWidth - width) / 2;
      var top = (window.innerHeight - height) / 2;

      // 打开对话框窗口
      window.open('edu.php', 'Dialog', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left + ',resizable=yes,scrollbars=yes,status=no,menubar=no,toolbar=no');
    }
  </script>
    
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
  
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>

    
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="arrow-right-circle" viewBox="0 0 16 16">
    <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
  </symbol>
  <symbol id="bootstrap" viewBox="0 0 118 94">
    <title>Double Ninth Festival Gift System</title>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
  </symbol>
</svg>

<div class="col-lg-8 mx-auto p-4 py-md-5">
<p align="right" style="    background: #ffffff; border-radius: 20px;    padding: 10px;margin-bottom: 30px;"><?php echo $uid ; ?>，您好 <a href="register.php">新增管理者</a>&nbsp;<a href="logout.php" style="color: #ff2d00;">登出</a> </p>
 <!-- <header class="d-flex align-items-center pb-3 mb-5 border-bottom">-->
  <header>
  <!-- <a href="index.php" class="d-flex align-items-center text-body-emphasis text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
      <span class="fs-4">Double Ninth Festival Gift System</span>-->
	  
	<a href="index.php">
	  <img class="mb-4" src="img/logo.png" alt="" style=" max-width: 500px;width: 100%;" >   
    </a>
	
  </header>
  
  <p class="fs-4" style="color: #f00;font-weight: bold;">系統僅供本府社會處、公所使用，未經授權請勿使用以免觸法。</p>

  <main>
    <!--<h1 class="text-body-emphasis">重陽節禮金比對發放系統</h1>
    <p class="fs-5 col-md-8">系統僅供本府社會處、公所使用，未經授權請勿使用以免觸法。</p>-->
	
	<div class="mb-5">
	<button onclick="openDialogWindow()" class="btn btn-primary btn-lg px-4" style="font-size: 30px;">下載標準檔</button>
  <button onclick="openDialogWindow_edu()" class="btn btn-primary btn-lg px-4" style="font-size: 30px;">觀看教學檔</button>
  </div>	
	
    <div style="    border-top: 6px dashed #575757;height: 1px;overflow: hidden;padding-bottom: 50px;"></div>
    <!--<hr class="col-3 col-md-2 mb-5">-->

    <div class="row g-5">






      <div class="col-md-6" style="background: #e8d8d5; padding: 50px;margin-top: 0;">
	  <img class="mb-4" src="img/gov.png" alt="" style="border-top-left-radius: 20px;border-top-right-radius: 20px;" > 
        <h2 class="text-body-emphasis" style="font-weight: bold;font-size: 36px;">匯款申請登打(公所)</h2>
        <p>鄉鎮公所填報禮金匯款申請</p>
        <ul class="list-unstyled ps-0">
          <li>
            <a class="icon-link mb-1" href="request.php">
              <i class="fa-solid fa-user-pen"></i>登錄匯款申請資料
            </a>
          </li>
		  
		  
          <li>
            <a class="icon-link mb-1" href="request_editor_v2.php">
              <i class="fa-solid fa-magnifying-glass-arrow-right"></i>申請案搜尋與更新
            </a>
          </li>
		  <li>
            <a class="icon-link mb-1" href="non_RequestList.php">
              <i class="fa-solid fa-print"></i>符合領取資格且未申請匯款者
            </a>
          </li>
		  <li>
            <a class="icon-link mb-1" href="centenarians.php">
			<i class="fa-solid fa-hat-cowboy"></i>百歲人瑞發送重陽禮金清單              
            </a>
          </li>
        </ul>
      </div>
	 


 <div class="col-md-6" style="background: #f5efdc; padding: 50px;margin-top: 0;">
          <img class="mb-4" src="img/money.png" alt="" style="border-top-left-radius: 20px;border-top-right-radius: 20px;" >
        <h2 class="text-body-emphasis" style="font-weight: bold;font-size: 36px;">審查與匯款</h2>
        <p>社會處承辦審查申請案</p>
        <ul class="list-unstyled ps-0">
          <li>
            <a class="icon-link mb-1" href="request_compare.php">
              <i class="fa-solid fa-filter-circle-dollar"></i>初審禮金計算
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="review_payment.php">
              <i class="fa-solid fa-landmark"></i>複審申請資料
            </a>
          </li>

          <li>
            <a class="icon-link mb-1" href="query_download.php">
              <i class="fa-solid fa-cloud-arrow-down"></i>下載轉帳清冊
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="give_cash.php">
              <i class="fa-solid fa-cloud-arrow-down"></i>下載領現金清冊
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="upload_DebugList.php" rel="noopener" target="_blank">
              <i class="fa-solid fa-people-pulling"></i>勘誤重送被剔退之匯款資料
            </a>
          </li>

        </ul>
      </div>





<div class="col-md-6" style="background: #ace5ff; padding: 50px;margin-top: 0;">
          <img class="mb-4" src="img/upload.png" alt="" style="border-top-left-radius: 20px;border-top-right-radius: 20px;" >
        <h2 class="text-body-emphasis" style="font-weight: bold;font-size: 36px;">標準比對檔上傳</h2>
        <p>上傳檔案請用CSV格式，僅供縣府承辦操作</p>
        <ul class="list-unstyled ps-0">
          <li>
            <a class="icon-link mb-1" href="upload_ca.php" rel="noopener">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              領取禮金資格檔
            </a>
          </li>
                  <li>
            <a class="icon-link mb-1" href="upload_move_in.php" rel="noopener">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              遷入檔
            </a>
          </li>
                  <li>
            <a class="icon-link mb-1" href="upload_move_out.php" rel="noopener">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              遷出檔
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="upload_die.php" rel="noopener">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              死亡檔
            </a>
          </li>
                  <li>
            <a class="icon-link mb-1" href="upload_request.php" rel="noopener">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              上傳申請匯款清冊
            </a>
          </li>
        </ul>
      </div>




	  
	  <div class="col-md-6" style="background: #cce8f0; padding: 50px;margin-top: 0;">
	  <img class="mb-4" src="img/admin.png" alt="" style="border-top-left-radius: 20px;border-top-right-radius: 20px;" > 
        <h2 class="text-body-emphasis" style="font-weight: bold;font-size: 36px;">超級管理者功能</h2>
        <p>縣府承辦超級管理者專屬功能</p>
        <ul class="list-unstyled ps-0">
          <li>
            <a class="icon-link mb-1" href="signed_report.php">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              複審清冊查詢
            </a>
          </li>
		<li>
            <a class="icon-link mb-1" href="report_dnf.php">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              當年度複審報表
            </a>
          </li>
          </li>   
          <li>
            <a class="icon-link mb-1" href="">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              設定匯款金額計算標準
            </a>
          </li>
		  <li>
            <a class="icon-link mb-1" href="reset.php">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              新年度系統資料重設
            </a>
          </li>
		  
		  <li>
            <a class="icon-link mb-1" href="register.php">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              新增系統使用者
            </a>
          </li>
        </ul>
      </div>
	  
    </div>
	
	
	
	
	
  </main>
  <footer class="pt-5 my-5 text-body-secondary border-top">
    花蓮縣政府社會處福利科 &middot; &copy; 2023
  </footer>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
