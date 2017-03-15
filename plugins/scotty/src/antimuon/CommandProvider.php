<?php
	
	namespace antimuon;
	
	use antimuon\Crew;
	use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
	use Symfony\Component\Console\Style\SymfonyStyle;
	use Symfony\Component\Console\Input\InputArgument;
	use Symfony\Component\Console\Input\InputDefinition;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Output\OutputInterface;
	use Symfony\Component\Console\Question\ChoiceQuestion;
	use Symfony\Component\Console\Helper\ProgressBar;
	use Composer\Command\BaseCommand;
	
	class CommandProvider implements CommandProviderCapability {
		
		public function getCommands() {
			return array(new Command);
		}
		
	}
	
	class Command extends BaseCommand {
		
		private $inputInterface;
		private $outputInterface;
		private $io;
		private $optBeamUp;
		private $optWarp;
		
		protected function configure() {
			$this->setName('scotty')
				->setDescription("The Alpha Quadrant's best engineer.")
				->addOption('beam-up', null, InputOption::VALUE_NONE, 'Ask Scotty to beam up something')
				->addOption('warp', null, InputOption::VALUE_REQUIRED, 'Ask Scotty warp')
			;
		}
		
		protected function execute(InputInterface $input, OutputInterface $output) {

			$this->inputInterface = $input;
			$this->outputInterface = $output;
			
			// options passsed to the command
			$this->optBeamUp = $this->inputInterface->getOption('beam-up');
			$this->optWarp = $this->inputInterface->getOption('warp');
			
			// using SymfonyStyle for io
			$this->io = new SymfonyStyle($input, $output);
			
			$this->io->title("Aye, welcome to Scotty.");
			
			$output->writeln("Starting up ...\n");

			// play a sound on start up (this works on a mac)
			shell_exec('afplay ~/Talks/Extending\ Composer/tos_com_beep_1.mp3 -t 2 2>&1');
			
			// if --warp is passed
			if ($this->optWarp) {
				// create a new instance of the ship's engine
				$engine = new Systems\Engines();
				// set the warp factor based on what was passed into the command
				$response = $engine->setWarpFactor($this->optWarp);
				// return the response from Scotty
				$output->writeln("<bg=yellow;fg=black;options=bold>{$response}</>\n");
			}
			
			// if --beam-up is passed
			if ($this->optBeamUp) {
				$this->beam();
			}
			
		}
		
		private function beam() {
			
			$helper = $this->getHelper('question');
			
			// setup our choices
			$who_to_beam_up = new ChoiceQuestion(
				'Aye, who shall I beam yee up?',
				array('Kirk', 'McCoy', 'Spock','Uhura')
			);
			
			$who_to_beam_up->setErrorMessage("%s? ".Crew\Scotty::rephrase());
			
			$answer = $helper->ask($this->inputInterface, $this->outputInterface, $who_to_beam_up);

			$this->io->newLine();
			
			// set which crew member based on the answer
			$crewMember =  "antimuon\\Crew\\{$answer}";
			
			// do the beam up!
			$this->doBeam(new $crewMember);
			
		}
	
		private function doBeam($crewMember) {
			
			if ($crewMember->name == "McCoy") {
				
				$response  = "{$crewMember->name} said: \"I signed on this ship to practice medicine, ";
				$response .= "not to have my atoms scattered back and forth across space by this gadget.\"";
				
				$this->io->error($response);
				
				return false;
				
			} else {
				
				// create a new progress bar (3 units)
				$progress = new ProgressBar($this->outputInterface, 3);
				$progress->setFormat('[%bar%] %percent:3s%% ');
				
				// start and displays the progress bar
				$progress->start();
				
				$i = 0;
				while ($i++ < 3) {
					sleep(1);
					$progress->advance();
				}
				
				$progress->finish();
				
				$this->io->newLine(2);
				
				$this->io->success("Aye, I beamed up {$crewMember->name}!");
				
			}
			
			return true;
			
		}
		
	}

?>