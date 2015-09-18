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
use pocketmine\inventory\PlayerInventory;
use pocketmine\item\Item;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\Player;

abstract class ArenaManager{

    public $plugin;

    public function __construct(Arena $plugin){
        $this->plugin = $plugin;
    }

    public function getArenaPlayers(){
        $players = [];
        foreach($this->plugin->players as $name => $p){
            $players[$name] = $p["ins"];
        }
    }

    public function messageArenaPlayers($message){
        foreach($this->plugin->players as $p){
            $p["ins"]->sendMessage($message);
        }
    }

    public function inArena(Player $p){
        return isset($this->plugin->players[strtolower($p->getName())]) ? true : false;
    }

    public function isArenaFull(){
        return $this->getArenaPlayers() >= $this->plugin->data["max_players"] ? true : false;
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
        $find = false;
        $i = 0;
        while($find = false){
            foreach($this->plugin->positions as $key => $pos){
                if($pos === $i){
                    $this->plugin->positions[$key]++;
                    $find = $this->plugin->data["join_positions"][$key];
                }
            }
            $i++;
        }
        return new Position($find->x, $find->y, $find->z, $this->plugin->level);
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

    public function saveInv(Player $p){
        $this->plugin->players[strtolower($p->getName())]['inv'] = new VirtualInventory($p);
        $p->getInventory()->clearAll();
        $p->getInventory()->sendContents($p);
    }

    public function loadInv(Player $p){
        $inv = $p->getInventory();
        $inv->clearAll();
        $items = $this->plugin->players[strtolower($p->getName())]['inv'];
        $inv->setContents($items->getContents());
        $inv->setArmorContents($items->armor);
        for($i = 0; $i < 10; $i++){
            $inv->setHotbarSlotIndex($items->hotbar[$i], $i);
        }
        $inv->sendContents($p);
    }
}