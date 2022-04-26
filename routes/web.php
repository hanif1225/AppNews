<?php
use App\Models\Postingan;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RiwayatrewardController;
use App\Http\Controllers\RiwayatrewardkontributorController;
use App\Http\Controllers\AfiliasiController;
use App\Http\Controllers\AfiliasikontributorController;

//user
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\LikeuserController;
use App\Http\Controllers\User\PostinganuserController;
use App\Http\Controllers\User\KomentaruserController;
use App\Http\Controllers\User\TransaksiController;

//kontributor
use App\Http\Controllers\Kontributor\ProfileKontributorController;
use App\Http\Controllers\Kontributor\KomentarkontributorController;
use App\Http\Controllers\Kontributor\PostingankontributorController;
use App\Http\Controllers\Kontributor\LikecontributorController;
use App\Http\Controllers\Kontributor\TransaksikontributorController;

//editor
use App\Http\Controllers\Editor\ProfileEditorController;
use App\Http\Controllers\Editor\KomentareditorController;
use App\Http\Controllers\Editor\PostinganeditorController;


//superadmin
use App\Http\Controllers\SuperAdmin\KomentarController;
use App\Http\Controllers\SuperAdmin\DatapenggunaController;
use App\Http\Controllers\SuperAdmin\PostinganadminController;
use App\Http\Controllers\SuperAdmin\CategoryController;
use App\Http\Controllers\SuperAdmin\CKEditorController;
use App\Http\Controllers\SuperAdmin\TentangController;
use App\Http\Controllers\SuperAdmin\AksesController;
use App\Http\Controllers\SuperAdmin\LikeController;
use App\Http\Controllers\SuperAdmin\IklanController;
use App\Http\Controllers\SuperAdmin\KebijakanController;
use App\Http\Controllers\SuperAdmin\ContactController;
use App\Http\Controllers\SuperAdmin\PengajuanadmController;
use App\Http\Controllers\SuperAdmin\PointController;

//umum
use App\Http\Controllers\Umum\PostinganumumController;

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

//umum
 Route::get('/',[PostinganumumController::class,'index'])->name('index');
// Route::get('/', function () {
//     return view('login');
// });


Route::get('/artikel/{postingan:slug}',[PostinganumumController::class,'show'])->name('artikel_show');
Route::get('/artikel/kategori/{category:slug}',[PostinganumumController::class,'show_category'])->name('show_kategori');
Route::get('/about',[PostinganumumController::class,'tentang'])->name('umum_tentang');  
Route::get('/isi_tentang',[PostinganumumController::class,'isi_tentang'])->name('isi_tentang_api');  
Route::get('/kebijakan',[PostinganumumController::class,'kebijakan'])->name('umum_kebijakan');  
Route::get('/isi_kebijakan',[PostinganumumController::class,'isi_kebijakan']); 
Route::get('/bantuan',[PostinganumumController::class,'bantuan'])->name('bantuan');  
Route::get('/isi_bantuan',[PostinganumumController::class,'isi_bantuan']);

