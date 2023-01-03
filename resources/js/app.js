import './bootstrap';
let foreignCurrency = '';
let exchangeRate = 0;
let surCharge = 0;
let surchargeAmount = 0;
let foreignCurrencyAmount = 0;
let totalPaidAmount = 0;
let discountPercent = 0;
let totalDiscount = 0;
let successDiv = document.getElementById('success-div');
let calculationSuccessResponse = document.getElementById('success-response');



function calculate() {
    let calculateButton = document.querySelector('#calculate');

    calculateButton.addEventListener('click', function (e) {
        e.preventDefault();
        let amount = document.getElementById('grid-last-name').value
        let selectionBox = document.getElementById("grid-state");
        let selectValue= selectionBox.options[selectionBox.selectedIndex].text;
        var payload = { amount: amount, currency: selectValue};


        axios.post('/api/orders/calculate',
            payload,
        ).then((response) => {
            let calculationSuccessResponse = document.getElementById('success-response');

            foreignCurrency = response.data.data.foreign_currency;
            exchangeRate = response.data.data.exchange_rate;
            surCharge = response.data.data.surcharge_percent;
            surchargeAmount = response.data.data.surcharge_amount;
            foreignCurrencyAmount = response.data.data.foreign_currency_amount;
            totalPaidAmount = response.data.data.total_paid_amount;
            discountPercent = response.data.data.discount_percent;
            totalDiscount = response.data.data.total_discount;

            calculationSuccessResponse.innerHTML = 'Exchange rate: '+ exchangeRate + '' +
                '<br />Foreign currency: ' + foreignCurrency +
                '<br />Surcharge: ' + surCharge +
                '<br />Surcharge amount: ' + surchargeAmount +
                '<br />Amount of foreign currency purchased: ' + foreignCurrencyAmount +
                '<br />Total paid amount: ' + totalPaidAmount +
                '<br />Discount percentage: ' + discountPercent +
                '<br />Total discount: ' + totalDiscount + '<br />'

            console.log(response.data.data.exchange_rate);
            successDiv.style.display = "block";

        }) .catch((error) => {
            let calculationErrorResponse = document.getElementById('error-response');
            let errorRedDiv = document.getElementById('error-red-div');
            calculationErrorResponse.innerHTML = error.response.data.message;
            errorRedDiv.style.display = "block";



        })

    });
};

function createOrder()
{
    let purchaseButton = document.querySelector('#purchase');

    purchaseButton.addEventListener('click', function (e) {
        e.preventDefault();

        var purchasePayload = {
            foreign_currency: foreignCurrency,
            exchange_rate: exchangeRate,
            surcharge_percent: surCharge,
            surcharge_amount: surchargeAmount,
            foreign_currency_amount: foreignCurrencyAmount,
            total_paid_amount: totalPaidAmount,
            discount_percent: discountPercent,
            discount_amount: totalDiscount
        };

        axios.post('/api/orders/create',
            purchasePayload,
        ).then((response) => {
            calculationSuccessResponse.innerHTML = response.data.message;
            console.log(response.data.message);

        }) .catch((error) => {

        })

    });

}

// const axios = require('axios').default;
window.onload = function () {

    axios.get('/api/getCurrenciesList')
        .then(function (response) {
            let currencyList = response.data;
            let currencyListSelect = document.querySelector('#grid-state')

            for (const [key, value] of Object.entries(currencyList.data)) {
                let currencyOption = document.createElement('option');
                currencyOption.value = value;
                currencyOption.text = key;
                currencyListSelect.appendChild(currencyOption);

            }

        })
    calculate();
    createOrder();
}







