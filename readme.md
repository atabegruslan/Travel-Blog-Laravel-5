# Laravel 5.4 CRUD API Android

- Website http://ruslan-website.com/laravel/travel_blog/

- Tester account: ruslan_aliyev_@hotmail / ruslan

- Note: FB and Google login is outdated.

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/Snapshot.PNG)

## Features

- Laravel MVC CRUD

- User Accounts, Social Signin, RESTful API, Token Auth

- Android & Web FrontEnd

- Contact Form

- Search

- Custom Carousel

- HTML5 Notification, GCM

## Database 

phpmyadmin, import `travel_blog.sql`

## Download all app images

`./download_all_travel_blog_images.sh`

## Android App

Download here: http://ruslan-website.com/laravel/travel_blog/apk/TravelBlog.apk

Source code: https://github.com/atabegruslan/Travel-Blog-Android

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Android/master/Screenshot.png)

## API

For Register: Insert new user, get access token, get user data.

For Social signins: Get social ID via 3rd party signin, insert new user, get access token, get user data.

For Login: Get access token, get user data. 

- Insert new user: POST `http://ruslan-website.com/laravel/travel_blog/api/user`

| Post Form Data Name | Post Form Data Value |
| --- | --- |
| name | Name |
| email | name@email.com |
| password | abcdef |
| type | 'normal' or 'facebook' or 'google' |
| social_id | (optional) |

- Get access token: POST `http://ruslan-website.com/laravel/travel_blog/oauth/token`

| Post Form Data Name | Post Form Data Value |
| --- | --- |
| client_id | (from oauth_clients table) |
| client_secret | (from oauth_clients table) |
| grant_type | password |
| username | (user email) |
| password | (user password) |
| type | 'normal' or 'facebook' or 'google' |

Return access token

- Get user data: GET `http://ruslan-website.com/laravel/travel_blog/api/user`

| Header Field Name | Header Field Value |
| --- | --- |
| Accept | application/json |
| Authorization | Bearer (access token) |

Return user data

- Get post entry: GET `http://ruslan-website.com/laravel/travel_blog/api/entry`

| Header Field Name | Header Field Value |
| --- | --- |
| Accept | application/json |
| Authorization | Bearer (access token) |

Return json entry(s)

- Post new entry: POST `http://ruslan-website.com/laravel/travel_blog/api/entry`

| Header Field Name | Header Field Value |
| --- | --- |
| Accept | application/json |
| Authorization | Bearer (access token) |

| Post Form Data Name | Post Form Data Value |
| --- | --- |
| user_id | (user id) |
| place | (place name) |
| comments | (comments) |
| image | (image) |

Return ok or error message

# How to make this app

## Make New Project

### Beginner CRUD and User accounts - refer to:

- [YouTube - Traversy Media - Laravel From Scratch](https://www.youtube.com/playlist?list=PLillGF-RfqbYhQsN5WMXy6VsDMKGadrJ-)

- [Github - bradtraversy/lsapp](https://github.com/bradtraversy/lsapp)

In CLI: `composer create-project --prefer-dist laravel/laravel travel_blog`

.env : 
```
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=***
```

config/database.php : 
```
'mysql' => [
	...
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	...
],
```

## Auth (Web)

Create default database tables for user: `php artisan migrate`

Make route, controller and model for user: `php artisan make:auth`

## Customize flow of app to the following diagram

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/flow.PNG)

New Controller for Entry: `php artisan make:controller EntryController --resource`

To ensure that Login must happen before CRUD Entry, add to EntryController:
```php
public function __construct(){
	$this->middleware('auth');
}
```

New Entry Model: `php artisan make:model Entry`

routes/web.php :
```php
Route::resource('/entry', 'EntryController');
```

Create: resources/views/entry.blade.php

In EntryController:
```php
public function index(){
	return view('entry');
}
```

In app/http/controllers/auth/LoginController, RegisterController & ResetPasswordController: `protected $redirectTo = '/entry';`


\app\Http\Middleware\RedirectIfAuthenticated.php: 
```php
if (Auth::guard($guard)->check()) {
	return redirect('/');
}
```

Delete home controller, view and route

Make new database table like below:

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/db.PNG)

## Text and Image MultiPart Upload Form

composer.json:
```js
"require": {
	"laravelcollective/html": "^5.3.0"
},
```
	
In CLI: `composer update`

config/app.php:
```php
'providers' => [
	Collective\Html\HtmlServiceProvider::class,
],
'aliases' => [
	'Form' => Collective\Html\FormFacade::class,
	'Html' => Collective\Html\HtmlFacade::class,
],
```

