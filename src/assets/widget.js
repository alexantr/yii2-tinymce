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
        tinymce.init(options);
        $('#' + inputId).closest('form').on('beforeValidate', function () {
            tinymce.triggerSave();
        });
    }
})(jQuery);
