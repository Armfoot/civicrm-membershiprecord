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
 *  Class containing all test suites
 *
 * @author Armfoot <armfoot@sapo.pt>
 * @package   CiviCRM
 */
class CRM_Membershiprecord_AllTests extends CiviTestSuite {
  private static $instance = NULL;

  /**
   * Get an instance of CRM_Membershiprecord_AllTests
   */
  private static function getInstance() {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * Dynamically build test suite
   */
  public static function suite() {
    $inst = self::getInstance();
    return $inst->implSuite(__FILE__);
  }

}
