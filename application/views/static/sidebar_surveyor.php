      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Survei Harga Komoditas</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SHK</a>
          </div>
          
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li <?php if ($menu=='home') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('home')?>"><i class="fas fa-fire"></i> <span>Home</span></a>
            </li>
            <li <?php if ($menu=='komoditas') {echo "class=active";} else {echo "";}?>>
              <a class="nav-link" href="<?php echo base_url('survey')?>"><i class="fas fa-inbox"></i> <span>Komoditas</span></a>
            </li>
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?php echo base_url(); ?>login/logout" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </div>        </aside>
      </div>