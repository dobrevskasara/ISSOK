<?php

namespace App\Repositories\Organizer;

use App\Models\Organizer;
use App\Repositories\Organizer\OrganizerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class OrganizerRepository implements OrganizerRepositoryInterface
{
    public function all(): Collection
    {
        return Organizer::all();
    }

    public function find(int $id): Organizer
    {
        return Organizer::query()->findOrFail($id);
    }

    public function create(array $data): Organizer
    {
        return Organizer::query()->create($data);
    }

    public function update(Organizer $organizer, array $data): Organizer
    {
        $organizer->update($data);

        return $organizer;

    }
    public function delete(Organizer $organizer): bool
    {
        return $organizer->delete();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Organizer::paginate($perPage);
    }

    public function search(?string $search)
    {
        return Organizer::query()
            ->when($search, fn($query) =>
            $query->where('name', 'LIKE', "%{$search}%")
            )
            ->paginate(10)
            ->withQueryString();
    }
}
