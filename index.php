<?php
// 开启会话
session_start();

// 用户是否已登录
if (isset($_SESSION['user_id'])) {
  $id = "<h2>Welcome: " . $_SESSION['user_id'] . "</h2>";
  $logout = '<a href="http://140.134.53.57:21080/login.php" class="btn btn-danger">Logout</a>';
} else {
  $id = '<a href="http://140.134.53.57:21080/login.php" class="btn btn-secondary btn-sm">Sign in</a>';
  $logout = '<h4 class="text-white"></h4>';
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>AIAT</title>
  </head>
  <body>
    <div class="pos-f-t">
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
          <h4 class="text-white">AITA</h4>
          <span class="text-muted">人工智慧技術與應用學士學位學程</span>
          <h4 class="text-white"></h4>
          <button type="button" class="btn btn-secondary btn-sm">  首頁  </button>
          <h4 class="text-white"></h4>
          <button type="button" class="btn btn-secondary btn-sm">帳號設定</button>
          <h4 class="text-white"></h4>
          <?php echo $logout; ?>
        </div>
      </div>
      <nav class="navbar navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <?php echo $id; ?>
      </nav>
    </div>

    <div class="bd-example">
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="image\Test0.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="image\Test1.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="image\Test2.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">AI學程</h1>
        <p class="lead">Available courses</p>
      </div>
    </div>




    <div class="container">
  <div class="row">
    <div class="col">
      
    <div class="col-sm">
    <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="image\python.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">112 暑期 程式先修</h5>
    <p class="card-text">暑期程序式先修課程是為那些對計算機編程感興趣，希望提供前期學習和準備編程知識的學生而設計的課程。無論您是計劃在未來追求計算機科學相關專業，或者只是對編程和計算機技術感興趣，本課程將為您提供一個紮實的基礎。</p>
    <a href="#" class="btn btn-primary">加入 列表</a>
  </div>
</div>
    </div>

    </div>
    <div class="col">
      
    <div class="col-sm">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="image\system_class.jpg" style="object-fit: cover; width: 286px; height: 161px;" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">企業實習及畢業專題管理系統開發</h5>
            <p class="card-text">企業實踐及畢業專業管理系統開發項目是一個早在幫助學生和學校有高效管理實踐和畢業專業的信息系統。系統早在提供一個集合中的平台，使學生、教師和企業能夠更好地合作。</p>
            <a href="#" class="btn btn-primary">加入列表</a>
  </div>
</div>
    </div>

    </div>
    <div class="col">

    <div class="col-sm">
    <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="image\C++.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">112 暑期 C++語言</h5>
    <p class="card-text">暑期C++語言課程是為那些學習C++編寫程序語言並深入了解了計算機編寫程序感有趣的學生和設計的課程。本課程早在幫助學生掌握C++編寫程序語言的基礎概念、語言方法和應用，並培養他們解決問題和開發實際應用程序的能力。</p>
    <a href="#" class="btn btn-primary">加入 列表</a>
  </div>
</div>
    </div>

    </div>
    <div class="w-100"></div>
    <div class="col"></div>
    <div class="w-100"><br /></div>
    <div class="col">

    <div class="col-sm">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="image\wite.jpg" style="object-fit: cover; width: 286px; height: 161px;" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">盡情期待</h5>
    <p class="card-text">101110100100110101101011010101100110101001110101011111000101101011010</p>
    <a href="#" class="btn btn-primary">加入 列表</a>
  </div>
</div>
    </div>

    </div>
    <div class="col">

    <div class="col-sm">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="image\wite.jpg" style="object-fit: cover; width: 286px; height: 161px;" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">盡情期待</h5>
    <p class="card-text">101110100100110101101011010101100110101001110101011111000101101011010</p>
    <a href="#" class="btn btn-primary">加入 列表</a>
  </div>
</div>
    </div>

    </div>
    <div class="col">

    <div class="col-sm">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="image\wite.jpg" style="object-fit: cover; width: 286px; height: 161px;" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">盡情期待</h5>
    <p class="card-text">101110100100110101101011010101100110101001110101011111000101101011010</p>
    <a href="#" class="btn btn-primary">加入 列表</a>
  </div>
</div>
    </div>

    </div>

    <div class="w-100"></div>
    <div class="col"></div>
    <div class="w-100"><br /></div>


  </div>
</div>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>

    </script>
  </body>
</html>
