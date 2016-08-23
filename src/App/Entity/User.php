<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 23/08/16
 * Time: 20:54
 */

namespace App\Entity;

/**
 * Class User
 * @package App\Entity
 */
class User
{
    protected $id;
    protected $username;
    protected $email;

    /**
     * User constructor.
     * @param $username
     * @param $email
     */
    public function __construct($username, $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
}
