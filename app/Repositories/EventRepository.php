<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\Event;

class EventRepository extends Repository
{
    protected $model;

    public function __construct(Event $model)
    {
        $this->model = $model;
    }


    public function paginate($perPage = 15)
    {
        return $this->model->all();
    }


    /**
     * @param Event $event
     * @param array $files
     */
    public function saveImages(Event $event, array $files)
    {
        $eventImages = [];
        for ($i = 0; $i < count($files); $i++) {
            $eventImages[] = [
                'file' => $files[$i],
                'event_id' => $event->getAttribute('id')
            ];
        }
        $event->images()->insert($eventImages);
    }


    /**
     * @param array $removedIndex
     * @param array $files
     * @return array
     */
    public function prepareImageToSave(array $removedIndex, array $files): array
    {
        if ($files)
            return array_diff($files, $removedIndex);
        return [];

    }


    /**
     * @param Event $event
     * @param array $ticketTypeIds
     * @param array $rates
     */
    public function storeEventPricing(Event $event, array $ticketTypeIds, array $rates)
    {
        $pricing = [];
        for ($i = 0; $i < count($ticketTypeIds); $i++) {
            $pricing[] = [
                'event_id' => $event->getAttribute('id'),
                'ticket_type_id' => $ticketTypeIds[$i],
                'rate' => $rates[$i]
            ];
        }
        $event->pricing()->insert($pricing);
    }

    public function getAllEvents()
    {
        return $this->getModel()
            ->with('pricing','eventType')
            ->orderByDesc('created_at')
            ->paginate(20);
    }


}
