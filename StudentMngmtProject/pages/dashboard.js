let qs = new URLSearchParams(window.location.search);

function gotoWeek(week, replace = false) {
    qs.set('week', week);

    if(replace) {
        window.location.replace(window.location.pathname + '?' + qs.toString());
    }
    else {
        window.location.search = qs.toString();
    }
}

function nextWeek() {
    let qs = new URLSearchParams(window.location.search);
    let curr = parseInt(qs.get('week'));
    gotoWeek(curr + 1);
}

function prevWeek() {
    let qs = new URLSearchParams(window.location.search);
    let curr = parseInt(qs.get('week'));
    gotoWeek(curr - 1);
}
