# CiviCRM Membership Record

This extension records all terms or periods of a membership. A term is associated to an interval of dates (start and end) and to a specific payment/contribution.

The table with the terms data is shown under the Memberships table of a Contact's _Memberships_ tab:

![Memberships tab](/images/contact-memberships_tab.png)

Upon installation, all memberships are compared with their respective contributions and, for example, if a contact has 4 memberships with 2 of them renewed 5 times (in total), this leads to 9 records, as depicted below:

![Memberships' terms example](/images/contact_59-membership_terms_example.png)

Each record corresponds to a term where the _Start Date_ is either the beginning of a membership or a renewal of an existing one. In general, a lifetime membership may not have an _End Date_.

## Installation

Follow the standard [CiviCRM installation procedure](https://docs.civicrm.org/user/en/latest/introduction/extensions/#installing-extensions):

1. Copy all the files to a newly created folder named `org.civicrm.membershiprecord` in `sites/default/files/civicrm/ext/`;
2. In your web browser access `http://YOUR-CIVICRM-DOMAIN/civicrm/admin/extensions`;
3. Click the **Install** link under the **Membership Record** extension (this creates a new database table which is automatically filled with the terms of the existing memberships);
4. Click **Enable** to allow the terms to be visualized and new terms to be recorded.

## Usage

1. Access any contact with at least one membership to view the respective term(s) in the _Memberships_ tab;
2. Upon a membership's creation with an associated payment, there will be a new term record which will appear on the _Memberships Terms_ table (links to the appropriate contribution and membership are provided on the respective IDs);
3. If a membership is renewed, a new record will also be shown in the same table, with a _Start Date_ corresponding to the respective payment.
4. If a membership is deleted, all the terms associated to it will also be deleted, i.e. the _Memberships Terms_ table will not display terms of a deleted membership.

## Disabling and Uninstalling the extension

A couple of points should be considered:

- Disabling the extension will prevent the terms to be displayed in the Contact's _Memberships_ tab and new terms to be recorded (only the terms prior to _disabling_ will remain in the database and **re-enabling does not insert new records**);
- Uninstalling will only **remove the data associated to the terms**, i.e. a `DROP` is performed on the database table that stores the membership terms. Memberships and associated contributions are not affected.


## Files overriden by this extension

1. `CRM/Member/Page/Tab.php`: adds a new variable to the memberships tab's context (`membershipTerms`) containing the records of the terms fetched through `CRM_Core_DAO`;
1. `templates/CRM/Member/Page/Tab.tpl`: adds the terms table under the _(In)Active Memberships_ table (the `alterTemplateFile` hook is used in order to change the file path to `templates/CRM/MembershipTerm/MembershipTab.tpl`);
1. `templates/CRM/Member/Page/Tab.hlp`: although this file was not modified, it needs to be in the same folder as the previous one.

