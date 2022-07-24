function cardValidation() {
    let valid = true;
    const cardName = $('input[name="name_on_card"]');
    const cvv = $('input[name="cvc"]');
    const cardNumber = $('input[name="card_number"]');
    const regName = /^[a-z ,.'-]+$/i;
    const regCVV = /^[0-9]{3,3}$/;

    if (cardName.val() !== "" && !regName.test(cardName.val())) {
        cardName.css('background-color', '#fc1d1d');
        cardName.after('<div class="invalid-feedback">Card Holder Name is Invalid</div>');
        valid = false;
    }

    if (cardNumber.val() !== "") {
        // $('#card_number').validateCreditCard(function (result) {
        //     if (!(result.valid)) {
        //         message += "<div>Card Number is Invalid</div>";
        //         cardNumber.css('background-color', '#FFFFDF');
        //         valid = false;
        //     }
        // });
    } else if (cvv.val() !== "" && !regCVV.test(cvv.val())) {
        cvv.css('background-color', '#fc1d1d');
        cvv.after('<div class="invalid-feedback">Card Holder Name is Invalid</div>');
        valid = false;
    }
    if (!valid) {
        $('.submitButton').attr('disabled', 'disabled')
    } else {
        $('.submitButton').removeAttr('disabled')
    }

}
