<?php
/**
 * Created by PhpStorm.
 * User: Honza
 * Date: 16. 9. 2015
 * Time: 17:19
 */

namespace SurvivalGames\Arena;


use SurvivalGames\SurvivalGames;

class Messages{

    public $plugin;

    public function __construct(SurvivalGames $plugin){
        $this->plugin = $plugin;
    }

    public function getMsg($msg){

    }

    public function getPrefix(){

    }
}