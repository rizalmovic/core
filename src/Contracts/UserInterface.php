<?php

namespace Rizalmovic\Core\Contracts;

interface UserInterface extends BaseInterface
{
    public function current();
    public function findByEmail($email);
    public function findByUsername($username);
    public function updatePassword($user, $data);
}