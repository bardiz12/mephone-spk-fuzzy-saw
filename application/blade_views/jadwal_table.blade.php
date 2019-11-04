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
      </header>