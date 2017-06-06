Varukorg

1. För att lägga till en produkt i varukorgen så måste produkten finnas i inventoryn
och samt måste kunden finnas i customers.

2. För att lägga till varan använder du proceduren "addToCart(product_id, customer_id, amount_of_items)"

3. Efter du har lagt in producten i varukorgen så skrivs all information in i klartext i vyn "VCart"
(där räknar den även ut priset beroende på items som du har valt).

4. För att ta bort product från varukorgen använder du proceduren "removeFromCart(Cart_id)"



Order

1. för att övergå till en order från varukorgen använder du:
"
INSERT INTO `cartOrder` (`customer`, `product`, `items`)
SELECT `customer_id`, `prod_id`, `NumberOfItems` FROM `Cart`
;
"
Detta tar altså bara informationen från varukorgen och lägger in den i ordern.

2. Orderns "insert" är kopplat till en trigger som tarbort "items" från inventoryn
beroende på hur många som är bestälda.

3. Triggern skriver även ut en raport till tabellen "Messeges" beroende på hur ordern gick.
Om antalet som är bestälda är mer en som finnas på lager så går inte ordern igenom utan du får i din
Messeges "Order error" anledningen är att det inte ska finnas minus på en produkt på lagret.
Om invetoryns items blir mindre en 5 så får du ut medelandet "low" som påminner dig att
det kanske är bäst att beställa hem mer av den produkten.


4. för att ta väck en order så använder du "CALL removeOrder(order_id)"
Som tar väck ordern och lämnar tillbaka antalet produkter som var beställda i lagret. 
