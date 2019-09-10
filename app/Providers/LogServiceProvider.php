<?php

namespace App\Providers;

use Auth;
use Event;
use App\Models\Log;
use Illuminate\Support\ServiceProvider;

class LogProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('eloquent.created: *', function($data,$data2) {
            $this->save_event('crear',$data2);
        });

        Event::listen('eloquent.updated: *', function($data,$data2) {
            $this->save_event('actualizar',$data2);
        });

        Event::listen('eloquent.deleting: *', function($data,$data2) {
            $this->save_event('borrar',$data2);
        });
    }
    
    private function save_event($event,$data)
    {
      $table_name = $data[0]->getTable();

      $id_user = Auth::check() ? Auth::id() : null;
       
      $log = [
        'user_id'     => $id_user,
        'table'       => $table_name,
        'action'      => $event,
        'data'        => json_encode($data)
        ];

      Log::create($log);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
