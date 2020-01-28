# Laravel 5.4 App

- Tester account: ruslan_aliyev_@hotmail / ruslan

- Note: FB, Google and Android integrations are outdated. 

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/Snapshot.PNG)

## Features

- Laravel MVC CRUD

- User Accounts, Social Signin, RESTful API, Token Auth

- Android & Web FrontEnd

- Contact Form

- Search

- Custom Carousel

- HTML5 Notification, GCM

## Download all app images

`./download_all_travel_blog_images.sh` 

## Android App <sup>outdated</sup>

Source code: 

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Android/master/Screenshot.png)

# API

## Users

### Get access token

POST `http://ruslan-website.com/laravel/travel_blog/oauth/token`

| Post Form Data Name | Post Form Data Value |
| --- | --- |
| client_id | (from oauth_clients table) |
| client_secret | (from oauth_clients table) |
| grant_type | password |
| username | (user email) |
| password | (user password) |
| type | 'normal' or 'facebook' or 'google' |

Return access token

### Get user data

GET `http://ruslan-website.com/laravel/travel_blog/api/user`

| Header Field Name | Header Field Value |
| --- | --- |
| Accept | application/json |
| Authorization | Bearer (access token) |

Return user data

### Insert new user

POST `http://ruslan-website.com/laravel/travel_blog/api/user`

| Header Field Name | Header Field Value |
| --- | --- |
| Accept | application/json |
| Authorization | Bearer (access token) |

| Post Form Data Name | Post Form Data Value |
| --- | --- |
| name | Name |
| email | name@email.com |
| password | abcdef |
| type | 'normal' or 'facebook' or 'google' |
| social_id | (optional) |

Return OK or Error response

## Entries

### Get all entries

GET `http://ruslan-website.com/laravel/travel_blog/api/entry`

| Header Field Name | Header Field Value |
| --- | --- |
| Accept | application/json |
| Authorization | Bearer (access token) |

Return all entries

### Get one entry

GET `http://ruslan-website.com/laravel/travel_blog/api/entry/{id}`

| Header Field Name | Header Field Value |
| --- | --- |
| Accept | application/json |
| Authorization | Bearer (access token) |

Return one entry

### Create entry

POST `http://ruslan-website.com/laravel/travel_blog/api/entry`

| Header Field Name | Header Field Value |
| --- | --- |
| Accept | application/json |
| Authorization | Bearer (access token) |

| Post Form Data Name | Post Form Data Value |
| --- | --- |
| user_id | (user id, int) |
| place | (place name, string) |
| comments | (comments, string) |
| image | (image, file, optional) |

Return OK or Error response

### Update entry

POST `http://ruslan-website.com/laravel/travel_blog/api/entry/{id}`

| Header Field Name | Header Field Value |
| --- | --- |
| Accept | application/json |
| Authorization | Bearer (access token) |

| Post Form Data Name | Post Form Data Value |
| --- | --- |
| _method | PUT |
| user_id | (user id, int, optional) |
| place | (place name, string, optional) |
| comments | (comments, string, optional) |
| image | (image, file, optional) |

Return OK or Error response

### Delete entry

POST `http://ruslan-website.com/laravel/travel_blog/api/entry/{id}`

| Header Field Name | Header Field Value |
| --- | --- |
| Accept | application/json |
| Authorization | Bearer (access token) |

| Post Form Data Name | Post Form Data Value |
| --- | --- |
| _method | DELETE |

Return OK or Error response

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

## Scaffolding

1. New Controller for Entry: `php artisan make:controller EntryController --resource`

2. New Entry Model: `php artisan make:model Entry`

3. routes/web.php :
```php
Route::resource('/entry', 'EntryController');
```

4. In EntryController:
```php
public function index(){
    return view('entry');
}
```

5. Create: resources/views/entry.blade.php

### Model Relationships

- 1 - many or many - 1
    - `->belongsTo` 
- Many to many
    - Pivot tables: https://laraveldaily.com/pivot-tables-and-many-to-many-relationships/

### Create Controller Inside a Subfolder

