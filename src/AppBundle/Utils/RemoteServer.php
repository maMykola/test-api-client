<?php

namespace AppBundle\Utils;

class RemoteServer
{
    const API_URL_ALL_GROUPS = '/users/group';
    const API_URL_FIND_GROUP = '/users/group/{id}';
    const API_URL_CREATE_GROUP = '/users/group/create';
    const API_URL_UPDATE_GROUP = '/users/group/{id}/update';
    const API_URL_DELETE_GROUP = '/users/group/{id}/delete';

    const API_URL_ALL_USERS = '/users';
    const API_URL_CREATE_USER = '/users/create';
    const API_URL_FIND_USER = '/users/{id}';
    const API_URL_UPDATE_USER = '/users/{id}/update';
    const API_URL_DELETE_USER = '/users/{id}/delete';

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
        if (!empty($post_data)) {
            $data = http_build_query($post_data);
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => ['Content-Type: application/x-www-form-urlencoded', 'Content-Length: ' . strlen($data)],
                    'content' => $data,
                ],
            ]);
        } else {
            $context = null;
        }

        $api_url = 'http://' . $this->hostname . '/api' . str_replace('{id}', $id, $path);
        $content = @file_get_contents($api_url, false, $context);
        
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
        return $this->getJsonResponse(self::API_URL_CREATE_GROUP, null, ['name' => $group_name]);
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
        return $this->getJsonResponse(self::API_URL_UPDATE_GROUP, $group_id, $data);
    }

    /**
     * Return status of user group deletion.
     *
     * @param  integer  $group_id
     * @return array
     * @author Mykola Martynov
     **/
    public function deleteGroup($group_id)
    {
        return $this->getJsonResponse(self::API_URL_DELETE_GROUP, $group_id);
    }

    /**
     * Return list of all users from remote server.
     *
     * @return array
     * @author Mykola Martynov
     **/
    public function allUsers()
    {
        return $this->getJsonResponse(self::API_URL_ALL_USERS);
    }

    /**
     * Return status of user creation.
     *
     * @param  array  $user_info
     * @return array
     * @author Mykola Martynov
     **/
    public function createUser($user_info)
    {
        return $this->getJsonResponse(self::API_URL_CREATE_USER, null, $user_info);
    }

    /**
     * Return information about user from remote server
     *
     * @param  integer  $user_id
     * @return array
     * @author Mykola Martynov
     **/
    public function findUser($user_id)
    {
        return $this->getJsonResponse(self::API_URL_FIND_USER, $user_id);
    }

    /**
     * Return status of user update.
     *
     * @param  integer  $user_id
     * @param  array    $data
     * @return array
     * @author Mykola Martynov
     **/
    public function updateUser($user_id, $data)
    {
        return $this->getJsonResponse(self::API_URL_UPDATE_USER, $user_id, $data);
    }

    /**
     * Return status of user deletion on remote server.
     *
     * @param  integer  $user_id
     * @return array
     * @author Mykola Martynov
     **/
    public function deleteUser($user_id)
    {
        return $this->getJsonResponse(self::API_URL_DELETE_USER, $user_id);
    }
}
