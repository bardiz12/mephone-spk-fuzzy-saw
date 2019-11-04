<header class="masthead bg-info text-white banner-hp-2">
    <div class="container" style="margin-top:-30px">
        
        <h2 class="text-center">Parameter Barang yang ingin dipertimbangkan:</h2>
        <center>
            <label for="check_semua">
                <input type="checkbox"  class="form-check-input" id="check_semua"> Check Semua
            </label>
        </center>

        {!! form_open('home/proses_rekomendasi') !!}
        <div class="row">
            @foreach($params as $i => $parameter)
                <div class="col-md-3 col-sm-6">
                
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" value="on" name='checkbox_{{$parameter['name']}}' id='checkbox_param_{{$parameter['name']}}'> {{ $parameter['title'] }}
                        </label>
                    </div>
                    
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <br>
            <h2 class="text-center">Nilai Bobot :</h2>
            <div class="row">
                @foreach($params as $i => $parameter)
                    @php
                    $rand = rand(10,50);
                    if($rand<=30){
                        $bdg = "badge-warning";
                    }else if($rand<=60){
                        $bdg = "badge-primary";
                    }else if($rand<=100){
                        $bdg = "badge-success";
                    }
                    @endphp
                    <div class="col-md-3 col-sm-6" id="kotak_param_{{$parameter['name']}}" style="display: none;">
                    {{$parameter['title']}} <span id="nilai_param_{{$parameter['name']}}"" class="badge {{$bdg}}">{{$rand}}</span>
                        <br/>
                        
                            <input class="no-border slider" type="range" name="{{$parameter['name']}}" min="10" max="100" step = "5" value="{{$rand}}" id="range_{{$parameter['name']}}"/>
      
                    </div>
                @endforeach
                
            </div>
            <button class="btn btn-primary pull-right btn-lg btn-block" type="submit">PROSES</button>
        </div>


    {!! form_close() !!}
    </div>
</header>

<script>
    @foreach($params as $i => $parameter)
        $("#checkbox_param_{{$parameter['name']}}").click(function() {
            $("#kotak_param_{{$parameter['name']}}").toggle(this.checked);
        });

        $("#range_{{$parameter['name']}}").on('input',function(){
            if($(this).val() <= 30){
                $("#nilai_param_{{$parameter['name']}}").attr('class','badge badge-warning');
            }else if($(this).val() <= 60){
                $("#nilai_param_{{$parameter['name']}}").attr('class','badge badge-primary');
            }else if($(this).val() <= 100){
                $("#nilai_param_{{$parameter['name']}}").attr('class','badge badge-success');
            }

            $("#nilai_param_{{$parameter['name']}}").html($(this).val());
            
        })
    @endforeach

    $("#check_semua").click(function(){
        $("input:checkbox").each(function(i){
            if($(this).attr('id') != 'check_semua'){
                $(this).click();
            }
        });
    });

    $("form").on('submit',function (e) { 
        
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            dataType: "html",
            beforeSend: function(){
                loadingPage();
            },
            success: function (response) {
                loadPage(response)
            }
        }).fail(function(){
            errorPage();
        });
        return;
    });
</script>