{*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2017                                |
 +--------------------------------------------------------------------+
 | This file belongs to CiviCRM's Membershiprecord extension.         |
 |                                                                    |
 +--------------------------------------------------------------------+
*}

<h3>Memberships Terms</h4>
<table id="membership_terms" class="display">
  <thead>
    <tr>
      <th>{ts}Term ID{/ts}</th>
      <th>{ts}Membership ID{/ts}</th>
      <th>{ts}Contribution ID{/ts}</th>
      <th>{ts}Start Date{/ts}</th>
      <th>{ts}End Date{/ts}</th>
    </tr>
  </thead>
  <tbody>
    {foreach from=$membershipTerms item=term}
      <tr id="crm-membership_term_{$term.id}" class="{cycle values="odd-row,even-row"} {$term.class} crm-membership_term">
          <td class="crm-membership_term-id" data-order="{$term.id}">{$term.id}</td>
          <td class="crm-membership-id" data-order="{$term.membership_id}"><a href="#crm-membership_{$term.membership_id}">{$term.membership_id}</a></td>
          <td class="crm-contribution-id" data-order="{$term.contribution_id}"><a href="{crmURL p='civicrm/payment' q="view=transaction&component=contribution&action=browse&cid=`$contactId`&id=`$term.contribution_id`&selector=1"}" target="_blank">{$term.contribution_id}</a></td>
          <td class="crm-membership-start_date" data-order="{$term.start_date}">{$term.start_date|crmDate}</td>
          <td class="crm-membership-end_date" data-order="{$term.end_date}">{$term.end_date|crmDate}</td>
      </tr>
    {/foreach}
  </tbody>
</table>

{* ALTERNATE

<div class="view-content">
{include file="CRM/common/jsortable.tpl"}
<div id="membershipterms">
{strip}
<table id="active_membership" class="display">
<thead>
<tr>
<th>{ts}Term{/ts}</th>
<th>{ts}Start Date{/ts}</th>
<th>{ts}End Date{/ts}</th>
</tr>
</thead>
</table>
{/strip}
</div>
</div>
*}