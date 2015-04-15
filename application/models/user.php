<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author chelsea.perkins
 */
class User extends MY_Model{
    /** @var int */
    public $id;
   /** @var string */
    public $first_name;
    /** @var string */
    public $last_name;
    /** @var string */
    public $email;
}
