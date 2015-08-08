function handleMouseOver(elem) {
elem.style.background='white';
elem.style.color='red';
}
function handleMouseOut(elem) {
elem.style.removeProperty('color');
elem.style.removeProperty('background');
}