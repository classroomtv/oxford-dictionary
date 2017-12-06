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

  // Search for entries in the dictionary
  public function search($lang, $word) {

    $url = $this->url.'/entries/'.$lang.'/'.rawurlencode($word);

    echo $this->requestAPI($url);

  }

  //Suggest autocomplete words
  public function suggest($lang, $word, $limit=10) {

    $url = $this->url.'/search/'.$lang.'?q='.rawurlencode($word).'&prefix=true&limit='.$limit;

    echo $this->requestAPI($url);

  }

  private function requestAPI($url) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_SSL_VERIFYPEER => false, // Need to disable SSL verification on localhost test machine (Server configuration)
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

      curl_close($curl);

      return json_encode($error);
    } else {

      if(curl_getinfo($curl, CURLINFO_HTTP_CODE) == 404) { // Word not found for specific language
        $error = array('error' => "Not entry available for '".$word."' in '".$lang."'");

        curl_close($curl);

        return json_encode($error);
      } else {

        curl_close($curl);

        return $response;
      }
    }
  }

}

?>
