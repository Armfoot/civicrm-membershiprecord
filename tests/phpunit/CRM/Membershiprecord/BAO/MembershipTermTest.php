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
 *  Test CRM/Member/BAO MembershipTerm add, delete functions
 *
 * @package   CiviCRM
 * @author Armfoot <armfoot@sapo.pt>
 */
class CRM_Membershiprecord_BAO_MembershipTermTest extends CiviUnitTestCase {

  protected $_contributionID;
  protected $_membership;
  protected $_contactID;

  public function setUp() {
    parent::setUp();
    $this->_contactID = $this->individualCreate();

    $params = array(
      'contact_id' => $this->_contactID,
      'membership_type_id' => 1, // General
      'join_date' => date('Ymd', strtotime('2017-07-09')),
      'start_date' => date('Ymd', strtotime('2017-07-09')),
      'end_date' => date('Ymd', strtotime('2017-10-09')),
      'source' => 'Payment',
      'is_override' => 1,
      'status_id' => 1, // New
    );

    $ids = array();
    $this->_membership = CRM_Member_BAO_Membership::create($params, $ids);

    $params = array(
      'contact_id' => $this->_contactID,
      'receive_date' => '2017-07-09'
    );
    $this->_contributionID = $this->contributionCreate($params);
  }

  /**
   * Called after a test is executed.
   */
  public function tearDown() {
    $this->contributionDelete($this->_contributionID);
    $this->membershipDelete($this->_membership->id);
    $this->contactDelete($this->_contactID);
  }

  /**
   * Not-a-test: exclusively for creating a membership term with all params
   */
  private function _membershipTermCreate() {
    $params = array(
      'membership_id' => $this->_membership->id,
      'contact_id' => $this->_contactID,
      'contribution_id' => $this->_contributionID,
      'start_date' => $this->_membership->start_date,
      'end_date' => $this->_membership->end_date
    );

    return CRM_Membershiprecord_BAO_MembershipTerm::create($params);
  }

  /**
   *  Test Membership Term's direct creation
   */
  public function testcreate() {
    $membershipTerm = $this->_membershipTermCreate();

    $this->assertDBNotNull(
      'CRM_Membershiprecord_BAO_MembershipTerm',
      $membershipTerm->id, // search value
      'membership_id',     // return column
      'id',                // search column
      'Membership Term ID '.$membershipTerm->id.' creation DB check.'
    );
  }

  /**
   *  Test Membership Term's deletion
   */
  public function testdel() {
    $membershipTerm = $this->_membershipTermCreate();

    $deleteRes = CRM_Membershiprecord_BAO_MembershipTerm::del($membership->id);
    
    $this->assertDBNull(
      'CRM_Membershiprecord_BAO_MembershipTerm',
      $membershipTerm->id, // search value
      'membership_id',     // return column
      'id',                // search column
      'Membership Term ID '.$membershipTerm->id.' check of deletion performed '.($deleteRes ? '': 'un').'successfully.'
    );
  }

  /**
   *  Test Membership Term's creation through civicrm_membership_payment verification
   **/
  public function testaddthroughpayment() {
    $membershipTerm = CRM_Membershiprecord_BAO_MembershipTerm::addMembershipTerm($this->_contributionID);
    
    $this->assertDBNotNull(
      'CRM_Membershiprecord_BAO_MembershipTerm',
      $membershipTerm->id, // search value
      'membership_id',    // return column
      'id',               // search column
      'Membership Term ID '.$membershipTerm->id.' creation DB check.'
    );
  }
}
