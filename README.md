# cart-api


Create the following functionality in PHP OOP style:

Imagine a store where products have prices per unit but also volume prices. E.g., bananas may be £1.00 each or 5 for £3.00.

Create an API that takes products in arbitrary order (similar to a checkout line) and then returns the correct final price for the entire shopping basket based on the prices as applicable.

Please use following products:

| Code | Price |
|------|-------|
| ZA | £2.00 each or 4 for £7.00
| YB | £12.00
| FC | £1.25 or £6 for a six pack
| GD | £0.15

A top level point of sale terminal service is needed that looks something like this pseudo-code:

```
$terminal->setPricing(...)
$terminal->scanItem("ZA")
$terminal->scanItem("FC")
$result = $terminal->getTotal()
```

It is up to you to design and implement the rest of the code as you wish, including how you specify the product prices.

Following test cases must be shown to work in your program:

1. Scan items in this order: `ZA,YB,FC,GD,ZA,YB,ZA,ZA`; Verify the total price is __£32.40__.

2. Scan items in this order: `FC,FC,FC,FC,FC,FC,FC`; Verify the total price is __£7.25__.

3. Scan items in this order: `ZA,YB,FC,GD`; Verify the total price is __£15.40__.