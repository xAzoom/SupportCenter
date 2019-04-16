<?php

namespace AppBundle\Security;

use AppBundle\Entity\User;
use DbBundle\Services\IDbManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterUser
{
    const DEFAULT_ROLE = 'ROLE_USER';

    /**
     * @var IDbManager
     */
    private $dbManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(IDbManager $dbManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->dbManager = $dbManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function register($data)
    {
        $data['roles'] = json_encode([self::DEFAULT_ROLE]);
        $data['password'] = $this->passwordEncoder->encodePassword(new User(), $data['password']);
        $this->dbManager->insert('users', $data);
    }
}