Good Tutorials:
- https://laravelcollective.com/docs/5.3/html
- https://laracasts.com/discuss/channels/general-discussion/errorexception-in-urlgeneratorphp-line-273)
- http://tutsnare.com/upload-files-in-laravel/
- http://itsolutionstuff.com/post/laravel-5-fileimage-upload-example-with-validationexample.html

## Auth for RESTful API

In CLI: `composer require laravel/passport`
  
config/app.php
```php
'providers' => [
	Laravel\Passport\PassportServiceProvider::class,
],
```

In CLI: `php artisan migrate`, `php artisan passport:install`

App\User (model):
```php
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    use HasApiTokens, Notifiable;
}
```

App\Providers\AuthServiceProvider:
```php
use Laravel\Passport\Passport;
public function boot(){
	$this->registerPolicies();
	Passport::routes();
}
```

config/auth.php:
```php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
```

Good Tutorial: https://www.sitepoint.com/build-rest-resources-laravel/

## RESTful API

api.php: 
```php
Route::middleware('auth:api')->resource('/entry', 'EntryApiController');
```

In CLI: `php artisan make:controller EntryApiController --resource`, `php artisan make:model EntryApi`

## Search Box Functionality

routes/web.php:
```php
Route::get('/search', 'SearchController@index');
```

New Controller for Search: `php artisan make:controller SearchController`

Good Tutorials:
- https://tutorialedge.net/laravel-5-simple-site-search-bar
- http://anytch.com/laravel-5-simple-get-search/

## Social Login (Socialite)

In Facebook Developer Console:

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/fb_dev_con_1.PNG)

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/fb_dev_con_2.PNG)

The same idea applies for Google or any social developers' console.

In .env

```
FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_CALLBACK_URL=

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_CALLBACK_URL=
```

In config/services.php

```php
'facebook' => [
    'client_id' => env('FACEBOOK_CLIENT_ID'),
    'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
    'redirect' => env('FACEBOOK_CALLBACK_URL'),
],
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_CALLBACK_URL'),
],
```

In CLI : `composer require laravel/socialite`

In config/app.php

```php
'providers' => [
	Laravel\Socialite\SocialiteServiceProvider::class,
],
'aliases' => [
	'Socialite' => Laravel\Socialite\Facades\Socialite::class,
],
```

Add new columns in database's users table for social login

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/new_social_db_cols.PNG)

Also make the email column not unique (above image). The existing code don't yet allow the same email address to be used for normal and social logins. To allow distinction between same emails of different login methods:

For Login:

In vendor\laravel\framework\src\Illuminate\Foundation\Auth\AuthenticatesUsers.php 

```php
protected function credentials(Request $request)
{
    //return $request->only($this->username(), 'password');
    $request = $request->only($this->username(), 'password');
    $request['type'] = 'normal';
    return $request;
}
```

For Register:

In vendor\laravel\framework\src\Illuminate\Foundation\Auth\RegistersUsers.php 

```php
public function register(Request $request)
{
    $request['type'] = 'normal';  // add this line
    $this->validator($request->all())->validate();
```

In app\Http\Controllers\Auth\RegisterController.php

```php
protected function validator(array $data)
{
    // return Validator::make($data, [
    //     'name' => 'required|max:255',
    //     'email' => 'required|email|max:255|unique:users',
    //     'password' => 'required|min:6|confirmed',
    // ]);
    return Validator::make($data, [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique_with:users,type',
        'password' => 'required|min:6|confirmed',
        'type' => 'required',
    ]);
}
```

Notice that `unique_with` is used to allow composite key validation. 

In CLI: `composer require felixkiss/uniquewith-validator`

In config/app.php

```php
'providers' => [
    ...
    Felixkiss\UniqueWithValidator\ServiceProvider::class,
],
```

More info about `unique_with` : https://github.com/felixkiss/uniquewith-validator

For Forget Passwords:

In vendor\laravel\framework\src\Illuminate\Foundation\Auth\SendsPasswordResetEmails.php

```php
public function sendResetLinkEmail(Request $request)
{
    $this->validate($request, ['email' => 'required|email']);

    $request1 = $request->only('email'); // add this line
    $request1['type'] = 'normal'; // add this line

    $response = $this->broker()->sendResetLink(
        //$request->only('email')
        $request1 // add this line
    );

    return $response == Password::RESET_LINK_SENT
                ? $this->sendResetLinkResponse($response)
                : $this->sendResetLinkFailedResponse($request, $response);
}
```

In vendor\laravel\framework\src\Illuminate\Foundation\Auth\ResetsPasswords.php

```php
protected function credentials(Request $request)
{
    $request = $request->only(
        'email', 'password', 'password_confirmation', 'token'
    );
    $request['type'] = 'normal';
    return $request;
    // return $request->only(
    //     'email', 'password', 'password_confirmation', 'token'
    // );
}
```

For API Login:

