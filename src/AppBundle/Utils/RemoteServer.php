<?php

namespace AppBundle\Utils;

class RemoteServer
{
    const API_URL_ALL_GROUPS = '/users/group';

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
     * Return remote url with the given path.
     *
     * @param  string   $path
     * @param  integer  $id
     * @return string
     * @author Mykola Martynov
     **/
    private function getUrl($path, $id = null)
    {
        $url = 'http://' . $this->hostname . '/api' . str_replace('{id}', $id, $path);
        return $url;
    }

    /**
     * Return list of available user groups.
     *
     * @return array
     * @author Mykola Martynov
     **/
    public function allGroups()
    {
        $api_url = $this->getUrl(self::API_URL_ALL_GROUPS);
        $content = @file_get_contents($api_url);
        
        try {
            $groups = json_decode($content, true);
        } catch (\Exceptino $ex) {
            return null;
        }

        return $groups;
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

    /**
     * Return status of user group creation.
     *
     * @param  string  $group_name
     * @return array
     * @author Mykola Martynov
     **/
    public function createGroup($group_name)
    {
        // !!! stub
        // !!! mockup
        return [
            'status' => 'failed',
            'error' => 'unexpected',
        ];
    }

    /**
     * Return status of user group update.
     *
     * @param  integer  $group_id
     * @param  array    $data
     * @return array
     * @author Mykola Martynov
     **/
    public function updateGroup($group_id, $data)
    {
        // !!! stub
        // !!! mockup
        return [
            'status' => 'failed',
            'error' => 'unexpected',
        ];
    }
}
