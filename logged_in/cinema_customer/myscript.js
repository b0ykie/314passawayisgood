

//f&b check box event listener
var foodCheckbox = document.getElementById("fnbCheckbox");
var foodSelection = document.getElementById("fnb");

foodCheckbox.addEventListener("change", function() {
    if (this.checked) {
        foodSelection.disabled = false;
    } else {
        foodSelection.disabled = true;
    }
    console.log("foodSelection: " + foodSelection.disabled);
});









var ticketTypeSelect = document.getElementById("ticket_type");
var ticketQtyInput = document.getElementById("ticket_qty");
var tixCostElement = document.getElementById("tixCost");
var tixCostInput = document.getElementById("tixCostInput");
var fnbCheckbox = document.getElementById("fnbCheckbox");
var fnbSelect = document.getElementById("fnb");
var fnbCostElement = document.getElementById("fnbCost");
var fnbCostInput = document.getElementById("fnbCostInput");
var totalCostElement = document.getElementById("totalCost");

// Event listener for ticket_type selection change
ticketTypeSelect.addEventListener("change", updateTixCost);
// Event listener for ticket_qty input change
ticketQtyInput.addEventListener("input", updateTixCost);
// Event listener for F&B checkbox change
fnbCheckbox.addEventListener("change", updateTotalCost);
// Event listener for F&B select change
fnbSelect.addEventListener("change", updateTotalCost);

// Function to update the ticket cost
function updateTixCost() {
    var ticketType = ticketTypeSelect.value;
    var ticketQty = parseInt(ticketQtyInput.value);
    var tixPrice = parseFloat(ticketType.split("|")[1]);

    // Retrieve the ticket price for the selected ticket type
    //var ticketPrice = ;

    var tixCost = tixPrice * ticketQty;
    tixCostElement.textContent = "Ticket Cost: $" + tixCost.toFixed(2);
    tixCostInput.value = tixCost.toFixed(2);

    updateTotalCost(); // Call function to update the total cost
}



function updateTotalCost() {
    var tixCost = parseFloat(tixCostInput.value);
    var fnbCost = 0.0;

    if (fnbCheckbox.checked) {
        var fnbType = fnbSelect.value;
        var fnbPrice = parseFloat(fnbType.split("|")[1]);
        fnbCost = fnbPrice;
    }

    fnbCostElement.textContent = "F&B Cost: $" + fnbCost.toFixed(2);
    fnbCostInput.value = fnbCost.toFixed(2);

    var totalCost = tixCost + fnbCost;
    totalCostElement.textContent = "Total Cost: $" + totalCost.toFixed(2);
}



// // select DOM elements
// const ticketQtyInput = document.getElementById('ticket_qty');
// const fnbSelect = document.getElementById('fnb');
// const useLoyaltyPtsCheckbox = document.getElementById('useLoyaltyPtsCheckbox');
// const tixCostDiv = document.getElementById('tixCost');
// const fnbCostDiv = document.getElementById('fnbCost');
// const totalCostDiv = document.getElementById('totalCost');
// const loyaltyPtsEarnDiv = document.getElementById('loyaltyPtsEarn');
// const fnbCheckbox = document.getElementById("fnb-checkbox");

// // define event listeners
// ticketQtyInput.addEventListener('change', updateCosts);
// ticketTypeSelect.addEventListener('change', updateCosts);
// fnbSelect.addEventListener('change', updateCosts);
// useLoyaltyPtsCheckbox.addEventListener('change', updateCosts);

// // function to update costs based on input values
// function updateCosts() {
//     // get ticket int input values
//     let ticketQty = parseInt(ticketQtyInput.value);
//     if (isNaN(ticketQty)) {
//         ticketQty = 0;
//     }


//     // get the price of ticket type
//     let ticketTypePrice;
//     if (ticketTypeSelect.value === 'Adults') {
//         ticketTypePrice = 12;
//     } else if (ticketTypeSelect.value === 'Students') {
//         ticketTypePrice = 8;
//     } else if (ticketTypeSelect.value === 'Senior Citizen') {
//         ticketTypePrice = 6;
//     } else {
//         ticketTypePrice = 0;
//     }

//     // get the price of fnb
//     let fnbPrice = 0;
//     if (fnbCheckbox.checked) {
//         if (fnbSelect.value === 'Popcorn'){
//             fnbPrice = 6; 
//         } else if (fnbSelect.value === 'Nachos'){
//             fnbPrice = 5; 
//         } else if(fnbSelect.value === 'Soft Drinks'){
//             fnbPrice = 3; 
//         } else if(fnbSelect.value === 'Popcorn Set'){
//             fnbPrice = 12; 
//         } else if(fnbSelect.value === 'Nacho Set'){
//             fnbPrice = 10; 
//         }
//     }


//     // calculate costs
//     const tixCostOut = ticketQty * ticketTypePrice;
//     const fnbCostOut = fnbPrice;
//     const totalCostOut = tixCostOut + fnbCostOut;
//     const loyaltyPtsEarn = Math.floor(totalCostOut); // 1 loyalty point per $1 spent

//     // display costs
//     tixCostDiv.textContent = `Ticket Cost : $${tixCostOut.toFixed(2)}`;
//     fnbCostDiv.textContent = `F&B Cost : $${fnbCostOut.toFixed(2)}`;
//     totalCostDiv.textContent = `Total Cost : $${totalCostOut.toFixed(2)}`;
//     loyaltyPtsEarnDiv.textContent = `Loyalty Points Earn : ${loyaltyPtsEarn}`;

//     // apply loyalty points if checkbox is checked
//     const useLoyaltyPts = useLoyaltyPtsCheckbox.checked;


//     if (totalCostOut > 0) {
//         // Show payment method
//         document.getElementById("payment-method").style.display = "block";
//     }
//}
