<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class IpnController extends Controller
{

/**
 * Payement success
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function success(Request $request)
{
	$token = $request->get('token');
	$PayerID = $request->get('PayerID');  
	$ccustName = $request->get('ccustname');     //customer name
	$ccustEmail = $request->get('ccustemail');  //customer email
	$cProdItem = $request->get('cproditem');   //JVZoo product number  
	$cProdTitle = $request->get('cprodtitle');  //title of product at time of purchase

 
    // check if the user already exists
    $user = User::where('email', '=', $ccustEmail)->first();

	if ($user === null) {
        User::create([
            'name' => $ccustName,
            'email' => $ccustEmail,
            'password' => \Hash::make('12345678'),
        ]);
		 dd("Creation of the new user ".$ccustName." successfully"); 
    }else{
		$user->membership="pro";   // update a column membership
		$user->save();
	    dd("updating the membership of ".$ccustName ." to pro"); 
	}
	


    //return redirect()->route('/');
		
}
}
