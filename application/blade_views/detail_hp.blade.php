<div class="modal fade" id="detail_hp" tabindex="-1" role="dialog" aria-labelledby="detail_hpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title text-dark" id="detail_hpLabel">Detail Handphone</h4>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-fluid" src="{!!site_url("storage/image/")!!}{{$id}}">
                    </div>
                    <div class="col-md-6 text-dark">
                        <b>Handphone : </b> {{$nama_hp}}<br/>
                        <b>Ram : </b> {{$ram}} Gb<br/>
                        <b>Memori Internal : </b> {{$memori_internal}} Gb<br/>
                        <b>Ini Processor : </b> {{$core}} Core<br/>
                        <b>Baterai : </b> {{$baterai}} MAh<br/>
                        <b>Kamera Depan : </b> {{$mp_kamera_depan}} Mp<br/>
                        <b>Kamera Belakang : </b> {{$mp_kamera_belakang}} Mp<br/>
                        <b>Ukuran Layar : </b> {{$layar}}"<br/>
                        <b>Harga : </b> Rp {{number_format($harga,2,",",".")}}

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick='' data-dismiss="modal">Close</button>
        </div>
    </div>
</div>