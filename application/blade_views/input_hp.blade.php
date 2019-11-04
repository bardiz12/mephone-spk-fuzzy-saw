<header class="masthead bg-success text-white" id="input_hp_div">
    <div class="container" style="margin-top:-30px">
    
    <h3 class="text-center">Input Data Hp</h3><br/>
    <h5> Total data : {{$total_data}}</h5>
    {!! form_open_multipart('home/add_hp') !!}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="nama_hp">Nama Hp</label>
                <input type="text" name="nama_hp" id="nama_hp" class="form-control" required="" placeholder="contoh : Iphone 5s" value="{{ $nama_hp or '' }}">
                </div>

                <div class="form-group">
                    <label for="layar">Ukuran Layar (Inch)</label>
                    <input type="text" name="layar" id="layar" class="form-control" required="" placeholder="contoh : 4.7" value="{{ $layar or '' }}">
                </div>

                <div class="form-group">
                    <label for="ram">Ukuran Ram (GB)</label>
                    <input type="text" name="ram" id="ram" class="form-control" required="" placeholder="contoh : 2" value="{{ $ram or '' }}">
                </div>

                <div class="form-group">
                    <label for="memori_internal">Memori Internal (GB)</label>
                    <input type="number" name="memori_internal" id="memori_internal" class="form-control" required="" placeholder="contoh : 32" value="{{ $memori_internal or '' }}">
                </div>

                <div class="form-group">
                    <label for="mp_kamera_depan">Ukuran kamera Depan (Mp)</label>
                    <input type="text" name="mp_kamera_depan" id="mp_kamera_depan" class="form-control" required="" placeholder="contoh : 8" value="{{ $mp_kamera_depan or '' }}">
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="mp_kamera_belakang">Ukuran kamera Belakang (Mp)</label>
                    <input type="text" name="mp_kamera_belakang" id="mp_kamera_belakang" class="form-control" required="" placeholder="contoh : 13" value="{{ $mp_kamera_belakang or '' }}">
                </div>

                <div class="form-group">
                    <label for="core">Jumlah Core CPU</label>
                    <input type="number" name="core" id="core" class="form-control" required="" placeholder="contoh : 4" value="{{ $core or '' }}">
                </div>

                <div class="form-group">
                    <label for="baterai">Baterai (MAh)</label>
                    <input type="number" name="baterai" id="baterai" class="form-control" required="" placeholder="contoh : 2000" value="{{ $baterai or '' }}">
                </div>

                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" class="form-control" required="" placeholder="contoh : 1500000" value="{{ $harga or '' }}">
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar Hp</label>
                    <input type="file" name="gambar" id="gambar" class="form-control" required="">
                </div>

                <button class="btn btn-primary pull-right btn-lg" type="submit"><i class="fa fa-paper-plane"></i> Proses</button>
            </div>
        </div>
        

       
    {!! form_close() !!}
    </div>
</header>

<script>
$("#input_hp_div").hide();
$("#input_hp_div").fadeIn("slow");
/*$("form").submit(function (e) { 
    e.preventDefault();
    var formData = new FormData(this);    
    $.post($(this).attr("action"), formData, function(data) {
        console.log(data);
    });
    return;
});*/
</script>