<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepoInterface {

    public function create(array $attributes): Model;

    public function fetchAll(): Collection;

    public function fetchById(int $id): Model;

    public function update(array $params, int $id): Model;

    public function delete(int $id): bool;

}