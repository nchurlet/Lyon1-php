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
     * Saves the user to the database.
     *
     * @param \App\Users\Entity\User $user
     */
    public function save($user)
    {
        $userData = array(
            'username' => $user->getUsername(),
            'mail' => $user->getMail(),
            'role' => $user->getRole(),
        );
        // If the password was changed, re-encrypt it.
        if (strlen($user->getPassword()) != 88) {
            $userData['salt'] = uniqid(mt_rand());
            $userData['password'] = $this->encoder->encodePassword($user->getPassword(), $userData['salt']);
        }
        if ($user->getId()) {
            // If a new image was uploaded, make sure the filename gets set.
            $newFile = $this->handleFileUpload($user);
            if ($newFile) {
                $userData['image'] = $user->getImage();
            }
            $this->db->update('users', $userData, array('user_id' => $user->getId()));
        } else {
            // The user is new, note the creation timestamp.
            $userData['created_at'] = time();
            $this->db->insert('users', $userData);
            // Get the id of the newly created user and set it on the entity.
            $id = $this->db->lastInsertId();
            $user->setId($id);
            // If a new image was uploaded, update the user with the new
            // filename.
            $newFile = $this->handleFileUpload($user);
            if ($newFile) {
                $newData = array('image' => $user->getImage());
                $this->db->update('users', $newData, array('user_id' => $id));
            }
        }
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
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('users', 'u');

       $statement = $queryBuilder->execute();
       $usersData = $statement->fetchAll();

       return $usersData;
   }
}
