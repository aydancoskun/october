<?php

class conf_ApplicationDelegate {


	function getPermissions(&$record){
         $auth =& Dataface_AuthenticationTool::getInstance();
         $user =& $auth->getLoggedInUser();
         if ( !isset($user) ) return Dataface_PermissionsTool::NO_ACCESS();
             // if the user is null then nobody is logged in... no access.
             // This will force a login prompt.
         $role = $user->val('Role');
         return Dataface_PermissionsTool::getRolePermissions($role);
             // Returns all of the permissions for the user's current role.

        $perms = Dataface_PermissionsTool::ALL();
        //$perms contains all permissions now..
        // let's remove the find permission
        $perms['xml_view'] = 0;
        $perms['view xml'] = 0;
        $perms['view in rss'] = 0;
        $perms['rss']         = 0;
        $perms['export_csv']  = 1;
        $perms['export_xml']  = 0;
        $perms['export_json'] = 0;
        //$perms['import'] = 0;

        return $perms;
}

    function beforeHandleRequest(){
        $theme = "g2";
        $themePath = 'themes/'.basename($theme);
        $themePath = 'modules/'.basename($theme);
        // Check that the theme exists.
        if ( $theme and file_exists($themePath) ){
            df_register_skin($theme, $themePath);
        } else {
            //die("Theme does not exist");
        }
    }
}
