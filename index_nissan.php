<?php

include_once('./lib/simple_html_dom.php');

$ch = curl_init("https://publicvo.imaweb.net/==ANzEzXzlmbv8WayFmbvl2clNmbvN2XvNWayVmbld2Lz92ZvxWY0F2Y");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html = str_get_html(curl_exec($ch));
curl_close($ch);

//var_dump($html);

foreach($html->find('ad') as $element){
    preg_match('/<reference>(.*?)<\/reference>/s', $element, $reference);
    $r1 = explode("<reference>",$reference[0]);
    $r2 = explode("</reference>",$r1[1]);
    $r3 = explode("nis_134_",$r2[0]);
    $ref = $r3[1];
    echo "Ref: ".$ref."<br>";
    preg_match('/<model>(.*?)<\/model>/s', $element, $model);
    echo "Modelo: ".$model[0]."<br>";
    preg_match('/<version>(.*?)<\/version>/s', $element, $version);
    echo "Version: ".$version[0]."<br>";
    preg_match('/<description>(.*?)<\/description>/s', $element, $description);
    echo "Descripción: ".$description[0]."<br>";
    preg_match('/<photos>(.*?)<\/photos>/s', $element, $photos);
    //var_dump(htmlspecialchars($photos[0]));
    $photo = explode("<photo>https://imgnis.imaweb.net/uv/image.jpg?id=",$photos[0]);

    mkdir('./tmp_nis/'.$ref, 0755, true);
    foreach ($photo as $value) {
        //"https://imgnis.imaweb.net/uv/image.jpg?id="
        $photo_id = explode("&amp;brandDealer=nis_134</photo>",$value)[0];

        if ($photo_id != "<photos>"){
            //var_dump(htmlspecialchars($photo_id)); echo "<br>";
/*
            echo "./tmp_nis/".$ref."/".$photo_id; echo "<br>";
            $fh = fopen("./tmp_nis/".$ref."/".$photo_id.".jpeg", "w");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://imgnis.imaweb.net/uv/image.jpg?id=".$photo_id);
            curl_setopt($ch, CURLOPT_FILE, $fh);
            curl_exec($ch);
            curl_close($ch);
*/            
        }

        
        echo '<a href="https://imgnis.imaweb.net/uv/image.jpg?id='.$photo_id.'" target="_blank">
            <img width="80" height="80" border="0" align="center"  src="https://imgnis.imaweb.net/uv/image.jpg?id='.$photo_id.'"/>
        </a>';
        
    }

    echo "<br><br>";
    //echo htmlspecialchars($element) . '-------------<br><br>';
}