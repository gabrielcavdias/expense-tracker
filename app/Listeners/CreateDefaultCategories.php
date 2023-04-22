<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Category;

class CreateDefaultCategories
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        Category::create([
            "title" => "Alimentação",
            "color" => "#ff0000",
            "icon" => "fa-solid fa-utensils",
            "type" => "expense",
            "user_id"=>$event->user->id]);
        
        Category::create([
            "title" => "Salário",
            "color" => "#10B981",
            "icon" => "fas fa-dollar-sign",
            "type" => "income",
            "user_id"=> $event->user->id]);

        Category::create([
            "title" => "Outros",
            "color" => "#090818",
            "icon" => "fa-solid fa-ellipsis",
            "type" => "expense",
            "user_id" => $event->user->id,
        ]);
    }
}
