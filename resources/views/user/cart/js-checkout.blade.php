<script>
function clickCheckout(event,id){
	if(!event.target.checked){
		var newCart = [];
		for(var i=0;i<cart.length;i++){
			if(cart[i] != id){
				newCart.push(cart[i]);
			}
		}
		cart = newCart;
	}else{
		cart.push(id);
	}
}

function clickAllCheckout(event){
	var list = $(".list-cart-checkbox");
	cart = [];
	if(event.target.checked){
		for(var i=0;i<list.length;i++){
			list[i].checked = true;
			cart.push(list[i].value);
		}
	}else{
		for(var i=0;i<list.length;i++){			
			list[i].checked = false;
		}
	}
}
</script>