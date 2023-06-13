<?php

use App\Models\AdminModel;
use App\Models\InnerSidebarModel;
use App\Models\SidebarModel;
use App\Models\UserAccessModel;
use Illuminate\Support\Facades\Crypt;



if (!function_exists('getuserdetail')) {
    function getuserdetail($string)
    {
        $sess = session('admin_login');
        return $sess[$string] ?? '';
    }
}

// get sidebar dynamic
if (!function_exists('getsidebar')) {
    function getsidebar()
    {
        $det = SidebarModel::where('flag','!=','2')->get();
        $mainarr = array();

        if (!empty($det)) {
            foreach ($det as $value) {

                $subarr = array();
                $menu = InnerSidebarModel::where('navigation_id', $value['id'])->where('flag','!=','2')->get();

                if (!empty($menu)) {
                    foreach ($menu as $sidemenu) {

                        if(getuserdetail('role') == 1) {
                            array_push($subarr, array('id' => $sidemenu->id, 'navigation_id' => $sidemenu->navigation_id, 'inner_menu' => $sidemenu->inner_menu, 'slug' => $sidemenu->slug));
                        }else{
                            $exist = UserAccessModel::where('menu','inner')->where('user_id',getuserdetail('id'))->where('nav_id',$sidemenu->id)->where('read_per','1')->first();
                            if(!empty($exist)) {
                                array_push($subarr, array('id' => $sidemenu->id, 'navigation_id' => $sidemenu->navigation_id, 'inner_menu' => $sidemenu->inner_menu, 'slug' => $sidemenu->slug));    
                            }
                        }                        
                    }
                }

                if(getuserdetail('role') == 1) {
                    array_push($mainarr, array('id' => $value['id'], 'icon' => $value['icon'], 'menu' => $value['menu'], 'slug' => $value['slug'], 'innermenu' => $subarr));
                }else{
                    $exist = UserAccessModel::where('menu','main')->where('user_id',getuserdetail('id'))->where('nav_id',$value['id'])->where('read_per','1')->first();
                    if(!empty($exist) || !empty($subarr)) {
                        array_push($mainarr, array('id' => $value['id'], 'icon' => $value['icon'], 'menu' => $value['menu'], 'slug' => $value['slug'], 'innermenu' => $subarr));
                    }
                }
            }
        }

        return $mainarr;
    }
}

// check access
function checkaccess($module, $access, $navmaininner)
{
    if (getuserdetail('role') != 1) {
        $exist = UserAccessModel::where('user_id', getuserdetail('id'))->where('nav_id', $module)->where($access, '1')->where('menu', $navmaininner)->count();
        if ($exist > 0) {
            return true;
        }
        return false;
    }

    return true;
}

 function decrypt_new($string)
    {
         $decrypt= Crypt::decryptString($string);
         return $decrypt;
    }
