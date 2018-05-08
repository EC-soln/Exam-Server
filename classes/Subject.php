<?php

require_once('DB.php');
class Subject
{
    var $subjectCode;
    var $subject;
    Var $maxTime;
    static function fromSubjectCode($code){
        $query="select subject,exam,max_time from subject where subject=?";
        $db=new DB();
        $stmt=$db->connect()->prepare($query);
        $stmt->bind_param('s',$code);
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close();
        if($row=$result->fetch_assoc()){
            $subject=$row['subject'];
            $exam=$row['exam'];
            $max_time=$row['max_time'];
            $x=new Subject();
            $x->subject=$exam;
            $x->subjectCode;
            $x->maxTime=$max_time;
            return $x;
        }
        return false;
    }
}