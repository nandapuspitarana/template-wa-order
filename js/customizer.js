jQuery(document).ready(function ($) {
$( 'ul.my-multicheck-sortable-list' ).sortable({
    handle: 'ul.my-multicheck-sortable-list .dashicons-menu',
    axis: 'y',
    update: function( e, ui ){
        $('ul.my-multicheck-sortable-list input').trigger( 'change' );
    }
});


$( "ul.my-multicheck-sortable-list li input" ).on( 'change', function(){

    /* Get the value, and convert to string. */
    this_checkboxes_values = $( this ).parents( 'ul.my-multicheck-sortable-list' ).find( 'li input' ).map( function(){
        var active = '0';
        if( $(this).prop("checked") ){
            var active = '1';
        }
        return this.name + ':' + active;
    }).get().join( ',' );
   /* Add the value to hidden input. */
   $( this ).parents( 'ul.my-multicheck-sortable-list' ).find( 'input[type="hidden"]' ).val( this_checkboxes_values ).trigger( 'change' );

});



});
