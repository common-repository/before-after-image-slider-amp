  jQuery(document).ready( function( $ ) {
    if($('#jozzampimageslider_img1a').val() === ''){
    $('#resetMe1a').hide();
    }else{
    $('#resetMe1a').show();
    }

    $('#resetMe1a').click(function() {
      $('#jozzampimageslider_img1a').val('');
      $(this).hide();
    });

    if($('#jozzampimageslider_img1b').val() === ''){
      $('#resetMe1b').hide();
      }else{
      $('#resetMe1b').show();
      }
  
      $('#resetMe1b').click(function() {
        $('#jozzampimageslider_img1b').val('');
        $(this).hide();
      });
    $('#select_img1a, #showpre1a').click(function() {
        items_frame1a = wp.media.frames.items = wp.media({
          title: 'Select Image',
          button: {
            text: 'Select'
      },
      multiple: false,
      library: {
            type: [ 'image' ]
    },});
        items_frame1a.on('select', function(){
            attachment1a = items_frame1a.state().get('selection').first().toJSON();
             var all = JSON.stringify( attachment1a );
             var id = attachment1a.id;
             var url = attachment1a.url;
             var icon = attachment1a.icon;
             $('#showpre1a').attr('src',url);
             $('#jozzampimageslider_img1a').val(url);
    $('#resetMe1a').show();
        });
items_frame1a.open();
        return false;   
    });
    $('#select_img1b, #showpre1b').click(function() {
      items_frame1b = wp.media.frames.items = wp.media({
        title: 'Select Image',
        button: {
          text: 'Select'
    },
    multiple: false,
    library: {
          type: [ 'image' ]
  },});
      items_frame1b.on('select', function(){
          attachment1b = items_frame1b.state().get('selection').first().toJSON();
           var all = JSON.stringify( attachment1b );
           var id = attachment1b.id;
           var url = attachment1b.url;
           var icon = attachment1b.icon;
           $('#showpre1b').attr('src',url);
           $('#jozzampimageslider_img1b').val(url);
  $('#resetMe1b').show();
      });
items_frame1b.open();
      return false;   
  });

});