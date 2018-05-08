<?php

require_once('DB.php');
class Parser
{
    public static $question=false;
    public static $answer=false;
    public static $choicea=false;
    public static $choiceb=false;
    public static $choicec=false;
    public static $choiced=false;

    static function createExam($path,$booklet,$subject,$exam_date){
        Parser::parse($path);
        if(Parser::$question==false || count(Parser::$question)<1){
            die("Path: ".$path."    Question: ".Parser::$question);
            return false;
        }
        $query1="insert into exam(booklet,subject,exam_date) values(?,?,?)";
        $db=new DB();
        $stmt=$db->connect()->prepare($query1);
        $stmt->bind_param('sss',$booklet,$subject,$exam_date);
        $r=$stmt->execute();
        $id=$stmt->insert_id;
        $stmt->close();
        $count=count(Parser::$question);
        for($i=0;$i<$count;$i++){
            $query="insert into question(exam_id,no,question,choicea,choiceb,choicec,choiced,answer) values(?,?,?,?,?,?,?,?)";
            $db=new DB();
            $stmt=$db->connect()->prepare($query);
            $no=$i+1;
            $stmt->bind_param('iissssss',$id,$no,Parser::$question[$i],Parser::$choicea[$i],Parser::$choiceb[$i],Parser::$choicec[$i],Parser::$choiced[$i],Parser::$answer[$i]);
            $stmt->execute();
        }
    }
    static function parse($path){
        $fh = fopen($path,'r');
        $question=false;
        $optiona=false;
        $optionb=false;
        $optionc=false;
        $optiond=false;
        $answer=false;
        $i=0;
        while ($line = fgets($fh)) {
            if(!empty($line)){
                $c=substr($line,0,1);
                if(is_numeric($c)==true){
                    $index=strpos($line,".");

                    $question[$i]=substr($line,$index+1);
                }
                else{
                    $ch=substr($line,0,2);
                    switch($ch){
                        case "A.":
                            $optiona[$i]=trim(substr($line,2));
                            //$i++;
                            break;
                        case "B.":
                            $optionb[$i]=trim(substr($line,2));
                            //$i++;
                            break;
                        case "C.":
                            $optionc[$i]=trim(substr($line,2));
                            //$i++;
                            break;
                        case "D.":
                            $optiond[$i]=trim(substr($line,2));
                            //$i++;
                            break;
                        case "A,":
                            $optiona[$i]=trim(substr($line,2));
                            //$i++;
                            break;
                        case "B,":
                            $optionb[$i]=trim(substr($line,2));
                            //$i++;
                            break;
                        case "C,":
                            $optionc[$i]=trim(substr($line,2));
                            //$i++;
                            break;
                        case "D,":
                            $optiond[$i]=trim(substr($line,2));
                            //$i++;
                            break;
                        case "An":
                            $ans=explode(":",$line);
                            $answer[$i]=trim($ans[1]);
                            $i++;
                        case "an":
                            $ans=explode(":",$line);
                            $answer[$i]=trim($ans[1]);
                            $i++;
                            break;
                    }
                }
            }
        }
        Parser::$question=$question;
        Parser::$answer=$answer;
        Parser::$choicea=$optiona;
        Parser::$choiceb=$optionb;
        Parser::$choicec=$optionc;
        Parser::$choiced=$optiond;
        fclose($fh);
    }
}