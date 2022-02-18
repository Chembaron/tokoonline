<?php


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
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
  $array_response = json_decode($response, TRUE);
  $dataprovinsi = $array_response['rajaongkir']['results'];
  echo" <option value=''>--Pilih Provinsi--</option>"; 
  foreach($dataprovinsi as $key => $tiapprov){
      echo "<option value='".$tiapprov["province_id"]."' id_provinsi='".$tiapprov['province_id']."'>";
      echo $tiapprov['province'];
      echo "</option>";
  }
}

?>