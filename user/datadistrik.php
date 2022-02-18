<?php
$id_provinsi_terpilih = $_POST["id_provinsi"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi_terpilih,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: f0ed128f06c764917280e6db729e2cba"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//   echo $response;
$array_response = json_decode($response, TRUE);
$datadistrik = $array_response['rajaongkir']['results'];
// echo "<pre>";
// print_r($datadistrik);
// echo "</pre>";
echo "<option value=''>--Pilih distrik--</option>";
foreach($datadistrik as $key => $tiapdis){
    echo "<option value=''
    id_distrik = '". $tiapdis['city_id']."'  
    nama_provinsi='".$tiapdis["province"]."'
    nama_distrik='".$tiapdis["city_name"]."'
    tipe_distrik='".$tiapdis["type"]."'
    kode_pos = '".$tiapdis["postal_code"]."'>";
    echo $tiapdis['type']." ";
    echo $tiapdis['city_name'];
    echo "</option>";
}
}
?>