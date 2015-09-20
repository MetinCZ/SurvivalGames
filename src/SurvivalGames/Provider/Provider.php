<?php

namespace SurvivalGames\Provider;

use pocketmine\Player;

interface Provider{

    public function init();

    public function addWin(Player $p);

    public function addLoss(Player $p);

    public function addKill(Player $p);

    public function addDeath(Player $p);
}