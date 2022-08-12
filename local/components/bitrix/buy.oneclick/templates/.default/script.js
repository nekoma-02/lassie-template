$(document).ready(function () {

	$('#show-form').on('click', function () {
		$("#buy-one-click").removeClass('hidden');
	});


	$('#btn-buy-click').on('click', function () {

		var user_phone = $("#user_phone").val();
		var func;
		var params;

		if (arParams.URL == 'DETAIL PAGE') {
			func = 'buyFromDetailPage';
			params = {
				phone: user_phone,
				productId: arParams.ID_PRODUCT
			}
		} else {
			func = 'buyFromBasketOneClick';
			params = {
				phone: user_phone
			}
		}

		
		BX.ajax.runComponentAction('bitrix:buy.oneclick',
			func, { // Вызывается без постфикса Action
			mode: 'class',
			data: params, // ключи объекта data соответствуют параметрам метода
		})
			.then(function (response) {
				console.log(response);

				if (typeof response.data.errors !== 'undefined') {
					$('.alert').show();
					$('#message').text(response.data.errors.message);
				}
				if (typeof response.data.success !== 'undefined') {
					$("#buy-one-click").hide();
					$('.alert').show();
					$('#message').text(response.data.success.message);
				}
			});
	});

});