In vendor\league\oauth2-server\src\Grant\PasswordGrant.php

```php
protected function validateUser(ServerRequestInterface $request, ClientEntityInterface $client)
{
    ...
    $type = $this->getRequestParameter('type', $request);

    $user = $this->userRepository->getUserEntityByUserCredentials(
        $username,
        $password,
        $type, // add this
        $this->getIdentifier(),
        $client
    );
```

In vendor\league\oauth2-server\src\Repositories\UserRepositoryInterface.php

```php
interface UserRepositoryInterface extends RepositoryInterface
{
    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $type, // add this
        $grantType,
        ClientEntityInterface $clientEntity
    );
}
```

In vendor\laravel\passport\src\Bridge\UserRepository.php

```php
public function getUserEntityByUserCredentials($username, $password, $type, $grantType, ClientEntityInterface $clientEntity)
{
    ...
    if (method_exists($model, 'findForPassport')) {
        $user = (new $model)->findForPassport($username);
    } else {
        // $user = (new $model)->where('email', $username)->first();
        $user = (new $model)->where('email', $username)->where('type', $type)->first(); // add this
    }
```

Modify the app/User.php model too

```php
class User extends Authenticatable{
...
    protected $fillable = [
        'name', 'email', 'password', 'type', 'social_id'
    ];
```

Add Facebook button to resources/views/auth/login.blade.php

```html
<a href="{{ route('social.login', ['facebook']) }}">
    <img src="btn_facebook.png">
</a> 
<a href="{{ route('social.login', ['google']) }}">
    <img src="btn_google.png">
</a> 
```

In routes.web.php

```php
Route::group(['middleware' => ['web']], function(){
	Route::get('auth/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login']);
	Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
});
```

In App/Http/Controllers/Auth/AuthController.php

```php
public function redirectToProvider($provider)
{
	return Socialite::driver($provider)->redirect();
}
public function handleProviderCallback($provider)
{
	$user = Socialite::driver($provider)->user();
	$data = [
        'name' => $user->getName(),
        'email' => $user->getEmail(),
        'type' => $provider,
        'social_id' => $user->getId(),
        'password' => ''
    ];
    Auth::login(User::firstOrCreate($data));
    return Redirect::to('/entry');
}
```

Tweek for Socialite Plugin Update (Early-Mid 2017) :

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Android/master/socialite_tweek_1.png)

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Android/master/socialite_tweek_1.png)

https://stackoverflow.com/questions/43053871/socialite-laravel-5-4-facebook-provider

Useful tutorials:

https://github.com/laravel/socialite

https://www.youtube.com/watch?v=D3oLLz8bFp0

http://devartisans.com/articles/complete-laravel5-socialite-tuorial

## Contact form with emailing ability

In .env

```
MAIL_DRIVER=sendmail
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=***@gmail.com
MAIL_PASSWORD=***
MAIL_ENCRYPTION=ssl
```

Create contact form view, connect it to route then to controller.

In controller:

```php
use Mail;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:40',
            'email' => 'required|email|max:40',
            'subject' => 'required|max:40',
            'body' => 'required|max:200'
        ]); 

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body
        );

        Mail::send(
            'email.admin',
            $data, 
            function($message) use ($data) {
                $message->from( $data['email'] );
                $message->to('ruslan_aliyev_@hotmail.com')->subject( $data['body'] );
            }
        );

        Mail::send(
            'email.enquirer',
            $data, 
            function($message) use ($data) {
                $message->from('ruslan_aliyev_@hotmail.com');
                $message->to( $data['email'] )->subject( $data['body'] );
            }
        );

        \Session::flash('success', 'Email Sent');

        return Redirect::to('/contact');
    }
}
```

In view, for HTML email template. Here I just show the HTML email that Admin receives:

```html
<p style="font-size: 100%;">Dear Administrator, You got new mail from Travel Blog</p>

<p style="font-size: 160%; background-color: #F0F8FF;">
{{ $body }}
</p>

<p style="font-size: 100%; background-color: #DCDCDC;">
    <b>From:</b> {{ $name }} ( <a href="mailto:{{ $email }}">{{ $email }}</a> )<br>
</p>
```

## Custom Carousel on Welcome Page

Selects a sample of content images for display

Include my custom written js and css: `/js/ruslan_slider.js` and `/css/ruslan_slider.css`.

Also include: `hammer.js` and this jQuery: `http://code.jquery.com/jquery-latest.min.js`

```html
<div class="slides-holder">
    <div class="slider"></div>
</div>
```

```js
$slider1.slider
({
    title: "Title", //carousel's title
    fade: 500, // fade transition time
    pictures: (array of pictures) // eg ["path/to/image/img1.png", "path/to/image/img2.png", ...]
});     
```

## Events (Hooks)

