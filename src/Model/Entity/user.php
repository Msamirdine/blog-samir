<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher as AuthDefaultPasswordHasher;

class User extends Entity
{
    protected function _setPassword(string $password): ?string {
        $hasher = new AuthDefaultPasswordHasher();
        return $hasher->hash($password);
    }

}