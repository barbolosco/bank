<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Welcome in Group3 Bank</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/php/assets/img/favicon.png" rel="icon">
  <link href="/php/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/php/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/php/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/php/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/php/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/php/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/php/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/php/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/php/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .card {
      background-color: #fff;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin: 20px;
    }

    .jchartfx {
      margin-bottom: 10px;
    }

    #StockdioWidget_WatermarkTopText {
      background-color: transparent;
      color: #333;
      font-weight: bold;
    }

    #StockdioWidget_WatermarkTop a {
      background-color: transparent;
      text-decoration: none;
      font-weight: bold;
      display: inline;
      color: #333;
    }

    #StockdioWidget_MainTitleSimpleText {
      color: #333;
    }

    .news-item {
      margin-bottom: 20px;
      background-color: #fff;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .news-item-date {
      margin-right: 5px;
      color: #999;
    }

    .news-item-source-img {
      padding-left: 7px;
    }

    .news-item-title {
      color: #333;
      text-decoration: none;
      font-weight: bold;
    }

    .news-item-description {
      color: #666;
    }
  </style>

</head>

<body class="toggle-sidebar" onload="initKeycloak()">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between justify-content-end">
      <a href="/" class="logo d-flex align-items-center">
        <img src="/php/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Welcome</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->
    <nav class="header-nav ms-auto">
      <ul>
        <li class="nav-item dropdown pe-3">

          <a href="/php/login.php" class="btn btn-primary">Login</a>
          <a href="/php/register.php" class="btn btn-primary">Register</a>
          <!-- End Profile Image Icon -->
        </li>
      </ul>
    </nav>

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="/php/faq.php">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/php/contacts.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="/php/services.php">
          <i class="bi bi-credit-card-2-back"></i>
          <span>Services</span>
        </a>
      </li><!-- End Services Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Your bank, everywhere you are</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Our capabilities</h5>

              <!-- Slides with controls -->
              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                    aria-label="Slide 1" class="active" aria-current="true"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2" class=""></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3" class=""></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                    aria-label="Slide 4" class=""></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"
                    aria-label="Slide 5" class=""></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="/imggs/1welcome.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>The future of personal banking is here</h5>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="/imggs/Screenshot__25_.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5 style="color:grey;">Discover our services</h5>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="/imggs/pw3.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Always in your help</h5>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="/imggs/tt2.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5 style="color:black; text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);"><strong>How other
                          banks treat your money</strong></h5>

                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="/imggs/tt3.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5><strong>How we treat your money</strong></h5>
                      <button class="btn btn-primary"><a href="/php/register.php"
                          class="btn btn-primary">Join Now</a></button>
                    </div>
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                  data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                  data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div>
              <!-- End Slides with controls -->

            </div>
          </div>

        </div>
        <div class="col-lg-3">

          <!-- News & Updates Traffic -->
          <div class="card">
            <div id="StockdioWidget_Main" class="jchartfx StockdioWidget_Main"
              style="width: 100%; position: relative; visibility: visible; box-sizing: border-box; float: left; overflow: hidden;">
              <div id="StockdioWidget_WatermarkTop"
                class="jchartfx AdditionalUI StockdioWidget_WatermarkTop StockdioWidget_WatermarkTopBackground"
                style="text-align: right; overflow: hidden; display: none; vertical-align: middle !important; float: right;">
                <span id="StockdioWidget_WatermarkTopText" style="background-color: transparent;">Data powered by
                </span><a href="http://www.stockdio.com" target="_blank"
                  style="background-color:transparent;text-decoration:none;font-weight:bold;display:inline;">Stockdio.com<img
                    src="https://www.stockdio.com/images/stockdio-icon-w36.svg" width="18"
                    style="background-color:transparent;vertical-align: middle !important;padding-left:4px;"></a>
              </div>
              <div id="StockdioWidget_MainBorder" class="StockdioWidget_MainBorder jchartfx"
                style="width:100%;box-sizing:border-box;">
                <div id="StockdioWidget_MainTitle"
                  class="StockdioWidget_MainTitle StockdioWidget_MainBorderBackground StockdioWidget_MainTitleCaption">
                  <a id="StockdioWidget_TitleFinLink" target="_blank"
                    class="StockdioWidget_TitleFinLink StockdioWidget_TitleFinLinkCaption"
                    style="cursor:pointer;text-decoration:none;"
                    href="https://finance.stockdio.com/profile/nysenasdaq/AAPL?s=1">
                    <div id="StockdioWidget_MainTitleSimple" class="StockdioWidget_MainTitleSimple"
                      style="padding-top:3px;padding-bottom:1px;padding-left:2px;">
                      <h5 class="card-title">News</h5>
                    </div>
                  </a>
                </div>
                <div id="StockdioWidget_MainContent" class="StockdioWidget_MainContent">
                  <div class="jchartfx_container" id="StockdioWidget_Container"
                    style="visibility:inherit;width:100%;z-index:1">

                    <div class="news-wide" id="table1">
                      <div class="has-thumbnail news-item">
                        <div id="news_imageplaceholder" class="thumb"
                          style="background-image: url(&quot;https://d20b5zp0cx3lpw.cloudfront.net/photos/stock-photo-048.jpg&quot;);background-position: 50% 50%;background-size: cover;">
                        </div>
                        <div class="news-text news-text-withimg w-clearfix">
                          <div class="clear news-item-source-datetime"><span class="news-item-date" id="news_datetime0"
                              style="margin-right:5px;">2 hours ago</span> | <img
                              class="news-item-source-img StockdioWidget_ItemBorder" style="padding-left:7px;"
                              height="10" title="TipRanks"
                              src="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?e=PUBLISHERS&amp;s=tipranks.com&amp;h=100&amp;at=TipRanks&amp;ac=0, 0, 0&amp;af=Arial&amp;as=68">
                          </div><a class="news-item-title"
                            href="https://www.tipranks.com/news/meta-introduces-new-vr-headset-analyst-backs-apple"
                            target="_blank" id="news_title0">Meta Introduces New VR Headset; Analyst Backs Apple</a>
                          <div class="news-item-description" id="news_description0"></div>
                        </div>
                      </div>
                      <div class="has-thumbnail news-item">
                        <div id="news_imageplaceholder" class="thumb"
                          style="background-image: url(&quot;https://api.stockdio.com/visualization/financial/charts/GetImage.ashx?url=https://s.yimg.com/ny/api/res/1.2/37GLcuB4ruA0AvrgfOdVYQ--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyMDA7aD02MDA-/https://media.zenfs.com/en/wsj.com/72d3e5f7e43055c72b9b96fed942f6dd&quot;);background-position: 50% 50%;background-size: cover;">
                        </div>
                        <div class="news-text news-text-withimg w-clearfix">
                          <div class="clear news-item-source-datetime"><span class="news-item-date" id="news_datetime1"
                              style="margin-right:5px;">4 hours ago</span> | <img
                              class="news-item-source-img StockdioWidget_ItemBorder" style="padding-left:7px;"
                              height="10" title="Yahoo Finance"
                              src="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?e=PUBLISHERS&amp;s=finance.yahoo.com&amp;h=100&amp;at=Yahoo Finance&amp;ac=0, 0, 0&amp;af=Arial&amp;as=68">
                          </div><a class="news-item-title"
                            href="https://finance.yahoo.com/m/d9c5370c-293e-3876-b0a7-e7684b6ee3af/as-china-risks-grow%2c.html?.tsrc=rss"
                            target="_blank" id="news_title1">As China Risks Grow, Manufacturers Seek Plan B—and C and
                            D</a>
                          <div class="news-item-description" id="news_description1"></div>
                        </div>
                      </div>
                      <div class="has-thumbnail news-item">
                        <div id="news_imageplaceholder" class="thumb"
                          style="background-image: url(&quot;https://d20b5zp0cx3lpw.cloudfront.net/photos/stock-photo-014.jpg&quot;);background-position: 50% 50%;background-size: cover;">
                        </div>
                        <div class="news-text news-text-withimg w-clearfix">
                          <div class="clear news-item-source-datetime"><span class="news-item-date" id="news_datetime2"
                              style="margin-right:5px;">5 hours ago</span> | <img
                              class="news-item-source-img StockdioWidget_ItemBorder" style="padding-left:7px;"
                              height="10" title="TipRanks"
                              src="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?e=PUBLISHERS&amp;s=tipranks.com&amp;h=100&amp;at=TipRanks&amp;ac=0, 0, 0&amp;af=Arial&amp;as=68">
                          </div><a class="news-item-title"
                            href="https://www.tipranks.com/news/why-are-some-users-unhappy-with-apples-savings-account"
                            target="_blank" id="news_title2">Why Are Some Users Unhappy with Apple's Savings
                            Account?</a>
                          <div class="news-item-description" id="news_description2"></div>
                        </div>
                      </div>
                      <div class="has-thumbnail news-item">
                        <div id="news_imageplaceholder" class="thumb"
                          style="background-image: url(&quot;https://api.stockdio.com/visualization/financial/charts/GetImage.ashx?url=https://s.yimg.com/ny/api/res/1.2/Uihjvz7I8fe0DJXTuTAZuQ--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyMDA7aD03OTU-/https://media.zenfs.com/en/motleyfool.com/3841e8a0a9660e218334a8aa1df45a73&quot;);background-position: 50% 50%;background-size: cover;">
                        </div>
                        <div class="news-text news-text-withimg w-clearfix">
                          <div class="clear news-item-source-datetime"><span class="news-item-date" id="news_datetime3"
                              style="margin-right:5px;">7 hours ago</span> | <img
                              class="news-item-source-img StockdioWidget_ItemBorder" style="padding-left:7px;"
                              height="10" title="Yahoo Finance"
                              src="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?e=PUBLISHERS&amp;s=finance.yahoo.com&amp;h=100&amp;at=Yahoo Finance&amp;ac=0, 0, 0&amp;af=Arial&amp;as=68">
                          </div><a class="news-item-title"
                            href="https://finance.yahoo.com/m/aaece033-49fe-3bb1-b86c-f9d9b56b6242/indian-unions-oppose.html?.tsrc=rss"
                            target="_blank" id="news_title3">Indian Unions Oppose Apple-Backed Labor Laws</a>
                          <div class="news-item-description" id="news_description3"></div>
                        </div>
                      </div>
                      <div class="has-thumbnail news-item">
                        <div id="news_imageplaceholder" class="thumb"
                          style="background-image: url(&quot;https://api.stockdio.com/visualization/financial/charts/GetImage.ashx?url=https://s.yimg.com/ny/api/res/1.2/qU9miILaBXgZJZt70vkiQw--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyMDA7aD04MDA-/https://media.zenfs.com/en/motleyfool.com/e4623c0e1b5362b72c5137bd6dd94a49&quot;);background-position: 50% 50%;background-size: cover;">
                        </div>
                        <div class="news-text news-text-withimg w-clearfix">
                          <div class="clear news-item-source-datetime"><span class="news-item-date" id="news_datetime4"
                              style="margin-right:5px;">9 hours ago</span> | <img
                              class="news-item-source-img StockdioWidget_ItemBorder" style="padding-left:7px;"
                              height="10" title="Yahoo Finance"
                              src="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?e=PUBLISHERS&amp;s=uk.finance.yahoo.com&amp;h=100&amp;at=Yahoo Finance&amp;ac=0, 0, 0&amp;af=Arial&amp;as=68">
                          </div><a class="news-item-title"
                            href="https://uk.finance.yahoo.com/news/apple-denies-hacking-thousands-iphones-224524561.html?.tsrc=rss"
                            target="_blank" id="news_title4">Apple denies hacking thousands of iPhones in Russian spy
                            plot</a>
                          <div class="news-item-description" id="news_description4"></div>
                        </div>
                      </div>
                      <div class="has-thumbnail news-item">
                        <div id="news_imageplaceholder" class="thumb"
                          style="background-image: url(&quot;https://api.stockdio.com/visualization/financial/charts/GetImage.ashx?url=https://s.yimg.com/ny/api/res/1.2/bnHHX.vJdAuVHKpSnOZQBQ--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyMDA7aD02NzU-/https://media.zenfs.com/en/bloomberg_technology_68/75caeeb9adcfb3f4852729e6b4f63ca7&quot;);background-position: 50% 50%;background-size: cover;">
                        </div>
                        <div class="news-text news-text-withimg w-clearfix">
                          <div class="clear news-item-source-datetime"><span class="news-item-date" id="news_datetime5"
                              style="margin-right:5px;">10 hours ago</span> | <img
                              class="news-item-source-img StockdioWidget_ItemBorder" style="padding-left:7px;"
                              height="10" title="Yahoo Finance"
                              src="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?e=PUBLISHERS&amp;s=finance.yahoo.com&amp;h=100&amp;at=Yahoo Finance&amp;ac=0, 0, 0&amp;af=Arial&amp;as=68">
                          </div><a class="news-item-title"
                            href="https://finance.yahoo.com/news/russia-accuses-us-intelligence-hacking-220225802.html?.tsrc=rss"
                            target="_blank" id="news_title5">Russia Accuses US Intelligence of Hacking Thousands of
                            iPhones</a>
                          <div class="news-item-description" id="news_description5"></div>
                        </div>
                      </div>
                      <div class="has-thumbnail news-item">
                        <div id="news_imageplaceholder" class="thumb"
                          style="background-image: url(&quot;https://api.stockdio.com/visualization/financial/charts/GetImage.ashx?url=https://s.yimg.com/ny/api/res/1.2/XlhlI5jCS_t9pg7Dqlr0yQ--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyMDA7aD01OTk-/https://media.zenfs.com/en/wsj.com/ca5906c7975524c7e3837e5566ebb8aa&quot;);background-position: 50% 50%;background-size: cover;">
                        </div>
                        <div class="news-text news-text-withimg w-clearfix">
                          <div class="clear news-item-source-datetime"><span class="news-item-date" id="news_datetime6"
                              style="margin-right:5px;">11 hours ago</span> | <img
                              class="news-item-source-img StockdioWidget_ItemBorder" style="padding-left:7px;"
                              height="10" title="Yahoo Finance"
                              src="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?e=PUBLISHERS&amp;s=finance.yahoo.com&amp;h=100&amp;at=Yahoo Finance&amp;ac=0, 0, 0&amp;af=Arial&amp;as=68">
                          </div><a class="news-item-title"
                            href="https://finance.yahoo.com/m/439563fc-418f-3775-9326-02e911ddb40a/mark-zuckerberg-unveils.html?.tsrc=rss"
                            target="_blank" id="news_title6">Mark Zuckerberg Unveils Meta’s Newest VR Headset Days Ahead
                            of Apple Event</a>
                          <div class="news-item-description" id="news_description6"></div>
                        </div>
                      </div>
                      <div class="has-thumbnail news-item">
                        <div id="news_imageplaceholder" class="thumb"
                          style="background-image: url(&quot;https://api.stockdio.com/visualization/financial/charts/GetImage.ashx?url=https://s.yimg.com/ny/api/res/1.2/R.4GWph0Y03TAju99FY_1w--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyMDA7aD02NzU-/https://s.yimg.com/os/creatr-uploaded-images/2023-06/c823ab20-00b7-11ee-9d9a-c9a45e4c3b42&quot;);background-position: 50% 50%;background-size: cover;">
                        </div>
                        <div class="news-text news-text-withimg w-clearfix">
                          <div class="clear news-item-source-datetime"><span class="news-item-date" id="news_datetime7"
                              style="margin-right:5px;">12 hours ago</span> | <img
                              class="news-item-source-img StockdioWidget_ItemBorder" style="padding-left:7px;"
                              height="10" title="Yahoo Finance"
                              src="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?e=PUBLISHERS&amp;s=finance.yahoo.com&amp;h=100&amp;at=Yahoo Finance&amp;ac=0, 0, 0&amp;af=Arial&amp;as=68">
                          </div><a class="news-item-title"
                            href="https://finance.yahoo.com/video/trillion-dollar-companies-wealthy-ceos-202446129.html?.tsrc=rss"
                            target="_blank" id="news_title7">Trillion-dollar companies: How wealthy are their CEOs?</a>
                          <div class="news-item-description" id="news_description7"></div>
                        </div>
                      </div>
                      <div class="has-thumbnail news-item">
                        <div id="news_imageplaceholder" class="thumb"
                          style="background-image: url(&quot;https://api.stockdio.com/visualization/financial/charts/GetImage.ashx?url=https://s.yimg.com/ny/api/res/1.2/snoLVbkd2R6kc2wP7kHvhg--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyMDA7aD02MDA-/https://media.zenfs.com/en/Barrons.com/001040ca1b8645583839ce8a5e29d38a&quot;);background-position: 50% 50%;background-size: cover;">
                        </div>
                        <div class="news-text news-text-withimg w-clearfix">
                          <div class="clear news-item-source-datetime"><span class="news-item-date" id="news_datetime8"
                              style="margin-right:5px;">12 hours ago</span> | <img
                              class="news-item-source-img StockdioWidget_ItemBorder" style="padding-left:7px;"
                              height="10" title="Yahoo Finance"
                              src="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?e=PUBLISHERS&amp;s=finance.yahoo.com&amp;h=100&amp;at=Yahoo Finance&amp;ac=0, 0, 0&amp;af=Arial&amp;as=68">
                          </div><a class="news-item-title"
                            href="https://finance.yahoo.com/m/1f4a7556-5606-3a5d-bc26-543550d612b5/apple-stock-is-near-a-record.html?.tsrc=rss"
                            target="_blank" id="news_title8">Apple Stock Is Near a Record High. What Could Get It
                            There.</a>
                          <div class="news-item-description" id="news_description8"></div>
                        </div>
                      </div>
                      <div class="has-thumbnail news-item">
                        <div id="news_imageplaceholder" class="thumb"
                          style="background-image: url(&quot;https://api.stockdio.com/visualization/financial/charts/GetImage.ashx?url=https://s.yimg.com/ny/api/res/1.2/lPwk9bogvQprNQtoHj3COw--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyMDA7aD02NzY-/https://s.yimg.com/os/creatr-uploaded-images/2023-05/7204a5f0-00b2-11ee-bf5e-3ebab7a2ee64&quot;);background-position: 50% 50%;background-size: cover;">
                        </div>
                        <div class="news-text news-text-withimg w-clearfix">
                          <div class="clear news-item-source-datetime"><span class="news-item-date" id="news_datetime9"
                              style="margin-right:5px;">12 hours ago</span> | <img
                              class="news-item-source-img StockdioWidget_ItemBorder" style="padding-left:7px;"
                              height="10" title="Yahoo Finance"
                              src="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?e=PUBLISHERS&amp;s=finance.yahoo.com&amp;h=100&amp;at=Yahoo Finance&amp;ac=0, 0, 0&amp;af=Arial&amp;as=68">
                          </div><a class="news-item-title"
                            href="https://finance.yahoo.com/video/stock-market-gains-powered-just-193032968.html?.tsrc=rss"
                            target="_blank" id="news_title9">Stock market gains powered by just a few stocks</a>
                          <div class="news-item-description" id="news_description9"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="logo1"
                    style="visibility: visible; display: block; width: 939px; margin-top: -559px; height: 559px; z-index: 9998; pointer-events: none; position: relative;">
                    <div class="jchartfx">
                      <div style="position:absolute;visibility:hidden;height:auto;width:auto" id="textMeasure"></div>
                      <div style="position:absolute;visibility:hidden;height:auto;width:auto" id="textMeasureClass"
                        class="Border">
                        <div style="position:absolute;visibility:hidden;height:auto;width:auto"
                          id="textMeasureClassChild"></div>
                      </div>
                    </div><svg width="1139" height="0" xmlns="http://www.w3.org/2000/svg"
                      xmlns:sfx="http://www.softwarefx.com/ns" xmlns:xlink="http://www.w3.org/1999/xlink" id="chart"
                      class="jchartfx"></svg>
                    <div class="jchartfx">
                      <div style="position:absolute;visibility:hidden;height:auto;width:auto" id="textMeasure"></div>
                      <div style="position:absolute;visibility:hidden;height:auto;width:auto" id="textMeasureClass"
                        class="GaugeText">
                        <div style="position:absolute;visibility:hidden;height:auto;width:auto"
                          id="textMeasureClassChild"></div>
                      </div>
                    </div><svg width="939" height="559" xmlns="http://www.w3.org/2000/svg"
                      xmlns:sfx="http://www.softwarefx.com/ns" xmlns:xlink="http://www.w3.org/1999/xlink" id="chart2"
                      class="jchartfx" style="position: absolute; left: 0px; top: 0px; z-index: -1;">
                      <rect sfxid="-A,0" style="fill:#ffffff;fill-opacity:0;stroke:none" x="234.5" y="139.5" width="469"
                        height="279"></rect>
                      <image sfxid="-A,0" x="356.5" y="140.5" width="226.92000000000002" height="279"
                        preserveAspectRatio="xMinYMin slice"
                        xlink:href="https://resources.stockdio.com/visualization/financial/charts/Logo.ashx?h=500&amp;dfx_date=eCjXtmnmrHh8ntCo0EK19GF6nAOT4%2bI2X1gJroGfC4BZyUiq%2f7at7MIMzdV377pNf%2baCwndOOzgi00cyMx7a8grfNXXEs35pqpgNuaVAXguCPUvP1Q%2b6P2HSx4lXngjpu1o6670l8L3OFS8zj3BEjn3Csj6mmsF2L%2b8k6O4ZlqA%3d"
                        style="opacity:0.05"></image>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End News & Updates -->
        </div>
        <div class="col-lg-3">
          <div class="example-peve7351">
            <div id="market-overview" class="widgetContainer-peve7351" style="overflow: hidden;">
              <div class="tradingview-widget-container" style="width: 100%; height: 55%;">
                <iframe scrolling="no" allowtransparency="true" frameborder="0"
                  src="https://s.tradingview.com/embed-widget/market-overview/?locale=it#%7B%22width%22%3A%22100%25%22%2C%22height%22%3A%22100%25%22%2C%22isTransparent%22%3Afalse%2C%22dateRange%22%3A%2212M%22%2C%22showSymbolLogo%22%3Atrue%2C%22tabs%22%3A%5B%7B%22title%22%3A%22Indici%22%2C%22initTitle%22%3A%22Indices%22%2C%22symbols%22%3A%5B%7B%22s%22%3A%22FOREXCOM%3ASPXUSD%22%2C%22d%22%3A%22S%26P%20500%22%7D%2C%7B%22s%22%3A%22FOREXCOM%3ANSXUSD%22%2C%22d%22%3A%22US%20100%22%7D%2C%7B%22s%22%3A%22FOREXCOM%3ADJI%22%2C%22d%22%3A%22Dow%2030%22%7D%2C%7B%22s%22%3A%22INDEX%3ANKY%22%2C%22d%22%3A%22Nikkei%20225%22%7D%2C%7B%22s%22%3A%22INDEX%3ADEU40%22%2C%22d%22%3A%22Indice%20DAX%22%7D%2C%7B%22s%22%3A%22FOREXCOM%3AUKXGBP%22%2C%22d%22%3A%22UK%20100%22%7D%5D%7D%2C%7B%22title%22%3A%22Futures%22%2C%22initTitle%22%3A%22Futures%22%2C%22symbols%22%3A%5B%7B%22s%22%3A%22CME_MINI%3AES1!%22%2C%22d%22%3A%22S%26P%20500%22%7D%2C%7B%22s%22%3A%22CME%3A6E1!%22%2C%22d%22%3A%22Euro%22%7D%2C%7B%22s%22%3A%22COMEX%3AGC1!%22%2C%22d%22%3A%22Oro%22%7D%2C%7B%22s%22%3A%22NYMEX%3ACL1!%22%2C%22d%22%3A%22Petrolio%20greggio%22%7D%2C%7B%22s%22%3A%22NYMEX%3ANG1!%22%2C%22d%22%3A%22Gas%20naturale%22%7D%2C%7B%22s%22%3A%22CBOT%3AZC1!%22%2C%22d%22%3A%22Mais%22%7D%5D%7D%2C%7B%22title%22%3A%22Obbligazioni%22%2C%22initTitle%22%3A%22Bonds%22%2C%22symbols%22%3A%5B%7B%22s%22%3A%22CME%3AGE1!%22%2C%22d%22%3A%22Eurodollaro%22%7D%2C%7B%22s%22%3A%22CBOT%3AZB1!%22%2C%22d%22%3A%22T-Bond%22%7D%2C%7B%22s%22%3A%22CBOT%3AUB1!%22%2C%22d%22%3A%22Ultra%20T-Bond%22%7D%2C%7B%22s%22%3A%22EUREX%3AFGBL1!%22%2C%22d%22%3A%22Euro%20Bund%22%7D%2C%7B%22s%22%3A%22EUREX%3AFBTP1!%22%2C%22d%22%3A%22Euro%20BTP%22%7D%2C%7B%22s%22%3A%22EUREX%3AFGBM1!%22%2C%22d%22%3A%22Euro%20BOBL%22%7D%5D%7D%2C%7B%22title%22%3A%22Forex%22%2C%22initTitle%22%3A%22Forex%22%2C%22symbols%22%3A%5B%7B%22s%22%3A%22FX%3AEURUSD%22%2C%22d%22%3A%22EUR%2FUSD%22%7D%2C%7B%22s%22%3A%22FX%3AGBPUSD%22%2C%22d%22%3A%22GBP%2FUSD%22%7D%2C%7B%22s%22%3A%22FX%3AUSDJPY%22%2C%22d%22%3A%22USD%2FJPY%22%7D%2C%7B%22s%22%3A%22FX%3AUSDCHF%22%2C%22d%22%3A%22USD%2FCHF%22%7D%2C%7B%22s%22%3A%22FX%3AAUDUSD%22%2C%22d%22%3A%22AUD%2FUSD%22%7D%2C%7B%22s%22%3A%22FX%3AUSDCAD%22%2C%22d%22%3A%22USD%2FCAD%22%7D%5D%7D%5D%2C%22colorTheme%22%3A%22light%22%2C%22utm_source%22%3A%22it.tradingview.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22market-overview%22%2C%22page-uri%22%3A%22it.tradingview.com%2Fwidget%2F%22%7D"
                  style="box-sizing: border-box; display: block; height: calc(100% - 32px); width: 100%;"></iframe>
                <!-- <div class="tradingview-widget-copyright"><a href="https://it.tradingview.com/?utm_source=it.tradingview.com&amp;utm_medium=widget_new&amp;utm_campaign=market-overview" rel="noopener nofollow" target="_blank"><span class="blue-text">Segui tutti i mercati su TradingView</span></a></div> -->

                <style>
                  .tradingview-widget-copyright {
                    font-size: 13px !important;
                    line-height: 32px !important;
                    text-align: center !important;
                    vertical-align: middle !important;
                    /* @mixin sf-pro-display-font; */
                    font-family: -apple-system, BlinkMacSystemFont, 'Trebuchet MS', Roboto, Ubuntu, sans-serif !important;
                    color: #9db2bd !important;
                  }

                  .tradingview-widget-copyright .blue-text {
                    color: #2962FF !important;
                  }

                  .tradingview-widget-copyright a {
                    text-decoration: none !important;
                    color: #9db2bd !important;
                  }

                  .tradingview-widget-copyright a:visited {
                    color: #9db2bd !important;
                  }

                  .tradingview-widget-copyright a:hover .blue-text {
                    color: #1E53E5 !important;
                  }

                  .tradingview-widget-copyright a:active .blue-text {
                    color: #1848CC !important;
                  }

                  .tradingview-widget-copyright a:visited .blue-text {
                    color: #2962FF !important;
                  }
                </style>
              </div>
              <!-- End progetto segreto che se leggi sto commento non è più segreto -->
            </div>
          </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="copyright">
      © Copyright <strong><span>Group3</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="/php/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/php/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/php/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="/php/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/php/assets/vendor/quill/quill.min.js"></script>
  <script src="/php/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/php/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="/php/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/php/assets/js/main.js"></script>
  <script>src="http://localhost:8085/auth/js/keycloak.js"</script>
  <script>src="/php/assets/js/myLogic.js"</script>


</body>

</html>
