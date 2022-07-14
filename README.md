# NcpConfig

Short description of the project "Configurator" and with some technical details and users manual on
https://webweit.atlassian.net/wiki/spaces/~624da93ba629c30068a8dbc5/pages/3698851876/The+Configurator

Warning: The code and styling are in a durty state.

The main purpose of the project is to get familiar with the Shopware 6 plugin development.

What I implemented are these points

database
* creating of enties and using them

backend
* insert, update, edit and delete new items to the tables of the configuration
* assign/withdraw a single projectGroup to a selected product (each projectgroup has it own dimensions and min/max values)

frontend
* use a modal dialog to configure the dimensions of the selected product
* calculcate on each data change the new price of the product (for simplified reasons: it's a multiplication of the volume and the base-price)
* put the product into the cart and show the configuration data and the new price
