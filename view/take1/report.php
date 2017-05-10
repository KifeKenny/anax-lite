<h1>Report</h1>
<hr>

<h3>Kmom01</h3>
<p>
Uppgift 1 (Gissa vilket nummer jag tänker på)
<br>Uppgiften gick bra att utföra efter jag hade läst in mig på GET, SESSION, POST
igen. Hade glömt bort en hel del. Fick även läsa igenom hur klasser och objekt
fungerar i PHP har ju jobbat med det i PYTHON innan och lärde mig att det
skiljer sig lite.
<br><br>
Efter det flöt det på ganska bra. Fastnade lite här och där men inget jätte
stort det mesta gick att lösa genom Google eller övningarna.
<br><br>
Uppgift 2(Bygg en me-sida med Anax Lite)
<br>Gick mest ut på att jobba igenom övningen. Efter man hade jobbat igenom
övningen med alla installationer och instruktioner så förstod man sig på hur
man skulle göra. Allting för att lösa resten av uppgiften stod ju i övningen
så jag hade egentligen inga problem. Valde att gå för en ganska simpel
styling på sidan.

<br><br>
Uppgift 3(En navbar till Anax Lite (steg 1))
<br>Inte så stor uppgift och ja den gick rätt så snabbt att göra. Jag la in värdena
till mina olika sidor i en Array med nycklar, så som det vissas i exemplet.
Gjorde sen en foreach loop som som checkade om nycklarna och matchade och tog ut
rätt värde på det sättet. Echoade ut värdena tillsammans med html kod.
<br><br>
Uppgift4 (Kom igång med SQL)
<br>Gick också ut på att jobba igenom en övning/artikel. Ja om man jobbade igenom
övningen så klarar man uppgiften bra i den står allt man behöver.

<br><br>
1.Hur känns det att hoppa rakt in i klasser med PHP, gick det bra?
<br>Jo det gick väl bra, alltid lite slött att komma igång med nya saker. Men när
man väl kommer igång med det så gick det bra.

<br><br>
2.Berätta om dina reflektioner kring ramverk, anax-lite och din me-sida.
<br>Jag vet inte direkt vad jag tycker om det än. Förstår mig ju inte direkt på hur
allt fungerar. Man importerade ju in en massa filer i början som. Får se vad
jag tycker om det efter jag har jobbat med det ett tag.
<br><br>
3.Gick det bra att komma igång med MySQL, har du liknande erfarenheter sedan tidigare?
<br>Ja det gick bra. Har ju jobbat med SQLite maneger och gjort diagram där i dem andra
kurserna. Så det va inte jätte svårt att komma igång med det.


</p>


<h3>Kmom02</h3>
<p>
<strong>
1.Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och
nackdelar med de olika sätten?<br>
</strong>
Vet inte helt om jag gjorde rätt. Men så som jag gjorde det ser jag att koden
blir mer strukturerad. Koden blir även mindre, så det är positivt. Nackdelar vet
jag inte direkt en, kanske kommer på några senare efter jag har jobbat med det
ett tag.
<br><br>
<strong>2.Hur väljer du att organisera dina vyer?</strong><br>
Organiserar dem så som det visades i kmom01. Inte direkt ändrat något där.
<br><br>
<strong>3.Berätta om hur du löste integreringen av klassen Session.</strong>
<br>La till Sessions klass i min $app varible i min index fil, likadant som dem
andra klasserna. Efter det bara startade jag Sessionen i samma fil. Gjorde
också en snabb if sats som kollar om ”value” variblen är satt i sessionen och
är den inte satt så sätter sessionen det värdet till 0. Efter det var det bara
att använda klassens funktioner.
<br><br>
<strong>4.Berätta om hur du löste uppgiften med Tärningsspelet 100/Månadskalendern, hur du
tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?</strong>
<br><br>
Jag gjorde en månads kalender. Jag planerade att jag skulle ha tre klasser. Först
dag klassen som innehöll två värden dagens datum alltså ett numer. Samt ett värde
som visar om dagen är aktiv med ett boolean värde med false som default(visade
sig senare att detta värde var ganska värdelöst). Gjorde såklart funktioner i
klassen som gav ut dagens datum osv.
<br><br>
Andra klassen var en månads klass som tanken var bara skulle innehålla två värden.
Första var en array som innehåller alla dagar pushade in i arrayen genom en loop.
Tillslut fick jag lägga till en massa små värden som inte var planerade eftersom
jag inte hade planerat hur jag skulle ta ut den aktiva dagen och röda dagar.
<br><br>
Sista klassen Calendar klassen. Ger månads klass sina värden så den vet månadens
namn, dagar, bild länk. Den får värdena från en array som innehåller namnet på
månaden, antalet dagar månaden har, och bilden för månaden. Den ger månaden alla
värdena och lägger sen in dem i en year array med alla 12 månads klasser.
<br><br>
Efter jag har dessa klasser var det bara att kalla på deras funktioner i min view fil.
<br><br>
<strong>5.Några tankar kring SQL så här långt?</strong>
<br>Inte direkt blir lite förvirrad av artikeln ibland, men det brukar lösa sig.


