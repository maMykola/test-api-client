<?php

namespace AppBundle\Utils;

class RemoteServer
{
    const API_URL_ALL_GROUPS = '/users/group';
    const API_URL_FIND_GROUP = '/users/group/{id}';

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
     * Return response from 
     *
     * @param  string   $path
     * @param  integer  $id
     * @param  array    $post_data
     * @return array
     * @author Mykola Martynov
     **/
    private function getJsonResponse($path, $id = null, $post_data = null)
    {
        $api_url = 'http://' . $this->hostname . '/api' . str_replace('{id}', $id, $path);
        $content = @file_get_contents($api_url);
        
        try {
            $response = json_decode($content, true);
        } catch (\Exceptino $ex) {
            return null;
        }

        return $response;
    }

    /**
     * Return list of available user groups.
     *
     * @return array
     * @author Mykola Martynov
     **/
    public function allGroups()
    {
        return $this->getJsonResponse(self::API_URL_ALL_GROUPS);
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
        return $this->getJsonResponse(self::API_URL_FIND_GROUP, $id);
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
