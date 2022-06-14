const select = document.querySelector('select').getElementsByTagName('option');
const urlParams = new URLSearchParams(window.location.search);
const param = urlParams.get('year_order');

for (let i = 0; i < select.length; i++) {
    if (param === select[i].value) {
        select[i].selected = true;
    }
}