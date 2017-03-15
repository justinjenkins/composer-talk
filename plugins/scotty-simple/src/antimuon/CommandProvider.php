<?php
	
	namespace antimuon;
	
	use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
	use Symfony\Component\Console\Input\InputArgument;
	use Symfony\Component\Console\Input\InputDefinition;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Output\OutputInterface;
	use Composer\Command\BaseCommand;
	
	class CommandProvider implements CommandProviderCapability {
		
		public function getCommands() {
			return array(new Command);
		}
		
	}
	
	class Command extends BaseCommand {
		
		protected function configure() {
			$this->setName('scotty')
				->setDescription("The Alpha Quadrant's best engineer.")
				->addOption('person',  null, InputOption::VALUE_REQUIRED, 'Tell Scotty to target a person')
				->addOption('beam-up', null, InputOption::VALUE_NONE, 'Ask Scotty to beam up something');
		}
		
		protected function execute(InputInterface $input, OutputInterface $output) {
			$output->writeln("Aye, sir?");
		}
		
	}
	
	?>