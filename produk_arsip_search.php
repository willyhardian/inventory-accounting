<?php include "security.php"; ?>
<?php
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = <<<EOT
 (
    SELECT
      produk.id,
      concat_ws(' ',item.nama, jenis.nama, standard.nama, tipe.nama, merek.nama, kategori.nama, warna.nama, concat('dia. ',produk.diameter), concat('@', produk.panjang, 'cm/', satuan.nama)) as produk_nama,
      produk.harga,
      jenis.nama AS jenis,
      warna.nama AS warna,
      kategori.nama AS kategori,
      produk.diameter,
      produk.panjang,
      merek.nama AS merek,
      satuan.nama AS satuan_nama,
      produk.gambar AS gambar
    FROM produk
    LEFT JOIN item ON produk.item_id = item.id
    LEFT JOIN jenis ON produk.jenis_id = jenis.id
    LEFT JOIN standard ON standard.jenis_id = jenis.id
    LEFT JOIN tipe ON tipe.standard_id = standard.id
    LEFT JOIN warna ON produk.warna_id = warna.id
    LEFT JOIN kategori ON produk.kategori_id = kategori.id
    LEFT JOIN satuan ON produk.satuan_id = satuan.id
    LEFT JOIN merek ON produk.merek_id = merek.id
    WHERE produk.status = 'arsip'
 ) temp
EOT;

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'id', 'dt' => 1 ),
    array( 'db' => 'produk_nama', 'dt' => 2 ),
    array(
       'db' => 'harga',
       'dt' => 3,
       'formatter' => function( $d, $row ) {
          return "Rp " . number_format($d, 0, ",", ".");
       }
     ),
    array(
       'db' => 'gambar',
       'dt' => 4,
       'formatter' => function( $d, $row ) {

           return "<a href='$d'><img src='$d' style='height:50px;width:50px;align:middle;'/></a>";
       }
       ),

    );

include 'config_search.php';

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
