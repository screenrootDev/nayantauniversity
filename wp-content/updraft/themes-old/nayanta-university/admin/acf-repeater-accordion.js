(function ($) {
    function setupAccordion($row) {
        if ($row.hasClass('acf-accordion-ready')) return;

        const $fields = $row.children('.acf-fields');
        const $firstInput = $row.find('input[type="text"]').first();
        const title = $firstInput.val() || 'Faculty Row';

        const $toggle = $(`
      <div class="acf-accordion-toggle">
        <strong>${title}</strong>
        <span class="icon">+</span>
      </div>
    `);

        $row.prepend($toggle);
        $fields.hide();
        $row.addClass('acf-accordion-ready');

        $toggle.on('click', function () {
            const isOpen = $fields.is(':visible');
            $fields.slideToggle(200);
            $toggle.toggleClass('open', !isOpen);
            $toggle.find('.icon').text(isOpen ? '+' : '−');
        });

        $firstInput.on('input', function () {
            $toggle.find('strong').text($(this).val() || 'Faculty Row');
        });
    }

    function initAccordion(scope = document) {
        $(scope)
            .find('.acf-field-repeater .acf-row')
            .each(function () {
                setupAccordion($(this));
            });
    }

    $(document).ready(function () {
        initAccordion();
        if (typeof acf !== 'undefined') {
            acf.addAction('append', function ($el) {
                initAccordion($el);
            });
        }
    });
})(jQuery);
