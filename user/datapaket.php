<?php
$ekspedisi = $_POST['ekspedisi'];
$distrik = $_POST['distrik'];
$berat = $_POST['berat'];
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=289&destination=".$distrik."&weight=".$berat."&courier=".$ekspedisi,
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: f0ed128f06c764917280e6db729e2cba"
    ),
));
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
    //dijadikan array
    $array_response = json_decode($response, TRUE);

    $paket = $array_response['rajaongkir']['results']['0']['costs'];
    
    echo "<option>--Pilih Paket--</option>";
    foreach ($paket as $key => $tiappak) {
        echo "<option
        paket='" . $tiappak["service"] . "'
        ongkir='" . $tiappak["cost"]["0"]["value"] . "'
        etd='" . $tiappak["cost"]["0"]["etd"] . "'>";
        echo $tiappak["service"] . " ";
        echo number_format($tiappak["cost"]['0']['value']) . " ";
        echo $tiappak["cost"]['0']['etd'];
        echo "</option>";
    }
}
