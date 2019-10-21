class idxSlick {
    constructor() {
        this.target = $('.js-idx-slider');

        let self = this;

        $(document).ready(function () {
            self.target.each(function () {
                self.showSliderAfterLoadListener($(this));
                self.slickInit($(this));
            });
        });
    }

    executeAction(target, action, parameter, isConstruct) {
        let eventDependence = target.data('event-dependence');

        if (undefined !== eventDependence) {
            target.on(eventDependence, function () {
                action(parameter);
            });
        } else {
            if (isConstruct) {
                action(parameter);
            } else {
                target.on('init', function () {
                    action(parameter);
                });
            }
        }
    };

    slickInit(target) {
        let options = {}, mobileOptions = {};

        eval("options=" + target.data('options'));
        eval("mobileOptions=" + target.data('mobile-options'));

        if (mobileOptions !== undefined) {
            options.responsive = mobileOptions.responsive;
        }

        this.executeAction(target, idxSlick.slickConstruct, {'target': target, 'options': options}, true);
    }

    showSliderAfterLoadListener(target) {
        this.executeAction(target, idxSlick.showSlider, target, false);
    }

    static slickConstruct(parameters) {
        parameters.target.slick(parameters.options);
    }

    static showSlider(target) {
        target.closest('.c__hidden').removeClass('c__hidden');
    }
}

new idxSlick();
