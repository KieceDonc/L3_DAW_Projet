<?php
        function supprimer($a,$NumChapter)
        {
                    $xml = simplexml_load_file(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");
                    $tosupp = $xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$a}]");
                    foreach($tosupp as $node)
                    {
                        unset($node[0]);
                    }
                    $xml->asXML(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");
                }
        function reorgonize($NumChapter)
        {
                    $xml = simplexml_load_file(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");
                    $number = $xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question");
                    $number = count($number);
        
                    $toreplace = $xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question");
        
                    for($i=1;$i<=$number;$i++)
                    {
                        $toreplace[$i-1]['id']=$i;
                    }
        
                    $xml->asXML(($_SERVER["DOCUMENT_ROOT"]) . "/quizxml/quiz".$NumChapter.".xml");
                }

        function getName($xml)
        {
            $array=$xml->xpath("//Questionnaire/@Nom");
            return $array[0][0];
        }

        function getChoice($idQ,$xml,$NumChoice,$NumChapter)
        {
            $array=$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$idQ}]/choix[@id={$NumChoice}]");
            return $array[0][0];
        }

        function getQuestion($xml,$idQ,$NumChapter)
        {
            $array=$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$idQ}]/intitule");
            return "Question n°".$idQ." : ".$array[0][0] ;
        }

        function getReponse($xml,$idQ,$NumChapter)
        {
            $array=$xml->xpath("//Questionnaire[@chapitre={$NumChapter}]/question[@id={$idQ}]/reponse");
            return $array[0][0];
        }

        function getCountXML($xml,$id)
    {
        $number = $xml->xpath("//Questionnaire[@chapitre={$id}]/question");
        $number = count($number);
        return $number;
    }

        function getResultatBienvenue($i)
        {
            if(intval($i)<4)
            {
                echo $i."on 10 . You can start with basics course (Certified Courses)";
            }
            else if (intval($i)<7)
            {
                echo $i."on 10 . You can start with advanced course (Certified Courses)";
            }
            else
            {
                echo $i."on 10 . You can start with expert course (Certified Courses)";
            }
        }
?>