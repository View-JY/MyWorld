<?php

namespace App\Observers;

use App\Models\WorkTopic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class WorkTopicObserver
{
    public function saving(WorkTopic $workTopic)
    {
        $workTopic ->abstract = make_excerpt($workTopic ->body);
    }
}
