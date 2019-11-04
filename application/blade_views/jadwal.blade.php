<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>fuzzy.bardizba.com | Jadwal {{$nama_prodi or "WWKKWLAND"}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{base_url()}}assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{base_url()}}assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{base_url()}}assets/css/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="{{base_url()}}assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="{{base_url()}}assets/css/font-roboto.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark fixed-top text-uppercase navbar-shrink" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href=""><i class="fa fa-gear fa-spin"></i> BARD</a>
      </div>
    </nav>  


    <!--CONTENT-->
    <div id="contents">
    <header class="masthead bg-secondary text-white text-center">
      <div class="container" style="margin-top:-30px">
      <h3>{{$nama_prodi or "WWKKWLAND"}}</h3>
        <div class="table-responsive">
        <table class="table">
            <thead class="thead-inverse">
                <tr>
                <th>#</th>
                <th>Matkul</th>
                <th>SKS</th>
                <th>Dosen</th>
                <th>Hari Jam</th>
                <th>Kode Jadwal</th>
                <th>Kode Mk</th>
                <th>Rombel</th>
                <th>Kuota</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result as $i=>$items)
                    <tr>
                        <th scope="row">{{($i+1)}}</th>
                        <td>{{$items->nama_matakuliah}}</td>
                        <td>{{$items->detail->sks}}</td>
                        <td>{{$items->detail->dosen}}</td>
                        <td>{{$items->detail->jam_mk}}</td>
                        <td>{{$items->kode_jdw}}</td>
                        <td>{{$items->kode_mk}}</td>
                        <td>{{$items->rombel}}</td>
                        <td>{{$items->detail->kuota}}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        
      </div>
      
      </header>
    </div>
    <!--CONTENT-->

    <header class="masthead bg-dark text-white">
      <div class="container" id="tes2" style="margin-top:-120px">
      <div class="row">
        <div class="col-md-6">
        <h3><i class="fa fa-info"></i> Tentang</h3>
        <p class="text-left">
            Aplikasi ini ditujukan untuk memenuhi tugas Akhir <br/>
            Mata Kuliah  : Logika Fuzzy<br/>
            Dosen  pengampu : Bp Budi Prasetyo S.Si, M.Kom,.
        </p>
        </div>
        <div class="col-md-6 text-right">
            <h3>Kelompok 1 <i class="fa fa-group"></i></h3>
        Novi Kurniawan (4611416001) <br/>
        M. Giri Laksana (4611416016)<br/>
        Mochammad Bardizba Z (4611416038)<br/>
        David Topanto (4611416041)
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
        });
    </script>
</body>
</html>