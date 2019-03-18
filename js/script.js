/* Получаю все чекбоксы, для изменения их цвета при клике */
const label = document.querySelectorAll('.container-checkbox')
const checkbox = document.querySelectorAll('.checkbox')

/* Получаю иконки вида : Tile и List */
const listIcon = document.getElementById("list-icon")
const tileIcon = document.getElementById("tile-icon")

const loginBlockUser = document.getElementById('block-user')



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

const showListProducts = (tile, list) => {
	document.getElementById('card-deck_list').style.display = "flex"
	document.getElementById('card-deck_tile').style.display = "none"

	if(tile.src === 'http://shop-diplom.ru/img/icons/tile-black.svg') {
		tile.src = '../img/icons/tile.svg'
	} 
	
	list.src = '../img/icons/list-black.svg'
}

const showTileProducts = (tile, list) => {
	document.getElementById('card-deck_list').style.display = "none"
	document.getElementById('card-deck_tile').style.display = "flex"

	if(list.src === 'http://shop-diplom.ru/img/icons/list-black.svg') {
		list.src = '../img/icons/list.svg'
	} 

	tile.src = '../img/icons/tile-black.svg'
}


// loginBlockUser.onclick = () => {
// 	const blockProfile = document.getElementById('block-profile')
	
// 	blockProfile.classList.toggle('block-user_active')
	
// }

listIcon.addEventListener('click', () => showListProducts(tileIcon, listIcon))
tileIcon.addEventListener('click', () => showTileProducts(tileIcon, listIcon))

addEvents(checkbox)

$(document).ready(function() {
	$('.dropdown-toggle').dropdown()

		$("#block-user-name").click(() => {
			$('#block-user-modal').fadeToggle(100)
		})
	
	$('#logout').click(() => {
		$.ajax({
			type: "POST",
			url: "../login.php",
			dataType: "html",
			cache: false,
			success: (data) => {
				if (data === 'logout') {
					location.reload()
				}
			}
		})
	})
})

