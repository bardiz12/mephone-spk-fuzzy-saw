<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Jenssegers\Blade\Blade;
class Home extends CI_Controller {

    private $admin = ["username"=>"admin","password"=>"ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f"];
    private $params;
    public function __construct()
    {
        parent::__construct();
        $this->blade = new Blade(APPPATH.'/blade_views', APPPATH.'/cache');
        $this->params = [
            ['title'=>"Harga Hp",
            'name'=>"harga"],
            ['title' => 'Besaran RAM',
            'name'=>'ram'],
            ['title'=>"Kapasitas Memori Internal",
            'name'=>'memori_internal'],
            ['title'=>"Kualitas Kamera Depan",
            'name'=>'mp_kamera_depan'],
            ['title'=>"Kualitas Kamera Belakang",
            "name"=>'mp_kamera_belakang'],
            ["title"=>'Jumlah Core Processor',
            "name"=>'core'],
            ['title'=>"Kapasitas Baterai",
            'name'=>'baterai'],
            ['title'=>'Ukuran Layar',
            'name'=>'layar']
        ];
    }
    
    public function index()
    {
       // $this->load->view("home");
        $msg = $this->session->flashdata("msg");
        echo $this->blade->make("home",["judul"=>"Sistem Pendukung Keputusan Pembelian Smartphone
        Dengan Menggunakan Metode Fuzzy Tsukamoto","msg"=>$msg]);
        
    }
    

    public function detail_hp($id=null){
        if(is_numeric($id)){
            $this->db->select("*");
            $this->db->where("id",$id);
            $data = $this->db->get("hp")->row_array();
            echo $this->blade->make("detail_hp",$data);
        }
    }

    public function youtube(){
        echo $this->blade->make("youtube",["link"=>$this->input->post("link")]);
    }

    private function getDetail($id){
        
        $this->db->select("hp.*,link_youtube.link_youtube as youtube");
        $this->db->from("hp");
        $this->db->where("hp.id",$id);
        $this->db->join("link_youtube","link_youtube.id_hp = hp.id","LEFT");
        return $this->db->get()->row_array();
    }
    public function proses_rekomendasi(){
        //$this->output->set_header('X-Frame-Options: https://www.youtube.com/');
        //echo "<pre>";
        //print_r($_POST);
        $params = [];
        $to_get_query = [];
        $bobot_preferensi = [];
        if(isset($_POST['harga'])){
            $_POST['harga'] = abs($_POST['harga'] - 110);
        }

        foreach ($this->params as $key => $value) {
            if($this->input->post("checkbox_".$value['name']) == "on") {
                $bobot_preferensi[] = $this->input->post($value['name']);
                $to_get_query[] = $value['name'];
                $params = ["name"=>$value['name'],
                            "nilai"=>$this->input->post($value['name'])
                ];
            }
        }
        //r($params);
        //print_r($params);

        
        //get field data from database 
        /*$this->db->select("nama_hp,id,".implode(",",$to_get_query).",link_youtube.link_youtube as youtube");
        $this->db->from("hp");
        $this->db->join("link_youtube","link_youtube.id_hp = hp.id");*/
        $this->db->select("nama_hp,id,".implode(",",$to_get_query));
        $this->db->from("hp");
        $data = $this->db->get()->result_array();
        $blacklist = ["nama_hp","id"];
        $cost = ["harga"];
        //get Kriteria
        $kriteria = $this->getKriteria($data,$blacklist);
        //print_r($kriteria);
        $total_bobot_preferensi = 0;
        foreach ($bobot_preferensi as $key => $value) {
            $total_bobot_preferensi+=$value;
        }

        $bobot_fuzzy = [];
        foreach ($bobot_preferensi as $key => $value) {
            $bobot_fuzzy[] = $value / $total_bobot_preferensi;
        }

        //print_r($bobot_fuzzy);

        $R_Normalisasi = [];
        foreach ($data as $key => $value) {
            $index_ke = $key;
            $tmp = [];
            $nama_hp = $value['nama_hp'];
            $id_hp = $value['id'];
            foreach ($kriteria as $data_kriteria) {
                //print_r($data_kriteria);
                if(in_array($data_kriteria['name'],$cost)){
                    $tmp[$data_kriteria['name']] = $data_kriteria['min'] / $value[$data_kriteria['name']];
                }else{
                    //echo $$data_kriteria['name'];
                    $tmp[$data_kriteria['name']] = $value[$data_kriteria['name']] / $data_kriteria['max'];
                }
            }
            $total_tmp = 0;
            $i=0;
            $newTmp = [];
            $newTmp['id'] = $id_hp;
            $newTmp['nama_hp'] = $nama_hp;
            

            foreach ($tmp as $k => $v) {
                $total_tmp += $v * $bobot_fuzzy[$i];
                $i++;
                $newTmp[$k]=$v;
            }
            
            $newTmp['nilai_v'] = $total_tmp;
            $newTmp['detail_hp'] = $this->getDetail($value['id']);
            //print_r($this->detail_hp($value['id']));
            //$newTmp['detail_hp'] = $data[$index_ke];
            $R_Normalisasi[] = $newTmp;
            //$R_Normalisasi[] = 
        }
        
        //print_r($R_Normalisasi);

        for($i=0;$i<count($R_Normalisasi);$i++){
            //print_r($R_Normalisasi[$i]);
            //exit();
            for($j=0;$j<count($R_Normalisasi)-1;$j++){
                if($R_Normalisasi[$j]['nilai_v'] < $R_Normalisasi[$i]['nilai_v']){
                    $tmp1 = $R_Normalisasi[$i];
                    $R_Normalisasi[$i] = $R_Normalisasi[$j];
                    $R_Normalisasi[$j] = $tmp1;
                 }
            }
        }
        //print_r($R_Normalisasi);
        
        //echo "</pre>";

        $to_render = ["parameters"=>$to_get_query,
                        "kriteria"=>$kriteria,
                        "bobot_preferensi"=>$bobot_preferensi,
                        "bobot_fuzzy"=>$bobot_fuzzy,
                        "tabel_normalisasi"=>$R_Normalisasi];
        echo $this->blade->make('hasil',$to_render);

        

    }

    public function cari_hp(){
        $data = ["params"];
        $data['params'] = $this->params;
        echo $this->blade->make("cari_hp",$data);
    }

    public function input_hp(){
        if(!$this->session->has_userdata('admin')){
            echo $this->blade->make("login");
        }else{
            $this->db->select("count(*) as jumlah");
            $data = $this->db->get("hp");
            echo $this->blade->make("input_hp",["total_data"=>$data->row()->jumlah]);
        }
    }

    public function add_hp(){
        if($this->session->has_userdata('admin')){
            $nama_hp	= $this->input->post("nama_hp");
            $harga	= $this->input->post("harga");
            $ram = $this->input->post("ram");
            $memori_internal = $this->input->post("memori_internal");
            $mp_kamera_depan = $this->input->post("mp_kamera_depan");	
            $mp_kamera_belakang = $this->input->post("mp_kamera_belakang");
            $core = $this->input->post("core");
            $baterai = $this->input->post("baterai");
            $layar = $this->input->post("layar");

            if($nama_hp && is_numeric($ram) && is_numeric($harga) && is_numeric($memori_internal) && is_numeric($mp_kamera_depan) && is_numeric($mp_kamera_belakang) && is_numeric($core) && is_numeric($baterai) && is_numeric($layar)){
                $do = $this->db->insert("hp",["nama_hp"=>$nama_hp,
                                    "harga"=>$harga,
                                    "ram"=>$ram,
                                    "memori_internal"=>$memori_internal,
                                    "mp_kamera_depan"=>$mp_kamera_depan,
                                    "core"=>$core,
                                    "baterai"=>$baterai,
                                    "layar"=>$layar]);
                if($do){
                    $last = $this->db->insert_id();
                    $config['upload_path']          = APPPATH.'/storage/';
                    $config['file_name']            = $last.".jpg";
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 1000;
                    //$config['max_width']            = 1024;
                    //$config['max_height']           = 768;

                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('gambar'))
                    {
                            //$error = array('error' => );
                            $this->session->set_flashdata("msg","Berhasil menambahkan data, namun gambar tidak berhasil ditambahkan, ".$this->upload->display_errors());
                            //echo $this->blade->make('after_input', ["msg"=>]);
                    }
                    else
                    {
                            //$data = array('upload_data' => $this->upload->data());
                            $this->session->set_flashdata("msg","Berhasil menambahkan data");
                    }
                    
                }else{
                    $this->session->set_flashdata("msg","Gagal menambahkan data");
                }
            }else{
                $this->session->set_flashdata("msg","Isi Form dengan benar!");
            }
            
        }else{
            $this->session->set_flashdata("msg","anda bukan admin");
        }

        redirect("home");
    }

    public function login_admin(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        if($username && $password){
            if($username === $this->admin['username'] && hash('sha256',$password) === $this->admin['password']){
                $this->session->set_userdata("admin",$this->admin);
                redirect("home/input_hp");
            }else{
                echo $this->blade->make("login",["username"=>$username,"password"=>$password,"message"=>"Username atau password salah"]);
            }
        }
    }



    private function getKriteria($data_hp,$blacklist){
        $all_kriteria = [];
        
        foreach ($data_hp[0] as $key => $value) {
            $min = NULL;
            $max = NULL;
            if(!in_array($key,$blacklist)){
                foreach ($data_hp as $i => $hp) {
                    foreach ($hp as $kriteria => $nilai) {
                        if($kriteria == $key){
                            if($min == null){
                                $min = $nilai;
                            }else if($min > $nilai){
                                $min = $nilai;
                            }

                            if($max == null){
                                $max = $nilai;
                            }else if($max < $nilai){
                                $max = $nilai;
                            }
                        }
                    }
                }
                $all_kriteria[] = ["name"=>$key,"min"=>$min,"max"=>$max];
            }
            
        }

        return $all_kriteria;
        
    }

    public function tes(){
        $this->db->select("harga,ram,memori_internal,mp_kamera_depan,mp_kamera_belakang,core,baterai,layar");
        $data_hp = $this->db->get("hp")->result_array();
        
        $this->db->select("*");
        $data_hp_lengkap = $this->db->get("hp")->result_array();

        $kriteria = $this->getKriteria($data_hp);
        print_r($kriteria);
        /*
        Cost
            harga	

        Benefit
            ram
            memori_internal
            mp_kamera_depan	
            mp_kamera_belakang
            core
            baterai
            layar
         */
        $index_cost = [0];
        $index_benefit = [1,2,3,4,5,6,7];

        $bobot_preferensi = [10,10,10,10,10,10,10,10];
        
        $total = 0;
        foreach ($bobot_preferensi as $key => $value) {
            $total += $value;
        }

        $bobot_fuzzy = [];
        foreach ($bobot_preferensi as $key => $value) {
            $bobot_fuzzy[]= $value / $total;
        }

        echo "BOBOT PREFERENSI = ".implode(" ",$bobot_preferensi)."\n";
        echo "TOTAL => ".$total."\n";
        echo "BOBOT FUZZY = ".implode(" ",$bobot_fuzzy)."\n";

        $R_Normalisasi = [];
        $Total_R = [];
        foreach ($data_hp as $key => $value) {
            print_r($value);
            $tmp = [];
            foreach ($kriteria as $i => $kriterianya) {
                if(in_array($i,$index_cost)){
                    //print_r($kriterianya);
                    //echo $kriterianya['name'];
                    $tmp[] = $kriterianya['min'] / $value[$kriterianya['name']];
                }else{
                    $tmp[] = $value[$kriterianya['name']] / $kriterianya['max'];
                }
            } 
            $total_tmp = 0;
            foreach ($tmp as $key => $value) {
                $total_tmp+= $value * $bobot_fuzzy[$key];
            }
            $R_Normalisasi[] = $tmp;
            $Total_R[]= $total_tmp;
        }

        //print_r($R_Normalisasi);
        print_r($Total_R);
        $do = $this->reArrangeData($data_hp_lengkap,$Total_R);
        foreach ($do as $key => $value) {
            echo $value['nama_hp']." ".$value['harga']."\n";
        }
    }

    private function reArrangeData($data_hp,$v_normalisasi){
        print_r($v_normalisasi);

        for($i=0;$i<count($v_normalisasi);$i++){
            for($j=0;$j<count($v_normalisasi)-1;$j++){
                if($v_normalisasi[$j] < $v_normalisasi[$i]){
                    $tmp1 = $v_normalisasi[$i];
                    $v_normalisasi[$i] = $v_normalisasi[$j];
                    $v_normalisasi[$j] = $tmp1;
                    
                    $tmp2 = $data_hp[$i];
                    $data_hp[$i] = $data_hp[$j];
                    $data_hp[$j] = $tmp2;
                 }
            }
        }
        /*foreach ($v_normalisasi as $i => $data1) {
            foreach ($v_normalisasi as $j => $data2) {
                if($data1 > $data2){
                    $tmp1 = $v_normalisasi[$i];
                    $v_normalisasi[$i] = $v_normalisasi[$j];
                    $v_normalisasi[$j] = $tmp1;
                    
                    $tmp2 = $data_hp[$i];
                    $data_hp[$i] = $data_hp[$j];
                    $data_hp[$j] = $tmp2;
                }
            }
        }*/
        

        print_r($v_normalisasi);

        return $data_hp;
    }

}

/* End of file Home.php */
