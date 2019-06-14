(function($, Drupal){
    Drupal.behaviors.IconBlockBehavior = {
        attach: function(context, settings) {
            $('.icon_block_icon-link.menu-item a').removeAttr('href');
        }
    };
})(jQuery, Drupal);
