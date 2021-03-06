<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Tambah Mata Pelajaran</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                echo form_open('mapel/add', 'role="form" class="form-horizontal"');
            ?>

                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Kode Matakuliah</label>

                      <div class="col-sm-9">
                        <input type="text" name="kd_mapel" class="form-control" placeholder="Masukkan Kode Mapel">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label">NAMA MATKUL</label>

                      <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama MATKUL">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label">SKS</label>

                      <div class="col-sm-9">
                        <input type="text" name="sks" class="form-control" placeholder="Masukkan SKS">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-1">
                        <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
                      </div>

                      <div class="col-sm-1">
                        <?php
                          echo anchor('mapel', 'Kembali', array('class'=>'btn btn-danger btn-flat'));
                        ?>
                      </div>
                  </div>

                </div>
                <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>