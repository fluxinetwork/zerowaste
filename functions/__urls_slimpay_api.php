Code 200 - Ok

{
  "_links" : {
    "self" : {
      "href" : "https://api-sandbox.slimpay.net/"
    },
    "profile" : {
      "href" : "https://api-sandbox.slimpay.net/alps/v1"
    },
    "https://api.slimpay.net/alps#post-token" : {
      "href" : "https://api-sandbox.slimpay.net/oauth/token"
    },
    "https://api.slimpay.net/alps#create-orders" : {
      "href" : "https://api-sandbox.slimpay.net/orders"
    },
    "https://api.slimpay.net/alps#get-orders" : {
      "href" : "https://api-sandbox.slimpay.net/orders{?creditorReference,reference}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-order-by-id" : {
      "href" : "https://api-sandbox.slimpay.net/orders/{id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-orders" : {
      "href" : "https://api-sandbox.slimpay.net/orders{?creditorReference,entityReference,subscriberReference,state,dateCreatedBefore,dateCreatedAfter,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#get-creditors" : {
      "href" : "https://api-sandbox.slimpay.net/creditors{?reference}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#create-mandates" : {
      "href" : "https://api-sandbox.slimpay.net/mandates"
    },
    "https://api.slimpay.net/alps#get-mandates" : {
      "href" : "https://api-sandbox.slimpay.net/mandates{?creditorReference,reference,rum,id,paymentScheme}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-mandates" : {
      "href" : "https://api-sandbox.slimpay.net/mandates{?creditorReference,entityReference,subscriberReference,paymentScheme,dateSignedBefore,dateSignedAfter,state,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#create-documents" : {
      "href" : "https://api-sandbox.slimpay.net/documents"
    },
    "https://api.slimpay.net/alps#get-documents" : {
      "href" : "https://api-sandbox.slimpay.net/documents{?creditorReference,entityReference,reference}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#create-payins" : {
      "href" : "https://api-sandbox.slimpay.net/payments/in"
    },
    "https://api.slimpay.net/alps#create-payouts" : {
      "href" : "https://api-sandbox.slimpay.net/payments/out"
    },
    "https://api.slimpay.net/alps#search-payments" : {
      "href" : "https://api-sandbox.slimpay.net/payments{?creditorReference,entityReference,subscriberReference,mandateReference,cardAliasReference,scheme,reference,category,currency,executionStatus,executionDateBefore,executionDateAfter,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-payment-by-id" : {
      "href" : "https://api-sandbox.slimpay.net/payments/{id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-payment-issues" : {
      "href" : "https://api-sandbox.slimpay.net/payment-issues{?creditorReference,entityReference,subscriberReference,scheme,currency,executionStatus,dateCreatedBefore,dateCreatedAfter,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-payment-issue-by-id" : {
      "href" : "https://api-sandbox.slimpay.net/payment-issues/{id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#create-direct-debits" : {
      "href" : "https://api-sandbox.slimpay.net/direct-debits"
    },
    "https://api.slimpay.net/alps#get-direct-debits" : {
      "href" : "https://api-sandbox.slimpay.net/direct-debits{?id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-direct-debits" : {
      "href" : "https://api-sandbox.slimpay.net/direct-debits{?creditorReference,entityReference,subscriberReference,mandateReference,paymentReference,currency,executionDateBefore,executionDateAfter,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-direct-debit-issues" : {
      "href" : "https://api-sandbox.slimpay.net/direct-debit-issues{?creditorReference,entityReference,subscriberReference,currency,executionStatus,dateCreatedBefore,dateCreatedAfter,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#get-direct-debit-issues" : {
      "href" : "https://api-sandbox.slimpay.net/direct-debit-issues{?id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#create-recurrent-direct-debits" : {
      "href" : "https://api-sandbox.slimpay.net/recurrent-direct-debits"
    },
    "https://api.slimpay.net/alps#get-recurrent-direct-debits" : {
      "href" : "https://api-sandbox.slimpay.net/recurrent-direct-debits{?id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-recurrent-direct-debits" : {
      "href" : "https://api-sandbox.slimpay.net/recurrent-direct-debits{?creditorReference,entityReference,subscriberReference,reference,currency,activated,frequency,dateFromBefore,dateFromAfter,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#create-credit-transfers" : {
      "href" : "https://api-sandbox.slimpay.net/credit-transfers"
    },
    "https://api.slimpay.net/alps#get-credit-transfers" : {
      "href" : "https://api-sandbox.slimpay.net/credit-transfers{?id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-credit-transfers" : {
      "href" : "https://api-sandbox.slimpay.net/credit-transfers{?creditorReference,entityReference,subscriberReference,mandateReference,paymentReference,currency,executionDateBefore,executionDateAfter,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#create-card-transactions" : {
      "href" : "https://api-sandbox.slimpay.net/card-transactions"
    },
    "https://api.slimpay.net/alps#get-card-transactions" : {
      "href" : "https://api-sandbox.slimpay.net/card-transactions{?id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#get-card-aliases" : {
      "href" : "https://api-sandbox.slimpay.net/card-aliases{?id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-card-aliases" : {
      "href" : "https://api-sandbox.slimpay.net/card-aliases{?creditorReference,entityReference,subscriberReference,reference,status,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-card-by-id" : {
      "href" : "https://api-sandbox.slimpay.net/cards/cards/{id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#get-recurrent-card-transactions" : {
      "href" : "https://api-sandbox.slimpay.net/recurrent-card-transactions{?id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#get-card-transaction-issues" : {
      "href" : "https://api-sandbox.slimpay.net/card-transaction-issues{?id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-bank-account-by-id" : {
      "href" : "https://api-sandbox.slimpay.net/bank-accounts{?id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-balances" : {
      "href" : "https://api-sandbox.slimpay.net/balances{?creditorReference,entityReference,currency,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-order-item-by-id" : {
      "href" : "https://api-sandbox.slimpay.net/order-items/{id}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-subscribers" : {
      "href" : "https://api-sandbox.slimpay.net/subscribers{?creditorReference,entityReference,reference,page,size}",
      "templated" : true
    },
    "https://api.slimpay.net/alps#search-report" : {
      "href" : "https://api-sandbox.slimpay.net/reports{?creditorReference,entityReference,dateFrom,dateTo}",
      "templated" : true
    }
  }
}