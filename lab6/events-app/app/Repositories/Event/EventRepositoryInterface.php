<?php

namespace App\Repositories\Event;
use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface EventRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function all(): Collection;

    public function find(int $id): Event;

    public function create(array $data): Event;

    public function update(Event $event, array $data): Event;

    public function delete(Event $event): bool;

    public function search(?string $search);
}
