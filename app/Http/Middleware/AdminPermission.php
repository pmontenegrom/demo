<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;

use Closure;
use Auth;
use View;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Application Permissions Here!
        $controller = explode('/', Route::getCurrentRoute()->getPath())[1];
        $method     = explode('@', Route::getCurrentRoute()->getActionName())[1];

        $module = \App\AdmModule::where('controller', $controller)->first();
        
        if(!$module){
            //redirect to error page
            return redirect('admin/home/notfound');
        }

        switch ($method) {
            case 'store':
            case 'update':
            case 'sort':
            case 'destroy':
                $action=\App\AdmAction::where('alias', 'administrar')->first();
                break;
            default:
                $action=\App\AdmAction::where('alias', 'listar')->first();
                break;
        }

        $user=\App\User::find(Auth::user()->id);
        $profile=$user->profile;
        $event=\App\AdmEvent::where('module_id', $module->id)->where('action_id', $action->id)->first();
        $permission=\App\AdmPermission::where('event_id', $event->id)->where('profile_id', $profile->id)->first();

        if(!$permission && $profile->sa!='1'){
            //redirect to error page
            return redirect('admin/home/permission');
        }

        View::share('current_module', $module);

        return $next($request);
    }
}
