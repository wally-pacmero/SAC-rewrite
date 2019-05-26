<?php
declare(strict_types=1);
namespace DarkWav\SAC;

use pocketmine\utils\TextFormat;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\Player;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\TaskScheduler;

use DarkWav\SAC\Analyzer;
use DarkWav\SAC\Main;
class KickTask extends Task
{
  public $Main;
  public $Message;
  public $Player;

  public function __construct(Main $mn, Player $plr, $msg)
  {
    $this->Main    = $mn;
    $this->Message = $msg;
    $this->Player  = $plr;
  }
  public function onRun(int $currentTick) : void
  {
    if ($this->Player != null && $this->Player->isOnline())
    {
      $this->Player->close("", TextFormat::ESCAPE.$this->Main->Colorized . $this->Message);
      $name = $this->Player->getName();
      $msg = "[SAC] > $name was kicked for Cheating. I am always watching you.";
      $this->Main->server->broadcastMessage(TextFormat::ESCAPE.$this->Main->Colorized . $msg);
    }
  }
}
