/* Получаю все чекбоксы, для изменения их цвета при клике */
const label = document.querySelectorAll('.container-checkbox')
const checkbox = document.querySelectorAll('.checkbox')

/* Получаю иконки вида : Tile и List */
const listIcon = document.getElementById("list-icon")
const tileIcon = document.getElementById("tile-icon")


const color = () => {
	
	for (let i = 0; i < label.length; i++) {
		
		if(label[i].children[0].checked === true) {
			label[i].style.color = '#007bff'
		} else {
			label[i].style.color = '#000'
		}	

	}

}

addEvents = arr => {
	for (let i = 0; i < arr.length; i++) {
		const element = arr[i];
		if(element.type === 'checkbox') {
			element.onclick = color
		} 
	}
}

const showListProducts = () => {
	document.getElementById('card-deck_list').style.display = "flex"
	document.getElementById('card-deck_tile').style.display = "none"
	if(tileIcon.src === 'http://shop-diplom.ru/img/icons/tile-black.svg') {
		tileIcon.src = '../img/icons/tile.svg'
	} 
	
	listIcon.src = '../img/icons/list-black.svg'
}

const showTileProducts = () => {
	document.getElementById('card-deck_list').style.display = "none"
	document.getElementById('card-deck_tile').style.display = "flex"

	if(listIcon.src === 'http://shop-diplom.ru/img/icons/list-black.svg') {
		listIcon.src = '../img/icons/list.svg'
	} 

	tileIcon.src = '../img/icons/tile-black.svg'
}

listIcon.addEventListener('click', showListProducts)
tileIcon.addEventListener('click', showTileProducts)

addEvents(checkbox)

$.document.ready(function() {
	$('.dropdown-toggle').dropdown()
})
