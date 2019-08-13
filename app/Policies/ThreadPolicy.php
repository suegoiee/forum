<?php

namespace App\Policies;

use App\User;
use App\Models\Thread;
use App\Models\Permission;
use App\Models\CategoryProduct;

class ThreadPolicy
{
    const UPDATE = 'update';
    const DELETE = 'delete';
    const SUBSCRIBE = 'subscribe';
    const UNSUBSCRIBE = 'unsubscribe';
    const ISVIP = 'isvip';

    public function update(User $user, Thread $thread): bool
    {
        return $thread->isAuthoredBy($user);
    }

    public function delete(User $user, Thread $thread): bool
    {
        return $thread->isAuthoredBy($user) || $user->isModerator() || $user->isAdmin();
    }

    public function subscribe(User $user, Thread $thread): bool
    {
        return ! $thread->hasSubscriber($user) && $thread->isAuthoredBy($user);
    }

    public function unsubscribe(User $user, Thread $thread): bool
    {
        return $thread->hasSubscriber($user) && $thread->isAuthoredBy($user);
    }

    public function isvip(User $user, Thread $thread, object $products): bool
    {
        $purchased = $user->Products();
        $vip = false;
        if(empty($products[0])){
            $vip = true;
        }
        else{
            foreach ($purchased as $purchase) {
                foreach($products as $product){
                    if(($purchase['productRelation']['id'] === $product['product_id'] && strtotime($purchase['deadline']) > time()) || ($purchase['productRelation']['id'] === $product['product_id'] && $purchase['deadline'] == null)){
                        $vip = true;
                        break 2;
                    }
                }
            }
        }
        return $vip || $user->isAdmin();
    }
}
