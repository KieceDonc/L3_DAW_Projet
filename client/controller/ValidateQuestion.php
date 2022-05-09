<?php

    function addQuestion($id,$ques,$Difficulty,$isok,$Answer,$choice1,$choice2,$choice3,$choice4)
    {
        $xml = getXml($id);
        $number = getCountXML($xml,$id);

        $Question = $xml->addChild("question","");
        $Question->addAttribute("id",strval(++$number));

        $Question->addChild("difficulte",$Difficulty);
        $Question->addChild("intitule",$ques);

        $choix1xml = $Question->addChild("choix",$choice1);
        $choix1xml->addAttribute("id",1);

        $choix2xml = $Question->addChild("choix",$choice2);
        $choix2xml->addAttribute("id",2);

        $choix3xml = $Question->addChild("choix",$choice3);
        $choix3xml->addAttribute("id",3);

        $choix4xml = $Question->addChild("choix",$choice4);
        $choix4xml->addAttribute("id",4);

        $Question->addChild("reponse",$Answer);

        saveXML($xml,$id);
    }


    function getCountXML($xml,$id)
    {
        $number = $xml->xpath("//Questionnaire[@chapitre={$id}]/question");
        $number = count($number);
        return $number;
    }
    

    function saveXML($xml,$id)
    {
        $chemindossier =(realpath($_SERVER["DOCUMENT_ROOT"])."/quizxml/quiz".$id.".xml");
        $xml->asXML($chemindossier); 
    }

?>