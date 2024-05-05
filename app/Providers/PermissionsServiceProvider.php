<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;


class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try{
            Permission::get()->map(function($permission){
                Gate::define($permission->slug, function($user) use($permission){
                    return $user->hasPermissionTo($permission);
                });
            });
        }catch(\Exception $e){
            report($e);
            
        }

        // create blade directive 
        Blade::directive('role',function($role){
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) { ?>";
        });

        Blade::directive('endrole',function($role){
            return "<?php } ?>";
        });
    }
    }

