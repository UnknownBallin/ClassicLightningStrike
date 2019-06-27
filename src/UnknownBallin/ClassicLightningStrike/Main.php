<?php

namespace UnknownBallin\ClassicLightningStrike;

use pocketmine\Player;
use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\network\mcpe\protocol\AddEntityPacket;

class Main extends PluginBase implements Listener{

	public function onEnable():void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	public function addStrike(Player $player){
		$level=$player->getLevel();
		$strike=new AddEntityPacket();
		$strike->type=93;
		$strike->entityRuntimeId=Entity::$entityCount++;
		$strike->metadata=array();
		$strike->position=$player->asVector3()->add(0, $height = 0);
		$strike->yaw=$player->getYaw();
		$strike->pitch=$player->getPitch();
		$this->getServer()->broadcastPacket($level->getPlayers(), $strike);
	}
	public function onDeath(PlayerDeathEvent $event){
		$player=$event->getPlayer();
		$this->addStrike($player);
	}
}
