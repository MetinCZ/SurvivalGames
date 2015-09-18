<?php
/**
 * Created by PhpStorm.
 * User: Honza
 * Date: 16. 9. 2015
 * Time: 17:19
 */

namespace SurvivalGames\Arena;


use pocketmine\utils\Config;
use SurvivalGames\SurvivalGames;

class Messages{

    public $plugin;
    private $cfg;

    public function __construct(SurvivalGames $plugin){
        $this->plugin = $plugin;
        $this->cfg = $this->plugin->msg;
    }

    public function getMsg($msg){
        return str_replace("&", "§", $this->cfg[$msg]);
    }
}