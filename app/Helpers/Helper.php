<?php


namespace App\Helpers;


use Carbon\Carbon;
use function PHPUnit\Framework\at;
use function Termwind\ValueObjects\underline;

class Helper
{
        public static function menus($menus, $parent_id = 0, $char = '')
        {
                $html = '';

                foreach ($menus as $key => $menu){
                    if ($menu->parent_id == $parent_id){
                        $html .= '
                           <tr>
                             <td>' . $menu->id .'</td>
                             <td>' . $char . $menu->name .'</td>
                             <td>' . self::active($menu->active) .'</td>
                             <td>' . Carbon::parse( $menu->updated_at)->format('d/m/Y H:i:s') .'</td>
                             <td>
                                    <a class="btn btn-primary btn-sm" href="/admin/menus/edit/' . $menu->id .'">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm"
                                       onclick="removeRow(' . $menu->id .',\'/admin/menus/destroy\')">
                                        <i class="fas fa-trash"></i>
                                    </a>

                             </td>
                           </tr>
                        ';

                        unset($menus[$key]);

                        $html .= self::menus($menus, $menu->id, $char .'|--');

                    }
                }
                return $html;
        }

        public static function active($active = 0) : string
        {
            return $active ==0 ? '<span class="btn btn-danger btn-xs">NO</span>'
                : '<span class="btn btn-success btn-xs"> YES</span>';
        }
}
