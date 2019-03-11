/* Получаю селекторы категорий  */
const categories = document.querySelectorAll('.dropdown')

/* Получаю все чекбоксы, для изменения их цвета при клике */
const label = document.querySelectorAll('.container-checkbox')
const checkbox = document.querySelectorAll('.checkbox')

/* Получаю иконки вида : Tile и List */
const listIcon = document.getElementById("list-icon")
const tileIcon = document.getElementById("tile-icon")

const openDropdown = (item) => {
    let menu = item.querySelector('.dropdown-menu')

    item.classList.toggle('show')
    menu.classList.toggle('show')    
}

const dropdowns = items => {
    for(key in items) {
        const element = items[key]
        items[key].onclick = () => openDropdown(element)

    }
}

function color() {
	
	for (let i = 0; i < label.length; i++) {
		
		if(label[i].children[0].checked === true) {
			label[i].style.color = '#007bff'
		} else {
			label[i].style.color = '#000'
		}	

	}

}

function addEvents(arr) {
	for (let i = 0; i < arr.length; i++) {
		const element = arr[i];
		if(element.type === 'checkbox') {
			element.onclick = color
		} 
	}
}

function showListProducts() {
	document.getElementById('card-deck_list').style.display = "flex"
	document.getElementById('card-deck_tile').style.display = "none"
	console.log(tileIcon.src)
	if(tileIcon.src === 'http://shop-diplom.ru/img/icons/tile-black.svg') {
		tileIcon.src = '../img/icons/tile.svg'
	} 
	
	listIcon.src = '../img/icons/list-black.svg'
}

function showTileProducts() {
	document.getElementById('card-deck_list').style.display = "none"
	document.getElementById('card-deck_tile').style.display = "flex"

	if(listIcon.src === 'http://shop-diplom.ru/img/icons/list-black.svg') {
		listIcon.src = '../img/icons/list.svg'
	} 

	tileIcon.src = '../img/icons/tile-black.svg'
}

listIcon.addEventListener('click', showListProducts)
tileIcon.addEventListener('click', showTileProducts)

dropdowns(categories)
addEvents(checkbox)

