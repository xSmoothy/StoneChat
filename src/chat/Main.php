<?php
namespace chat;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\event\block\BlockBreakEvent;
use pockemine\inventory\Inventory;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{
	
		public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("EloWiad enabled.");
		}
	
  public function BlockBreak(BlockBreakEvent $event){
	  if($event->getBlock()->getId() == 1) {
    $breakdata = new Config($this->getDataFolder() . "/zniszczone.yml", Config::YAML);
        $name = $event->getPlayer()->getDisplayName();
        $breaks = $breakdata->get($name);
        $breakdata->set($name,$breaks+1);
		        $breakdata->save();
  }
  }
  	public function onJoin(PlayerJoinEvent $event){
	$player = $event->getPlayer()->getName();
        $breakdata = new Config($this->getDataFolder() . "/zniszczone.yml", Config::YAML);
        $breaks = $breakdata->get($player);
	if($breakdata->exists($player)){
	}
	else{
	$breakdata->set($player, "0");
	$breakdata->save();
			}
	}
  public function onChat(PlayerChatEvent $event){
	  $player = $event->getPlayer();
	  $nick = $event->getPlayer()->getDisplayName();
	        $breakdata = new Config($this->getDataFolder() . "/zniszczone.yml", Config::YAML);
            $breaks = $breakdata->get($nick);
        if($breaks >= 500 or $player->hasPermission("admin.admin")) {	
		} 
		else{
			$event->setCancelled(true);
			$player->sendMessage("§f• §7Aby pisać na chacie musisz wykopać:§e " . $breaks . "§7/§e500§7 kamienia! §f• ");
  }
}
}