- https://www.youtube.com/watch?v=e40_eal2DmM
- https://laravel.com/docs/5.8/events#dispatching-events
- `php artisan event:generate`

## Service Provider

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/servicecontainer1.jpg)

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/servicecontainer2.png)

- https://code.tutsplus.com/tutorials/how-to-register-use-laravel-service-providers--cms-28966
- Then watch these tutorials:
 - https://www.youtube.com/watch?v=urycXvTEnF8&t=1m
 - https://www.youtube.com/watch?v=GqVdt6OWN-Y&list=PL_HVsP_TO8z7aeylCMe64BIx3VEfvPdn&index=34
- Then watch these tutorials:
 - https://www.youtube.com/watch?v=pIWDFVWQXMQ&list=PL_HVsP_TO8z7aey-lCMe64BIx3VEfvPdn&index=33&t=19m35s
 - https://www.youtube.com/watch?v=hy0oieokjtQ&list=PL_HVsP_TO8z7aey-lCMe64BIx3VEfvPdn&index=35

## Different ways of writting things

In Blade
```
@if (!in_array($modLabel, ['xxx', 'yyy']))

@endif
```
is same as
```
@php {{ $skips = ['xxx','yyy','deleted_at']; }} @endphp
@if (!in_array($initLabel, $skips))

@endif
```

In PHP
```
$thisAndPrevious = ActionLog::where([
        [ 'time',            '<=', $log['time']            ],
        [ 'record_key_name', '=',  $log['record_key_name'] ],
        [ 'record_id',       '=',  $log['record_id']       ],
        [ 'model',           '=',  $log['model']           ],
    ])
    ->where(function ($query) {
        $query->where('method', '=', 'create')
              ->orWhere('method', '=', 'update');
    })
    ->orderBy('id', 'DESC')
    ->take(2)
    ->get();
```
is same as
```
$thisAndPrevious = CrudLog::where('time', '<=', $log['time'])
    ->where('record_key_name', '=',  $log['record_key_name'])
    ->where('record_id', '=',  $log['record_id'])
    ->where('model', '=',  $log['model'])
    ->whereIn('method', ['create', 'update'])
    ->orderBy('id', 'DESC')
    ->take(2)
    ->get();
```

## Upload to server

- public folder to server's public folder
- The rest to another folder outside of the server's public folder
- public/index.php: rectify all relevant paths
- import .sql to server's database, rectify database-name, username & password in the .env file

---

# Vue.js

## Tutorials

- https://www.youtube.com/watch?v=DJ6PD_jBtU0&feature=share&fbclid=IwAR0-NOMr-b1Eu6v-Ks5c7lnUfnKiwOrCbk2y3ues-1NGrKGLz5B1FTksI6o

## Setup

Install Laravel. In CLI: `composer create-project --prefer-dist laravel/laravel [project-name]`

Update `node_modules` according to `package.json` . In CLI: `npm install`

Install Bootstrap. In CLI: `npm install bootstrap`

## Find out if Vue works in setup

`resources/assets/js/components/Example.vue` is an example vue file that comes along with Laravel. 

This can be used to see if Vue works ok in the project.

### Method 1: 

Set up `resources/views/welcome.blade.php` like this:

```html
<head>    
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <example></example>
    </div>
    <script src="js/app.js"></script>
</body>
```

In CLI, launch server: `php artisan serve`, then see: `http://url.domain/project-name:8000`

Note that `resources/assets/js/app.js` and `resource/assets/sass/app.scss` is used.

### Method 2: 

Set up `resources/views/welcome.blade.php` like this:

```html
<head>   
    <script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
      ]); ?>
    </script> 
    <link href="public/css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <example></example>
    </div>
    <script src="public/js/app.js"></script>
</body>
```

Set up `package.json` like this:

```js
...
  "scripts": {
    "dev": "node node_modules/cross-env/dist/bin/cross-env.js NODE_ENV=development node_modules/webpack/bin/webpack.js --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js",

    "watch": "node node_modules/cross-env/dist/bin/cross-env.js NODE_ENV=development node_modules/webpack/bin/webpack.js --watch --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js",

    ...
  },
...
```

In CLI: run `npm run dev`, which calls `package.json`'s `scripts`'s `dev`, which calls `webpack.mix.js`, which processes `resources/assets/js/app.js` into `public/js/app.js` and `resource/assets/sass/app.scss` into `public/css/app.css`.

See `http://url.domain/project-name/public/`

Note that `public/js/app.js` and `public/css/app.css` is used.

### It should look like this:

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/vuetest.PNG)

### Method 3 (this site): 

See `routes/web.php` , `welcome.blade.php` and `app.js`

Access `http://url.domain/project-name/public/vuetest`

---

## To Do

- Update Laravel version, FB login, Google login, GCM
- vue 
