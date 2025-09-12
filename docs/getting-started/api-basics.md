# API Basics

This document explains the basics of working with **Nova Poshta API** and important things you need to know before
making requests.

---

## What is Nova Poshta API?

API (Application Programming Interface) is a set of tools for automating interaction with **Nova Poshta**.  
It allows you to integrate logistics processes into your business quickly and serves as a single entry point for all
clients and services.

---

## API Key

To start using the API, you need to generate an **API key** and include it in your requests.

- Generate it in the Business Cabinet → **Settings** → **Security** → **Create API Key**
- Link: [Get API Key](https://new.novaposhta.ua/dashboard/settings/developers)

> ⚠️ Keep your API key secret. Do not share it publicly.

---

## Entry Points

- **JSON** (we only use this) → `https://api.novaposhta.ua/v2.0/json/`
- XML → `https://api.novaposhta.ua/v2.0/xml/` (not supported in this client)

> All requests in this library use JSON format. XML is ignored.

---

## Request Format

- Data is sent via **HTTPS** using **POST** (or GET if specifically required. Not supported in this client, POST only).
- The endpoint must be in **lowercase**, e.g.:

## Responses

- The API always returns HTTP 200, even if there is a logical error.
- Check `errors` and `info` if something went wrong

Example of successful response

```json
{
  "success": true,
  "data": [
    {
      "Description": "Абазівка (Полтавський р-н, Полтавська обл)",
      "DescriptionRu": "Абазовка (Полтавский р-н, Полтавская обл)",
      "Ref": "fc5f1e3c-928e-11e9-898c-005056b24375",
      "Delivery1": "1",
      "Delivery2": "0",
      "Delivery3": "1",
      "Delivery4": "0",
      "Delivery5": "1",
      "Delivery6": "0",
      "Delivery7": "0",
      "Area": "71508137-9b87-11de-822f-000c2965ae0e",
      "SettlementType": "563ced13-f210-11e3-8c4a-0050568002cf",
      "IsBranch": "0",
      "PreventEntryNewStreetsUser": "0",
      "CityID": "2667",
      "SettlementTypeDescriptionRu": "село",
      "SettlementTypeDescription": "село",
      "SpecialCashCheck": 1,
      "AreaDescription": "Полтавська",
      "AreaDescriptionRu": "Полтавская"
    }
  ],
  "errors": [],
  "warnings": [],
  "info": {
    "totalCount": 10698
  },
  "messageCodes": [],
  "errorCodes": [],
  "warningCodes": [],
  "infoCodes": []
}
```

Example of unsuccessful response

```json
{
  "success": false,
  "data": [],
  "errors": [
    "FindByString is not specified"
  ],
  "warnings": [],
  "info": [],
  "messageCodes": [],
  "errorCodes": [
    "20000500612"
  ],
  "warningCodes": [],
  "infoCodes": []
}
```

## Tips & Best Practices

* Validate fields before sending requests to reduce errors.
* Cache frequently used data (like cities or warehouses) to avoid unnecessary API calls.
* Check API responses for `errors` and `info` even if HTTP status is 200. Logical errors are reported there.
* Throttle requests — the API does not like too many requests in a short time.  
  Add a delay between requests:
    - Minimum: 0.5 seconds
    - Recommended: 1 second
    - Safer: 2 seconds