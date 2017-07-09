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
 * MembershipTerm.create API specification
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 * @author Armfoot <armfoot@sapo.pt>
 */
function _civicrm_api3_membership_term_create_spec(&$spec) {
    $params['membership_id']['api.required'] = 1;
    $params['contact_id']['api.required'] = 1;
    $params['contribution_id']['api.required'] = 1;
    $params['start_date'] = array(
      'title' => 'Term\'s Start Date',
      'description' => 'Beginning of the Membership\'s term',
      'type' => CRM_Utils_Type::T_DATE,
    );
    $params['end_date'] = array(
      'title' => 'Term\'s End Date',
      'description' => 'End of the Membership\'s term',
      'type' => CRM_Utils_Type::T_DATE,
    );
}

/**
 * Add or update a membership's term.
 *
 * @param array $params
 *   Input parameters.
 *
 * @return array
 *   API result array.
 * @throws API_Exception
 */
function civicrm_api3_membership_term_create($params) {
  return _civicrm_api3_basic_create('CRM_Membershiprecord_DAO_MembershipTerm', $params);
  // return _civicrm_api3_basic_create(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * MembershipTerm.delete API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_membership_term_delete($params) {
  return _civicrm_api3_basic_delete('CRM_Membershiprecord_DAO_MembershipTerm', $params);
  // return _civicrm_api3_basic_delete(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * Get contact Membership's term record.
 *
 * This api will return the terms records for the contacts' memberships.
 *
 * @param array $params
 *   Key/value pairs.
 *
 * @return array
 *   Array with all membership terms found.
 * @throws API_Exception
 */
function civicrm_api3_membership_term_get($params) {
  return _civicrm_api3_basic_get('CRM_Membershiprecord_DAO_MembershipTerm', $params);
  // return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}
