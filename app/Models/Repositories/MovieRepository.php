<?php

namespace App\Models\Repositories;

use App\Models\Movie;
use App\Services\OpenAiService;

class MovieRepository
{
    protected $table;

    public function __construct()
    {
        $this->table = new Movie;
    }

    public function createMovies(int $total)
    {
        $openAi = new OpenAiService();
        $records = $openAi->requestMovieData($total);
        $recordsArray = json_decode($records, true);
        $now = now()->toDateTimeString();

        foreach ($recordsArray as $record) {
            $record['created_at'] = $now;
            $this->table->insert($record);
        }
    }
}
