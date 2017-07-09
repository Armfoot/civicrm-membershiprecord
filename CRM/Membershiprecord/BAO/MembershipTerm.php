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
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2017
 * @author Armfoot <armfoot@sapo.pt>
 */
class CRM_Membershiprecord_BAO_MembershipTerm extends CRM_Membershiprecord_DAO_MembershipTerm {

  /**
   * Class constructor.
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Create a new MembershipTerm based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Membershiprecord_DAO_MembershipTerm|NULL
   *
   */
  public static function create($params) {
    $entityName = 'MembershipTerm';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $dao = new CRM_Membershiprecord_DAO_MembershipTerm();
    $dao->copyValues($params);
    $dao->save();
    CRM_Utils_Hook::post($hook, $entityName, $dao->id, $dao);

    return $dao;
  }

  /**
   * Delete membership terms.
   *
   * @param int $id
   *
   * @return bool
   */
  public static function del($id) {
    $dao = new CRM_Membershiprecord_DAO_MembershipTerm();
    $dao->id = $id;
    $result = FALSE;
    if ($dao->find(TRUE)) {
      $dao->delete();
      $result = TRUE;
    }
    return $result;
  }

  /**
   * Adds a membership term related to a payment not previously recorded
   *
   * @param int $contribution_id ID to be queried and recorded in the term's table
   */
  public static function addMembershipTerm($contribution_id) {
    if (empty($contribution_id)) {
      return;
    }

    // Get the membership's data and contribution_id
    // JOIN with term's table to check if this payment was already assigned to a term (if it was not => term_id is NULL)
    $q_sql = <<<SQL
SELECT m.`id`, m.`contact_id`, m.`start_date`, m.`end_date`, c.`receive_date`, t.`id` term_id
FROM `civicrm_membership` m
INNER JOIN `civicrm_membership_payment` p ON m.`id` = p.`membership_id`
INNER JOIN `civicrm_contribution` c ON c.`id` = p.`contribution_id`
LEFT JOIN `civicrm_membership_term` t ON p.`contribution_id` = t.`contribution_id`
WHERE p.`contribution_id` = %0
SQL;
    $q_params = array(
      array(intval($contribution_id), 'Integer')
    );
    
    $dao_results = CRM_Core_DAO::executeQuery($q_sql,$q_params);
    if ($dao_results->fetch()) {
      // only inserts a term if the payment wasn't recorded in terms
      // this does not exclude renewals since a new contribution_id is associated to a renewal
      if(!empty($dao_results->term_id))
        return;

      $start_date_time = strtotime($dao_results->start_date);
      $receive_date_time = strtotime($dao_results->receive_date);
      // in case of a renewal, the start_date is the receive_date
      $start_date = $receive_date_time > $start_date_time ?
            date('Y-m-d', $receive_date_time) :
            date('Y-m-d', $start_date_time);
      $end_date = empty($dao_results->end_date)?
            // in lifetime memberships, end_date may be null
            NULL : $dao_results->end_date;
      
      $params = array(
        'membership_id' => $dao_results->id,
        'contact_id' => $dao_results->contact_id,
        'contribution_id' => $contribution_id,
        'start_date' => $start_date
      );
      if(!empty($end_date)) {
        $params['end_date'] = $end_date;
      }

      return CRM_Membershiprecord_BAO_MembershipTerm::create($params);

      //BOR Alternative: INSERT through executeQuery
      /*
      // CRM/Utils/Type.php@validate expects Ymd format
      $end_date = empty($dao_results->end_date)?
            // in lifetime memberships, end_date may be null
            NULL :
            // remove the `-` from the date for Ymd format
            str_replace('-', '',$dao_results->end_date);

      $q_params = array(
        array(intval($dao_results->id), 'Integer'),
        array(intval($dao_results->contact_id), 'Integer'),
        array(intval($contribution_id), 'Integer'),
        array($start_date, 'Date')
      );

      if(empty($end_date)) {
        // for lifetime terms without an end_date
        $q_sql = <<<SQL
INSERT INTO `civicrm_membership_term`
(`membership_id`, `contact_id`, `contribution_id`, `start_date`)
VALUES (%0, %1, %2, '%3')
SQL;
      } else {
        $q_params[] = array($end_date, 'Date');
        $q_sql = <<<SQL
INSERT INTO `civicrm_membership_term`
(`membership_id`, `contact_id`, `contribution_id`, `start_date`, `end_date`)
VALUES (%0, %1, %2, '%3', '%4')
SQL;
      }
        
      try {
        CRM_Core_DAO::executeQuery($q_sql, $q_params);
      }
      catch (CiviCRM_API3_Exception $e) {
        CRM_Core_Error::debug_var('Unable to create term', $e);
        return;
      } // */
      //EOR
    }
  }
}
