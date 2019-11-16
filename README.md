php plesk api
============

Introduction
------------

This package contains a PHP client for the Plesk RPC API.

The following features are currently supported:

*   List IP addresses
*   List service plans
*   Get server information and stats
*   List/create/suspend/unsuspend/delete clients
*   List/add/update/delete subscriptions
*   List/add/update/delete sites
*   List/add/update/delete email addresses
*   List/add/update/delete domain aliases
*   List/add/update/delete subdomains
*   List database servers
*   List/add/delete databases
*   Add database users
*   Further functionality can be seen in the examples folder
*   Email halo@ranto.my.id with requests for exposing further functionality

Requirements
------------

This library package requires PHP 5.4 or later and Plesk 12.0 or above.


List Client
-----

The following example shows how to retrieve the list of websites available for the 
supplied user.

    $config = array(
        'host'=>'example.com',
        'username'=>'username',
        'password'=>'password',
    );
    
    $request = new \almediatama\Plesk\ListClients($config);
    $info = $request->process();


Suspend Client
---------------

    $config = array(
        'host'=>'example.com',
        'username'=>'username',
        'password'=>'password',
    );
    $params = array(
    'login'=>'username',
    'status'=>'16',
	);
	
    $request = new \almediatama\Plesk\UpdateClient($config,$params);
    $info = $request->process();
