<?php
//
//namespace App\Repositories\Organizer;
//use App\Models\Organizer;
//use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Database\Eloquent\Collection;
//
//interface OrganizerRepositoryInterface
//{
//    public function paginate(int $perPage = 10): LengthAwarePaginator;
//
//    public function all(): Collection;
//
//    public function find(int $id): Organizer;
//
//    public function create(array $data): Organizer;
//
//    public function update(Organizer $organizer, array $data): Organizer;
//
//    public function delete(Organizer $organizer): bool;
//
//}


namespace App\Repositories\Organizer;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Organizer;
use Illuminate\Database\Eloquent\Collection;

interface OrganizerRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): Organizer;

    public function create(array $data): Organizer;

    public function update(Organizer $organizer, array $data): Organizer;

    public function delete(Organizer $organizer): ?bool;
    public function search(?string $search);
}
