(function() {
    tinymce.create('tinymce.plugins.gallery_button_script', {
        init : function(editor, url) {
            editor.addButton('gallery_button', {
                title : 'Insert Image Gallery',
                icon : 'image',
                onclick : function() {
                    editor.insertContent('[gallery ids="" class="gallery-image owl-carousel owl-theme"]');
                }
            });
        }
    });
    tinymce.PluginManager.add('gallery_button_script', tinymce.plugins.gallery_button_script);
})();
