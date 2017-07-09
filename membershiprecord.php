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

require_once 'membershiprecord.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function membershiprecord_civicrm_config(&$config) {
  _membershiprecord_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function membershiprecord_civicrm_xmlMenu(&$files) {
  _membershiprecord_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function membershiprecord_civicrm_install() {
  _membershiprecord_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function membershiprecord_civicrm_postInstall() {
  _membershiprecord_civix_civicrm_postInstall();
  // creates the Membership Terms table and fills in the current memberships
  $upgrader_obj = new CRM_Membershiprecord_Upgrader('Membershiprecord', __DIR__);
   $upgrader_obj->install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function membershiprecord_civicrm_uninstall() {
  _membershiprecord_civix_civicrm_uninstall();
  // drops the Membership Terms table
  $upgrader_obj = new CRM_Membershiprecord_Upgrader('Membershiprecord', __DIR__);
   $upgrader_obj->uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function membershiprecord_civicrm_enable() {
  _membershiprecord_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function membershiprecord_civicrm_disable() {
  _membershiprecord_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function membershiprecord_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _membershiprecord_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function membershiprecord_civicrm_managed(&$entities) {
  _membershiprecord_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function membershiprecord_civicrm_caseTypes(&$caseTypes) {
  _membershiprecord_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function membershiprecord_civicrm_angularModules(&$angularModules) {
  _membershiprecord_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function membershiprecord_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _membershiprecord_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

//BOR preProcess and navigationMenu (auto-generated)

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function membershiprecord_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function membershiprecord_civicrm_navigationMenu(&$menu) {
  _membershiprecord_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'org.civicrm.membershiprecord')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _membershiprecord_civix_navigationMenu($menu);
} // */
//EOR

/**
 * Alter tpl file to include a different tpl file
 * @param string $formName name of the form
 * @param object $form (reference) form object
 * @param string $context page or form
 * @param string $tplName (reference) change this if required to the altered tpl file
 */
function membershiprecord_civicrm_alterTemplateFile($formName, &$form, $context, &$tplName) {
  $formsToTouch = array(
    'CRM_Member_Page_Tab' => array('path' => 'CRM', 'file' => 'MembershipTerm/MembershipTab'),
    // 'CRM_Contact_Page_DashBoard' => array('path' => 'CRM', 'file' => 'MembershipTerm/ContactDashBoard'),
  );


  if(!array_key_exists($formName, $formsToTouch)) {
    return;
  }
  $possibleTpl = $formsToTouch[$formName]['path'] . '/' . $formsToTouch[$formName]['file']. '.tpl';
  $template = CRM_Core_Smarty::singleton();
  if ($template->template_exists($possibleTpl)) {
    $tplName = $possibleTpl;
  }
}

/**
 * Upon a membership payment, add a new term.
 * @param Object $dao the DAO object that has been saved
 */
function membershiprecord_civicrm_postSave_civicrm_membership_payment($dao) {
  CRM_Membershiprecord_BAO_MembershipTerm::addMembershipTerm($dao->contribution_id);
}

//BOR Other Possible Interactions
/**
 * Upon membership creation, add a new term.
 * [HOWEVER the payment does not exist at this point]
 * @param string $op operation being performed with CiviCRM object
 * @param string $objectName a component of CiviCRM
 * @param string $objectId the unique identifier for the object.
 * @param string objectRef the reference to the object if available. 
 *
function membershiprecord_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  if ($op == 'create' && $objectName == 'Membership') {
    // here could call CRM_Membershiprecord_BAO_MembershipTerm::addMembershipTerm
  }
} // */

/**
  * Access the content of a specific template in order to alter it
  * [HOWEVER alterTemplateFile allows more flexibility and interaction with variables from CRM files]
  * https://docs.civicrm.org/dev/en/master/hooks/hook_civicrm_alterContent/
  * @param string $content - previously generated content
  * @param string $context - context of content - page or form
  * @param string $tplName - the file name of the tpl
  * @param object $object - a reference to the page or form object
  *
function membershiprecord_civicrm_alterContent( &$content, $context, $tplName, &$object ) {
  if($context == "page") {
    if(preg_match("/^MembershipTerm[\/\\\]MembershipTab\.tpl$/i", $tplName)) {
      $content = "<p class=\"warning\">This page was modified by the Membershiprecord extension</p>$content";
    }
  }
} // */

/**
  * [FOR CREATING a new tab - part of the example from docs]
  * Called when composing the tabs interface used for contacts, contributions and events
  * @param $tabset - name of the screen or visual element
  * @param $tabs - the array of tabs that will be displayed
  * @param $context - extra data about the screen or context in which the tab is used
  * https://docs.civicrm.org/dev/en/master/hooks/hook_civicrm_tabset/
  *
function civitest_civicrm_tabset($tabsetName, &$tabs, $context) {
  //check if the tabset is Contact Summary Page
  if ($tabsetName == 'civicrm/contact/view') {
    // unset the contribition tab, i.e. remove it from the page
    unset( $tabs[1] );
    $contactId = $context['contact_id'];
    // let's add a new "contribution" tab with a different name and put it last
    // this is just a demo, in the real world, you would create a url which would
    // return an html snippet etc.
    $url = CRM_Utils_System::url( 'civicrm/contact/view/contribution',
                                  "reset=1&snippet=1&force=1&cid=$contactID" );
    // $url should return in 4.4 and prior an HTML snippet e.g. '<div><p>....';
    // in 4.5 and higher this needs to be encoded in json. E.g. json_encode(array('content' => <html form snippet as previously provided>));
    // or CRM_Core_Page_AJAX::returnJsonResponse($content) where $content is the html code
    // in the first cases you need to echo the return and then exit, if you use CRM_Core_Page method you do not need to worry about this.
    $tabs[] = array( 'id'    => 'mySupercoolTab',
      'url'   => $url,
      'title' => 'Contribution Tab Renamed',
      'weight' => 300,
    );
  }
} // */

/**
  * Allows MySQL triggers definition
  * https://docs.civicrm.org/dev/en/master/hooks/hook_civicrm_trigger_info/
  * @param array $info - array of triggers to be created
  * @param string $tableName - not sure how this bit works
  *
function regionfields_civicrm_triggerInfo(&$info, $tableName) {
  $table_name = 'civicrm_value_region_13';
  $customFieldID = 45;
  $columnName = 'region_45';
  $sourceTable = 'civicrm_address';
  $locationPriorityOrder = '1, 3, 5, 2, 4, 6'; // hard coded prioritisation of addresses
  $zipTable = 'CANYRegion';
  if(civicrm_api3('custom_field', 'getcount', array('id' => $customFieldID, 'column_name' => 'region_45', 'is_active' => 1)) == 0) {
    return;
  }

  $sql = "
    REPLACE INTO `$table_name` (entity_id, $columnName)
    SELECT  * FROM (
      SELECT contact_id, b.region
      FROM
      civicrm_address a INNER JOIN $zipTable b ON a.postal_code = b.zip
      WHERE a.contact_id = NEW.contact_id
      ORDER BY FIELD(location_type_id, $locationPriorityOrder )
    ) as regionlist
    GROUP BY contact_id;
  ";
  $sql_field_parts = array();

  $info[] = array(
      'table' => $sourceTable,
      'when' => 'AFTER',
      'event' => 'INSERT',
      'sql' => $sql,
  );
  $info[] = array(
      'table' => $sourceTable,
      'when' => 'AFTER',
      'event' => 'UPDATE',
      'sql' => $sql,
  );
  // For delete, we reference OLD.contact_id instead of NEW.contact_id
  $sql = str_replace('NEW.contact_id', 'OLD.contact_id', $sql);
  $info[] = array(
      'table' => $sourceTable,
      'when' => 'AFTER',
      'event' => 'DELETE',
      'sql' => $sql,
  );
} // */
//EOR