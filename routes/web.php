<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'UserController@page')->name('index');
Auth::routes();

Route::get('/api/user/library/episode/{slug}', ['as'=> 'library.episode', 'uses'=> 'LibraryController@getEpisode'])->where('slug','[\w\d\-\_]+');
Route::get('/api/user/library/score/{slug}', ['as'=> 'library.score', 'uses'=> 'LibraryController@getScore'])->where('slug','[\w\d\-\_]+');
Route::get('/api/user/library/favorite/{slug}', ['as'=> 'library.favorite', 'uses'=> 'LibraryController@getFavorite'])->where('slug','[\w\d\-\_]+');
Route::get('/api/user/library/status/{slug}', ['as'=> 'library.status', 'uses'=> 'LibraryController@getStatus'])->where('slug','[\w\d\-\_]+');
Route::get('/api/user/library/all',['uses' => 'LibraryController@getAll','as' => 'library.all']);
Route::get('/api/user/library/delete/{slug}', ['as'=> 'library.delete', 'uses'=> 'LibraryController@getDelete'])->where('slug','[\w\d\-\_]+');
Route::get('/api/group/delete/{slug}/member/{id}', ['as'=> 'group.dmember', 'uses'=> 'GroupController@memberdelete'])->where('slug','[\w\d\-\_]+');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/novel', 'NovelController@getAll')->name('getAll');

Route::get('/news/{slug}', ['as'=> 'news.lihat', 'uses'=> 'NewsController@lihat'])->where('slug','[\w\d\-\_]+');

