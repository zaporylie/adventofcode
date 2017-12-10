<?= "<?php\n" ?>

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Utils\<?= $service_class_name ?>;

class <?= $command_extra_class_name ?> extends Command
{
    protected static $defaultName = '<?= $command_extra_name ?>';

    /**
     * @var \App\Utils\<?= $service_class_name ?>

     */
    protected $service;

    /**
     * {@inheritdoc}
     */
    public function __construct(<?= $service_class_name ?> $service)
    {
        $this->service = $service;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            // ->addArgument('input', InputArgument::REQUIRED)
            // ->addArgument('filepath')
            // ->addOption('input', null, InputOption::VALUE_OPTIONAL, 'Provide data directly')
            ->setDescription('Runs <?= $ordinal ?> extra task.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $answer = $this->service->executeExtra(); // @todo: Provide input.
        $io->success($answer);
    }
}
