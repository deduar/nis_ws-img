<?php

$opts = array(
    'http' => array(
        'user_agent' => 'PHP libxml agent',
    )
);

$context = stream_context_create($opts);
libxml_set_streams_context($context);

$doc = DOMDocument::load('https://carspark.dealerk.es/myPortalXML/index?myPortalXMLkey=talleresrodosa');

$cars = $doc->getElementsByTagName('car');
for ($i = 0; $i < $cars->length; $i++) {
    foreach ($cars->item($i)->childNodes as $node) {
        if($node->nodeName === 'plate'){ echo "Matricula: ".$node->nodeValue."<br>"; }
        if($node->nodeName === 'make'){ echo "Marca: ".$node->nodeValue."<br>"; }
        if($node->nodeName === 'model'){ echo "Modelo: ".$node->nodeValue."<br>"; }
        if($node->nodeName === 'version'){ echo "Version: ".$node->nodeValue."<br>"; }
        if($node->nodeName === 'image'){ echo "<img width='80' height='80' border='0' align='center' src=".$node->nodeValue.">"; }
    }
    echo "<br>";
}


var_dump($tokens);
//var_dump($doc);

/*
foreach ($doc->getElementsByTagName("car") as $node){
    $ref = $node->getAttribute("id");

    mkdir('./tmp_rodosa/'.$ref, 0755, true);
    foreach ($node->childNodes as $value) {
        var_dump($value); echo "<br>";
        if($value->nodeName == "image"){
            var_dump($value->nodeValue); echo "<br>";
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
*/


echo "Finish";
