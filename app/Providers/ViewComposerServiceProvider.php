<?php

namespace App\Providers;

use DB;

use App\Post;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.sidebar', function($view){
            $view->with('pinned', Post::where('pinned', '=', '1')->first());
            $popular = DB::select( "SELECT p.id, p.title, p.slug, pv.hits
                                    FROM posts p
                                    LEFT JOIN (
                                        SELECT post_id, COUNT(id) AS hits
                                        FROM post_views
                                        WHERE created_at > curdate() - INTERVAL DAYOFWEEK(curdate())+1 MONTH
                                        GROUP BY post_id
                                    ) pv ON p.id = pv.post_id
                                    ORDER BY pv.hits DESC
                                    LIMIT 5
                                    "
                                );
            $view->with('popular', $popular);
        });
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
