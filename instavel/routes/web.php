<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// =================  Rutas de HOME =======================
Route::get('home', 'HomeController@index');
Route::get('/', 'HomeController@index');
// End home


// =================  Rutas de LOGIN =======================
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login','Auth\LoginController@login');
// End login


// =================  Rutas de LOGOUT ======================
Route::get('logout','Auth\LoginController@logout');
// End logout

// =================  Rutas de REGISTER ====================
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');
// End Register


// ============  Rutas de RESET PASSWORD ===========
// Ruta para cuando haces clic en "¿Has olvidado tu contraseña?" - solo muestra un formulario con un campo email y un submit
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// Ruta para cuando el usuario introduce su email y pulsa en "recordar", se le enviará un mail
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// Ruta para el formulario que se muestra tras haber hecho clic en el enlace del mail (tiene un campo email y dos campos password)
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// Ruta para reestablecer la contraseña
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// =================  Rutas de Perfil ====================
Route::get('/perfil','ProfileController@showPerfil');
Route::get('/perfil/{user}','ProfileController@getPerfil');
//Route::get('friends','ProfileController@getFriends');
//Route::get('friends/{{id}}','ProfileController@getUserFriends');
Route::get('info','ProfileController@getInfo');
Route::get('info/{user}','ProfileController@getInfoUser');
Route::get('/perfil/{user}/info','ProfileController@getInfoUser');
Route::post('info/update','ProfileController@updateInfo');
Route::get('search','PhotoController@getSearchView');
Route::post('search','PhotoController@getSearchResult');
//añadir lade user/info y la de user/amigos
// End Perfil

// =================  Rutas Gestion de Friends ====================
Route::get('/addfriend/{nickname}','FriendController@addFriend');
Route::post('/delfriend/{nickname}','FriendController@deleteFriend');
Route::get('/friends','FriendController@getFriends');
Route::get('/perfil/{nickname}/friends','FriendController@getUserFriends');
Route::get('/news','FriendController@getFriendsNews');

// End Friends

// =================  Rutas Gestion de Fotos ====================
Route::post('/like/{idphoto}','PhotoController@likePhoto');
Route::get('/view/{idphoto}','PhotoController@getPhoto');
Route::post('/edit/{idphoto}','PhotoController@editPhoto');
Route::post('/addcomment','CommentsController@addComment');
Route::post('/delcomment','CommentsController@deleteComment');
Route::get('/delete/{idphoto}','PhotoController@deletePhoto');
// End Fotos

// =================  Rutas de UPLOAD ====================
Route::get('upload', 'UploadController@dropzone');
Route::get('uploader', 'UploadController@getUploader');
Route::get('upload_single', 'UploadController@dropzone_single');
Route::post('upload/store', ['as'=>'upload.store','uses'=>'UploadController@dropzoneStore']);
Route::post('upload/storecam', 'UploadController@dropzoneStoreCam');
Route::post('upload_single/store', ['as'=>'upload_single.store','uses'=>'UploadController@dropzoneStoreSingle']);
// End Photo uploader

// =================  Rutas de Messages ====================
Route::get('messages', 'MessageController@index');
Route::get('messages/add', 'MessageController@compose');
Route::post('messages/send', 'MessageController@sendMessage');
// End Messages

// =================  Rutas de Admin ====================
Route::get('admin', 'AdminController@index');
Route::get('admin/panel', 'AdminController@panel');
Route::get('admin/panel/users', 'AdminController@showUsers');
Route::get('admin/panel/newsletter', 'AdminController@newsletter');
Route::get('admin/panel/edit/{nickname}', 'AdminController@editAlbum');
Route::post('admin/panel/deleteimg', 'AdminController@deletePhoto');
Route::post('admin/panel/sendnewsletter', 'AdminController@sendNewsletter');
Route::post('admin/login', 'AdminController@login');
Route::post('admin/panel/search', 'AdminController@search');
Route::post('/addsub', 'AdminController@addSub');
Route::get('admin/panel/delete/{nickname}', 'AdminController@deleteUser');
Route::get('admin/panel/api', 'AdminController@showApi');
Route::post('admin/panel/api/add', 'AdminController@addKey');
Route::get('api/{key}/tags/{tag}/n/{n}', 'AdminController@getAPIRequest');
Route::post('api/post', 'AdminController@getAPIPostRequest');
// End Admin


//PRUEBAS
Route::get('prueba2',function(){
        try{
        $photo=new App\Photo;
        $photo->id_user=Auth::user()->id;
        $photo->path=public_path() .'/images/' . Auth::user()->nickname.'/'.time().'.png';
        $photo->photoname='';
        $photo->likes=0;
        $photo->description='';
        $photo->mode='public';
      
        $photo->save();
    }
    catch(QueryException $e){
       // do task when error
       return $e->getMessage();
    }
});

Route::get('pruebas',function(){
  return view('profile.pruebas')->with('error','0');
});  
Route::get("prueba", function() {
        Mail::send("home", [], function($message) {
            $message->to("asierpaz@gmail.com", "Asier")
            ->subject("Bienvenido a Laragram!");
        });
    });

/*Route::get('/perfil','ProfileController@index');
Route::get('/perfil/{id}','ProfileController@getId');*/