//User
Route::group(['middleware'=>'user'],function(){

    //afiliasi
    Route::get('/afiliasi',[AfiliasiController::class,'index'])->name('afiliasi');
    Route::put('/afiliasi/update/{id}',[AfiliasiController::class,'update'])->name('afiliasi_update');

    //profile
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::get('/profile/create',[ProfileController::class,'create'])->name('create_profile');
    Route::post('/profile/store',[ProfileController::class,'store'])->name('profile.store');
    Route::get('/profile/edit/{id}',[ProfileController::class,'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}',[ProfileController::class,'update'])->name('profile.update');

    //pendaftaran hak akses
    Route::get('/pendaftaran/{id}',[PendaftaranController::class,'edit'])->name('pendaftaran');
    Route::put('/pendaftaran/update/{id}',[PendaftaranController::class,'update'])->name('pendaftaran.update');

    //Postingan
    Route::get('/postingan/aktif',[PostinganuserController::class,'index'])->name('postingan');
    Route::get('/postingan/draft',[PostinganuserController::class,'draft'])->name('draft');
    Route::get('/postingan/create',[PostinganuserController::class,'create'])->name('postingan.create');
    Route::post('/postingan/store',[PostinganuserController::class,'store'])->name('postingan_store');
    Route::get('/postingan/pending',[PostinganuserController::class,'pending'])->name('postingan.pending');
    Route::get('/postingan/editing',[PostinganuserController::class,'tampil_editing'])->name('postingan_editing');
    Route::get('/postingan/reject',[PostinganuserController::class,'reject'])->name('postingan_reject');
    Route::get('/postingan/perbaikan/{postingan:slug}',[PostinganuserController::class,'perbaikan'])->name('postingan_perbaikan');
    Route::get('/postingan/edit/{postingan:slug}',[PostinganuserController::class,'edit'])->name('edit_post');
    Route::put('/postingan/update/{postingan:slug}',[PostinganuserController::class,'update'])->name('postingan_update');
    Route::get('/postingan/{postingan:slug}',[PostinganuserController::class,'show'])->name('postingan_show');
    Route::delete('/postingan/delete/{postingan:slug}',[PostinganuserController::class,'destroy'])->name('postingan_delete');

    Route::get('/like_user/{id}',[LikeuserController::class,'like'])->name('like_user');
    //komentar
    Route::post('/komentar',[KomentaruserController::class,'store'])->name('komentar');
    Route::get('/userkomentar',[KomentaruserController::class,'index'])->name('komentar_aktif');
    Route::get('/userkomentar/pending',[KomentaruserController::class,'pending'])->name('komentar_pending');
    Route::get('/userkomentar/ditolak',[KomentaruserController::class,'ditolak'])->name('komentar_ditolak');
    Route::delete('/userkomentar/delete/{id}',[KomentaruserController::class,'destroy'])->name('komentar_delete');
    Route::get('/userkomentar/show/{id}',[KomentaruserController::class,'show'])->name('komentar_user_show');

    //Reward
    Route::get('/history-reward',[RiwayatrewardController::class,'index'])->name('history_reward');
    Route::put('/proses/transaksi/{id}',[TransaksiController::class,'transaksi'])->name('proses_transaksi');
    Route::get('/history-transaksi',[TransaksiController::class,'history'])->name('history_transaksi');
    
});

//kontributor
Route::group(['middleware'=>'kontributor'],function(){

    //afiliasi
    Route::get('/afiliasi/kontributor',[AfiliasikontributorController::class,'index'])->name('afiliasi_kontributor');
    Route::put('/afiliasi/update/kontributor/{id}',[AfiliasikontributorController::class,'update'])->name('afiliasi_update_kontributor');

    //profile
    Route::get('/kontributor/profile',[ProfileKontributorController::class,'index'])->name('profile.kontributor');
    Route::get('/kontributor/profile/create',[ProfileKontributorController::class,'create'])->name('profile.createkontributor');
    Route::post('/kontributor/profile/store',[ProfileKontributorController::class,'store'])->name('profile.storekontributor');
    Route::get('/kontributor/profile/edit/{id}',[ProfileKontributorController::class,'edit'])->name('profile.editkontributor');
    Route::put('/kontributor/profile/update/{id}',[ProfileKontributorController::class,'update'])->name('profile.updatekontributor');

    //postingan
    Route::get('/postingan/aktif/kontributor',[PostingankontributorController::class,'index'])->name('postingan_kontributor');
    Route::get('/postingan/draft/kontributor',[PostingankontributorController::class,'draft'])->name('draft_kontributor');
    Route::get('/postingan/editing/kontributor',[PostingankontributorController::class,'tampil_editing'])->name('postingan_kontributor_editing');
    Route::get('/postingan/create/kontributor',[PostingankontributorController::class,'create'])->name('postingan_kontributor_create');
    Route::post('/postingan/store/kontributor',[PostingankontributorController::class,'store'])->name('postingan_kontributor_store');
    Route::get('/postingan/checkSlug/kontributor',[PostingankontributorController::class,'checkSlug'])->name('postingan_slug_kontributor');
    Route::get('/postingan/pending/kontributor',[PostingankontributorController::class,'pending'])->name('postingan_kontributor_pending');
    Route::get('/postingan/reject/kontributor',[PostingankontributorController::class,'reject'])->name('postingan_kontributor_reject');
    Route::get('/postingan/perbaikan/kontributor/{postingan:slug}',[PostingankontributorController::class,'perbaikan'])->name('postingan_kontributor_perbaikan');
    Route::put('/postingan/update/kontributor/{postingan:slug}',[PostingankontributorController::class,'update'])->name('postingan_kontributor_update');
    Route::get('/postingan/kontributor/{postingan:slug}',[PostingankontributorController::class,'show'])->name('postingan_kontributor_show');
    Route::get('/postingan-edit/kontributor/{postingan:slug}',[PostingankontributorController::class,'edit'])->name('postingan_kontributor_edit');
    Route::delete('/postingan/delete/kontributor/{postingan:slug}',[PostingankontributorController::class,'destroy'])->name('postingan_kontributor_delete');
    Route::get('/like_kontributor/{id}',[LikecontributorController::class,'like'])->name('like_kontributor');

    //komentar
     Route::post('/komentar/kontributor',[KomentarkontributorController::class,'store'])->name('komentar_kontributor');
     Route::get('/komentar/kontributor/aktif',[KomentarkontributorController::class,'index'])->name('komentar_aktif_kontributor');
     Route::get('/komentar/kontributor/pending',[KomentarkontributorController::class,'pending'])->name('komentar_pending_kontributor');
     Route::get('/komentar/kontributor/ditolak',[KomentarkontributorController::class,'ditolak'])->name('komentar_ditolak_kontributor');
     Route::delete('/komentar/kontributor/delete/{id}',[KomentarkontributorController::class,'destroy'])->name('komentar_delete_kontributor');
     Route::get('/komentar/kontributor/show/{id}',[KomentarkontributorController::class,'show'])->name('komentar_show_kontributor');

    //Reward
     Route::get('/history-reward-kontributor',[RiwayatrewardkontributorController::class,'index'])->name('history_reward_kontributor');
     Route::put('/proses/transaksi-kontributor/{id}',[TransaksikontributorController::class,'transaksi'])->name('proses_transaksi_kontributor');
     Route::get('/history-transaksi-kontributor',[TransaksikontributorController::class,'history'])->name('history_transaksi_kontributor');
     
});

//editor
Route::group(['middleware'=>'editor'],function(){

    // profile
    Route::get('/editor/profile',[ProfileEditorController::class,'index'])->name('profile.editor');
    Route::get('/editor/profile/create',[ProfileEditorController::class,'create'])->name('profile.createeditor');
    Route::post('/editor/profile/store',[ProfileEditorController::class,'store'])->name('profile.storeeditor');
    Route::get('/editor/profile/edit/{id}',[ProfileEditorController::class,'edit'])->name('profile.editeditor');
    Route::put('/editor/profile/update/{id}',[ProfileEditorController::class,'update'])->name('profile.updateeditor');

    //postingan
    Route::get('/postingan/aktif/editor',[PostinganeditorController::class,'index'])->name('postingan_editor');
    Route::get('/post/edit/editor/',[PostinganeditorController::class,'menampilkan'])->name('postinganedit_editor');
    Route::get('/postingan/checkSlug/editor',[PostinganeditorController::class,'checkSlug'])->name('postingan_slug_editor');
    Route::get('/postingan/pending/editor',[PostinganeditorController::class,'pending'])->name('postingan_editor_pending');
    Route::get('/postingan/draft/editor',[PostinganeditorController::class,'draft'])->name('postingan_editor_draft');
    Route::get('/postingan/edit-aktif/editor/{postingan:slug}',[PostinganeditorController::class,'edit'])->name('post_editor_edit');
    Route::get('/postingan/reject/editor',[PostinganeditorController::class,'reject'])->name('postingan_editor_reject');
    Route::get('/postingan/editor/{postingan:slug}',[PostinganeditorController::class,'show'])->name('postingan_editor_show');
    Route::get('/postingan/proses_editing/{postingan:slug}',[PostinganeditorController::class,'proses_editing'])->name('proses_editing_editor');
    Route::put('/postingan/publish/editor/{postingan:slug}',[PostinganeditorController::class,'publish'])->name('postingan_editor_publish');
    Route::put('/postingan/editing/editor/{postingan:slug}',[PostinganeditorController::class,'editing'])->name('postingan_editor_editing');
    Route::get('/postingan/alasan/editor/{postingan:slug}',[PostinganeditorController::class,'alasan'])->name('postingan_editor_alasan');
    Route::put('/postingan/rejected/editor/{postingan:slug}',[PostinganeditorController::class,'rejected'])->name('editorrejected');
    Route::put('/postingan/ditolak/editor/{postingan:slug}',[PostinganeditorController::class,'update_editing'])->name('update_edit_editor');
    Route::put('/postingan/aktif-update/editor/{postingan:slug}',[PostinganeditorController::class,'update'])->name('update_post_editor');
    Route::delete('/editorpostingan/delete/{postingan:slug}',[PostinganeditorController::class,'destroy'])->name('postingan_delete_editor');
    //komentar
    Route::get('/editorkomentar',[KomentareditorController::class,'index'])->name('komentar_editor');
    Route::get('/editorkomentar/ditolak',[KomentareditorController::class,'ditolak'])->name('komentar_editor_ditolak');
    Route::get('/editorkomentar/pending',[KomentareditorController::class,'pending'])->name('komentar_editor_pending');
    Route::get('/editorkomentar/alasan/{id}',[KomentareditorController::class,'alasan'])->name('komentar_editor_alasan');
    Route::put('/editorkomentar/aktif/{id}',[KomentareditorController::class,'update'])->name('komentar_editor_aktif');
    Route::put('/editorkomentar/rejected/{id}',[KomentareditorController::class,'rejected'])->name('komentar_editor_rejected');
    Route::delete('/editorkomentar/delete/{id}',[KomentareditorController::class,'destroy'])->name('komentar_editor_delete');
    Route::get('/editorkomentar/show/{id}',[KomentareditorController::class,'show'])->name('komentar_editor_show');

    //Tentang
    
});

//SuperAdmin
Route::group(['middleware'=>'superadmin'],function(){

    //kelola data pengguna
    Route::get('/datapengguna',[DatapenggunaController::class,'index'])->name('datapengguna');
    Route::get('/datapengguna/create',[DatapenggunaController::class,'create'])->name('datapengguna.create');
    Route::post('/datapengguna/store',[DatapenggunaController::class,'store'])->name('datapengguna.store');
    Route::get('/datapengguna/create/profil/{id}',[DatapenggunaController::class,'create_profil'])->name('datapengguna.createprofile');
    Route::post('/datapengguna/store/profil/{id}',[DatapenggunaController::class,'store_profil'])->name('datapengguna.storeprofile');
    Route::get('/datapengguna/show/{id}',[DatapenggunaController::class,'show'])->name('datapengguna.show');
    Route::get('/datapengguna/edit/{id}',[DatapenggunaController::class,'edit'])->name('datapengguna.edit');
    Route::put('/datapengguna/update/{id}',[DatapenggunaController::class,'update'])->name('datapengguna.update');
    Route::delete('/datapengguna/delete/{id}',[DatapenggunaController::class,'destroy'])->name('datapengguna.delete');
    Route::delete('/datapengguna/delete/profil/{id}',[DatapenggunaController::class,'destroy_profil'])->name('datapenggunaprofil.delete');

    //kelola data akses
    Route::get('/akses',[AksesController::class,'index'])->name('akses');
    Route::post('/akses/store',[AksesController::class,'store'])->name('akses.store');
    Route::delete('/akses/delete/{id}',[AksesController::class,'destroy'])->name('akses_delete');

    //kelola category
    Route::get('/category',[CategoryController::class,'index'])->name('category');
    Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::put('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');

    //postingan
    Route::get('/admpostingan',[PostinganadminController::class,'index'])->name('postingan_adm');
    Route::get('/admpostingan/editing',[PostinganadminController::class,'tampil_editing'])->name('postingan_adm_editing');
    Route::get('/admpostingan/create',[PostinganadminController::class,'create'])->name('postingan_create_adm');
    Route::get('/admpostingan/checkSlug',[PostinganadminController::class,'checkSlug'])->name('postingan_slug_adm');
    Route::get('/admpostingan/draft',[PostinganadminController::class,'draft'])->name('postingan_draft_adm');
    Route::post('/admpostingan/store',[PostinganadminController::class,'store'])->name('postingan_store_adm');
    Route::get('/admpostingan/pending',[PostinganadminController::class,'pending'])->name('postingan_pending_adm');
    Route::get('/admpostingan/ditolak',[PostinganadminController::class,'ditolak'])->name('postingan_ditolakadm');
    Route::get('/admpostingan/proses_editing/{postingan:slug}',[PostinganadminController::class,'proses_editing'])->name('proses_editing_adm');
    Route::get('/admpostingan/proses-editing-aktif/{postingan:slug}',[PostinganadminController::class,'edit'])->name('post_edit_aktif');
    Route::get('/admpostingan/{postingan:slug}',[PostinganadminController::class,'show'])->name('postingan_show_adm');
    Route::put('/admpostingan/publish/{postingan:slug}',[PostinganadminController::class,'publish'])->name('postingan_publish_adm');
    Route::get('/admpostingan/alasan/{postingan:slug}',[PostinganadminController::class,'alasan'])->name('postingan_alasan_adm');
    Route::put('/admpostingan/ditolak/{postingan:slug}',[PostinganadminController::class,'rejected'])->name('postingan_ditolak_adm');
    Route::put('/admpostingan/editing/{postingan:slug}',[PostinganadminController::class,'editing'])->name('postingan_editing_adm');
    Route::put('/admpostingan/update/edit/{postingan:slug}',[PostinganadminController::class,'update_editing'])->name('update_edit_adm');
    Route::put('/admpostingan/update/aktif/{postingan:slug}',[PostinganadminController::class,'update'])->name('update_editaktif_adm');
    Route::delete('/admpostingan/delete/{postingan:slug}',[PostinganadminController::class,'destroy'])->name('postingan_delete_adm');
    Route::get('/like/{id}',[LikeController::class,'like'])->name('like_adm');
   

    //Komentar
    Route::get('/admkomentar',[KomentarController::class,'index'])->name('komentar_adm');
    Route::get('/admkomentar/ditolak',[KomentarController::class,'ditolak'])->name('komentar_adm_ditolak');
    Route::get('/admkomentar/pending',[KomentarController::class,'pending'])->name('komentar_adm_pending');
    Route::get('/admkomentar/alasan/{id}',[KomentarController::class,'alasan'])->name('komentar_adm_alasan');
    Route::put('/admkomentar/aktif/{id}',[KomentarController::class,'update'])->name('komentar_adm_aktif');
    Route::put('/admkomentar/rejected/{id}',[KomentarController::class,'rejected'])->name('komentar_adm_rejected');
    Route::delete('/admkomentar/delete/{id}',[KomentarController::class,'destroy'])->name('komentar_adm_delete');
    Route::get('/admkomentar/show/{id}',[KomentarController::class,'show'])->name('komentar_adm_show');
   
    //Tentang
    Route::get('/isi-tentang',[TentangController::class,'index'])->name('tentang');
    Route::get('/tentang',[TentangController::class,'create'])->name('tentang_create_adm');
    Route::get('/tentang/{id}',[TentangController::class,'edit'])->name('tentang_edit_adm');
    Route::put('/tentang/{id}',[TentangController::class,'update'])->name('tentang_update_adm');
    Route::post('/tentang/store',[TentangController::class,'store'])->name('tentang_store');
    Route::post('/tentang',[TentangController::class,'upload'])->name('upload');

    //Kebijakan
    Route::get('/isi-kebijakan',[KebijakanController::class,'index'])->name('kebijakan');
    Route::get('/store/kebijakan',[KebijakanController::class,'create'])->name('create_kebijakan');
    Route::get('/kebijakan/{id}',[KebijakanController::class,'edit'])->name('edit_kebijakan');
    Route::put('/kebijakan/{id}',[KebijakanController::class,'update'])->name('update_kebijakan');
    Route::post('/kebijakan',[KebijakanController::class,'store'])->name('store_kebijakan');

    //contact
    Route::get('/isi-contact',[ContactController::class,'index'])->name('contact');
    Route::post('/contact/store',[ContactController::class,'store'])->name('contact_store');
    Route::put('/contact/update/{id}',[ContactController::class,'update'])->name('contact_update');

    //iklan 
    Route::get('/iklan',[IklanController::class,'index'])->name('iklan');
    Route::get('/iklan-ads',[IklanController::class,'iklan_ads'])->name('iklan_ads');
    Route::get('/iklan-ads/create',[IklanController::class,'create'])->name('iklan_ads_create');
    Route::post('/iklan-ads/tambah',[IklanController::class,'add'])->name('iklan_ads_tambah');
    Route::get('/iklan-ads/{id}',[IklanController::class,'edit'])->name('iklan_ads_edit');
    Route::post('/iklan',[IklanController::class,'store'])->name('kirim_iklan');
    Route::put('/iklan/{id}',[IklanController::class,'update'])->name('update_iklan');
    Route::put('/iklan/ads/{id}',[IklanController::class,'update_ads'])->name('update_iklan_ads');
    Route::delete('/iklan/ads/delete/{id}',[IklanController::class,'destroy'])->name('delete_iklan_ads');
    
   
    //Reward
    Route::get('/kelola-point',[PointController::class,'index'])->name('kelola_point');
    Route::get('/pengajuan/reward',[PengajuanadmController::class,'index'])->name('pengajuan_reward');
    Route::get('/riwayat/reward',[PengajuanadmController::class,'riwayat'])->name('riwayat_reward');
    Route::put('/pengajuan/reward/{id}',[PengajuanadmController::class,'update'])->name('pengajuan_reward_update');
    Route::put('/pengajuan/update/{id}',[PengajuanadmController::class,'update_transaksi'])->name('update_pengajuan');
    Route::post('/kelola-point/add',[PointController::class,'store'])->name('point_store');
    Route::put('/kelola-point/update/{id}',[PointController::class,'update'])->name('point_update');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
