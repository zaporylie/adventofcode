<?php

namespace App\Maker;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\MakerBundle\MakerInterface;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use NumberFormatter;

class MakeDay implements MakerInterface
{
    public static function getCommandName(): string
    {
        return 'make:day';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConf)
    {
        $command
            ->setDescription('Creates files for a new day.')
            ->addArgument('number', InputArgument::REQUIRED, 'Select a day number');
        ;
    }

    public function interact(InputInterface $input, ConsoleStyle $io, Command $command)
    {
    }

    public function getParameters(InputInterface $input): array
    {
        $number = trim($input->getArgument('number'));
        \App\Maker\Validator::numeric($number);

        // Spellout.
        $spellout = (new NumberFormatter('en_US', NumberFormatter::SPELLOUT))->format($number);

        // Ordinal.
        $formatter = (new NumberFormatter('en_US', NumberFormatter::SPELLOUT));
        $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");
        $ordinal = $formatter->format($number);

        // Generate command class name.
        $commandClassName = Str::asClassName('Day' . ucfirst($spellout), 'Command');
        Validator::validateClassName($commandClassName);
        // Generate command test class name.
        $commandTestClassName = Str::asClassName('Day' . ucfirst($spellout), 'CommandTest');
        Validator::validateClassName($commandTestClassName);
        // Generate command class name.
        $commandExtraClassName = Str::asClassName('Day' . ucfirst($spellout), 'ExtraCommand');
        Validator::validateClassName($commandExtraClassName);
        // Generate command test class name.
        $commandExtraTestClassName = Str::asClassName('Day' . ucfirst($spellout), 'ExtraCommandTest');
        Validator::validateClassName($commandExtraTestClassName);
        // Generate service class name.
        $serviceClassName = Str::asClassName('Day' . ucfirst($spellout), 'Service');
        Validator::validateClassName($serviceClassName);
        // Generate service test class name.
        $serviceTestClassName = Str::asClassName('Day' . ucfirst($spellout), 'ServiceTest');
        Validator::validateClassName($serviceTestClassName);

        return [
            'number' => $number,
            'spellout' => $spellout,
            'ordinal' => $ordinal,
            'command_name' => "app:day:$spellout",
            'command_extra_name' => "app:day:$spellout:extra",
            'command_class_name' => $commandClassName,
            'command_extra_class_name' => $commandExtraClassName,
            'command_test_class_name' => $commandTestClassName,
            'command_extra_test_class_name' => $commandExtraTestClassName,
            'service_class_name' => $serviceClassName,
            'service_test_class_name' => $serviceTestClassName,
        ];
    }

    public function getFiles(array $params): array
    {
        return [
            __DIR__.'/../Resources/skeleton/Command.tpl.php' => 'src/Command/'.$params['command_class_name'].'.php',
            __DIR__.'/../Resources/skeleton/CommandExtra.tpl.php' => 'src/Command/'.$params['command_extra_class_name'].'.php',
//            __DIR__.'/../Resources/skeleton/CommandTest.tpl.php' => 'tests/Command/'.$params['command_test_class_name'].'.php',
            __DIR__.'/../Resources/skeleton/Service.tpl.php' => 'src/Utils/'.$params['service_class_name'].'.php',
            __DIR__.'/../Resources/skeleton/ServiceTest.tpl.php' => 'tests/Utils/'.$params['service_test_class_name'].'.php',
        ];
    }

    public function writeNextStepsMessage(array $params, ConsoleStyle $io)
    {
        $io->text([
            'Good job. Now you can solve today\'s task'
        ]);
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
        $dependencies->addClassDependency(
            Command::class,
            'console'
        );
//        $dependencies->addClassDependency(
//            TestCase::class,
//            'phpunit'
//        );
    }
}
