<?php
/**
 * Test example demonstrating the MembershipPayment.get API.
 *
 * @return array
 *   API result array
 */
function membership_term_get_example() {
  $params = array(
    'contribution_id' => 27,
    'contact_id' => 141,
    'membership_id' => 2,
  );

  try{
    $result = civicrm_api3('MembershipTerm', 'get', $params);
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
function membership_term_get_expectedresult() {

  $expectedResult = array(
    'is_error' => 0,
    'version' => 3,
    'count' => 1,
    'id' => 2,
    'values' => array(
      '2' => array(
        'id' => '2',
        'membership_id' => '2',
        'contact_id' => '141',
        'contribution_id' => '27',
      ),
    ),
  );

  return $expectedResult;
}

