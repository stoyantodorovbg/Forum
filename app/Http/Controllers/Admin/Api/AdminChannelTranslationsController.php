<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Traits\CheckUserRights;
use App\Models\ChannelTranslation;
use App\Http\Controllers\Controller;

class AdminChannelTranslationsController extends Controller
{
    use CheckUserRights;

    /**
     * Store new channel translation
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->authenticate('Channel',__FUNCTION__, true);

        $translation = new ChannelTranslation($request->all());

        $translation->save();

        return [
            'translations' => ChannelTranslation::where('channel_id', $request->channel_id)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Update a channel translation
     *
     * @param ChannelTranslation $channelTranslation
     * @return array
     */
    public function update(ChannelTranslation $channelTranslation)
    {
        $this->authenticate('Channel',__FUNCTION__, true);

        $channelTranslation->update(request()->all());

        $channelId = $channelTranslation->channel->id;

        return [
            'translations' => ChannelTranslation::where('channel_id', $channelId)
                ->with('language')
                ->get()
        ];
    }

    /**
     * Delete a channel translation
     *
     * @param ChannelTranslation $channelTranslation
     * @return array
     * @throws \Exception
     */
    public function destroy(ChannelTranslation $channelTranslation)
    {
        $this->authenticate('Channel',__FUNCTION__, true);

        $channelId = $channelTranslation->channel->id;
        $channelTranslation->delete();

        return [
            'translations' => ChannelTranslation::where('channel_id', $channelId)
                ->with('language')
                ->get()
        ];
    }
}
