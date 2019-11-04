<header class="masthead bg-secondary" id="slide_hasil">
    <div class="container" id="tes2" style="margin-top:-120px">
    <div id="myModal">
           
        </div>
            <h4 class="text-center text-white">RESULT</h4>
            <div class="row">

                @foreach($tabel_normalisasi as $i => $hp)
                    <div class="col-md-6 col-lg-4 col-sm-6 py-2">
                        <div class="card">
                            <img class="card-img-top img-fluid" style="max-height:300px" src="{{site_url('storage/image/'.$hp['detail_hp']['id'])}}" alt="Card image cap">
                            <div class="card-body">
                                
                                <h5 class="card-title text-small">
                                    <span>{{($i+1)}}. {{$hp['detail_hp']['nama_hp']}}</span> 
                                </h5>
                                <div class="d-flex justify-content-between">
                                @php 
                                $hp['detail_hp']['youtube'] = str_replace("watch?v=","embed/",$hp['detail_hp']['youtube']);
                                @endphp 
                                <a href="#" onClick="loadYoutube('{{$hp['detail_hp']['youtube']}}');return false;"class="btn btn-outline-danger btn-block"><i class="fa fa-youtube fa"></i> Review</a>@if($i == 0) 
                                    <button class="btn btn-outline-success">BEST MATCH!</button>
                                    @endif</div>
                                
                                <hr>
                                <ul class="list-group">
                                    <li class="list-group-item bg-secondary text-white text-center">Spesification
                                    
                                    </li>
                                    <li class="list-group-item">RAM : {{$hp['detail_hp']['ram']}}Gb</li>
                                    <li class="list-group-item">Storage : {{$hp['detail_hp']['memori_internal']}}gb</li>
                                    <li class="list-group-item">Front Camera : {{$hp['detail_hp']['mp_kamera_depan']}}Mp</li>
                                    <li class="list-group-item">Rear Camera : {{$hp['detail_hp']['mp_kamera_belakang']}}Mp</li>
                                    <li class="list-group-item">Processor : {{$hp['detail_hp']['core']}} Core</li>
                                    <li class="list-group-item">Battery : {{$hp['detail_hp']['baterai']}} MAh</li>
                                    <li class="list-group-item">Layar : {{$hp['detail_hp']['layar']}}"</li>
                                    <li class="list-group-item bg-warning text-dark text-center"><b>Rp {{number_format($hp['detail_hp']['harga'],2,",",".")}}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    <div class="container">
        <center><button data-toggle="collapse" class="btn btn-outline-primary btn-lg btn-block" data-target="#orekorekan">Hitungan</button></center>
    </div>
    <div class="container collapse text-white" style="margin-top:0px" id="orekorekan">
        
        
        
        <h3> <i class="fa fa-check-circle-o"></i> Hasil </h3>
        <i class="fa fa-info-circle"></i> Kriteria :<br/>
            @php 
            $i = 1;
            @endphp
            @foreach($kriteria as $parameter )
                <span class="badge badge-primary badge-lg"> C{{$i}} = {{$parameter['name']}} </span>
                @if($i % 3 == 0)
                    <br/>
                @endif
                @php 
                $i+=1;
                @endphp
            @endforeach
        <br/>
        <br/>
        
        <i class="fa fa-info-circle"></i> Parameter :<br/>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-inverse">
                    <tr>
                    <th>Bobot</th>
                    @foreach($parameters as $parameter )
                        <th class="text-center">{{$parameter}}</th>
                    @endforeach
                    <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">Preferesi</th>
                    
                    @php
                    $total = 0;
                    @endphp
                    @foreach($bobot_preferensi as $bobot )
                        <td class="text-center">{{$bobot}}</td>
                        @php
                        $total+=$bobot;
                        @endphp
                    @endforeach
                    <td class="text-center">{{$total}}</td>
                    </tr>
                    <tr>
                    <th scope="row">Fuzzy</th>
                    @foreach($bobot_fuzzy as $bobot )
                        <td class="text-center" data-toggle="tooltip" data-placement="top" title="tanpa pembulatan :
                        {{$bobot}}">{{round($bobot,4)}}</td>
                    @endforeach
                    <td class="text-center">1</td>
                    </tr>
                    <tr>
                        <th scope="row">Min</th>
                        @foreach($kriteria as $kr )
                        <td class="text-center">{{$kr['min']}}</td>
                        @endforeach
                        <td class="text-center">-</td>
                    </tr>
                    <tr>
                        <th scope="row">Max</th>
                        @foreach($kriteria as $kr )
                        <td class="text-center">{{$kr['max']}}</td>
                        @endforeach
                        <td class="text-center">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br/>

        <i class="fa fa-info-circle"></i> Tabel Normalisasi (R) :<br/>
        <div class="table-responsive">
            <table class="table table-bordered table-inverse">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Nama Hp</th>
                    @php 
                    $i = 1;
                    @endphp
                    @foreach($parameters as $parameter )
                        <th>C{{$i}}</th>
                        @php 
                        $i+=1;
                        @endphp
                    @endforeach
                    <th>V</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tabel_normalisasi as $i => $element)
                        <tr>
                            <th scope="row">{{$i+1}}</th>
                            <td><button class="btn btn-sm btn-primary text-uppercase" onclick="loadHp('{{$element['id']}}');"><i class="fa fa-mobile fa-2x"></i></button> {{$element['nama_hp']}}</td>
                            @foreach($element as $k => $e)
                                @if ($k != "id" and $k != "nama_hp" && $k != "detail_hp")
                                    <td>{{round($e,4)}}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>

        </div>
    </div>
</header>

<script>
    $('[data-toggle="tooltip"]').tooltip(); 

    function loadYoutube(link){
        $.ajax({
            type: "post",
            url: "{!!site_url('home/youtube/')!!}",
            data: {"link":link},
            dataType: "html",
            success: function (response) {
                $("#myModal").html(response);
                $('#detail_hp').modal('show')
            }
        });
        /*var html = `<iframe width="560" height="auto" src="`+link+`" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        $("#myModal").html(html);
        $('#detail_hp').modal('show')*/
    }
    function loadHp(id){
        $.ajax({
            type: "get",
            url: "{!!site_url('home/detail_hp/')!!}" + id,
            dataType: "html",
            success: function (response) {
                $("#myModal").html(response);
                $('#detail_hp').modal('show')
            }
        });
    }
    $(document).ready(function(ev){
        $("#slide_hasil").hide();
        $("#slide_hasil").fadeIn('slow');
    })

</script>