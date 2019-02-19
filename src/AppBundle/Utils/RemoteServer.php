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
        // !!! stub
        // !!! mockup
        return [
            ['id' => 11, 'name' => 'Desingers'],
            ['id' => 9, 'name' => 'Developer'],
            ['id' => 10, 'name' => 'IT'],
        ];
    }

    /**
     * Return information about user group for given identifier.
     *
     * @param  integer  $id
     * @return array
     * @author Mykola Martynov
     **/
    public function findGroup($id)
    {
        // !!! stub
        // !!! mockup
        foreach ($this->allGroups() as $group) {
            if ($group['id'] == $id) {
                break;
            }
        }

        if (empty($group) || $group['id'] != $id) {
            return null;
        }

        switch ($id) {
            case 11:
                $users = [
                    ['name' => 'John Doe', 'email' => 'john.doe@example.com'],
                    ['name' => 'Ben Laden', 'email' => 'ben.laden@example.com'],
                ];
                break;

            case 9:
                $users = [
                    ['name' => 'John Vue', 'email' => 'john.vue@example.com'],
                    ['name' => 'Sam Deniels', 'email' => 'sam.deniels@example.com'],
                ];
                break;

            case 10:
                $users = [
                    ['name' => 'Mikel Fox', 'email' => 'mikel.fox@exaple.com'],
                ];
                break;

            default:
                $users = [];
                break;
        }

        $group['users'] = $users;

        return $group;
    }
}
