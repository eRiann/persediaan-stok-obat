<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
// panggil fungsi untuk format tanggal
include "../../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");
$bulan_ini = date("F-Y");

$no = 1;
// fungsi query untuk menampilkan data dari tabel obat
$query = mysqli_query($mysqli, "SELECT kode_obat,nama_obat,jenis,stok,harga_beli,satuan FROM is_obat ORDER BY nama_obat ASC")
    or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));
$count  = mysqli_num_rows($query);
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>LAPORAN STOK OBAT</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
</head>

<body>
    <div id="title">
        Daftar Persediaan Barang Pakai Habis (Obat-Obatan) Bulan <span><?php echo ("$bulan_ini"); ?></span><br>
        Dinas Ketahanan Pangan Dan Pertanian Kota Madiun
    </div>

    <hr><br>

    <div id="isi">
        <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">KODE OBAT</th>
                    <th height="20" align="center" valign="middle">NAMA OBAT</th>
                    <th height="20" align="center" valign="middle">JENIS OBAT</th>
                    <th height="20" align="center" valign="middle">STOK</th>
                    <th height="40" align="center" valign="middle">HARGA<br> SATUAN</th>
                    <th height="20" align="center" valign="middle">TOTAL<br> HARGA</th>
                    <th height="20" align="center" valign="middle">SATUAN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {
                    $stok = $data['stok'];
                    $harga_beli = ($data['harga_beli']);
                    $total_harga = format_rupiah($harga_beli * $stok);

                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo "  <tr>
                        <td width='30' height='20' align='center' valign='middle'>$no</td>
                        <td width='80' height='20' align='center' valign='middle'>$data[kode_obat]</td>
                        <td style='padding-left:5px;' width='225' height='20' valign='middle'>$data[nama_obat]</td>
                        <td width='95' height='20' align='center' valign='middle'>$data[jenis]</td>
                        <td width='60' height='20' align='center' valign='middle'>$data[stok]</td>
                        <td style='padding-right:10px;' width='85' height='20' align='right' valign='middle'>Rp. $harga_beli</td>
                        <td style='padding-right:10px;' width='100' height='20' align='right' valign='middle'>Rp. $total_harga</td>
                        <td width='65' height='20' align='center' valign='middle'>$data[satuan]</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <br><br>

        <div style="page-break-before:always; margin-top:10px;">
        <table width="100%" align="center">
            <tr>
                <td></td>
                <td></td>
                <td style="text-align: center;">Madiun, <?php echo tgl_eng_to_ind("$hari_ini"); ?></td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>ATASAN LANGSUNG</b></td>
                <td></td>
                <td style="text-align: center;"><b>PENYIMPAN BARANG</b></td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>PENYIMPAN BARANG</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td height="40"></td>
                <td height="40"> </td>
                <td height="40"> </td>
            </tr>
            <tr>
                <td style="text-align: center;"><b><u>CANDRA SUSILAWATI, A.Md</u></b></td>
                <td></td>
                <td style="text-align: center;"><b><u>DYAH PROBORINI, D.H</u></b></td>
            </tr>
            <tr>
                <td style="text-align: center;">Penata Tk.I</td>
                <td></td>
                <td style="text-align: center;">Pengatur Tk.I</td>
            </tr>
            <tr>
                <td style="text-align: center;">NIP. 19671007 199703 2 003</td>
                <td></td>
                <td style="text-align: center;">NIP. 19760917 201001 2 001</td>
            </tr>
            <tr>
                <td height="40"> </td>
                <td height="40"> </td>
                <td height="40"> </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;"><b>Mengetahui</b></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;"><b>KEPALA DINAS KETAHANAN PANGAN</b></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;"><b>DAN PERTANIAN</b></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;"><b>KOTA MADIUN</b></td>
                <td></td>
            </tr>
            <tr>
                <td height="50"> </td>
                <td height="50"> </td>
                <td height="50"> </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;"><b><u>TOTOK SUGIARTO, SH, M.Si</u></b></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;">Pembina Utama Muda</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;">NIP. 19700901 199603 1 008</td>
                <td></td>
            </tr>
        </table>
        </div>

    </div>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename = "LAPORAN STOK OBAT ($bulan_ini).pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//=========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . ($content) . '</page>';
// panggil library html2pdf
require_once('../../assets/plugins/html2pdf_v4.03/html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('L', 'F4', 'en', false, 'ISO-8859-15', array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
} catch (HTML2PDF_exception $e) {
    echo $e;
}
?>