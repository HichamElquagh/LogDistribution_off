<!DOCTYPE html>
<html>
<head>
  <title>Bank Card</title>
  <!-- Include necessary CSS styles -->
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">  --}}
  <style>
.custom-card {
  width: 100%;
  border-radius: 1rem;
  background: #f9f9f9;
  box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.15);
  position: relative;
  color: #434343;
  display: flex;
  flex-direction: column;
  margin-top: 1rem;
}

.custom-card .card__container {
  padding: 2rem;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.custom-card .left-section {
  margin-top: 0.5rem;
}

.custom-card .card__header {
  margin-bottom: 1rem;
  font-family: 'Playfair Display', serif;
}

@media (max-width: 576px) {
  .card__header {
    margin-top: 1rem;
  }
}

.custom-card .card__body {
  font-family: 'Roboto', sans-serif;
  text-align: center;
}

  
.custom-card .operation {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid #ccc;
  /* margin-bottom: 1rem; */
}

.operation_transaction_bank{
  display: flex;
  justify-content: space-between;
  align-items: center;
  /* padding: 1rem; */
  border-bottom: 1px solid #ccc;
}

.custom-card .operation_transaction_bank .operation:last-child {
  border-bottom: none;
}

.custom-card .operation_transaction_bank .operation i {
  margin-right: 1rem;
}

.custom-card .operation_transaction_bank .operation .text-section {
  flex: 1;
  text-align: left;
}

.custom-card .operation_transaction_bank .operation .cta-section {
  flex: 0 0 auto;
}

.custom-card .operation_transaction_bank .operation .card-title {
  font-size: 1.2rem;
  margin-bottom: 0.5rem;
}

.custom-card .operation_transaction_bank .operation .operation-solde {
  font-size: 1.1rem;
  margin-bottom: 0.25rem;
}

.deposit {
  color: green;
}

.withdrawal {
  color: red;
}



  </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
      <!-- Bank Card -->
      <div class="col-xl-6 col-md-12">
        <div class="card text-center" style="background-color: #f3efef63; border-radius: 10px; padding: 20px; box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);">
          <div class="card-body d-flex justify-content-between align-items-center" style="font-size: 20px; font-family: Arial, sans-serif;">
            <div class="text-start">
              <div class="d-flex">
                <i class="fas fa-building me-2"></i>
                <h4 class="card-title" id="bankName" style="font-weight: bold; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4); font-size: 20px;"></h4>
              </div>
              <h1 class="card-text mb-4" id="bankSolde"></h1>
              <p class="card-text" id="bankAccountNumber" style="font-size: 20px;"></p>
            </div>
            <div>
              <button class="btn text-light" id="addFundsButton" style="background-color :rgb(255,193,7);">
                <i class="fas fa-plus"></i> Add Funds
              </button>
              <div class="mt-4">
                <i id="bankIcon" class="fas fa-university fa-4x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">

      <div class="col-xl-6 col-md-12 card-container">
        <div class="custom-card" data-label="Transactions">
          <div class="card__container">
            <h1 class="card__header">Transactions Bank</h1>
            <div class="card__body" id="transactionsContent"></div>
          </div>
        </div>
      </div>
      <!-- Operations Card -->
      <div class="col-xl-6 col-md-12 card-container">
        <div class="custom-card" data-label="Operations">
          <div class="card__container">
            <h1 class="card__header ">Operations Bank</h1>
            <div class="card__body" id="operationsContent"></div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Include necessary JS scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script> --}}
  {{-- <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script> <!-- Replace "your-fontawesome-kit" with your own Font Awesome kit ID --> --}}

  <script>
    $(document).ready(function() {
      cardbank();
      loadOperations();
      loadTransactions();
    });

    function cardbank() {
      $.ajax({
        url: "https://iker.wiicode.tech/api/bank",
        type: "GET",
        dataType: "json",
        success: function(data) {
          if (data.length > 0) {
            populateCard(data[0]);
          }
        },
        error: function() {
          console.log("Error occurred while fetching bank data.");
        }
      });

      function populateCard(bank) {
        $("#bankName").text(bank.nomBank);
        $("#bankSolde").html("MAD " + bank.solde);
        $("#bankAccountNumber").text("Account Number: " + bank.numero_compt);
        $("#bankAccountNumber").text("Account Number: " + bank.numero_compt);
        $("#addFundsButton").attr("onclick", "addsoldebank(" + bank.id + ")");
      }
    }

    function loadOperations() {
    $.ajax({
      url: "https://iker.wiicode.tech/api/opbank",
      type: "GET",
      dataType: "json",
      success: function(data) {
         $("#operationsContent").empty(); 
        if (data.length > 0) {
          data.forEach(function(operation) {
            createOperationElement(operation);
          });
        } else {
          $("#operationsContent").text("No operations found.");
        }
      },
      error: function() {
        console.log("Error occurred while fetching operations data.");
      }
    });
  }
  function createOperationElement(operation) {
  var operationElement = $("<div></div>").addClass("operation");
  var leftSectionElement = $("<div></div>").addClass("left-section");
  var rightSectionElement = $("<div></div>").addClass("right-section w-50");

  var titleElement = $("<h2></h2>").addClass("card-title").text(operation.title);

  var transactionMontant = parseFloat(operation.solde);
  var cardText = $("<span></span>").addClass("card-text mb-0 fw-bold");
  cardText.text(
  (operation.type === "withdraw")
    ? "- MAD " + transactionMontant.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
    : (operation.type === "transfert" && operation.mode === "bank")
    ? "- MAD " + transactionMontant.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
    : (operation.type === "transfert" && operation.mode === "caisse")
    ? "+ MAD " + transactionMontant.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
    : "+ MAD " + transactionMontant.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
);
// "#3AC47D"
   cardText.css({
    "font-size": "1.4rem",
    "font-family": "Arial, sans-serif",
    "color" : (operation.type === "withdraw") ? "#FF4D4D" 
    : (operation.type === "transfert" && operation.mode === "bank")
    ? "#FF4D4D" 
    : (operation.type === "transfert" && operation.mode === "caisse")
    ? "#3AC47D" 
    :"#3AC47D" 
  });

  var typeElement = $("<p></p>").addClass("operation-type text-start");
  typeElement.css({
    "font-size": "1rem",
    "font-weight": "bold",
    "font-family": "Arial, sans-serif",
    "color": "#555",
    "margin-top": "0.5rem",
  });

  var typeBadgeElement = $("<span></span>").addClass("me-2 badge");

  if (operation.type === "withdraw" ) {
    typeBadgeElement.addClass("bg-danger").text(operation.type);
  }
    else if (operation.type === "transfert" && operation.mode === "bank") {
      typeBadgeElement.addClass("bg-danger").text(operation.type);
  }else if (operation.type === "transfert" && operation.mode === "caisse") 
  typeBadgeElement.addClass("bg-success").text(operation.type);
  else {
    typeBadgeElement.addClass("bg-success").text(operation.type);
  }

  typeElement.prepend(typeBadgeElement); // Prepend the badge before the operation type

  var soldeIconElement = $("<i></i>").addClass("fas");
  var rightInnerSectionElement = $("<div></div>").addClass(" mt-4 right-inner-section");

  var dateIconElement = $("<i></i>").addClass("far fa-calendar-alt me-2");
var dateElement = $("<p></p>").addClass("operation-date text-end text-dark").text(new Date(operation.created_at).toLocaleString('fr-FR'));

dateElement.prepend(dateIconElement); // Prepend the date icon before the date


var motifElement = $("<p></p>").addClass("operation-motif").text("Motif: " + operation.motif);
motifElement.css({
  "font-size": "1rem",
  "text-align":"initial",
  "font-family": "Arial, sans-serif",
  "font-style": "italic",
  "font-weight": "bold",
  "color": "black",
  "overflow-wrap": "anywhere",
});

// Add responsive classes for different screen sizes
motifElement.addClass("text-sm-start text-md-center text-lg-end");

  operationElement.append(leftSectionElement, rightSectionElement);
  leftSectionElement.append(titleElement, soldeIconElement, cardText, typeElement);
  rightSectionElement.append(rightInnerSectionElement);
  rightInnerSectionElement.append(dateElement, motifElement);

  // if (operation.type === "depots" ) {
  //   soldeIconElement.addClass("fa-arrow-up deposit");
  //   soldeIconElement.css({
  //   "font-size": "1.4rem",
  //   "margin-right": "0.5rem",
  //   "color" : "#3AC47D" 
  // });
  // } 
  if(operation.type === "withdraw") {
    soldeIconElement.addClass("fa-arrow-down");
    soldeIconElement.css({
    "font-size": "1.4rem",
    "margin-right": "0.5rem",
    "color" : "#FF4D4D" 
  });
  }
  else if (operation.type === "transfert" && operation.mode === "bank") {
    soldeIconElement.addClass("fa-arrow-down");
    soldeIconElement.css({
    "font-size": "1.4rem",
    "margin-right": "0.5rem",
    "color" : "#FF4D4D" 
  });
  }
  else if (operation.type === "transfert" && operation.mode === "caisse" || operation.type === "depots") {
  soldeIconElement.addClass("fa-arrow-up");
    soldeIconElement.css({
    "font-size": "1.4rem",
    "margin-right": "0.5rem",
    "color" : "#3AC47D" 
  });}
 
  $("#operationsContent").append(operationElement);
}



