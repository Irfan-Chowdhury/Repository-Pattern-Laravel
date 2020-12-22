<?php

namespace App\Repositories;

interface CustomerRepositoryInterface
{
    public function all();
    
    public function findById($customerI);

    // public function update($customerI);
    
    // public function delete($customerI);
}