<?php

namespace App\Repositories\Event;

use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;

class EventRepository implements EventRepositoryInterface
{
    public function all(): Collection
    {
        return Event::all();
    }

    public function find(int $id): Event
    {
        return Event::query()->findOrFail($id);
    }

    public function create(array $data): Event
    {
        return Event::query()->create($data);
    }

    public function update(Event $event, array $data): Event
    {
        $event->update($data);

        return $event;

    }
    public function delete(Event $event): bool
    {
        return $event->delete();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Event::paginate($perPage);
    }

    public function search(?string $search): \Illuminate\Pagination\LengthAwarePaginator|AbstractPaginator
    {
        return Event::query()
            ->when($search, fn($query) =>
            $query->where('name', 'LIKE', "%{$search}%")
            )
            ->paginate(10)
            ->withQueryString();
    }
}
