<?= "<?php\n" ?>

namespace App\Utils;

class <?= $service_class_name ?>

{

    /**
     * @param string $input
     * @return int
     */
    public function execute(string $input) : int
    {
        throw new \Exception('Missing implementation');
    }

    /**
     * @param string $input
     * @return int
     */
    public function executeExtra(string $input) : int
    {
        throw new \Exception('Missing implementation');
    }
}
