<?php

namespace Rizalmovic\Core\Contracts;

interface UserInterface extends BaseInterface
{
    public function findByEmail($email);
    public function findByUsername($username);
}