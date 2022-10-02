<?php

namespace App\Http\Resources\Logs;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Logs\Request as RequestModel;

class ErrorTopicWithOccurrences extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $currentHour = date('H') + 1;
        $startTimestamp = strtotime("Y-m-d " . $currentHour < 10 ? '0' + $currentHour : $currentHour . ":00:00");
        $endTimestamp = $startTimestamp - 3600;

        for ($i = 0; $i < 24; $i++) {
            $requests = RequestModel::select('id')
                ->where('created_at', '<', date('Y-m-d H:i:s', $startTimestamp))
                ->where('created_at', '>=', date('Y-m-d H:i:s', $endTimestamp))
                ->where('error_topic_id', $this->id)
                ->get();
            $occurrences[] = [
                'start' => date('H', $startTimestamp),
                'end' => date('H', $endTimestamp),
                'number' => $requests->count(),
            ];
            $occursNumbers[] = $requests->count();

            $startTimestamp -= 3600;
            $endTimestamp -= 3600;
        }

        $max = max($occursNumbers);
        foreach ($occurrences as $key => $occur) {
            try {
                $occurrences[$key]['percentage'] = ($occur['number'] * 100 / $max);
                if($occurrences[$key]['percentage'] === 0) $occurrences[$key]['percentage'] = 1;
            } catch (\Throwable $th) {
                $occurrences[$key]['percentage'] = 1;
            }
        }

        return [
            'uuid' => $this->uuid,
            'code' => $this->code,
            'message' => $this->message,
            'error' => $this->error,
            'file' => $this->file,
            'line' => $this->line,
            'last_day' => array_sum($occursNumbers),
            'seen' => $this->seen,
            'occurrences' => array_reverse($occurrences),
        ];
    }
}
