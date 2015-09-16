<?php
/**
 * Created by PhpStorm.
 * User: Honza
 * Date: 16. 9. 2015
 * Time: 16:45
 */

namespace SurvivalGames\Arena;


use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Player;
use SurvivalGames\SurvivalGames;

class Arena extends ArenaManager implements Listener{

    public $plugin;
    public $game = 0; //0 = waiting, 1 = starting, 2 = playing, 3 = deathmatch
    public $players = [];
    public $id;
    public $data;
    public $level;

    public function __construct(SurvivalGames $plugin, $id, $data){
        parent::__construct($this);
        $this->plugin = $plugin;
        $this->id = $id;
        $this->data = $data;
        $this->plugin->getServer()->getScheduler()->scheduleRepeatingTask(new ArenaSchedule($this), 20);
    }

    public function joinToArena(Player $p){

    }

    public function leaveArena(Player $p){

    }

    public function startGame(){

    }

    public function stopGame(){

    }

    public function onBlockBreak(BlockBreakEvent $e){
        $p = $e->getPlayer();
    }

    public function onBlockPlace(BlockPlaceEvent $e){
        $p = $e->getPlayer();
    }

    public function onMove(PlayerMoveEvent $e){
        $p = $e->getPlayer();
    }

    public function onChat(PlayerChatEvent $e){
        $p = $e->getPlayer();
    }

    public function onHit(EntityDamageEvent $e){

    }

    public function onQuit(PlayerQuitEvent $e){

    }
}