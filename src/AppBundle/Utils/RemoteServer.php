<?php

namespace AppBundle\Utils;

class RemoteServer
{
    /**
     * Holds remote server hostname.
     *
     * @var array
     **/
    private $hostname;

    /**
     * undocumented function
     *
     * @return void
     * @author Mykola Martynov
     **/
    static public function getInstance($hostname)
    {
        $instance = new self();
        $instance->hostname = $hostname;

        return $instance;
    }

    /**
     * Return list of available user groups.
     *
     * @return array
     * @author Mykola Martynov
     **/
    public function allGroups()
    {
        // !!! mockup
        return [
            ['id' => 11, 'name' => 'Desingers'],
            ['id' => 9, 'name' => 'Developer'],
            ['id' => 10, 'name' => 'IT'],
        ];
    }
}