//  transaction 

function loadTransactions() {
  $.ajax({
    url: "https://iker.wiicode.tech/api/trbank",
    type: "GET",
    dataType: "json",
    success: function(data) {
      $("#transactionsContent").empty();
      if (data.length > 0) {
        data.forEach(function(transaction) {
          createTransactionElement(transaction);
        });
      } else {
        $("#transactionsContent").text("No transactions found.");
      }
    },
    error: function() {
      console.log("Error occurred while fetching transaction data.");
    }
  });
}
function createTransactionElement(transaction) {
  var transactionCard = $("<div></div>").addClass("transaction-card operation_transaction_bank");
  var cardBody = $("<div></div>").addClass("card-body p-0"); // Remove padding

  var flexContainer = $("<div></div>").addClass("operation_transaction_bank").css("display", "flex");
  var leftSection = $("<div></div>").addClass("left-section");
  var rightSection = $("<div></div>").addClass("right-section");

  var titleElement = $("<h2></h2>").addClass("card-title").text(transaction.title);
  
  var venteBadge = $("<span></span>").addClass("badge bg-success").text("Vente");
  var achatBadge = $("<span></span>").addClass("badge bg-danger").text("Achat");

  var numTransactionElement = $("<p></p>").addClass("transaction-info text-center text-dark");
  
  if (transaction.factureAchat_id === null) {
    numTransactionElement.text(" : " + transaction.num_transaction).prepend(venteBadge);
  } else {
    numTransactionElement.text(" : " + transaction.num_transaction).prepend(achatBadge);
  }

  var amountElement = $("<p></p>").addClass("card-text mb-0 fw-bold");
  amountElement.text((transaction.factureAchat_id === null) ? "+ MAD " + transaction.montant : "- MAD " + transaction.montant);
amountElement.css({
  "font-size": "1.4rem",
  "font-family": "Arial, sans-serif"
});

if (transaction.factureAchat_id === null) {
  amountElement.addClass("text-success");
} else {
  amountElement.addClass("text-danger");
}
  var amountIconElement = $("<i></i>").addClass((transaction.factureAchat_id === null) ? "fas fa-arrow-up" : "fas fa-arrow-down"); // Icon for vente or achat
  amountIconElement.css({
    "font-size": "1.4rem",
    "margin-right": "0.5rem"
  });

  var modePaiementElement = $("<p></p>").addClass("operation-type").text("Type: " + transaction.modePaiement);
  modePaiementElement.css({
    "font-size": "1rem",
    "font-weight": "bold",
    "font-family": "Arial, sans-serif",
    "color": "black", // Set color to black
    "margin-top": "0.5rem"
  });

  var dateIconElement = $("<i></i>").addClass("far fa-calendar-alt me-2"); // Add icon for date
  var dateElement = $("<p></p>").addClass("operation-date text-dark text-end").text(transaction.date_transaction);
  dateElement.prepend(dateIconElement); // Prepend icon to the date element

  var etatChequeElement = $("<p></p>").addClass("operation-motif").text("Etat de Cheque: " + transaction.etat_cheque);
  etatChequeElement.css({
    "font-size": "1rem",
    "font-family": "Arial, sans-serif",
    "font-style": "italic",
    "font-weight": "bold",
    "color": "black" // Set color to black
  });

  leftSection.append(numTransactionElement, amountElement, modePaiementElement);
  rightSection.append(dateElement);

  if (transaction.modePaiement === "cheque") {
    rightSection.append(etatChequeElement);
  }

  if (transaction.modePaiement === "virement") {
    var numVirementElement = $("<p></p>").addClass("operation-virement").text("Num Virement: " + transaction.num_virement);
    numVirementElement.css({
  "font-size": "1rem",
  "font-family": "Arial, sans-serif",
  "font-style": "italic",
  "font-weight": "bold",
  "color": "black",
  "width": "100%", // Set maximum width to 100%
  "word-wrap": "break-word", // Enable text wrapping
  "white-space": "normal" // Allow wrapping of long words
});
  
    rightSection.append(numVirementElement);
  }

  flexContainer.append(leftSection, rightSection);
  cardBody.append(titleElement, flexContainer);
  transactionCard.append(cardBody);

  if (transaction.factureAchat_id === null) {
    transactionCard.addClass("withdrawal");
    amountElement.prepend(amountIconElement); // Prepend the icon to the amountElement for vente
  } else {
    transactionCard.addClass("deposit");
    amountElement.prepend(amountIconElement); // Prepend the icon to the amountElement for achat
  }

  $("#transactionsContent").append(transactionCard);
}



  </script>
</body>
</html>
