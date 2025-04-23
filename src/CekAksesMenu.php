<?php

namespace Idaravel\KlienApijurnal;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Idaravel\SqlBuilder\Sql;

class CekAksesMenu
{
    public function handle(Request $request, Closure $next)
    {
        $namaRoute = request()->route()->getName();

        $routeTanpaDiCek = [
            'login', 'index.login', 'index.auth',
            'index.logout', 'index.dashboard'
        ];

        if(in_array($namaRoute, $routeTanpaDiCek)){
          return $next($request);
        }

        $roleID = Session::get('role_id');
        if(!$roleID){
          return $next($request);
        }

        $namaMenu = Sql::UserMenuSub()->one(['routename' => $namaRoute]);
        if($namaMenu == null){
          return $next($request);
        }

        $cek = Sql::UserMenuAccess()->alias("a")
        ->whereRaw("json_contains(cast(a.sub_menu_id as json), '".$namaMenu->id."')")
        ->where('a.role_id', $roleID)
        ->one();

        if($cek == null){
          abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
