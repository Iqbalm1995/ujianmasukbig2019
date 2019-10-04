      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Home</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Home</a></div>
              <!-- <div class="breadcrumb-item"><a href="#">Forms</a></div>
              <div class="breadcrumb-item">Advanced Forms</div> -->
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="text-center">
                <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
                <h2>SELAMAT DATANG DI APLIKASI SURVEI HARGA KOMODITAS</h2>
              </div>
            </div>                 
          </div>
        </section>
      </div>