</p>



<h3>Kmom03</h3>
<p>

1.Hur kändes det att jobba med PHP PDO, SQL och MySQL?
<br>Det kändes bra, känns som att jag förstår det mycket bättre nu. Kanske inte helt
säker på PDO. Men kändes rätt okej när jag skrev koden.

<br><br>
2.Reflektera kring koden du skrev för att lösa uppgifterna, klasser, formulär,
integration Anax Lite?
<br>
Följde mest övningarna körde. Min databas klass var en liten blandning på databasen
jag hämtade på github och koden från andra övningen. Men använde mig mest av POST
och sessioner för att ta ut värdena som användaren skriver in. Så när dem matar
in sin data så tar jag in det med POST i sessioner, skickar det till en rout
som kollar så allt ser bra och sen antingen re routar den dig om allt gick bra
eller så får du ut ett felmeddelande. Det är även i routerna där jag lägger in koden
för att skicka och hämta data från min databas.
<br><br>
Använder även sessioner för att sparka ut dig om du försöker nå en sida som jag
inte vill att du ska kunna nå om du t.ex inte är inloggad som admin.
<br><br>
Försökte att lägg den mesta koden i routerna och att mest ha vyer som visar,
hämtar och skickar ut data till routerna. Lyckades med detta mest för den första
uppgiften. Men inte alls för den andra uppgiften, fick skriva alldeles förmycket
kod i vyen för admin.
<br><br>
3.Känner du dig hemma i ramverket, dess komponenter och struktur?
<br>Nej inte på själva ramverk systemet känner jag mig inte helt hemma på. Jag vet var
jag ska lägga min kod, känns som det blir många routes bara.
<br><br>
4.Hur bedömmer du svårighetsgraden på kursens inledande kursmoment, känner du
att du lär dig något/bra saker?
<br>
Svårighetsgraden var väll helt okej. Tyckte att koden i den första övningen var
lite svårare att förstå en den i den andra övningen. Annars känns det som att
koden i dessa kursmoment tar längre tid att skriva än i dem andra. Ja jag
tycker faktiskt att sakerna jag lärt mig i denna kurs är väldigt användbara.

<br><br>
p.s Du når admin sidan genom att gå in på admins profil och sen trycka på Accounts



</p>


<h3>Kmom04</h3>
<p>redovisnings text ... </p>

<p> mer text .. </p>


<h3>Kmom05</h3>
<p>redovisnings text ... </p>

<p> mer text .. </p>


<h3>Kmom06</h3>
<p>redovisnings text ... </p>

<p> mer text .. </p>


<h3>Kmom07/10</h3>
<p>redovisnings text ... </p>

<p> mer text .. </p>
