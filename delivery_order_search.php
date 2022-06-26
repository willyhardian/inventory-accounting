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
$table = 'do';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'invoice_id', 'dt' => 0 ),
    array(
       'db' => 'id',
       'dt' => 1,
       'formatter' => function( $d, $row ) {
            return "DO" . $d;
       }
       ),
       array(
          'db' => 'invoice_id',
          'dt' => 2,
          'formatter' => function( $d, $row ) {
               return "INV" . $d;
          }
          ),
    array(
        'db' => 'tanggal',
        'dt' => 3,
        'formatter' => function( $d, $row ) {
             return date("d/m/Y", strtotime($d));
        }
        ),
    array( 'db' => 'penerima', 'dt' => 4 ),
    array( 'db' => 'penerima_hp', 'dt' => 5 ),
    array( 'db' => 'tujuan',  'dt' => 6 ),
    array( 'db' => 'keterangan',  'dt' => 7 ),
    array( 'db' => 'catatan', 'dt' => 8 ),
    array(
        'db' => 'updated_at',
        'dt' => 9,
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
            'dt' => 10,
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
    array( 'db' => 'disiapkan_oleh', 'dt' => 11 ),
    array( 'db' => 'disetujui_oleh', 'dt' => 12 ),
    array( 'db' => 'dikirim_oleh', 'dt' => 13 )
    );

include 'config_search.php';

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
