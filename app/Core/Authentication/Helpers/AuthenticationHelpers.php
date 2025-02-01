<?php
namespace Core\Authentication\Helpers;

class AuthenticationHelpers {
    public static function checkAuthentication(){

        if (!\Helpers::session("authenticated")) {
            \Helpers::session("routeRequestedBeforeLogin", \Helpers::currentroute());
            \Helpers::f3reroute("/login");
        }
    }
}