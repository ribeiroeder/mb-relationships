<?php
/**
 * Public API helper functions.
 *
 * @package    Meta Box
 * @subpackage MB Relationship
 */

/**
 * The API class.
 */
class MB_Relationship_API {
	/**
	 * The reference to WordPress global database object.
	 *
	 * @var wpdb
	 */
	protected $db;

	/**
	 * Reference to object factory.
	 *
	 * @var MB_Relationship_Connection_Factory
	 */
	public $factory;

	/**
	 * Constructor
	 *
	 * @param wpdb                               $wpdb    Database object.
	 * @param MB_Relationship_Connection_Factory $factory The object factory.
	 */
	public function __construct( wpdb $wpdb, MB_Relationship_Connection_Factory $factory ) {
		$this->db      = $wpdb;
		$this->factory = $factory;
	}

	/**
	 * Register a connection.
	 *
	 * @param array $settings Connection parameters.
	 *
	 * @return MB_Relationship_Connection
	 */
	public function register( $settings ) {
		return $this->factory->build( $settings );
	}

	/**
	 * Get connected items from an item.
	 *
	 * @param string $type      Connection type.
	 * @param int    $object_id Object ID. Optional.
	 *
	 * @return array
	 */
	public function get_connected_from( $type, $object_id = null ) {
		$object_id = empty( $object_id ) ? get_queried_object_id() : $object_id;
		return $this->db->get_col( $this->db->prepare(
			"SELECT `to` FROM {$this->db->mb_relationships} WHERE `from`=%d AND `type`=%s",
			$object_id,
			$type
		) );
	}

	/**
	 * Get connected items to an item.
	 *
	 * @param string $type      Connection type.
	 * @param int    $object_id Object ID. Optional.
	 *
	 * @return array
	 */
	public function get_connected_to( $type, $object_id = null ) {
		$object_id = empty( $object_id ) ? get_queried_object_id() : $object_id;
		return $this->db->get_col( $this->db->prepare(
			"SELECT `from` FROM {$this->db->mb_relationships} WHERE `to`=%d AND `type`=%s",
			$object_id,
			$type
		) );
	}
}
