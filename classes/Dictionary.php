<?php

class Dictionary {

  private $app_id;
  private $app_key;
  private $url;

  public function __construct($app_id, $app_key, $url) {
    $this->app_id = $app_id;
    $this->app_key = $app_key;
    $this->url = $url;
  }

  public function search($lang, $word) {

    $curl = curl_init();

    $url = $this->url.'/entries/'.$lang.'/'.$word;

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_SSL_VERIFYPEER => false, // Need to disable SSL verification on localhost test machine
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "app_id: ".$this->app_id,
        "app_key: ".$this->app_key,
        "Accept: application/json"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
      $error = array('error' => "cURL Error #:" . $err);

      echo json_encode($error);
    } else {

      if(curl_getinfo($curl, CURLINFO_HTTP_CODE) == 404) { // Word not found for specific language
        $error = array('error' => "Not entry available for '".$word."' in '".$lang."'");

        echo json_encode($error);
      } else {
        echo $response;
      }
    }

    curl_close($curl);

  }

}

?>
