if (typeof alexantr === 'undefined' || !alexantr) {
    var alexantr = {};
}

alexantr.tinyMceWidget = (function ($) {
    'use strict';

    var baseUrl,
        callbacks = [],
        loading = false,
        loaded = false;

    function callPlugin(inputId, options) {
        options.selector = '#' + inputId;
        tinymce.init(options);
        $('#' + inputId).closest('form').on('beforeValidate', function () {
            tinymce.triggerSave();
        });
    }

    $.getCachedScript = function (url, options) {
        options = $.extend(options || {}, {
            dataType: 'script',
            cache: true,
            url: url
        });
        return $.ajax(options);
    };

    return {
        setBaseUrl: function (url) {
            if (!baseUrl) {
                baseUrl = url;
            }
        },
        register: function (inputId, options) {
            if (loaded) {
                callPlugin(inputId, options);
            } else {
                callbacks.push({inputId: inputId, options: options});
                if (!loading && baseUrl) {
                    loading = true;
                    $.getCachedScript(baseUrl + 'tinymce.min.js').done(function () {
                        loaded = true;
                        loading = false;
                        for (var i = 0; i < callbacks.length; i++) {
                            callPlugin(callbacks[i].inputId, callbacks[i].options);
                        }
                    });
                }
            }
        }
    };
})(jQuery);