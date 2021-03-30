<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);






// THIS WORKS TO GET THAT KANJI!

function showTheKanji() { // Just leaving this here in a function for now! Incase I want it later!
    $funArray = array();

    $entry = new stdClass();
    libxml_use_internal_errors(TRUE);
 
    $objXmlDocument = simplexml_load_file("JMdict_e/JMdict_e.xml");
     
    if ($objXmlDocument === FALSE) {
        echo "There were errors parsing the XML file.\n";
        foreach(libxml_get_errors() as $error) {
            echo $error->message;
        }
        exit;
    }

    foreach ($objXmlDocument as $key => $guy) {
        if ($guy->k_ele->keb) {
            if (strpos($guy[0]->k_ele->keb, "説") !== false) {
                if ($guy->k_ele->ke_pri) {
                    foreach ($guy->k_ele->ke_pri as $priority) {
                        if ($priority == "news1") { // Can change this to get different priority rankings later if wanted
                            $entry = new stdClass();
                            echo $guy[0]->k_ele->keb[0]; // kanji
                            echo " ";
                            echo $guy[0]->r_ele->reb; // reading
                            echo " ";
                            echo $guy->sense->gloss[0]; // english
                            echo "<br>";

                            $entry->kanji = $guy[0]->k_ele[0]->keb[0];
                            $entry->kana = $guy[0]->r_ele[0]->reb[0];
                            $entry->english = $guy[0]->sense[0]->gloss[0];

                            array_push($funArray,$entry);
                        }
                    }
                }
            }
        }
    }
}


//file_put_contents("test.txt",json_encode($funArray));
//echo json_encode($funArray);


//print_r($funArray);

function mbStringToArray ($string) {
    $strlen = mb_strlen($string);
    while ($strlen) {
        $array[] = mb_substr($string,0,1,"UTF-8");
        $string = mb_substr($string,1,$strlen,"UTF-8");
        $strlen = mb_strlen($string);
    }
    return $array;
}


// All the seperate kanji. Keep them in chapter here because it might be a faff to seperate later
// Then join all these strings together and make a big array out of that?
// It may be worth having different lists of these kanji, so BKB, KiC, and the JLPT ones?
// Put them in external files and save to each line may be easier than having them as strings in here?

$bkb1 = "日月木山川田人口車門";
$bkb2 = "火水金土子女学生先私";
$bkb3 = "一二三四五六七八九十百千万円年";

$bkbArray = mbStringToArray($bkb1 . $bkb2 . $bkb3);

$jlptn1 = file_get_contents("kanji/jlpt-n1.txt");
$jlptn2 = file_get_contents("kanji/jlpt-n2.txt");
$jlptn3 = file_get_contents("kanji/jlpt-n3.txt");
$jlptn4 = file_get_contents("kanji/jlpt-n4.txt");
$jlptn5 = file_get_contents("kanji/jlpt-n5.txt");

$kanjiArray = mbStringToArray($jlptn5 . $jlptn4. $jlptn3 . $jlptn2 . $jlptn1);

?>



<html>
    <head>
    <script type="text/javascript" src="json/12kwords.json"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="css/kanji.css">
    </head>
    <body>
    <h1>Here lies the kanji!</h1>
    <div id="demo"></div>
        <div id="pageContainer">
            <div class="kanjiContainer">
            <?php
                foreach($bkbArray as $kanji) {
                    echo "<div class='kanji'>" . $kanji . "</div>";
                }
            ?>
            </div>
            <div id="vocabContainer">
                <div id="stickyVocab">
                </div>
            </div>
        </div>
    </body>
</html>


