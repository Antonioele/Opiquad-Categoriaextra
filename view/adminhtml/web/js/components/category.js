define([
    'underscore',
    'Magento_Catalog/js/components/new-category'
], function (_, Category) {
    'use strict';

    return Category.extend({
        getSelected: function () {
            var selected = this.value();
            if (selected && selected.indexOf(',') > -1) // split if contains comma only
                selected = selected.split(',');

            return this.cacheOptions.plain.filter(function (opt) {
                return _.isArray(selected) ?
                    _.contains(selected, opt.value) :
                    selected === opt.value;
            });
        },
        /**
         * Set option to options array.
         *
         * @param {Object} option
         * @param {Array} options
         */
       
    });
});