Route::get('/novel/{slug}', ['as'=> 'novel.lihat', 'uses'=> 'NovelController@lihat'])->where('slug','[\w\d\-\_]+');
Route::get('/novel/{slug}/banner.jpg', ['as'=> 'novel.image', 'uses'=> 'UserController@image'])->where('slug','[\w\d\-\_]+');
Route::get('/novel/{slug}/{cat}', ['as'=> 'novel.cat', 'uses'=> 'NovelController@lihatc'])->where('slug','[\w\d\-\_]+');
Route::post('/novel/{slug}', ['as'=> 'sentReview', 'uses'=> 'ReviewController@sentReview'])->where('slug','[\w\d\-\_]+');
Route::get('/bab/{slug}', ['as'=> 'chapter.show', 'uses'=> 'ChapterController@tampil'])->where('slug','[\w\d\-\_]+');
Route::get('/read/{slug}', ['as'=> 'chapter.lihat', 'uses'=> 'ChapterController@lihat'])->where('slug','[\w\d\-\_]+');
Route::get('/people/{slug}', ['as'=> 'author.show', 'uses'=> 'PeopleController@getPeople'])->where('slug','[\w\d\-\_]+');
Route::post('/people/{slug}', ['as'=> 'Followor', 'uses'=> 'PeopleController@Followor'])->where('slug','[\w\d\-\_]+');
Route::get('/publisher/{slug}', ['as'=> 'publisher.show', 'uses'=> 'PublisherController@tampil'])->where('slug','[\w\d\-\_]+');
Route::get('/api-comment/{slug}', ['as'=> 'comment.show', 'uses'=> 'CommentController@getCommentAPI'])->where('slug','[\w\d\-\_]+');
Route::post('/api-send',['uses' => 'CommentController@sendCommentAPI','as' => 'sendCommentAPI']);
//Kontribusi route 
Route::get('/kontribusi/history', 'ChangelogController@kontribhistory')->name('kontribhistory');
Route::get('/kontribusi/preview/{slug}', 'ChangelogController@preview')->name('previewkontrib');
Route::get('/kontribusi/novel/{slug}/edit', 'NovelController@edit')->where('slug','[\w\d\-\_]+');
Route::resource('/kontribusi/novel', 'NovelController');
Route::resource('/kontribusi/bab', 'ChapterController');
Route::resource('/kontribusi/people', 'PeopleController');
//Ulasan route
Route::get('/ulasan', ['as'=> 'ulasan.index', 'uses'=> 'ReviewController@getAll']);
Route::get('/ulasan/{slug}', ['as'=> 'ulasan.user', 'uses'=> 'ReviewController@getReview'])->where('slug','[\w\d\-\_]+');
//Pengguna route
//Comment route
Route::get('/s/comment', 'UserController@comment')->name('comment');
//Setting route
Route::get('/user/setting', 'HomeController@setting')->name('setting');
Route::post('/user/setting',['uses' => 'HomeController@changePassword','as' => 'changePassword']);
Route::get('/user', ['as'=> 'user.index', 'uses'=> 'UserController@getAll']);
Route::get('/profile/{slug}', ['as'=> 'user.user', 'uses'=> 'UserController@getUser'])->where('slug','[\w\d\-\_]+');
Route::get('/profile/{slug}/{cat}', ['as'=> 'user.cat', 'uses'=> 'UserController@getUsercat'])->where('slug','[\w\d\-\_]+');
// Group route
Route::get('/group/{slug}', ['as'=> 'group.group', 'uses'=> 'UserController@getGroup'])->where('slug','[\w\d\-\_]+');
Route::post('/group/{slug}', ['as'=> 'Groupwor', 'uses'=> 'GroupController@groupwor'])->where('slug','[\w\d\-\_]+');
Route::post('/group/{slug}/news', ['as'=> 'group.news', 'uses'=> 'GroupController@createNews'])->where('slug','[\w\d\-\_]+');
Route::post('/group/{slug}/proyek', ['as'=> 'group.project', 'uses'=> 'GroupController@createproject'])->where('slug','[\w\d\-\_]+');
Route::post('/group/{slug}/rilisan', ['as'=> 'group.rilisan', 'uses'=> 'GroupController@createrilisan'])->where('slug','[\w\d\-\_]+');
Route::post('/group/{slug}/news', ['as'=> 'creategroupnews', 'uses'=> 'NewsController@creategroupnews'])->where('slug','[\w\d\-\_]+');
Route::get('/group/{slug}/manajer', ['as'=> 'group.manajer', 'uses'=> 'GroupController@manajer'])->where('slug','[\w\d\-\_]+');
Route::get('/group/{slug}/manajer/proyek/{id}', ['as'=> 'group.viewproyek', 'uses'=> 'GroupController@getProyek'])->where('slug','[\w\d\-\_]+');
Route::post('/group/{slug}/manajer/proyek/{id}', ['as'=> 'updateProyek', 'uses'=> 'GroupController@updateProyek'])->where('slug','[\w\d\-\_]+');
Route::get('/group/{slug}/manajer/rilisan/{id}', ['as'=> 'group.viewrilis', 'uses'=> 'GroupController@getRilisan'])->where('slug','[\w\d\-\_]+');
Route::post('/group/{slug}/manajer/rilisan/{id}', ['as'=> 'updateRilisan', 'uses'=> 'GroupController@updateRilisan'])->where('slug','[\w\d\-\_]+');
Route::get('/group/{slug}/manajer/news/{id}', ['as'=> 'group.viewnews', 'uses'=> 'NewsController@getGroupNews'])->where('slug','[\w\d\-\_]+');
Route::post('/group/{slug}/manajer/news/{id}', ['as'=> 'updatenews', 'uses'=> 'NewsController@updatenews'])->where('slug','[\w\d\-\_]+');
Route::get('/group/{slug}/setting', ['as'=> 'group.setting', 'uses'=> 'GroupController@setting'])->where('slug','[\w\d\-\_]+');
Route::post('/group/{slug}/setting', ['as'=> 'Groupset', 'uses'=> 'GroupController@groupset'])->where('slug','[\w\d\-\_]+');
Route::get('/group/{slug}/{cat}', ['as'=> 'group.cat', 'uses'=> 'UserController@getGroupcat'])->where('slug','[\w\d\-\_]+');
Route::get('/group', 'GroupController@index')->name('group.index');
Route::post('/group', 'GroupController@groupindex')->name('groupindex');

//Diff route 
Route::get('/diff/{slug}', ['as'=> 'diff.show', 'uses'=> 'DifferController@getDiff'])->where('slug','[\w\d\-\_]+');
Route::get('/diff/{slug}/create', ['as'=> 'diff.create', 'uses'=> 'DifferController@EditorDiff'])->where('slug','[\w\d\-\_]+');
Route::post('/diff/{slug}/create', ['as'=> 'diff.store', 'uses'=> 'DifferController@EditorDiff'])->where('slug','[\w\d\-\_]+');
//Novel Route
Route::get('/search',['uses' => 'NovelController@getSearch','as' => 'search']);
Route::get('/r',['uses' => 'NovelController@getRandom','as' => 'random']);

//Statis 
Route::get('/page/{slug}', ['as'=> 'statis', 'uses'=> 'StatisController@show'])->where('slug','[\w\d\-\_]+');

//Ranking route
Route::get('/ranking/user', ['as'=> 'ranking.user', 'uses'=> 'UserController@getRankUser']);
Route::get('/ranking/people', ['as'=> 'ranking.people', 'uses'=> 'UserController@getRankPpl']);
Route::get('/ranking/novel', ['as'=> 'ranking.novel', 'uses'=> 'UserController@getRankNovel']);