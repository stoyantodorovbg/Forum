<?php

namespace App\Forms;

use App\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\ThrottleException;
use App\Notifications\YouWereMentioned;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create', new Reply);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required|spamfree',
        ];
    }

    /**
     * @param Thread $thread
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function persist(Thread $thread)
    {
        $reply = $thread->addReply([
            'title' => request('body'),
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        preg_match_all('/\@([^\s\.\,\!\?\:\;]+)/', $reply->body, $matches);
        $names = $matches[1];

        foreach ($names as $name) {
            $user = User::whereName($name)->first();

            if ($user) {
                $user->notify(new YouWereMentioned($reply));
            }
        }

        return $reply->load('owner');
    }

    /**
     * @throws ThrottleException
     */
    protected function failedAuthorization()
    {
        throw new ThrottleException('You are replying too frequently.');
    }
}
