<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\BlockService;
use Illuminate\Database\{Eloquent\ModelNotFoundException, QueryException};
use Illuminate\Http\RedirectResponse;

class BlockUserController
{
    protected $blockService;

    public function __construct(BlockService $blockService){
        $this->blockService = $blockService;
    }

    public function blockUser(User $user): RedirectResponse{
        // look for blockedUsers if there are none then block $user If there is a record then unblock
        $id = Auth()->user()->id;

        try{

            if($user->id === $id){
                throw new \Exception('You cannot block yourself!');
            }

            $blockedUser = $this->blockService->getBlockedUser($user);

            if(!$blockedUser){
                Auth()->user()->blockedUsers()->attach($user->id);
                $this->blockService->deleteConversationAndMessages($user);
            } else{
                Auth()->user()->blockedUsers()->detach($user->id);
            }
            return redirect()->route('create.profileTweets', ['id'=>$id]);

        } catch (QueryException $e) {
            return redirect()->back()->withErrors('query', 'There is an error' . ' ' . $e->getMessage());
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors('model', 'There is an error' . ' ' . $e->getMessage());
        }

    }

}

