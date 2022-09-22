if (typeof alexantr === 'undefined' || !alexantr) {
    var alexantr = {};
}

alexantr.tinyMceWidget = (function ($) {
    'use strict';

    return function (inputId, options) {
        var prevInstance = tinymce.get(inputId);
        if (prevInstance) {
            prevInstance.remove();
        }
        options.selector = '#' + inputId;
        // add keyup function to accomodate input in bootstrap modal with ajax form
        options.setup = function(editor) {
            editor.on('keyup', function () {
                tinymce.triggerSave(); 
            });
        };
        tinymce.init(options);

        // this below function can safe to remove, because has been accomodated with keyup function
        // $('#' + inputId).closest('form').on('beforeValidate', function () {
        //     tinymce.triggerSave();
        // });
    }
})(jQuery);
