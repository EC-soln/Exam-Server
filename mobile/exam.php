<?php
/*
 * request: subject code, year
 * returns: list of exams
 * request: subject code, booklet code
 */
require_once('../classes/Exam.php');
require_once("../classes/DB.php");
require_once("../classes/Subject.php");
require_once("../classes/Question.php");
if(isset($_POST['subject']) && isset($_POST['year'])){
    $subject=$_POST['subject'];
    $year=$_POST['year'];
    $exams=Exam::getExamByYear($subject,$year);
    if($exams==false){
        die("false");
    }

    $exam=$exams[0];
    $booklet=$exam->booklet;
    $id=$exam->id;
    $questions=Exam::getQuestionsFromDate($id);
    if($questions==false)
        die("false");
    $count=count($questions);
    $result="";
    for($i=0;$i<$count;$i++){
        $result=$result."".$questions[$i]->question."--".$questions[$i]->answer."--".$questions[$i]->choicea."--".$questions[$i]->choiceb."--".$questions[$i]->choicec."--".$questions[$i]->choiced."--".$questions[$i]->id.";;";
        
    }
    die($result);
}