1. `php artisan make:controller Web/EntryController --resource` ( https://laracasts.com/discuss/channels/laravel/create-controller-inside-a-subfolder?page=1 )

2. routes/web.php :
```php
Route::group(['namespace' => 'Web'], function () {
    Route::resource('/entry', 'EntryController');
});
```

## Auth (Web)

Create default database tables for user: `php artisan migrate`

Make route, controller and model for user: `php artisan make:auth`

After this, you can register and login in the browser.

## Customize flow of app

In `app/http/controllers/auth/LoginController`, `RegisterController` & `ResetPasswordController` : change the `protected $redirectTo` routes.

In `app\Http\Middleware\RedirectIfAuthenticated.php` - change the redirect route:
```php
if (Auth::guard($guard)->check()) {
    return redirect('/');
}
```

## Ensure login before accessing route

Either add this to controller
```php
public function __construct(){
    $this->middleware('auth');
}
```

Or add this to route
`Route::middleware('auth')->resource('/entry', 'EntryController')`


## Database table

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
- Extra fun with images - crop to circle with transparency: 
    - https://thedebuggers.com/transparent-circular-crop-using-php-gd/

## RESTful API

In CLI: `php artisan make:controller EntryApiController --resource`

routes/api.php: 
```php
Route::resource('/entry', 'EntryApiController');
```

## Auth (API)

In CLI: `composer require laravel/passport`

config/app.php
```php
'providers' => [
    Laravel\Passport\PassportServiceProvider::class,
],
```

In CLI: `php artisan migrate`, `php artisan passport:install`

Make the `App\User` model use the `Laravel\Passport\HasApiTokens` trait.

App\Providers\AuthServiceProvider:
```php
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
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

Now you can get access token: POST `.../oauth/token`

routes/api.php: 
```php
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
```

Now you can get user data: GET `.../api/user`

routes/api.php: 
```php
Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('/entry', 'EntryApiController');
});
```

Now you must do Entry CRUDs with access token

Good Tutorial: https://www.sitepoint.com/build-rest-resources-laravel/

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

### Register

#### Facebook Developer Console

https://developers.facebook.com

#### Google Developer Console

https://console.developers.google.com/

https://developers.google.com/identity/sign-in/web/sign-in

.env
```
FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_CALLBACK_URL=

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_CALLBACK_URL=
```

config/services.php
```php
'facebook' => [
    'client_id'     => env('FACEBOOK_CLIENT_ID'),
    'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
    'redirect'      => env('FACEBOOK_CALLBACK_URL'),
],
'google' => [
    'client_id'     => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect'      => env('GOOGLE_CALLBACK_URL'),
],
```

### Install Socialite

`composer require laravel/socialite`

config/app.php
```php
'providers' => [
    Laravel\Socialite\SocialiteServiceProvider::class,
],
'aliases' => [
    'Socialite' => Laravel\Socialite\Facades\Socialite::class,
],
```

### Modifications

```sql
ALTER TABLE `users` 
    ADD `type` VARCHAR(10) NOT NULL DEFAULT 'normal' AFTER `updated_at`, 
    ADD `social_id` VARCHAR(500) NULL DEFAULT NULL AFTER `type`;
