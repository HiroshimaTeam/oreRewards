<?php
namespace oreRewards\Refaltor\Commands;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use oreRewards\Refaltor\Register;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\Config;

class reward extends Command {
    private $plugin;
    public function __construct(Register $plugin)
    {
        parent::__construct("reward");
        $this->plugin = $plugin;
        $this->setUsage("/reward");
        $this->setDescription(Register::getInstance()->getConfig()->get("description_command"));
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $cfg = Register::getInstance()->getConfig();
        $config = new Config($this->plugin->getDataFolder() . $sender->getName() . ".yml", Config::YAML);
        if ($sender instanceof Player) {
            $amount = $config->get("rewards");
            $form = new SimpleForm(function (Player $sender, $data = null) {
                $result = $data;
                if ($result === null) {
                    return;
                }
                if($result === 0) {
                    switch ($result) {
                        case 0:
                            $config = new Config($this->plugin->getDataFolder() . $sender->getName() . ".yml", Config::YAML);
                            $amount = $config->get("rewards");
                            if($amount <= 0) {
                                $sender->sendMessage(Register::getInstance()->getConfig()->get("message_not_reward"));
                            } else {
                                $config->set("rewards", 0);
                                $config->save();
                                EconomyAPI::getInstance()->addMoney($sender, $amount);
                                $sender->sendMessage(str_replace("{amount}", $amount, Register::getInstance()->getConfig()->get("message_remove_rewards")));
                            }
                            break;
                        case 1:
                            break;
                    }

                }
                return;
            });
            $form->setTitle($cfg->get("Title_ui"));
            $form->setContent(str_replace("{rewards}", $amount, $cfg->get("Content_ui")));
            $form->addButton($cfg->get("Button_1_ui")); # remove
            $form->addButton($cfg->get("Button_2_ui")); # let
            $sender->sendForm($form);
        }
    }
}