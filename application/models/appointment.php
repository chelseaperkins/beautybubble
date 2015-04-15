<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Appointment
 *
 * @author chelsea.perkins
 */
class Appointment extends MY_Model {
    
        
   /** @var int */
    public $id;
   /** @var string */
    public $facial_treatments;
    /** @var string */
    public $eye_treatments;
    /** @var string */
    public $body_treatments;
    /** @var string */
    public $spray_tanning;
    /** @var string */
    public $nail_treatments;
    /** @var string */
    public $waxing_treatments;
    /** @var string */
    public $electrolysis;
    /** @var string */
    public $date;
    /** @var datetime */
    public $time;
    /** @var datetime */
    public $status;
    /** @var boolean */
    
}

