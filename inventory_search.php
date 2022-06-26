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
      inventory.id,
      concat_ws(' ', concat(produk.id, '-', item.nama), jenis.nama, merek.nama, standard.nama, warna.nama, concat('dia. ',produk.diameter), concat('@', produk.panjang, 'cm/', satuan.nama)) as produk_nama,
      lokasi.nama AS lokasi_name,
      inventory.qty AS qty_berdiri,
      (SUM(inventory_riwayat.qty) + inventory.qty) AS qty,
      inventory.tanggal,
      inventory.updated_at,
      inventory.created_at,
      produk.gambar AS gambar
    FROM inventory
    LEFT JOIN inventory_riwayat ON inventory.id = inventory_riwayat.inventory_id
    LEFT JOIN produk ON inventory.produk_id = produk.id
    LEFT JOIN item ON produk.item_id = item.id
    LEFT JOIN jenis ON produk.jenis_id = jenis.id
    LEFT JOIN standard ON standard.jenis_id = jenis.id
    LEFT JOIN warna ON produk.warna_id = warna.id
    LEFT JOIN merek ON produk.merek_id = merek.id
    LEFT JOIN satuan ON produk.satuan_id = satuan.id
    LEFT JOIN lokasi ON inventory.lokasi_id = lokasi.id
    WHERE produk.status = 'aktif'
    GROUP BY inventory.id
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
    array( 'db' => 'lokasi_name',  'dt' => 3 ),
    array(
       'db' => 'qty_berdiri',
       'dt' => 4,
       'formatter' => function( $d, $row ) {
          if($d < 10)
          {
            return "<strong style='color: #e32225'>$d</strong>";
          }
          else if($d > 500)
          {
            return "<strong style='color: #fcb521'>$d</strong>";
          }
          else
          {
            return $d;
          }
       }
     ),
     array(
        'db' => 'qty',
        'dt' => 5,
        'formatter' => function( $d, $row ) {
           if($d < 10)
           {
             return "<strong style='color: #e32225'>$d</strong>";
           }
           else if($d > 500)
           {
             return "<strong style='color: #fcb521'>$d</strong>";
           }
           else
           {
             return $d;
           }
        }
    ),
    array(
       'db' => 'tanggal',
       'dt' => 6,
       'formatter' => function( $d, $row ) {
          return date("d/m/Y", strtotime($d));
       }
    ),
    array(
       'db' => 'updated_at',
       'dt' => 7,
       'formatter' => function( $d, $row ) {
          if($d == 0)
          {
            return "-";
          }
          else
          {
            return date("d/m/Y | h:i A", strtotime($d));
          }
       }
    ),
    array(
       'db' => 'created_at',
       'dt' => 8,
       'formatter' => function( $d, $row ) {
         if($d == 0)
         {
           return "-";
         }
         else
         {
           return date("d/m/Y | h:i A", strtotime($d));
         }
       }
    ),
    array(
       'db' => 'gambar',
       'dt' => 9,
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
