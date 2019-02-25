(function($) {
    /**
     * A jQuery plugin that lets you easily enhance data tables with selectable rows.
     *
     *
     * @author Marco Kerwitz <marco@kerwitz.com>
     * @see    https://github.com/kerwitz/jquery.tableCheckbox.js
     */
    $.fn.tableCheckbox = function(options) {
        var _private = {
            /**
             * The configuration of this plugin.
             *
             * Overload with custom values when calling the plugin:
             * $('table').tableCheckbox({selectedRowClass: 'selected-row'});
             *
             * @var object
             */
            config: $.extend({
                // The class that will be applied to selected rows.
                selectedRowClass: 'warning',
                // The selector used to find the checkboxes on the table. You may customize this in
                // order to match your table layout if it differs from the assumed one.
                checkboxSelector: 'td:first-of-type input[type="checkbox"],th:first-of-type input[type="checkbox"]',
                // A callback that is used to determine wether a checkbox is selected or not.
                isChecked: function($checkbox) {
                    return $checkbox.is(':checked');
                }
            }, options),
            /**
             * Variables used across multiple tables.
             *
             * @var object
             */
            registry: {
                shiftKeyIsPressed: false
            },
            helpers: {
                /**
                 * Returns the selection methods available in the current browser.
                 *
                 * @author Grinn, http://stackoverflow.com/users/152648/grinn
                 * @author Gert Grenander, http://stackoverflow.com/users/339850/gert-grenander
                 * @see    http://stackoverflow.com/questions/3169786/clear-text-selection-with-javascript
                 */
                selection: window.getSelection ? window.getSelection() : document.selection ? document.selection : null,
                /**
                 * Removes any text selection the user made.
                 *
                 * @author Marco Kerwitz <marco@kerwitz.com>
                 */
                removeTextSelection: function() {
                    if (!!_private.helpers.selection) {
                        _private.helpers.selection.empty
                            ? _private.helpers.selection.empty()
                            : _private.helpers.selection.removeAllRanges();
                    }
                },
                /**
                 * Returns wether or not a text selection currently exists.
                 *
                 * @author Marco Kerwitz <marco@kerwitz.com>
                 * @todo   This will return false positives when the user selected text outside of
                 *         the table and then tries to select rows.
                 * @return {boolean}
                 */
                hasSelection: function() {
                    return !!_private.helpers.selection && _private.helpers.selection.toString().length;
                }
            }
        };
        // Initiate a event callback that we can use to tell wether the user is pressing the shift
        // key or not.
        $(document).on('keydown.tsc keyup.tsc', function(e) {
            _private.registry.shiftKeyIsPressed = e.shiftKey;
        });
        return this.each(function() {
            var $table = $(this),
                $headCheckbox = $table.find('thead tr ' + _private.config.checkboxSelector),
                $checkboxes = $table.find('tr ' + _private.config.checkboxSelector).not($headCheckbox),
                $lastRow = [];
            // Listen for changes on the checkbox in the table header and apply its current state
            // to all checkboxe on the table.
            $headCheckbox.on('change', function(e) {
                $checkboxes
                    .prop('checked', _private.config.isChecked($headCheckbox))
                    .trigger('change');
            });
            // Cycle through each checkbox found on the table.
            $checkboxes.each(function() {
                var $checkbox = $(this),
                    $row = $checkbox.parents('tr');
                $checkbox.on('change', function(e, isInternal) {
                    // When the user clicks directly on the rows he will unwillingly select
                    // the text of all rows inbetween. Remove that selection immediately.
                    _private.helpers.removeTextSelection();
                    if (!isInternal && _private.registry.shiftKeyIsPressed && $lastRow.length) {
                        // User held shift key while clicking on this checkbox and clicked another one
                        // prior. Get all checkboxes inbetween the two and check or uncheck them.
                        $inbetween = ($lastRow.index() < $row.index())
                            ? $row.prevUntil($lastRow)
                            : $row.nextUntil($lastRow);
                        $inbetween.find(_private.config.checkboxSelector)
                            .prop('checked', _private.config.isChecked($checkbox))
                            .trigger('change', [true]);
                    }
                    $lastRow = $row;
                    $row.toggleClass(_private.config.selectedRowClass, _private.config.isChecked($checkbox));
                });
                // Monitor the row and check the checkbox accordingly.
                $row.on('click', function(e) {
                    if (_private.helpers.hasSelection()) {
                        // There was a text slection prior to this click. Chances are that the user
                        // simply wants to clear that instead of selecting this row - so do nothing.
                        return;
                    }
                    if ($.data($row, 'tc-timeout')) {
                        // There was a timeout running from a previous click event, this seems to be
                        // a double click. Cancel the first timeout before we create a new one.
                        window.clearTimeout($.data($row, 'tc-timeout'));
                    }
                    // We use a short timeout to wait for double-click selections that the user might
                    // have intended to make. If any selection is created withing this timespan we
                    // wont do anything to not interfere with the users intentions too much.
                    $.data($row, 'tc-timeout', window.setTimeout(function() {
                        // Do nothing if the user selected text on the row.
                        if (_private.helpers.hasSelection()) return;
                        // Make sure the user did not click on any clickable content in the row.
                        if (!$(e.target).is('a,input,button') && !$(e.target).parents('a,input,button').length) {
                            $checkbox
                                .prop('checked', !_private.config.isChecked($checkbox))
                                .trigger('change');
                        }
                    }, 50));
                })
            });
        });
    };
}(jQuery));