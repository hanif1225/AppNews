<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

<!-- Untuk Navbar Super Admin-->
        @if(auth()->user()->level=="superadmin")
          <li class="nav-item">
            <a  class="nav-link">
              <p>
                Main Menu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/" class="nav-link">
             <i class="nav-icon fas fa-globe"></i>
              <p>
                Halaman Utama
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Kelola Berita
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('postingan_adm') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_create_adm')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_pending_adm')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_adm_editing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_draft_adm')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Draft</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('postingan_ditolakadm')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('category')}}" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Kelola Kategori
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-comments"></i>
              <p>
                Kelola Komentar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('komentar_adm') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komentar Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('komentar_adm_pending')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('komentar_adm_ditolak')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komentar Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link">
              <p>
                Pengaturan
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-ad"></i>
              <p>
                Iklan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('iklan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Berita</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('iklan_ads')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adsense</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banner</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
              <p>
                Kelola Point
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('kelola_point')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Point</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('pengajuan_reward')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('riwayat_reward')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat Transaksi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-id-badge"></i>
              <p>
                Tentang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('tentang')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('kebijakan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ketentuan & Kebijakan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('contact')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bantuan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('datapengguna')}}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
              <p>
                Kelola Data Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('akses')}}" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Kelola Hak Akses
              </p>
            </a>
          </li>


<!-- Untuk Navbar User-->
        @elseif(auth()->user()->level=="user") 
          <li class="nav-item">
            <a  class="nav-link">
              <p>
                Main Menu
              </p>
            </a>
          </li>      
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="/" class="nav-link">
             <i class="nav-icon fas fa-globe"></i>
              <p>
                Halaman Utama
              </p>
            </a>
          </li> -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Kelola Berita
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('postingan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('postingan.pending') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_editing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('draft')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Draft</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_reject')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-comments"></i>
              <p>
                Kelola Komentar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('komentar_aktif')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komentar Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('komentar_pending')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('komentar_ditolak')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komentar Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a  class="nav-link">
              <p>
                Pengaturan
              </p>
            </a>
          </li>  
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
              <p>
                Kelola Point
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('history_reward')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('history_transaksi')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat Transaksi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('afiliasi') }}" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Afialiasi
              </p>
            </a>
          </li>

<!-- Untuk Navbar Kontributor-->
        @elseif(auth()->user()->level=="kontributor") 
          <li class="nav-item">
            <a  class="nav-link">
              <p>
                Main Menu
              </p>
            </a>
          </li>        
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
              Dashboard
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="/" class="nav-link">
             <i class="nav-icon fas fa-globe"></i>
              <p>
                Halaman Utama
              </p>
            </a>
          </li> -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Kelola Berita
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('postingan_kontributor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_kontributor_create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_kontributor_pending')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_kontributor_editing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('draft_kontributor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Draft</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_kontributor_reject')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-comments"></i>
              <p>
                Kelola Komentar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('komentar_aktif_kontributor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komentar Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('komentar_pending_kontributor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('komentar_ditolak_kontributor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komentar Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a  class="nav-link">
              <p>
                Pengaturan
              </p>
            </a>
          </li>  
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
              <p>
              Kelola Point
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('history_reward_kontributor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('history_transaksi_kontributor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat Transaksi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('afiliasi_kontributor') }}" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Afialiasi
              </p>
            </a>
          </li>

<!-- Untuk Navbar Editor-->
@elseif(auth()->user()->level=="editor")      
          <li class="nav-item">
            <a  class="nav-link">
              <p>
                Main Menu
              </p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
              Dashboard
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="/" class="nav-link">
             <i class="nav-icon fas fa-globe"></i>
              <p>
                Halaman Utama
              </p>
            </a>
          </li> -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Kelola Berita
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('postingan_editor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_editor_pending')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postinganedit_editor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_editor_draft')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Draft</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('postingan_editor_reject')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-comments"></i>
              <p>
                Kelola Komentar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('komentar_editor') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komentar Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('komentar_editor_pending')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('komentar_editor_ditolak')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komentar Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
         @endif
        </ul>
      </nav>