<?php
class Validator {
    protected $subjects;
    protected $currentsubject;
    protected $state;
    protected $generalstate = true;

    public function validate($name, $subject){
        $this->subjects[$name] = $subject;
        $this->currentsubject = $name;
        $this->state[$name] = true;
        return $this;
    }

    public function regex($pattern){
        if (!preg_match($pattern."u", $this->subjects[$this->currentsubject])) {
            $this->state[$this->currentsubject] = false;
            $this->generalstate = false;
        }
        return $this;
    }

    public function len($left, $right){
        if (strlen($this->subjects[$this->currentsubject]) < $left || strlen($this->subjects[$this->currentsubject]) > $right){
            $this->state[$this->currentsubject] = false;
            $this->generalstate = false;
        }
        return $this;
    }

    public function setInvalid($name){
        $this->state[$name] = false;
        $this->generalstate = false;
        return $this;
    }

    public function invalid($name = ""){
        if ($name)
            return $this->state[$name];
        else 
            return $this->state[$this->currentsubject];
    }
    public function valid($name = ""){
        if ($name)
            return $this->state[$name];
        else 
            return $this->state[$this->currentsubject];
    }

    public function oneResult(){
        return $this->generalstate;
    }

    public function result(){
        return $this->state;
    }

    public function jsonResult(){
        return json_encode($this->state);
    }

    public function subjects(){
        return $this->subjects;
    }

    public function jsonSubjects(){
        return json_encode($this->subjects);
    }

    public function invalidList(){
        $invalidlist = array();
        foreach(array_keys($this->state) as $key){
            if($this->state[$key] == false){
                array_push($invalidlist, $key);
            }
        }
        return $invalidlist;
    }
}