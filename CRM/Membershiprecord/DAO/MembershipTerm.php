<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2017                                |
 +--------------------------------------------------------------------+
 | This file belongs to CiviCRM's Membershiprecord extension.         |
 |                                                                    |
 +--------------------------------------------------------------------+
 */

/**
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2017
 *
 * NOT GENERATED (manually created)
 * @author Armfoot <armfoot@sapo.pt>
 */
require_once 'CRM/Core/DAO.php';
require_once 'CRM/Utils/Type.php';
/**
 * CRM_Membershiprecord_DAO_MembershipTerm constructor.
 */
class CRM_Membershiprecord_DAO_MembershipTerm extends CRM_Core_DAO {
  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  static $_tableName = 'civicrm_membership_term';
  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var boolean
   */
  static $_log = true;
  /**
   * Membership Id
   *
   * @var int unsigned
   */
  public $id;
  /**
   * FK to Membership table
   *
   * @var int unsigned
   */
  public $membership_id;
  /**
   * FK to Contact ID
   *
   * @var int unsigned
   */
  public $contact_id;
  /**
   * FK to contribution table.
   *
   * @var int unsigned
   */
  public $contribution_id;
  /**
   * Beginning of current uninterrupted membership term or period.
   *
   * @var date
   */
  public $start_date;
  /**
   * End of an uninterrupted membership term or period.
   *
   * @var date
   */
  public $end_date;
  /**
   * Class constructor.
   */
  function __construct() {
    $this->__table = 'civicrm_membership_term';
    parent::__construct();
  }
  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static ::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName() , 'membership_id', 'civicrm_membership', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName() , 'contact_id', 'civicrm_contact', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName() , 'contribution_id', 'civicrm_contribution', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }
  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = array(
        'id' => array(
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Membership Term ID') ,
          'required' => true,
          'table_name' => 'civicrm_membership_term',
          'entity' => 'MembershipTerm',
          'bao' => 'CRM_Membershiprecord_BAO_MembershipTerm',
          'localizable' => 0,
        ) ,
        'membership_id' => array(
          'name' => 'membership_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Membership ID') ,
          'description' => 'FK to Membership table',
          'required' => true,
          'table_name' => 'civicrm_membership_term',
          'entity' => 'MembershipTerm',
          'bao' => 'CRM_Membershiprecord_BAO_MembershipTerm',
          'localizable' => 0,
          'FKClassName' => 'CRM_Member_DAO_Membership',
        ) ,
        'contact_id' => array(
          'name' => 'contact_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Contact ID') ,
          'description' => 'FK to Contact ID',
          'required' => true,
          'import' => true,
          'where' => 'civicrm_membership_term.contact_id',
          'headerPattern' => '/contact(.?id)?/i',
          'dataPattern' => '/^\d+$/',
          'export' => true,
          'table_name' => 'civicrm_membership_term',
          'entity' => 'MembershipTerm',
          'bao' => 'CRM_Membershiprecord_BAO_MembershipTerm',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contact_DAO_Contact',
          'html' => array(
            'type' => 'EntityRef',
          ) ,
        ) ,
        'contribution_id' => array(
          'name' => 'contribution_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Contribution ID') ,
          'description' => 'FK to contribution table.',
          'table_name' => 'civicrm_membership_term',
          'entity' => 'MembershipTerm',
          'bao' => 'CRM_Membershiprecord_BAO_MembershipTerm',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contribute_DAO_Contribution',
        ) ,
        'start_date' => array(
          'name' => 'start_date',
          'type' => CRM_Utils_Type::T_DATE,
          'title' => ts('Term Start Date') ,
          'description' => 'Beginning of current uninterrupted membership term or period.',
          'import' => true,
          'where' => 'civicrm_membership_term.start_date',
          'headerPattern' => '/(term.)?end(s)?(.date$)?/i',
          'dataPattern' => '/\d{4}-?\d{2}-?\d{2}/',
          'export' => true,
          'table_name' => 'civicrm_membership_term',
          'entity' => 'MembershipTerm',
          'bao' => 'CRM_Membershiprecord_BAO_MembershipTerm',
          'localizable' => 0,
          'html' => array(
            'type' => 'Select Date',
            'formatType' => 'activityDate',
          ) ,
        ) ,
        'end_date' => array(
          'name' => 'end_date',
          'type' => CRM_Utils_Type::T_DATE,
          'title' => ts('Term Expiration Date') ,
          'description' => 'End of an uninterrupted membership term or period.',
          'import' => true,
          'where' => 'civicrm_membership_term.end_date',
          'headerPattern' => '/(term.)?end(s)?(.date$)?/i',
          'dataPattern' => '/\d{4}-?\d{2}-?\d{2}/',
          'export' => true,
          'table_name' => 'civicrm_membership_term',
          'entity' => 'MembershipTerm',
          'bao' => 'CRM_Membershiprecord_BAO_MembershipTerm',
          'localizable' => 0,
          'html' => array(
            'type' => 'Select Date',
            'formatType' => 'activityDate',
          ) ,
        ) ,
      );
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }
  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }
  /**
   * Returns the names of this table
   *
   * @return string
   */
  static function getTableName() {
    return self::$_tableName;
  }
  /**
   * Returns if this table needs to be logged
   *
   * @return boolean
   */
  function getLog() {
    return self::$_log;
  }
  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &import($prefix = false) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'membership_term', $prefix, array());
    return $r;
  }
  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &export($prefix = false) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'membership_term', $prefix, array());
    return $r;
  }
  /**
   * Returns the list of indices
   */
  public static function indices($localize = TRUE) {
    $indices = array(
      'UI_contribution_contact_membership' => array(
        'name' => 'UI_contribution_contact_membership',
        'field' => array(
          0 => 'contribution_id',
          1 => 'contact_id',
          2 => 'membership_id',
        ) ,
        'localizable' => false,
        'unique' => true,
        'sig' => 'civicrm_membership_term::1::contribution_id::contact_id::membership_id',
      )
    );
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }
}
