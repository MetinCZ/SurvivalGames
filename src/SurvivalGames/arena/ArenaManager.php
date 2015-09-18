<?php
/**
 * Created by PhpStorm.
 * User: Honza
 * Date: 16. 9. 2015
 * Time: 16:50
 */

namespace SurvivalGames\Arena;


use pocketmine\block\Block;
use pocketmine\block\Chest;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\Player;

class ArenaManager{

    public $plugin;

    public function __construct(Arena $plugin){
        $this->plugin = $plugin;
    }

    public function getArenaPlayers($ingame = false){

    }

    public function messageAllPlayers($message){

    }

    public function inArena(Player $p){
        return isset($this->plugin->players[strtolower($p->getName())]) ? true : false;
    }

    public function isArenaFull(){

    }

    public function checkAlive(){

    }

    public function refillChests(){
        foreach($this->plugin->chests as $chest){
            $tile = $this->plugin->level->getTile(new Vector3($chest->x, $chest->x, $chest->z));
            if($tile instanceof \pocketmine\tile\Chest){
                $inv = $tile->getInventory();
                $inv->clearAll();
            }
        }
    }

    public function lightning(){

    }

    public function getNextJoinPos(){

    }

    public function getMaxPlayers(){
        return intval($this->plugin->data['max_players']);
    }

    public function getSpawnPositions(){
        return $this->data['spawn_positions'];
    }

    public function findChests(){
        for($x = $this->plugin->data["area_pos1"]["x"]; $x <= $this->plugin->data["area_pos2"]["x"]; $x++){
            for($y = $this->plugin->data["area_pos1"]["y"]; $y <= $this->plugin->data["area_pos2"]["y"]; $y++){
                for($z = $this->plugin->data["area_pos1"]["z"]; $z <= $this->plugin->data["area_pos2"]["z"]; $z++){
                    if($this->plugin->level->getBlockIdAt($x, $y, $z) === Block::CHEST){
                        $this->plugin->chests[] = new Vector3($x, $y, $z);
                    }
                }
            }
        }
    }

    public function setTime(){
        switch($this->plugin->data["time"]){
            case "day":
                $this->plugin->level->setTime(5000);
                $this->plugin->level->stopTime();
                break;
            case "night":
                $this->plugin->level->setTime(999999);
                $this->plugin->level->stopTime();
                break;
            case "cycle":
                $this->plugin->level->setTime(0);
                break;
            default:
                $this->plugin->level->setTime($this->plugin->data["time"]);
                break;
        }
    }
}