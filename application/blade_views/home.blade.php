<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MePhone : Choose Smartphone as You Wish</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{base_url()}}assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{base_url()}}assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{base_url()}}assets/css/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="{{base_url()}}assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="{{base_url()}}assets/css/font-roboto.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <style>
    .banner-hp{
        background: url('{{base_url('assets/img/banner.jpg')}}');
        background-size:cover;
          box-shadow:inset 0 0 0 2000px rgba(0,0,0,0.5)
    }

    .banner-hp-2{
        background: url('{{base_url('assets/img/banner2.jpg')}}');
        background-size:cover;
          box-shadow:inset 0 0 0 2000px rgba(0,0,0,0.5)
    }

    .slidecontainer {
    width: 100%;
}


.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 25px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark fixed-top text-uppercase navbar-shrink" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" id="block" href=""><i class="fa fa-search"></i> MePhone</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-white text-dark rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{!!site_url('home/cari_hp')!!}" id="links">Dapatkan Rekomendasi</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{!!site_url('home/input_hp')!!}" id="links">Input Hp</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>  


    <!--CONTENT-->
    <div id="contents">
    <header class="masthead banner-hp text-white text-center">
      <div class="container" style="margin-top:-30px">
        
       <h1><i class="fa fa-search"></i> MePhone</h1><br/>
        <h3 class="font-weight-light mb-0">Choose Smartphone as You Wish</h3>
        <hr style="border-color:white">
        <a class="btn btn-outline-light" href="{!!site_url('home/cari_hp')!!}" id="cari-hp-btn">Cari Handphone</a>
        
      </div>
      
      </header>
    </div>
    <!--CONTENT-->

    <header class="masthead bg-dark text-white">
      <div class="container" id="tes2" style="margin-top:-120px">
      <div class="row d-flex justify-content-between">
        <div class="col-md-3">
            <h3><i class="fa fa-info"></i> Tentang</h3>
            <p class="text-left">
            Sistem Penunjang Keputusan Pembelian Smartphone
    Dengan Menggunakan Metode Fuzzy Simple Additive Weighting
            </p>
        </div>
        <div class="col-md-6 text-center">
           Created By:<br/>
           <div class="d-flex justify-content-end">
            <div class="container">
                <img src="{{base_url('assets/img/author1.jpg')}}" class="rounded-circle img-thumbnail" style="height:150px"><br/>
                Moch bardizba Z
            </div>
            
            </div>
           
        </div>
      </div>
      
      </div>
      
    </header>

    

    <script type="text/javascript" src="<?=base_url('assets/js/jquery.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/jquery-ui.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/jquery-form.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/tether.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/popper.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
	<!--<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.js')?>"></script>-->
	

	<script type="text/javascript" src="<?=base_url('assets/js/toastr.min.js')?>"></script>

    <script>
        @if(isset($msg))
            alert('{!!$msg!!}');
        @endif
        function loadPage(html){
                $("#contents").html(html);
        }

        function loadingPage(){
                var str = `<header class="masthead bg-primary text-white">
    <div class="container text-center" style="margin-top:-30px">
            <i class='fa fa-spinner fa-spin fa-5x'></i>
            <h4>Loading....</h4>
    </div>
</header>`;
                $("#contents").html(str);
        }

        function errorPage(msg){
            if(msg){
                msg = "<h2>"+msg+"</h2>"
            }else{
                msg = '';
            }
            var str = `<header class="masthead bg-danger text-white">
                        <div class="container text-center" style="margin-top:-30px">
                                <i class="fa fa-rocket fa-4x"></i>
                                <h4>Error :(</h4><br/>
                                `+ msg +`
                        </div>
                    </header>`;
                $("#contents").html(str);
        }
        
        $(document).ready(function(){
            $(".container").hide();
            function doAnimation()
                {
                        //$("#tes2").effect( "bounce", {times:3}, 300);
                        $(".container").fadeIn("slow");
                }

                doAnimation();
            

            $(".nav-item a").click(function (event) { 
                event.preventDefault();
                $.ajax({
                    type: "get",
                    url: $(this).attr('href'),
                    dataType: "html",
                    beforeSend: function(xhr){
                        loadingPage();
                    },
                    success: function (response) {
                     loadPage(response);   
                    }
                }).fail(function(){
                    errorPage(null);
                });
                
                
            });

            $("#cari-hp-btn").click(function (event) { 
                event.preventDefault();
                $.ajax({
                    type: "get",
                    url: $(this).attr('href'),
                    dataType: "html",
                    beforeSend: function(xhr){
                        loadingPage();
                    },
                    success: function (response) {
                     loadPage(response);   
                    }
                }).fail(function(){
                    errorPage(null);
                });
                
                
            });
        });
    </script>
</body>
</html>