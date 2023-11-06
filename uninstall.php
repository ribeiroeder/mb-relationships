<?php
defined( 'WP_UNINSTALL_PLUGIN' ) || die;

if (defined('MB_RELATIONSHIPS_DELETE_TABLE') && MB_RELATIONSHIPS_DELETE_TABLE === true) {
    global $wpdb;
    // phpcs:ignore WordPress.DB.DirectDatabaseQuery
    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mb_relationships" );

    delete_option( 'mbr_table_created' );
}
