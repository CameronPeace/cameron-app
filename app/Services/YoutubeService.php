<?php

namespace App\Services;

use App\Exceptions\YoutubeServiceException;
use App\Services\Helpers\YoutubeRequest;

class YoutubeService
{

    /**
     * The youtube request instance utilitzed to make requests to Youtube's Api.
     *
     * @var YoutubeRequest
     */
    private $youtubeRequest;

    public function __construct(YouTubeRequest $youtubeRequest = null)
    {
        $this->setYoutubeRequest($youtubeRequest ?? new YouTubeRequest());
    }

    public function getYoutuberContent(string $handle, $results = 3)
    {

        $channelId = $this->getChannelId($handle);

        $params = [
            'maxResults' => $results,
            'channelId' => $channelId, //Bushy's channel ID https://www.youtube.com/@Bushy
            'order' => 'date'
        ];

        try {
            $content = $this->youtubeRequest->requestContent($params);
            \Log::info($content);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    /**
     * Pull youtube channel data by the channel handle.
     * Right now this is only pulling the ID but we can expand this function to get more channel data as we need it.
     * @param string $handle
     *
     * @return void
     */
    public function getChannelDataByHandle(string $handle = 'Bushy')
    {
        $params = [
            'part' => 'id',
            'forHandle' => $handle,
        ];

        try {
            $content = $this->youtubeRequest->requestChannelData($params);
            \Log::info($content);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    /**
     * Return a youtubers channel ID. We will edit this function to query the database once we figure out how we want to save our data.
     */
    public function getChannelId(string $handle)
    {
        $channelData = $this->getChannelDataByHandle($handle);

        try {
            $channelData = $this->getChannelDataByHandle($handle);

            // TODO lets see what this returns when the data isn't found.
            if (empty($channelData['body']['items'])) {
                throw new YoutubeServiceException('Could not find channel data.');
            }

            return $channelData['body']['items'][0]['id'];
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
    /**
     * Set our youtube request instance.
     *
     * @param YoutubeRequest $youtubeRequest
     *
     * @return void
     */
    public function setYoutubeRequest(YoutubeRequest $youtubeRequest)
    {
        $this->youtubeRequest = $youtubeRequest;
    }

    /**
     * Get our youtube request instance.
     *
     * @return YoutubeRequest.
     */
    public function getYoutubeRequest()
    {
        return $this->youtubeRequest;
    }
}
