<?php
/**
 * Test example demonstrating the MembershipTerm.create API.
 * Adapted from other MembershipPayment example
 *
 * @return array
 *   API result array
 */
function membership_term_create_example() {
  $params = array(
    'contribution_id' => 14,
    'contact_id' => 20,
    'membership_id' => 1,
  );

  try{
    $result = civicrm_api3('MembershipTerm', 'create', $params);
  }
  catch (CiviCRM_API3_Exception $e) {
    // Handle error here.
    $errorMessage = $e->getMessage();
    $errorCode = $e->getErrorCode();
    $errorData = $e->getExtraParams();
    return array(
      'is_error' => 1,
      'error_message' => $errorMessage,
      'error_code' => $errorCode,
      'error_data' => $errorData,
    );
  }

  return $result;
}

/**
 * Function returns array of result expected from previous function.
 *
 * @return array
 *   API result array
 */
function membership_term_create_expectedresult() {

  $expectedResult = array(
    'is_error' => 0,
    'version' => 3,
    'count' => 1,
    'id' => 1,
    'values' => array(
      '1' => array(
        'id' => '1',
        'membership_id' => '1',
        'contact_id' => '20',
        'contribution_id' => '14',
      ),
    ),
  );

  return $expectedResult;
}
