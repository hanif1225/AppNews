<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\AfiliasirestController;

//user
use App\Http\Controllers\User\LikerestController;
use App\Http\Controllers\User\ProfilRestController;
use App\Http\Controllers\User\RewardrestController;
use App\Http\Controllers\User\UserrestpostController;
use App\Http\Controllers\User\StatistikrestController;
use App\Http\Controllers\User\TransaksirestController;

//umum
use App\Http\Controllers\Umum\PostinganrestController;
use App\Http\Controllers\Editor\KomentarrestController;


//editor
use App\Http\Controllers\Umum\KomentarumumrestController;
use App\Http\Controllers\User\KomentaruserrestController;
use App\Http\Controllers\Editor\PostinganresteditorController;

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



Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {

    Route::resource('posts', PostController::class);

    //user & kontributor

    //afiliasi
    Route::get('afiliasiuser', [AfiliasirestController::class, 'index']);
    Route::put('afiliasiuser/update/{id}', [AfiliasirestController::class, 'update']);


    //profile
    Route::get('profil', [ProfilRestController::class, 'index']);
    Route::post('profil', [ProfilRestController::class, 'store']);
    Route::get('profil/edit/{id}', [ProfilRestController::class, 'edit']);
    Route::put('profil/update/{id}', [ProfilRestController::class, 'update']);

    //postingan
    Route::post('/postuser', [UserrestpostController::class, 'postuser']);
    Route::get('isi/postingan', [UserrestpostController::class, 'index']);
    Route::get('data_iklan', [UserrestpostController::class, 'data_iklan']);
    Route::post('postingan', [UserrestpostController::class, 'store']);
    Route::post('/postingan-user/draft', [UserrestpostController::class, 'draft']); 
    Route::get('postingan/edit/{id}', [UserrestpostController::class, 'edit']);
    Route::put('postingan/update/data/{id}', [UserrestpostController::class, 'update']);
    Route::delete('postingan/delete/data/{id}', [UserrestpostController::class, 'destroy']);
    Route::get('/pending', [UserrestpostController::class, 'pending']);
    Route::get('/editing', [UserrestpostController::class, 'editing']);
    Route::get('history', [UserrestpostController::class, 'history']);
    Route::post('history', [UserrestpostController::class, 'insert_history']);

    //komentar
    Route::get('/komentar/aktif/user', [KomentaruserrestController::class, 'index']);
    Route::post('/kirim_komentar', [KomentaruserrestController::class, 'store']);
    Route::get('/komentar/pending/user', [KomentaruserrestController::class, 'pending']);
    Route::get('/komentar/ditolak/user', [KomentaruserrestController::class, 'ditolak']);
    Route::delete('/delete_komentar/user/{id}', [KomentaruserrestController::class, 'destroy']);

    //menampilkan statistik
    Route::get('/statistik', [StatistikrestController::class, 'index']);


    //transaksi
    Route::put('/transaksi_user/{id}', [TransaksirestController::class, 'transaksi']);
    Route::get('/tampil/history_reward', [TransaksirestController::class, 'history']);



    //Pengajuan Hak Akses
    Route::put('/hak_akses/{id}', [ProfilRestController::class, 'pendaftaran']);

    // reward
    Route::get('/reward/{id}', [RewardrestController::class, 'show']);
    Route::get('/history_reward', [RewardrestController::class, 'history_reward']);
    Route::post('/reward/{postingan:slug}', [RewardrestController::class, 'reward']);

//Editor
    // postingan
    Route::post('/posteditor', [PostinganresteditorController::class, 'posteditor']);
    Route::put('/editing_postingan/{postingan:slug}', [PostinganresteditorController::class, 'editing']);
    Route::put('/publish/{postingan:slug}', [PostinganresteditorController::class, 'publish']);
    Route::put('/reject/{id}', [PostinganresteditorController::class, 'rejected']);
    Route::put('/edit_postingan/{postingan:slug}', [PostinganresteditorController::class, 'update']);
    Route::put('/simpan_draft/{postingan:slug}', [PostinganresteditorController::class, 'simpan_draft']);
    Route::put('/update_post_aktif/{postingan:slug}', [PostinganresteditorController::class, 'update_aktif']);  

    //Menampilkan fungsi Like
    Route::get('/like_data/{id}', [LikerestController::class, 'like']);
    //cek like
    Route::get('/cek_like/{id}', [LikerestController::class, 'cek_like']);



    //komentar

    Route::get('/komentar/aktif', [KomentarrestController::class, 'index']);
    Route::get('/komentar/pending', [KomentarrestController::class, 'pending']);
    Route::get('/komentar/ditolak', [KomentarrestController::class, 'ditolak']);
    Route::put('/aktivasi_komentar/{id}', [KomentarrestController::class, 'update']);
    Route::put('/reject_komentar/{id}', [KomentarrestController::class, 'rejected']);
    Route::delete('/delete_komentar/{id}', [KomentarrestController::class, 'destroy']);
});

Route::get('profil/edit/{id}', [ProfilRestController::class, 'edit']);

//umum
Route::get('category', [PostinganrestController::class, 'category']);
//menampilkan postingan
Route::get('index', [PostinganrestController::class, 'index']);
Route::get('trending', [PostinganrestController::class, 'trending']);
Route::get('/postingan/user/{id}', [PostinganrestController::class, 'postingan_user']);
//menampilkan detail postingan
route::get('/postingan/detail/{id}', [PostinganrestController::class, 'show']);
//menampilkan postingan berdasarkan kategori
route::post('/postingan/category/{id}', [PostinganrestController::class, 'postingan_category']);
route::post('/postingan/category/new/{id}', [PostinganrestController::class, 'postnew_category']);
route::post('/postingan/category/trending/{id}', [PostinganrestController::class, 'trending_category']);
//menampilkan iklan
Route::get('iklan', [PostinganrestController::class, 'iklan']);
//pencarian
Route::post('search', [PostinganrestController::class, 'search']);

//Menampilkan Jumlah like 
Route::get('/jumlah_like/{id}', [LikerestController::class, 'show_like']);
//Komentar 
Route::get('/jumlah_komentar/{id}', [KomentarumumrestController::class, 'show']);
Route::get('/detail_komentar/{id}', [KomentarumumrestController::class, 'detail']);