```

Also make `users`.`email` not unique. 

The existing code don't yet allow the same email address to be used for normal and social logins. 

To allow distinction between same emails of different login methods:

#### For Login:

vendor\laravel\framework\src\Illuminate\Foundation\Auth\AuthenticatesUsers.php 
```php
protected function credentials(Request $request)
{
    //return $request->only($this->username(), 'password');
    $request = $request->only($this->username(), 'password');
    $request['type'] = 'normal';

    return $request;
}
```

#### For Register:

vendor\laravel\framework\src\Illuminate\Foundation\Auth\RegistersUsers.php 
```php
public function register(Request $request)
{
    $request['type'] = 'normal';  // add this line
    $this->validator($request->all())->validate();
```

##### Install `unique_with`

`unique_with` is used to allow composite key validation. ( https://github.com/felixkiss/uniquewith-validator )

`composer require felixkiss/uniquewith-validator`

config/app.php
```php
'providers' => [
    ...
    Felixkiss\UniqueWithValidator\ServiceProvider::class,
],
```

app\Http\Controllers\Auth\RegisterController.php
```php
protected function validator(array $data)
{
    // return Validator::make($data, [
    //     'name' => 'required|max:255',
    //     'email' => 'required|email|max:255|unique:users',
    //     'password' => 'required|min:6|confirmed',
    // ]);
    return Validator::make($data, [
        'name'     => 'required|max:255',
        'email'    => 'required|email|max:255|unique_with:users,type',
        'password' => 'required|min:6|confirmed',
        'type'     => 'required',
    ]);
}
```

#### For Forget Passwords:

vendor\laravel\framework\src\Illuminate\Foundation\Auth\SendsPasswordResetEmails.php
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

vendor\laravel\framework\src\Illuminate\Foundation\Auth\ResetsPasswords.php
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

#### For API Login:

vendor\league\oauth2-server\src\Grant\PasswordGrant.php
```php
protected function validateUser(ServerRequestInterface $request, ClientEntityInterface $client)
{
    ...
    $type = $this->getRequestParameter('type', $request); // add this

    $user = $this->userRepository->getUserEntityByUserCredentials(
        $username,
        $password,
        $type, // add this
        $this->getIdentifier(),
        $client
    );
```

vendor\league\oauth2-server\src\Repositories\UserRepositoryInterface.php
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

vendor\laravel\passport\src\Bridge\UserRepository.php
```php
public function getUserEntityByUserCredentials($username, $password, $type /* ADD THIS TYPE */, $grantType, ClientEntityInterface $clientEntity)
{
    ...
    if (method_exists($model, 'findForPassport')) {
        $user = (new $model)->findForPassport($username);
    } else {
        // $user = (new $model)->where('email', $username)->first();
        $user = (new $model)->where('email', $username)->where('type', $type)->first(); // add this
    }
```

#### Models

App\User.php
```php
class User extends Authenticatable{
...
    protected $fillable = [
        'name', 'email', 'password', 'type', 'social_id'
    ];
```

#### Social buttons

resources/views/auth/login.blade.php
```html
<a href="{{ route('social.login', ['facebook']) }}">
    <img src="btn_facebook.png">
</a> 
<a href="{{ route('social.login', ['google']) }}">
    <img src="btn_google.png">
</a> 
```

### Handle Social Sign Ups

`php artisan make:controller Auth/AuthController`

app/Http/Controllers/Auth/AuthController.php
```php
public function redirectToProvider($provider)
{
    return Socialite::driver($provider)->redirect();
}

public function handleProviderCallback($provider)
{
    $user = Socialite::driver($provider)->user();
    $data = [
        'name'      => $user->getName(),
        'email'     => $user->getEmail(),
        'type'      => $provider,
        'social_id' => $user->getId(),
        'password'  => bcrypt('random') // @todo to be improved later
    ];

    Auth::login(User::firstOrCreate($data));
    
    return Redirect::to('/entry');
}
```

routes/web.php
```php
Route::group(['middleware' => ['auth']], function () {
    Route::get('auth/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login']);
    Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
});
```

### User creation by API

`php artisan make:controller Auth/UserApiController --resource`

routes/api.php
```php
// Protected Entry CRUDs
Route::group(['middleware' => ['auth:api']], function () {

    Route::resource('/entry', 'EntryApiController');

    Route::post('/user', 'Auth\UserApiController@store');

});
```

Then complete the store method, like in: https://github.com/atabegruslan/Travel-Blog-Laravel-5/blob/master/app/Http/Controllers/Auth/UserApiController.php

### Tweek for Socialite Plugin Update (Early-Mid 2017) :

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/socialite_tweek_1.PNG)

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/socialite_tweek_2.PNG)

https://stackoverflow.com/questions/43053871/socialite-laravel-5-4-facebook-provider


### Useful tutorials:

- https://github.com/laravel/socialite
- https://www.youtube.com/watch?v=D3oLLz8bFp0
- http://devartisans.com/articles/complete-laravel5-socialite-tuorial


## Contact form with emailing ability

.env
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=***@gmail.com
MAIL_PASSWORD=*****
MAIL_ENCRYPTION=tls
```

Create contact form view, connect it to route then to controller.

Write the controller like this: https://github.com/atabegruslan/Travel-Blog-Laravel-5/blob/master/app/Http/Controllers/EmailController.php

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
- https://laravel.com/docs/5.4/events#dispatching-events
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

## Upload to server

- public folder to server's public folder
- The rest to another folder outside of the server's public folder
- public/index.php: rectify all relevant paths
- import .sql to server's database, rectify database-name, username & password in the .env file

---

# Vue.js

## Tutorials

- https://www.youtube.com/watch?v=DJ6PD_jBtU0&feature=share&fbclid=IwAR0-NOMr-b1Eu6v-Ks5c7lnUfnKiwOrCbk2y3ues-1NGrKGLz5B1FTksI6o
- https://vuejsdevelopers.com/2018/02/05/vue-laravel-crud/

## Setup

Install Laravel. In CLI: `composer create-project --prefer-dist laravel/laravel [project-name]`

Update `node_modules` according to `package.json` . In CLI: `npm install`

Install Bootstrap. In CLI: `npm install bootstrap`

## Find out if Vue works in setup

`resources/assets/js/components/Example.vue` is an example vue file that comes along with Laravel. 

This can be used to see if Vue works ok in the project.

### Method 1 : 

1. Set up `resources/views/welcome.blade.php` like this:

```html
<body>
    <div id="app">
        <example></example>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
```

4. In CLI, launch server: `php artisan serve`, then see: `http://127.0.0.1:8000/welcome`, or turn on local server and see `http://localhost/{sitename}/public/welcome`

5. Note that `resources/assets/js/app.js` is used.

#### It should look like this:

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/vuetest1.PNG)

6. Then you will have to do your own css.

### Method 2 : 

1. Set up `resources/views/welcome.blade.php` like this:

```html
<head>   
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script> 
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <example></example>
    </div>
    <script src="js/app.js"></script>
</body>
```

2. Have the dev script `package.json` like this:

```js
...
  "scripts": {
    "dev": "node node_modules/cross-env/dist/bin/cross-env.js NODE_ENV=development node_modules/webpack/bin/webpack.js --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js",

    "watch": "node node_modules/cross-env/dist/bin/cross-env.js NODE_ENV=development node_modules/webpack/bin/webpack.js --watch --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js",

    ...
  },
...
```

3. In CLI: run `npm run dev`, which calls `package.json`'s `scripts`'s `dev`, which calls `webpack.mix.js`, which processes `resources/assets/js/app.js` into `public/js/app.js` and `resource/assets/sass/app.scss` into `public/css/app.css`.

4. In CLI, launch server: `php artisan serve`, then see: `http://127.0.0.1:8000/welcome`, or turn on local server and see `http://localhost/{sitename}/public/welcome`

5. Note that `public/js/app.js` and `public/css/app.css` is used.

#### It should look like this:

![](https://raw.githubusercontent.com/atabegruslan/Travel-Blog-Laravel-5/master/Illustrations/vuetest2.PNG)

## The Vue frontend relies on AJAXes to your backend API

AJAX here is done by

- JS's Fetch API
- Axios library

- https://stackoverflow.com/questions/40844297/what-is-difference-between-axios-and-fetch
- https://www.sitepoint.com/introduction-to-the-fetch-api/
- https://www.youtube.com/playlist?list=PLyuRouwmQCjkWu63mHksI9EA4fN-vwGs7


## Notes

- `fsevents` warnings when running `npm install`? Never mind it, it's not needed on Windows. https://stackoverflow.com/questions/40226745/npm-warn-notsup-skipping-optional-dependency-unsupported-platform-for-fsevents
- what if your APIs are protected by access token ? 
    - https://justlaravel.com/vuejs-consumer-app-laravel-api-passport/
    - https://gomakethings.com/using-oauth-with-fetch-in-vanilla-js/
    - https://learn.co/lessons/javascript-fetch

---

## To Do

- Update Laravel version, FB login, Google login, GCM.
- vue
