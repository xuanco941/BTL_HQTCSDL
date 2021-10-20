
var modal = document.querySelector('#modal');
var insert = document.querySelector('#insert');
var form = document.querySelector('#form');

var update = document.querySelector('#update');
var modal2 = document.querySelector('#modal2');
var form2 = document.querySelector('#form2');

var del = document.querySelector('#delete');
var modal3 = document.querySelector('#modal3');
var form3 = document.querySelector('#form3');


insert.onclick = () => {
    modal.style.display = 'flex';
}
modal.onclick = (e) => {
    modal.style.display = 'none';
}
form.onclick = (e) => {
    e.stopPropagation();

}

update.onclick = () => {
    modal2.style.display = 'flex';
}
modal2.onclick = (e) => {
    modal2.style.display = 'none';
}
form2.onclick = (e) => {
    e.stopPropagation();

}

del.onclick = () => {
    modal3.style.display = 'flex';
}
modal3.onclick = (e) => {
    modal3.style.display = 'none';
}
form3.onclick = (e) => {
    e.stopPropagation();

}