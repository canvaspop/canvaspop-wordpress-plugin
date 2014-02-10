# CanvasPop Photo Printing API

* Contributors: karlcanvaspop
* Donate link: http://developers.canvaspop.com/
* Tags: api, canvas, print, image, photo
* Requires at least: 3.5.1
* Tested up to: 3.6
* Stable tag: 1.0.0
* License: GPLv2
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

CanvasPop Photo Printing API is a simple and powerful way to offer customers the ability to purchase world class
handcrafted canvas prints.

## Description

Pop-up Store is a simple and powerful way to offer customers the ability to purchase world class handcrafted canvas
prints that are shipped right to their door. Inside you'll find implementation guides and reference documentation for
all of the components that make up Pop-up Store.

This plugin allows you to automatically add a "Print" button to your images. Users can then click the "Print" button
to open a cart in a modal and purchase a piece of art.

When a user opens a cart, the image provided in the link is submitted to protected environment where it is resized and
prepared for print. Once a user places an order, you can access information about that order in your API admin panel.

To learn more about out API, please visit https://developers.canvaspop.com/

## Installation

This section describes how to install the plugin and get it working.

1. Upload `canvaspop-wordpress-plugin` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Sign up for a CanvasPop API account at https://developers.canvaspop.com/sign-up
4. Add your information in the plugin Settings section.

## Frequently Asked Questions

### A question that someone might have

> An answer to that question.

### What products do you offer?

> We currently offer canvas prints, and plan to roll out new products in the near future. Stay tuned!

### What sizes can I print?

> We offer canvas prints ranging in size from 8"x10" all the way to 38"x76".

### Who does your printing?

> We own and operate all of the printing to ensure the highest level of quality.

### Do you guarantee your products?

> All of our products come with a 100% satisfaction guarantee.

### Who handles customer service?

> CanvasPop will handle all first-line customer service for you. We like to think of ourselves as "customer obsessed". We'll do everything in our power to ensure your customers are not just satisfied, but absolutely in love with their new canvas prints.

### As a partner, can I set my own prices for Pop-up Store?

> Yes. Every API partner may set their own markup rate by sending an email to api.support@canvaspop.com. This markup percentage is used in the calculation of the price of canvas, frame, and edge options.

### Do you support mobile?

> Absolutely. Our API works across web, touch and mobile.

### Do you support viewing Pop-up Store in other languages and currencies?

> Yes. Once the store is opened, we geolocate each user using their IP address. From there we select the appropriate currency and language that is appropriate for that region.

> We currently support the following languages: Danish, Dutch, English, Finnish, French, German, Italian, Polish, Portuguese, Spanish, Swedish. We currently support the following currencies: US Dollar (USD), Canadian Dollar (CAD), Euro (EUR), and Pound (GBP). Still want to change them? Don't worry, a user is able to manually switch their language and/or currency using the links at the bottom of the page. To see how this looks within Pop-up Store see our examples page.

### Where are you able to ship to?

> We currently ship to the United States, the European Union and Canada.

### How long will it take my customers to receive their canvas?

> Your customer will receive their order in 7 to 10 days.

### What are the shipping costs?

> Shipping to the US and Canada is a flat rate of just $14 per order. International orders are $39.95.

### Do I need my own payment gateway?

> No need to have your own gateway. We take care of that for you!

### How do I track my sales?

> You will have your very own admin dashboard to track all of your sales and products.

### What types of payments do you accept?

> We accept VISA, AMEX, MC, and PayPal.

### What currencies do you accept?

> Payments will be settled in USD; however, prices will be displayed in either USD, CAD, EURO, and GBP depending on where the customer is located. If local currency is not supported, display price will default to USD.

### Is there a minimum that I have to make before I get paid?

> No.

### How do I receive payment?

> You get paid on the 15th of every month. We send payment to our partners via cheque.

### If a customer buys prints multiple times, will they have to re-enter their billing and shipping information each time?

> Yes.

### How do I make money?

> We give you a wholesale price for each item purchased. We then add on a markup of your choice. The markup is your commission on the sale of this item.

### How much can I make?

> If you want to see exactly how much you make on each item purchased, you can visit the Products page in your CanvasPop API Administration Panel.

### What is the default markup?

> We default our partners to a 30% markup. You are free to choose your markup rate, just send us an email at API Sales and we can change that for you.

### How can I detect when a customer has completed a purchase or closed the store?

> As a customer interacts with Pop-up Store, these events (and many others) are emitted via HTML 5 pushMessage() calls. You may detect and handle these events however you wish in your application. See the Events documentation page for a list of events and their descriptions. We've also included some code samples on our Examples documentation page to help you get started.

### What image file formats are accepted for use in Pop-up Store?

> We currently accept the following image file types: jpeg, jpg, tif, tiff, png, ico, wmf, emf, bmp, and gif.

### What is the max file size that I may send to the API?

> 100MB.

### Are there any notifications sent to customers regarding their order?

> Yes. Currently a receipt and shipping notification are sent to Pop-up Store customers. You can see examples of what these emails look like on the Examples documentation page.

### Is there a way I can place a test order end-to-end when integrating Pop-up Store?

> Yes. By default your store is in TESTING mode. You may create test orders and use testing credit card numbers in order to complete orders. To activate your Pop-up Store in production click on the 'Request Activation' button in your settings.

### Why does a two step preview and print image handshake exist?

> We've developed the API to support first sending us a smaller, lower resolution preview image that allows the initial handshake to be completed quickly. This allows customers to begin interacting with checkout sooner. Once this is completed and the store is opened you may begin uploading a printable, high resolution image in the background. This prevents the customer from experiencing any initial delay and gives them the option to choose sizes, fill out shipping information etc. immediately.

### When using the Pull API, does the image have to reside on my own server or domain?

> No. You may load an image located at any publicly accessible URL into Pop-up Store, however you must own the rights to the image.

### How are the sizes that appear in the cart drop-down menu determined?

> As soon as we know the width, height and resolution of the printable image that is being purchased (either through our /loader or Pull API endpoints) we are able to compute a set of sizes that allow for the best fit with a minimal amount of cropping. This is unique per image, and allows customers to only see sizes that make sense for the image they are purchasing.

### Do I need the rights to sell the images that are uploaded?

> Yes. We can only print the item if you have the necessary rights to sell the image. All copyright images will be refused and refund will be sent to purchaser.

## Screenshots

* `/screenshot-1.png`

## Changelog

###  1.0
* First version

## Upgrade Notice

### 1.0
* First version