<?= "<?php\n" ?>

namespace App\Utils;

class <?= $service_class_name ?>

{

    /**
     * @param array $input
     * @return int
     */
    public function execute(array $input) : int
    {
        throw new \Exception('Missing implementation');
    }

    /**
     * @param array $input
     * @return int
     */
    public function executeExtra(array $input) : int
    {
        throw new \Exception('Missing implementation');
    }
}
