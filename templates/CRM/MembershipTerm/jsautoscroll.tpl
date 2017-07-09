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
{literal}
<script type="text/javascript">
  CRM.$(function($) {
    $("a[href^='#crm-membership_']").click(function() {
      // scroll to specific ID
      if(location.pathname.replace(/^\//,'')==this.pathname.replace(/^\//,'') || location.hostname==this.hostname) {
        var target = $(this.hash);
        target = target.length? target: $('[name='+this.hash.slice(1)+']');
        if(target.length) {
          $('html,body').animate({
            scrollTop:target.offset().top - 70 // slightly above
          },1000);

          // animate row's color
          var orig_color = $(target).css('background-color');
          $(target).animate({
            backgroundColor: '#CCCCFF'
          },1000);
          setTimeout(function() {
            $(target).animate({
              backgroundColor: orig_color
            },500);
          },1000)
          return false;
        }
      }
    });
  });
</script>
{/literal}