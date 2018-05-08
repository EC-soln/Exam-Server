<?php

require_once("DB.php");
class Exam
{
    var $id;
    var $booklet;
    var $subject;
    var $exam_date;
    function __construct()
    {
    }
    static function createNew($booklet,$subject,$exam_date){
        $query="insert into exam(booklet,subject,exam_date) values(?,?,?)";
        $db=new DB();
        $stmt=$db->connect()->prepare($query);
        $stmt->bind_param('iis',$booklet,$subject,$exam_date);
        $r=$stmt->execute();
        $id=$stmt->insert_id;
        $stmt->close();
        $exam=new Exam();
        $exam->id=$id;
        $exam->booklet=$booklet;
        $exam->subject=$subject;
        $exam->exam_date=$exam_date;
        return $exam;
    }
    static function fromId($id){
        $query="select id,booklet,subject,exam_date from exam where id=?";
        $db=new DB();
        $stmt=$db->connect()->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close();
        $exam=false;
        if($row=$result->fetch_assoc()){
            $id=$row['id'];
            $booklet=$row['booklet'];
            $subject=$row['subject'];
            $exam_date=$row['exam_date'];
            $exam=new Exam();
            $exam->id=$id;
            $exam->booklet=$booklet;
            $exam->subject=$subject;
            $exam->exam_date=$exam_date;
            return $exam;
        }
        else{
            return false;
        }

    }
    static function getExam($subject){
        $query="select id,booklet,subject,exam_date from exam where subject=?";
        $db=new DB();
        $stmt=$db->connect()->prepare($query);
        $stmt->bind_param('s',$subject);
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close();
        $exams=false;
        $i=0;
        while($row=$result->fetch_assoc()){
            $id=$row['id'];
            $booklet=$row['booklet'];
            $subject=$row['subject'];
            $exam_date=$row['exam_date'];
            $exam=new Exam();
            $exam->id=$id;
            $exam->booklet=$booklet;
            $exam->subject=$subject;
            $exam->exam_date=$exam_date;
            $exams[$i]=$exam;
            $i++;
        }
        return $exams;
    }
    static function getExamByBooklet($subject,$booklet){
        $query="select id,booklet,subject,exam_date from exam where subject=? and booklet=?";
        $db=new DB();
        $stmt=$db->connect()->prepare($query);
        $stmt->bind_param('s',$subject);
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close();
        $exams=false;
    }
    static function getAllQuestions($id){
        $query="select id,no,question,choicea,choiceb,choicec,choiced,answer from question where exam_id=?";
        $db=new DB();
        $stmt=$db->connect()->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close();
        $questions=false;
        $i=0;
        while($row=$result->fetch_assoc()){
            $id=$row['id'];
            $no=$row['no'];
            $question=$row['question'];
            $choicea=$row['choicea'];
            $choiceb=$row['choiceb'];
            $choicec=$row['choicec'];
            $choiced=$row['choiced'];
            $answer=$row['answer'];
            $q=new Qeustion();
            $q->id=$id;
            $q->no=$no;
            $q->question=$question;
            $q->choicea=$choicea;
            $i++;
        }
    }
    static function getQuestions($subject,$booklet,$date){
        $query="select id,booklet,subject,exam_date from exam where subject=? and booklet=?";
        $db=new DB();
        $stmt=$db->connect()->prepare($query);
        $stmt->bind_param('ss',$subject,$booklet);
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close();
        $id=false;
        if($row=$result->fetch_assoc()){
            $id=$row['id'];
        }
        else{
            return false;
        }
        $query2="select id,no,question,choicea,choiceb,choicec,choiced,answer from question where exam_id=?";
        $db=new DB();
        $stmt=$db->connect()->prepare($query2);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close();
        $questions=false;
        $i=0;
        while($row=$result->fetch_assoc()){
            $qid=$row['id'];
            $question=$row['question'];
            $choicea=$row['choicea'];
            $choiceb=$row['choiceb'];
            $choicec=$row['choicec'];
            $choiced=$row['choiced'];
            $answer=$row['answer'];
            $no=$row['no'];
            $question=new Question();
            $question->question=$row['question'];
            $question->choicea=$choicea;
            $question->choiceb=$choiceb;
            $question->choicec=$choicec;
            $question->choiced=$choiced;
            $question->no=$no;
            $question->answer=$answer;
            $question->id=$qid;
            $question->exam_id=$id;
            $questions[$i]=$question;
            $i++;
        }
        return $questions;

    }
    static function getQuestionsFromDate($id){

        $query2="select id,no,question,choicea,choiceb,choicec,choiced,answer from question where exam_id=?";
        $db=new DB();
        $stmt=$db->connect()->prepare($query2);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close();
        $questions=false;
        $i=0;
        while($row=$result->fetch_assoc()){
            $qid=$row['id'];
            $question=$row['question'];
            $choicea=$row['choicea'];
            $choiceb=$row['choiceb'];
            $choicec=$row['choicec'];
            $choiced=$row['choiced'];
            $answer=$row['answer'];
            $no=$row['no'];
            $question=new Question();
            $question->question=$row['question'];
            $question->choicea=$choicea;
            $question->choiceb=$choiceb;
            $question->choicec=$choicec;
            $question->choiced=$choiced;
            $question->no=$no;
            $question->answer=$answer;
            $question->id=$qid;
            $question->exam_id=$id;
            $questions[$i]=$question;
            $i++;
        }
        return $questions;

    }
    static function getExamByYear($subject,$year){
        $query="select id from exam where subject=? and YEAR(exam_date)=?";
        $db=new DB();
        $stmt=$db->connect()->prepare($query) or die(mysqli_error($db->connect()));
        $stmt->bind_param('ss',$subject,$year);
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close();
        $i=0;
        $searchResult=false;
        while($row=$result->fetch_assoc()){
            $id=$row['id'];
            $exam=Exam::fromId($id);
            $searchResult[$i]=$exam;
            $i++;
        }
        return $searchResult;
    }
}