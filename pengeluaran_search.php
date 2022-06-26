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
      beban.id,
      kode_akun.kode AS kode,
      beban.harga,
      beban.tanggal,
      beban.keterangan
    FROM beban
    LEFT JOIN kode_akun ON beban.kode_akun_id = kode_akun.id
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
    array( 'db' => 'kode', 'dt' => 2 ),
    array( 'db' => 'harga',  'dt' => 3 ),
    array( 'db' => 'tanggal',  'dt' => 4 ),
    array( 'db' => 'keterangan', 'dt' => 5 )
    );

include 'config_search.php';

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
