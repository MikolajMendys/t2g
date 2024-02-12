const futureDateInDays = moment('2024/02/28');
const futureDateInHours = moment().add(2, 'hours').add(1, 'minutes').add(37, 'seconds');

$(document).ready(() => {
    $('.numbers-container').each((i, el) => {
        const step1 = $(el).find('#step1');
        const step2 = $(el).find('#step2');
        const step1Text = $(el).find('#step1Text');
        const step2Text = $(el).find('#step2Text');
        const lowerCover = $(el).find('#lowerCover');
        const numberSpan = $(el).find('#numberSpan');

        numberSpan.on('DOMSubtreeModified', () => {
            const newNumber = numberSpan.html();
            step1.addClass('flip1');

            setTimeout(() => {
                step1Text.html(newNumber);
                step1.removeClass('flip1');
                step2Text.html(newNumber);
                step2.addClass('flip2');
                setTimeout(() => {
                    lowerCover.html(newNumber);
                    step2.removeClass('flip2');
                }, '450')
            }, '350');
        });
    });
    calcTimeToDraw();

    setInterval(() => {
        calcTimeToDraw();
    }, "1000");
});

const calcTimeToDraw = () => {
    const useCloserDate = $('#useCloserDate').is(':checked');
    const date = useCloserDate ? futureDateInHours : futureDateInDays;
    const now = moment();

    let differences = {};
    const units = ['days', 'hours', 'minutes', 'seconds'];

    units.forEach(unit => {
        differences[unit] = date.diff(now, unit);
        now.add(differences[unit], unit);
    });

    if (differences.days > 0) {
        delete differences.seconds
    } else {
        delete differences.days
    }

    setTimeToDraw(differences);
}

const setTimeToDraw = (diffs) => {
    const displays = $('.numbers-container');
    let i = 0;

    for (let key in diffs) {
        setIfValueIsDifferent(displays[i], key, diffs[key]);
        i++;
    }
}

const setIfValueIsDifferent = (el, unit, value) => {
    const numberSpan = $(el).find('#numberSpan');
    const timeUnitSpan = $(el).find('#timeUnitSpan');

    if (value < 0) {
        value = "00"
    } else if (value < 10) {
        value = "0" + value;
    }

    if (numberSpan.html() != value) {
        numberSpan.html(value);
        timeUnitSpan.html(unit);
    }
}