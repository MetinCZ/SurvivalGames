<?php

namespace SurvivalGames;

//© 2015 PocketMineDevelopers Team

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use SurvivalGames\Arena\Arena;
use SurvivalGames\Arena\Messages;

class SurvivalGames extends PluginBase{

    public $arenas = [];
    public $messagesManager;
    public $cfg;
    public $msg;

    public function onEnable(){
        $this->initConfig();
        $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML);
        $this->messagesManager = new Messages($this);
        $this->loadArenas();
    }

    public function onDisable(){

    }

    private function registerArena($arena, $data){
        $this->arenas[$arena] = new Arena($this, $arena, $data);
    }

    private function loadArenas(){
        $this->getLogger()->info("checking arena files...");
        foreach(glob($this->getDataFolder()."arenas/*.yml") as $file){
            $cfg = new Config($file, Config::YAML);
            $fname = basename($file, ".yml");
            if(!$this->checkSettings($cfg)){
                $this->getLogger()->error("Arena \"$fname\" is not set properly");
                continue;
            }
            $this->registerArena($cfg->get("name"), $cfg->getAll());
            $this->getLogger()->info("$fname - ".TextFormat::GREEN."checking sucessful");
        }
    }

    private function checkSettings(Config $cfg){
        foreach($cfg->getAll() as $key => $index){
            switch($key){
                case "world":
                    if(!$this->getServer()->isLevelGenerated($index)){
                        $this->getServer()->generateLevel($index);
                    }
                    break;
                case "area_pos1":
                    foreach($index as $key1 => $index1){
                        switch($key){
                            case "x":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                            case "y":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                            case "z":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                        }
                    }
                    break;
                case "are_pos2":
                    foreach($index as $key1 => $index1){
                        switch($key){
                            case "x":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                            case "y":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                            case "z":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                        }
                    }
                    break;
                case "sign":
                    foreach($index as $key1 => $index1){
                        switch($key1){
                            case "join_sign":
                                foreach($index1['join_sign'] as $key2 => $index2){
                                    switch($key2){
                                        case "x":
                                            if(!is_numeric($index2)){
                                                return false;
                                            }
                                            break;
                                        case "y":
                                            if(!is_numeric($index2)){
                                                return false;
                                            }
                                            break;
                                        case "z":
                                            if(!is_numeric($index2)){
                                                return false;
                                            }
                                            break;
                                    }
                                }
                                break;
                            case "allow_status":
                                if($index1 != "true" && $index1 != "false"){
                                    return false;
                                }
                                break;
                        }
                    }
                    break;
                case "leave_position":
                    foreach($index as $key1 => $index1){
                        switch($key1){
                            case "x":
                                if(!is_numeric($index2)){
                                    return false;
                                }
                                break;
                            case "y":
                                if(!is_numeric($index2)){
                                    return false;
                                }
                                break;
                            case "z":
                                if(!is_numeric($index2)){
                                    return false;
                                }
                                break;
                        }
                    }
                    break;
                case "refill":
                    if($index != "true" && $index != "false"){
                        return false;
                    }
                    break;
                case "interval":
                    if(!is_numeric($index)){
                        return false;
                    }
                    break;
                case "refill_items":
                    foreach($index as $key1 => $index1){
                        if(!is_array($index1)){
                            continue;
                        }
                        foreach($index1 as $index2){
                            if(!is_numeric($index2)){
                                return false;
                            }
                        }
                    }
                    break;
                case "spawn_positions":
                    foreach($index as $key1 => $index1){
                        if(!is_array($index1)){
                            continue;
                        }
                        foreach($index1 as $index2){
                            if(!is_numeric($index2)){
                                return false;
                            }
                        }
                    }
                    break;
                case "time":
                    if($index != "cycle" && $index != "night" && $index != "day" && !is_numeric($index)){
                        return false;
                    }
                    break;
                case "lightning":
                    if($index != "true" && $index != "false"){
                        return false;
                    }
                    break;
                case "lightning_delay":
                    if(!is_numeric($index)){
                        return false;
                    }
                    break;
                case "lightning_interval":
                    if(!is_numeric($index)){
                        return false;
                    }
                    break;
                case "deathmatch":
                    if($index != "true" && $index != "false"){
                        return false;
                    }
                    break;
                case "use_spawn_positions":
                    if($index != "true" && $index != "false"){
                        return false;
                    }
                    break;
                case "deathmatch_position":
                    foreach($index as $index1){
                        if(!is_numeric($index1)){
                            return false;
                        }
                    }
                    break;
                case "max_players":
                    if(!is_numeric($index)){
                        return false;
                    }
                    break;
                case "min_players":
                    if(!is_numeric($index)){
                        return false;
                    }
                    break;
                case "vote":
                    if($index != "true" && $index != "false"){
                        return false;
                    }
                    break;
                case "vote_players_count":
                    if(!is_numeric($index)){
                        return false;
                    }
                    break;
            }
        }
        return true;
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){

    }

    public function getPlayerArena(Player $p){

    }

    public function getArena($arena){

    }

    public function initConfig(){
        if(!file_exists($this->getDataFolder())){
            @mkdir($this->getDataFolder());
        }
        if(!is_file($this->getDataFolder()."config.yml")){
            $this->saveResource("config.yml");
        }
        $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML);
        if(!file_exists($this->getDataFolder()."arenas/")){
            @mkdir($this->getDataFolder()."arenas/");
            $this->saveResource("arenas/default.yml");
        }
        if(!file_exists($this->getDataFolder()."languages/")){
            @mkdir($this->getDataFolder()."languages/");
        }
        if(!is_file($this->getDataFolder()."languages/English.yml")){
            $this->saveResource("languages/English.yml");
        }
        if(!is_file($this->getDataFolder()."languages/Czech.yml")){
            $this->saveResource("languages/Czech.yml");
        }
        if(!is_file($this->getDataFolder()."languages/{$this->cfg->get('Language')}.yml")){
            $this->msg = new Config($this->getDataFolder()."languages/English.yml", Config::YAML);
            $this->getServer()->getLogger()->info("Selected language English");
        }
        else{
            $this->msg = new Config($this->getDataFolder()."languages/{$this->cfg->get('Language')}.yml", Config::YAML);
            $this->getServer()->getLogger()->info("Selected language {$this->cfg->get('Language')}");
        }
    }
}
