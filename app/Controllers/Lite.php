<?php

namespace ehr\Controllers;

class Lite
{
    public function home(){

        return view("welcome", ["users" => ["pythonleet", "pyxoon", "mama sobede", "daraluv"]]);
    }
}