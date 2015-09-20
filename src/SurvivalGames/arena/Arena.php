<?php

// Main arena Class
// © PocketMineDevelopers 2015

namespace SurvivalGames\Arena;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Player;
use SurvivalGames\SurvivalGames;
use SurvivalGames\Event\PlayerJoinArenaEvent;

class Arena extends ArenaManager implements Listener{

    public $plugin;
    public $game = 0; //0 = waiting, 1 = starting, 2 = playing, 3 = deathmatch
    public $players = [];
    public $queue = [];
    public $name;
    public $data;
    public $level;
    public $msg;
    public $chests = [];

    public $positions;

    public function __construct(SurvivalGames $plugin, $name, $data){
        parent::__construct($this);
        $this->plugin = $plugin;
        $this->name = $name;
        $this->data = $data;
        $this->positions = array_fill(1, count($this->getSpawnPositions()), 0);
        $this->msg = $this->plugin->messagesManager;
        $this->plugin->getServer()->loadLevel($this->data["world"]);
        $this->findChests();
        $this->plugin->getServer()->getScheduler()->scheduleRepeatingTask(new ArenaSchedule($this), 20);
    }

    public function joinToArena(Player $p, $arena_name){
        if($this->game[$arena_name] >= 1){
            $p->sendMessage($this->msg->getMsg("already_running"));
        }
        if($this->isArenaFull() && !$p->isOp() && !$p->hasPermission("sg.full")){
            $p->sendMessage($this->msg->getMsg("arena_full")); //full arena
            return;
        }
        $this->players[strtolower($p->getName())]["ins"] = $p;
        $this->saveInv($p);
        $p->teleport($this->getNextJoinPos());
        $this->messageArenaPlayers("");
    }

    public function leaveArena(Player $p){

    }

    public function startGame(){

    }

    public function startDeathMatch(){
        $this->game = 1;
    }

    public function stopGame(){
        $this->game = 0;
    }

    public function onInteract(PlayerInteractEvent $e){
        $p = $e->getPlayer();
        if($e->getAction() === $e::LEFT_CLICK_BLOCK){

        }
    }

    public functon onJoin(PlayerJoinArenaEvent $e){
     if ($e->getArena() == $this->name){
     $this->joinToArena($e->getPlayer());   
     }
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
