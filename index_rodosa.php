<?php

$opts = array(
    'http' => array(
        'user_agent' => 'PHP libxml agent',
    )
);

$context = stream_context_create($opts);
libxml_set_streams_context($context);

$doc = DOMDocument::load('https://carspark.dealerk.es/myPortalXML/index?myPortalXMLkey=talleresrodosa');

foreach ($doc->getElementsByTagName("car") as $node){
    $ref = $node->getAttribute("id");
    mkdir('./tmp_rodosa/'.$ref, 0755, true);
    foreach ($node->childNodes as $value) {
        if($value->nodeName == "image"){
            //var_dump($value->nodeValue); echo "<br>";
            $photo_id = explode("https://cdn.dealerk.es/dealer/datafiles/vehicle/images/800/1019/",$value->nodeValue)[1];
            $fh = fopen("./tmp_rodosa/".$ref."/".$photo_id.".jpeg", "w");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://cdn.dealerk.es/dealer/datafiles/vehicle/images/800/1019/".$photo_id);
            curl_setopt($ch, CURLOPT_FILE, $fh);
            curl_exec($ch);
            curl_close($ch);
        }
    }
 }

 echo "Finish";