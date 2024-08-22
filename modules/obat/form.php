 <?php
  // fungsi untuk pengecekan tampilan form
  // jika form add data yang dipilih
  if ($_GET['form'] == 'add') { ?>
   <!-- tampilan form add data -->
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       <i class="fa fa-edit icon-title"></i> Input Barang
     </h1>
     <ol class="breadcrumb">
       <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
       <li><a href="?module=obat"> Barang </a></li>
       <li class="active"> Tambah </li>
     </ol>
   </section>

   <!-- Main content -->
   <section class="content">
     <div class="row">
       <div class="col-md-12">
         <div class="box box-primary">
           <!-- form start -->
           <form role="form" class="form-horizontal" action="modules/obat/proses.php?act=insert" method="POST">
             <div class="box-body">
               <?php
                // fungsi untuk membuat id transaksi
                $query_id = mysqli_query($mysqli, "SELECT RIGHT(kode_obat,6) as kode FROM is_obat
                                                ORDER BY kode_obat DESC LIMIT 1")
                  or die('Ada kesalahan pada query tampil kode_obat : ' . mysqli_error($mysqli));

                $count = mysqli_num_rows($query_id);
                

                if ($count <> 0) {
                  // mengambil data kode_obat
                  $data_id = mysqli_fetch_assoc($query_id);
                  $kode    = $data_id['kode'] + 1;
                } else {
                  $kode = 1;
                }

                // buat kode_obat
                
                $buat_id   = str_pad($kode, 6, "0", STR_PAD_LEFT);
                $kode_obat = "A$buat_id";
                
                ?>

               <div class="form-group">
                 <label class="col-sm-2 control-label">Kode Barang</label>
                 <div class="col-sm-5">
                   <input type="text" class="form-control" name="kode_obat" value="<?php echo $kode_obat; ?>" readonly required>
                 </div>
               </div>

               <div class="form-group">
                 <label class="col-sm-2 control-label">Nama Barang</label>
                 <div class="col-sm-5">
                   <input type="text" class="form-control" name="nama_obat" autocomplete="off" required>
                 </div>
               </div>

               <div class="form-group">
                 <label class="col-sm-2 control-label">Jenis Barang</label>
                 <div class="col-sm-5">
                   <select class="chosen-select" name="jenis" data-placeholder="-- Pilih --" autocomplete="off" required>
                     <option value=""></option>
                     <option value="peternakan">Peternakan</option>
                     <option value="pertanian">Pertanian</option>
                     <option value="dll">DLL</option>
                   </select>
                 </div>
               </div>

               <div class="form-group">
                 <label class="col-sm-2 control-label">Harga Satuan</label>
                 <div class="col-sm-5">
                   <div class="input-group">
                     <span class="input-group-addon">Rp.</span>
                     <input type="text" class="form-control" id="harga_beli" name="harga_beli" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                   </div>
                 </div>
               </div>

               <!-- TIDAK MASUK DATABASE -->
               <!--
              <div class="form-group">
                <label class="col-sm-2 control-label">Total Harga</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="total_harga" name="total_harga" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" disabled>
                  </div>
                </div>
              </div> 
              -->

               <div class="form-group">
                 <label class="col-sm-2 control-label">Satuan</label>
                 <div class="col-sm-5">
                   <select class="chosen-select" name="satuan" data-placeholder="-- Pilih --" autocomplete="off" required>
                     <option value=""></option>
                     <option value="Ampul">Ampul</option>
                     <option value="Botol">Botol</option>
                     <option value="Box">Box</option>
                     <option value="Buah">Buah</option>
                     <option value="Bungkus">Bungkus</option>
                     <option value="Bolus">Bolus</option>
                     <option value="Butir">Butir</option>
                     <option value="Dosis">Dosis</option>
                     <option value="Dus">Dus</option>
                     <option value="Flass">Flass</option>
                     <option value="Kaleng">Kaleng</option>
                     <option value="Kotak">Kotak</option>
                     <option value="Kg">Kg</option>
                     <option value="Lembar">Lembar</option>
                     <option value="Liter">Liter</option>
                     <option value="Pack">Pack</option>
                     <option value="Pasang">Pasang</option>
                     <option value="Paket">Paket</option>
                     <option value="Pcs">Pcs</option>
                     <option value="Pot">Pot</option>
                     <option value="Roll">Roll</option>
                     <option value="Sachet">Sachet</option>
                     <option value="Set">Set</option>
                     <option value="Unit">Unit</option>
                     <option value="Us">Us</option>
                     <option value="Tablet">Tablet</option>
                     <option value="Tube">Tube</option>
                     <option value="Vial">Vial</option>
                   </select>
                 </div>
               </div>

             </div><!-- /.box body -->

             <div class="box-footer">
               <div class="form-group">
                 <div class="col-sm-offset-2 col-sm-10">
                   <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                   <a href="?module=obat" class="btn btn-default btn-reset">Batal</a>
                 </div>
               </div>
             </div><!-- /.box footer -->
           </form>
         </div><!-- /.box -->
       </div><!--/.col -->
     </div> <!-- /.row -->
   </section><!-- /.content -->
 <?php
  }
  // jika form edit data yang dipilih
  // isset : cek data ada / tidak
  elseif ($_GET['form'] == 'edit') {
    if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel obat
      $query = mysqli_query($mysqli, "SELECT kode_obat,nama_obat,jenis,harga_beli,satuan FROM is_obat WHERE kode_obat='$_GET[id]'")
        or die('Ada kesalahan pada query tampil Data obat : ' . mysqli_error($mysqli));
      $data  = mysqli_fetch_assoc($query);
    }
  ?>
   <!-- tampilan form edit data -->
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       <i class="fa fa-edit icon-title"></i> Ubah Barang
     </h1>
     <ol class="breadcrumb">
       <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
       <li><a href="?module=obat"> Barang </a></li>
       <li class="active"> Ubah </li>
     </ol>
   </section>

   <!-- Main content -->
   <section class="content">
     <div class="row">
       <div class="col-md-12">
         <div class="box box-primary">
           <!-- form start -->
           <form role="form" class="form-horizontal" action="modules/obat/proses.php?act=update" method="POST">
             <div class="box-body">

               <div class="form-group">
                 <label class="col-sm-2 control-label">Kode Barang</label>
                 <div class="col-sm-5">
                   <input type="text" class="form-control" name="kode_obat" value="<?php echo $data['kode_obat']; ?>" readonly required>
                 </div>
               </div>

               <div class="form-group">
                 <label class="col-sm-2 control-label">Nama Barang</label>
                 <div class="col-sm-5">
                   <input type="text" class="form-control" name="nama_obat" autocomplete="off" value="<?php echo $data['nama_obat']; ?>" required>
                 </div>
               </div>

               <div class="form-group">
                 <label class="col-sm-2 control-label">Jenis Barang</label>
                 <div class="col-sm-5">
                   <select class="chosen-select" name="jenis" data-placeholder="-- Pilih --" autocomplete="off" required>
                     <option value="<?php echo $data['jenis']; ?>"><?php echo $data['jenis']; ?></option>
                     <option value="peternakan">Peternakan</option>
                     <option value="pertanian">Pertanian</option>
                     <option value="dll">DLL</option>
                   </select>
                 </div>
               </div>

               <div class="form-group">
                 <label class="col-sm-2 control-label">Harga Satuan</label>
                 <div class="col-sm-5">
                   <div class="input-group">
                     <span class="input-group-addon">Rp.</span>
                     <input type="text" class="form-control" id="harga_beli" name="harga_beli" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo format_rupiah($data['harga_beli']); ?>" required>
                   </div>
                 </div>
               </div>

               <!-- HARGA JUAL TIDAK MASUK DATABASE -->
               <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Harga Jual</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="total_harga" name="total_harga" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo format_rupiah($data['total_harga']); ?>" required>
                  </div>
                </div>
              </div> -->

               <div class="form-group">
                 <label class="col-sm-2 control-label">Satuan</label>
                 <div class="col-sm-5">
                   <select class="chosen-select" name="satuan" data-placeholder="-- Pilih --" autocomplete="off" required>
                     <option value="<?php echo $data['satuan']; ?>"><?php echo $data['satuan']; ?></option>
                     <option value="Botol">Botol</option>
                     <option value="Box">Box</option>
                     <option value="Kotak">Kotak</option>
                     <option value="Strip">Strip</option>
                     <option value="Tube">Tube</option>
                   </select>
                 </div>
               </div>

             </div><!-- /.box body -->

             <div class="box-footer">
               <div class="form-group">
                 <div class="col-sm-offset-2 col-sm-10">
                   <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                   <a href="?module=obat" class="btn btn-default btn-reset">Batal</a>
                 </div>
               </div>
             </div><!-- /.box footer -->
           </form>
         </div><!-- /.box -->
       </div><!--/.col -->
     </div> <!-- /.row -->
   </section><!-- /.content -->
 <?php
  }
  ?>