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
$table = 'profil_perusahaan';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    //array( 'db' => 'id', 'dt' => 1 ),
    array( 'db' => 'nama', 'dt' => 1 ),
    array( 'db' => 'email',  'dt' => 2 ),
    array( 'db' => 'no_telepon',   'dt' => 3 ),
    array(
       'db' => 'tanggal',
       'dt' => 4,
       'formatter' => function( $d, $row ) {
           return date("d/m/Y", strtotime($d));
       }
        ),
    array(
       'db' => 'logo',
       'dt' => 5,
       'formatter' => function( $d, $row ) {

           return "<a href='$d'><img src='$d' style='width:100px;align:middle;'/></a>";
       }
       ),
    );

include 'config_search.php';

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);