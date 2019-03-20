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

if(listIcon && tileIcon) {
	listIcon.addEventListener('click', () => showListProducts(tileIcon, listIcon))
	tileIcon.addEventListener('click', () => showTileProducts(tileIcon, listIcon))
}

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

	$('#btn-send').click(e => {
		let orderFio = $('#order_full_name').val();
		let orderEmail = $('#order_email').val();
		let orderPhone = $('#order_phone').val();
		let orderAddress = $('#order_address').val();

		if(!$('.order_delivery').is(':checked')) {
			send_order_delivery = '0';
		} else {
			send_order_delivery = '1';
		}

		if(orderFio === '' || orderFio.length > 50) {
			$('#order_full_name').css('borderColor', '#FDB6B6');
			send_order_fio = '0';
		} else {
			$('#order_full_name').css('borderColor', '#DBDBDB');
			send_order_fio = '1';
		}

		if(orderEmail === '' || orderEmail.length > 50) {
			$('#order_email').css('borderColor', '#FDB6B6');
			send_order_email = '0';
		} else {
			$('#order_email').css('borderColor', '#DBDBDB');
			send_order_email = '1';
		}

		if(orderPhone === '' || orderPhone.length > 50) {
			$('#order_phone').css('borderColor', '#FDB6B6');
			send_order_phone = '0';
		} else {
			$('#order_phone').css('borderColor', '#DBDBDB');
			send_order_phone = '1';
		}

		if(orderAddress === '' || orderAddress.length > 50) {
			$('#order_address').css('borderColor', '#FDB6B6');
			send_order_address = '0';
		} else {
			$('#order_address').css('borderColor', '#DBDBDB');
			send_order_address = '1';
		}

		if (send_order_delivery === '1' && send_order_fio === "1" && send_order_phone === '1' && send_order_address === '1' && send_order_email === '1') {
			return true;
		}

		e.preventDefault();
	})


	$('.button-user-list, .button-user-tile').click(function(){
		let tid = $(this).attr('tid');

		$.ajax({
			type: "POST",
			url: "../include/addtocart.php",
			data: "id=" + tid,
			dataType: "html",
			cache: false
		})

		
	})

	function funGroupPrice(intPrice) {
		let resultTotal = String(intPrice);
		let lenStr = resultTotal.length;

		switch(lenStr) {
			case 4: {
				groupPrice = `${resultTotal.substring(0,1)} ${resultTotal.substring(1,4)}`;
				break;
			}
			case 5: {
				groupPrice = `${resultTotal.substring(0,2)} ${resultTotal.substring(2,5)}`;
				break;
			}
			case 6: {
				groupPrice = `${resultTotal.substring(0,3)} ${resultTotal.substring(3,6)}`;
				break;
			}
			case 7: {
				groupPrice = `${resultTotal.substring(0,1)} ${resultTotal.substring(1,4)} ${resultTotal.substring(4,7)}`;
				break;
			}
			default: {
				groupPrice = resultTotal;
			}
		}
		return groupPrice;
	}

	$('.card-count__minus').click(function() {
		let count = $(this).attr("count");
		$.ajax({
			type: "POST",
			url: "../include/count-minus.php",
			data: "id="+count,
			cache: false,
			success: data => {
				$("#input-id" + count).val(data)

				let priceProduct = $("#product"+count).attr("price")

				let resultTotal = Number(priceProduct) * Number(data)

				$("#product"+count).html(resultTotal + " руб.")
				
				totalPrice()
			}
		})
	})

	$('.card-count__plus').click(function() {
		let count = $(this).attr("count");

		$.ajax({
			type: "POST",
			url: "../include/count-plus.php",
			data: "id="+count,
			cache: false,
			success: data => {
				$("#input-id" + count).val(data)

				let priceProduct = $("#product"+count).attr("price")

				let resultTotal = Number(priceProduct) * Number(data)

				$("#product"+count).html(resultTotal + " руб.")
				
				totalPrice()
			}
		})
	})

	$('.count-input').keypress(function(e){
		if (e.keyCode === 13) {
			let count = $(this).attr("count")
			let inCount = $("#input-id"+count).val()

			$.ajax({
				type: "POST",
				url: "../include/count-input.php",
				data: "id="+count+"&count="+inCount,
				dataType: "html",
				cache: false,
				success: data => {

					$("input-id"+count).val(data)
					
					let priceProduct = $("#product"+count).attr("price")

					let resultTotal = Number(priceProduct) * Number(data)

					$("#product"+count).html(resultTotal + " руб.")
					
					totalPrice()
				}
			})
		}
	})

	function totalPrice() {
		$.ajax({
			type: "POST",
			url: "../include/total-price.php",
			dataType: "html",
			cache: false,
			success: data => {
				$('.cart-total__price').html(data)
			}
		})
	}

})

