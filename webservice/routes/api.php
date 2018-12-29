<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/test', function(Request $request){
	return "working";
});

Route::post('/register', function(Request $request){
	$data = $request->all();

	$is_valid = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

	if($is_valid->fails()){
		return $is_valid->errors();
	} 

	$user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

	$user->token = $user->createToken($user->email)->accessToken;

	return $user;
});

Route::post('/login', function(Request $request){
	$data = $request->all();

	$is_valid = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

	if($is_valid->fails()){
		return $is_valid->errors();
	}

	if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
		$user = auth()->user();
		$user->token = $user->createToken($user->email)->accessToken;
		return $user;
	}
	
	$response = ['error' => true, 'result' => 'Usuário incorreto.'];
	return $response;
	
});

Route::middleware('auth:api')->put('/profile', function (Request $request) {
    $user = $request->user();
    $data = $request->all();

    if(isset($data['password'])){
	    $data['password'] = Hash::make($data['password']);

		$is_valid = Validator::make($data, [
	            'name' => ['required', 'string', 'max:255'],
	            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
	            'password' => ['required', 'string', 'min:6', 'confirmed']
	        ]);
		if($is_valid->fails()){
			return $is_valid->errors();
		}
    }else{
		$is_valid = Validator::make($data, [
	            'name' => ['required', 'string', 'max:255'],
	            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
	        ]);
		if($is_valid->fails()){
			return $is_valid->errors();
		}    	
    }

    if(isset($data['image'])){

    	Validator::extend('base64_image', function($attr, $img, $pars, $validator){
    		$ext = substr($img, 11, strpos($img, ';') - 11);
    		$file = explode(",", $img)[1];
    		$allow = ['png', 'jpg', 'jpeg', 'svg'];

    		if(!in_array($ext, $allow)) return false;
    		if(!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $file)) return false;

    		return true;
    	});

    	$is_valid = Validator::make($data, [
            'image' => 'base64_image'
        ], ['base64_image' => 'Imagem inválida']);

		if($is_valid->fails()){
			return $is_valid->errors();
		}
		
    	$img_name = md5(time());
    	$dir = "profiles".DIRECTORY_SEPARATOR."pics_".$user->id.DIRECTORY_SEPARATOR;
    	$ext = substr($data['image'], 11, strpos($data['image'], ';') - 11);

    	$image_url = $dir.$img_name.".".$ext;
    	$file = explode(",", $data['image'])[1];
    	$file = base64_decode($file);
    	
    	if(!file_exists("profiles")){
    		mkdir("profiles",0700);
    	}elseif(!file_exists($dir)){
    		mkdir($dir, 0700);
    	}

    	if($user->image){
    		if(file_exists($user->image)){
    			unlink($user->image);
    		}
    	}

    	file_put_contents($image_url, $file);
    	$user->image = $image_url;
    }

	$user->name = $data['name'];
	$user->email = $data['email'];

	$user->save();

	$user->token = $user->createToken($user->email)->accessToken;
	$user->image = asset($image_url);
    return $user;
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
