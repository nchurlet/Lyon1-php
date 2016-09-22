<?php

namespace App\Users\Repository;

use App\Users\Entity\User;
use Doctrine\DBAL\Connection;

/**
 * User repository.
 */
class UserRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;
    /**
     * @var \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder
     */
    protected $encoder;
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

   /**
    * Returns a collection of users.
    *
    * @param int $limit
    *   The number of users to return.
    * @param int $offset
    *   The number of users to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    *
    * @return array A collection of users, keyed by user id.
    */
   public function getAll()
   {
       //  $userEntityList = array();

       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('users', 'u');

       $statement = $queryBuilder->execute();
       $usersData = $statement->fetchAll();
       foreach ($usersData as $userData) {
           $userEntityList[$userData['id']] = $this->buildUser($userData);
       }

       return $userEntityList;
   }

    protected function buildUser($userData)
    {
        $user = new User();
        $user->setId($userData['id']);
        $user->setNom($userData['nom']);
        $user->setPrenom($userData['prenom']);

        return $user;
    }
}
