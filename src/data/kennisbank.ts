/**
 * Kennisbank artikelen & GEO Direct Answers voor Spekadvies Moerkapelle
 * Geoptimaliseerd voor featured snippets en AI zoekmachines (ChatGPT, Perplexity, Gemini).
 */

export interface KennisbankArticle {
  slug: string;
  title: string;
  seoTitle: string;
  seoDescription: string;
  category: 'Hypotheken' | 'Verzekeringen' | 'Financiële Planning';
  readTime: string;
  publishedDate: string;
  directAnswer: string; // 40-60 woorden directe definitie voor GEO AI
  content: string;
  faqs: Array<{ question: string; answer: string }>;
  relatedServices: Array<{ name: string; url: string }>;
}

export const KENNISBANK_ARTIKELEN: KennisbankArticle[] = [
  {
    slug: 'hoe-werkt-overbruggingshypotheek',
    title: 'Hoe werkt een overbruggingshypotheek? Berekening, looptijd en regels',
    seoTitle: 'Hoe Werkt een Overbruggingshypotheek? | Uitleg & Voorwaarden | Spekadvies',
    seoDescription: 'Wat is een overbruggingshypotheek en hoe werkt het? Ontdek de looptijd, maximale overwaarde en dubbele maandlasten uitgelegd door Spekadvies Moerkapelle.',
    category: 'Hypotheken',
    readTime: '5 min leestijd',
    publishedDate: '2026-02-15',
    directAnswer: 'Een overbruggingshypotheek is een tijdelijke lening waarmee je de verwachte overwaarde van je huidige koopwoning direct inzet voor de aankoop van een nieuw huis, nog vóór de oude woning bij de notaris is gepasseerd. De lening kent een looptijd van 12 tot 24 maanden en wordt bij de definitieve verkoop in één keer afgelost.',
    content: `
### Wat is een overbruggingshypotheek?
Wanneer je doorstroomt naar een nieuwe koopwoning, zit je vermogen vaak vast in de stenen van je huidige huis. Een overbruggingshypotheek overbrugt deze periode. Je leent als het ware alvast het bedrag aan overwaarde dat vrijkomt zodra je oude huis wordt verkocht.

### Hoeveel overwaarde kun je overbruggen?
De hoogte van het overbruggingskrediet hangt af van de verkoopstatus van je huidige woning:
1. **Woning is al onvoorwaardelijk verkocht:** De bank financiert doorgaans tot 100% van de netto verkoopopbrengst (verkoopsom minus openstaande hypotheek en verkoopkosten).
2. **Woning staat nog te koop (onverkocht):** De bank bouwt een veiligheidsmarge in en financiert meestal maximaal 90% van de getaxeerde marktwaarde minus de huidige hypotheek.

### Hoe zit het met de dubbele maandlasten?
Tijdens de overbruggingsperiode heb je tijdelijk te maken met dubbele rentelasten: de rente van je huidige hypotheek, de rente van je nieuwe hypotheek én de rente over het overbruggingskrediet. Banken toetsen daarom streng of je voldoende spaargeld hebt om deze dubbele lasten minimaal 12 tot 24 maanden te dragen.

### Is de overbruggingsrente fiscaal aftrekbaar?
Ja. De rente die je betaalt over een overbruggingshypotheek is maximaal 3 jaar fiscaal aftrekbaar in box 1, mits de leegstaande woning daadwerkelijk bestemd is voor de verkoop.
    `,
    faqs: [
      {
        question: 'Wat gebeurt er als mijn oude woning niet binnen de overbruggingstermijn wordt verkocht?',
        answer: 'De meeste banken hanteren een termijn van 24 maanden. Dreigt deze termijn te verstrijken, dan kan in overleg met de bank vaak verlenging worden aangevraagd, mits de woning aantoonbaar te koop staat en er voldoende buffer is.'
      },
      {
        question: 'Moet ik maandelijks aflossen op een overbruggingshypotheek?',
        answer: 'Nee, tijdens de looptijd van een overbruggingshypotheek betaal je uitsluitend rente. De gehele hoofdsom wordt in één keer afgelost met de verkoopopbrengst bij de notaris.'
      }
    ],
    relatedServices: [
      { name: 'Doorstromers & Overbrugging', url: '/diensten/doorstromers-overbrugging' },
      { name: 'Hypotheek Oversluiten', url: '/diensten/hypotheek-oversluiten' }
    ]
  },
  {
    slug: 'boeterente-oversluiten-berekenen',
    title: 'Boeterente bij hypotheek oversluiten: Hoe wordt het berekend?',
    seoTitle: 'Boeterente Hypotheek Oversluiten Berekenen | Uitleg & Aftrek | Spekadvies',
    seoDescription: 'Hoeveel boeterente betaal je bij het oversluiten van je hypotheek? Leer hoe de bank het renteverlies berekent, wanneer je boetevrij aflost en hoe je dit terugverdient.',
    category: 'Hypotheken',
    readTime: '6 min leestijd',
    publishedDate: '2026-02-18',
    directAnswer: 'Boeterente (vergoedingsrente) is een vergoeding die je aan de bank betaalt wanneer je jouw hypotheek vóór het einde van de rentevastperiode aflost of oversluit naar een lagere rente. De bank berekent het renteverlies over het resterende leenbedrag minus de jaarlijkse boetevrije aflosruimte. De boeterente is eenmalig fiscaal aftrekbaar.',
    content: `
### Waarom rekent de bank een boete?
Wanneer je met de bank hebt afgesproken om bijvoorbeeld 10 jaar lang 4% rente te betalen, heeft de bank hier financieel op gerekend. Sluit je de hypotheek na 5 jaar over naar een andere aanbieder met 3% rente? Dan loopt de bank 5 jaar lang 1% rente-inkomsten mis. Deze gemiste rente brengt zij als boeterente in rekening.

### De 4 stappen van de AFM-boeteberekening
Sinds de richtlijn van de Autoriteit Financiële Markten (AFM) mag een bank niet meer boete rekenen dan haar daadwerkelijke financiële nadeel:
1. **Vaststellen resterende schuld:** Het openstaande leenbedrag.
2. **Aftrek boetevrije som:** Meestal mag je 10% tot 20% van de oorspronkelijke hoofdsom per jaar boetevrij aflossen. Dit deel telt niet mee in de boete.
3. **Bepalen van het renteverschil:** Het verschil tussen jouw contractrente en de actuele vergelijkingsrente van de bank voor de resterende renteperiode.
4. **Contant maken naar de huidige waarde:** De bank rekent uit wat dat renteverlies vandaag waard is.

### Boeterente is eenmalig fiscaal aftrekbaar
Het grote voordeel van de boeterente is dat je dit bedrag in het jaar van betaling volledig mag aftrekken in box 1 van je inkomstenbelasting. Hierdoor betaalt de fiscus tegen het voor jou geldende belastingtarief een aanzienlijk deel van de boete terug.
    `,
    faqs: [
      {
        question: 'Wanneer mag je boetevrij je hypotheek oversluiten?',
        answer: 'Je mag altijd 100% boetevrij oversluiten wanneer je rentevastperiode afloopt. Daarnaast mag je bij verkoop van je woning of bij overlijden van een partner vrijwel altijd boetevrij aflossen.'
      },
      {
        question: 'Kan ik de boeterente meefinancieren in mijn nieuwe hypotheek?',
        answer: 'Ja, mits de nieuwe hypotheek inclusief boete niet hoger wordt dan 100% van de marktwaarde van je woning en je inkomen de totale lening kan dragen.'
      }
    ],
    relatedServices: [
      { name: 'Hypotheek Oversluiten', url: '/diensten/hypotheek-oversluiten' },
      { name: 'Startershypotheek', url: '/diensten/startershypotheek' }
    ]
  },
  {
    slug: 'starterslening-gemeente-aanvragen',
    title: 'Starterslening aanvragen via het SVn: Voorwaarden per gemeente',
    seoTitle: 'Starterslening SVn Aanvragen | Gemeente Zuidplas & Regio | Spekadvies',
    seoDescription: 'Hoe vraag je een SVn Starterslening aan? Ontdek de voorwaarden, maximale leenbedragen en rentevrije voordelen voor starters in Moerkapelle en Zuid-Holland.',
    category: 'Hypotheken',
    readTime: '4 min leestijd',
    publishedDate: '2026-02-22',
    directAnswer: 'Een Starterslening via het Stimuleringsfonds Volkshuisvesting (SVn) overbrugt het verschil tussen de koopsom van je eerste woning (inclusief bijkomende kosten) en de maximale eerste hypotheek die je op basis van je inkomen kunt krijgen. De eerste drie jaar betaal je noch rente, noch aflossing.',
    content: `
### Wat is de SVn Starterslening?
Veel starters lopen ertegenaan dat hun maximale leencapaciteit net niet voldoende is om een koopwoning te bemachtigen. Om de kloof te overbruggen stellen veel Nederlandse gemeenten (waaronder Zuidplas, Waddinxveen en omliggende gemeenten) een Starterslening beschikbaar.

### Hoe werkt de rentevrije periode van 3 jaar?
Het unieke aan de SVn Starterslening is dat de lening uit twee delen bestaat: een leningdeel dat je aflost en een 'combinatielening'. Gedurende de eerste 36 maanden betaal je helemaal niets: geen rente en geen aflossing. Na 3 jaar toetst het SVn of je inkomen inmiddels is gestegen. Is dat zo, dan ga je betalen. Is dat niet zo, dan kan een hertoetsing plaatsvinden.

### Belangrijke voorwaarden
- Je koopt je allereerste woning (je hebt nooit eerder een koopwoning op naam gehad).
- De aankoop moet verplicht gebeuren onder Nationale Hypotheek Garantie (NHG).
- De koopsom mag de vastgestelde gemeentelijke grens niet overschrijden.
- Het budget van de gemeente is niet oneindig: op is op (wie het eerst komt, het eerst maalt).
    `,
    faqs: [
      {
        question: 'Hoeveel kan ik maximaal lenen via een starterslening?',
        answer: 'Dit verschilt per gemeentelijke verordening, maar bedraagt doorgaans maximaal 20% van de koopsom, vaak begrensd op bedragen tussen € 30.000 en € 60.000.'
      },
      {
        question: 'Wie vraagt de starterslening aan?',
        answer: 'Als erkend financieel adviseur verzorgt Spekadvies het complete aanvraagproces bij zowel jouw gemeente als het SVn, gelijktijdig met je bancaire hypotheekaanvraag.'
      }
    ],
    relatedServices: [
      { name: 'Startershypotheek', url: '/diensten/startershypotheek' },
      { name: 'Nieuwbouw Hypotheek', url: '/diensten/nieuwbouw-hypotheek' }
    ]
  },
  {
    slug: 'opeethypotheek-senioren-voorwaarden',
    title: 'Opeethypotheek vs. Verzilverhypotheek: Voorwaarden voor Senioren',
    seoTitle: 'Opeethypotheek & Verzilverhypotheek Senioren | Spekadvies Moerkapelle',
    seoDescription: 'Overwaarde opnemen na je pensioen? Alles over de opeethypotheek, rente bijschrijven en de geen-restschuldgarantie voor senioren in Moerkapelle.',
    category: 'Hypotheken',
    readTime: '5 min leestijd',
    publishedDate: '2026-03-01',
    directAnswer: 'Een opeethypotheek is een hypotheekvorm voor senioren waarbij de rente maandelijks wordt opgeteld bij de hypotheekschuld. Hierdoor blijven de maandelijkse woonlasten € 0 en wordt het vermogen uit de stenen geleidelijk omgezet in besteedbaar inkomen of verbouwingsbudget, zonder dat het pensioeninkomen in gevaar komt.',
    content: `
### Vermogen benutten als senior
Heb je een woning met veel overwaarde en een klein pensioen? Traditionele banken wijzen seniorenaanvragen vaak af op basis van strenge Nibud-inkomensnormen. De opeethypotheek biedt hiervoor een uitkomst.

### Het rente-bijschrijfmechanisme
Bij een reguliere hypotheek betaal je maandelijks rente van je betaalrekening. Bij een opeethypotheek houdt de bank de verschuldigde rente in op het beschikbare overwaardekrediet. Je totale hypotheekschuld loopt hierdoor langzaam op, terwijl je netto maandlasten niet veranderen.

### Geen-restschuldgarantie
Een belangrijk aspect van een gecertificeerde verzilverhypotheek is de zogeheten geen-restschuldgarantie. Mocht de woning bij overlijden onverhoopt minder opbrengen dan de opgebouwde schuld, dan scheldt de geldverstrekker het verschil kwijt. Jouw erfgenamen blijven hierdoor gevrijwaard van een schuld.
    `,
    faqs: [
      {
        question: 'Vanaf welke leeftijd kun je een opeethypotheek afsluiten?',
        answer: 'De meeste gespecialiseerde aanbieders hanteren een minimale leeftijd van 60 jaar of de AOW-gerechtigde leeftijd (circa 67 jaar).'
      },
      {
        question: 'Blijf ik eigenaar van mijn huis bij een opeethypotheek?',
        answer: 'Ja, je blijft 100% juridisch eigenaar van de woning. Je verkoopt het huis niet aan de bank; je sluit enkel een hypothecaire geldlening af met het huis als onderpand.'
      }
    ],
    relatedServices: [
      { name: 'Overwaarde Verzilveren & Senioren', url: '/diensten/overwaarde-verzilveren' },
      { name: 'Hypotheek Verduurzamen', url: '/diensten/hypotheek-verduurzamen' }
    ]
  },
  {
    slug: 'hypotheek-als-zzper-jaarcijfers',
    title: 'Hypotheek berekenen als ZZP\'er: Hoe toetsen banken jouw winst?',
    seoTitle: 'Hypotheek ZZP Berekenen met Jaarcijfers | Spekadvies Moerkapelle',
    seoDescription: 'Hoeveel kun je lenen als ZZP\'er? Lees hoe banken je toetsinkomen berekenen uit 3 jaar winst, prognoses en de Inkomensverklaring Ondernemer.',
    category: 'Hypotheken',
    readTime: '6 min leestijd',
    publishedDate: '2026-03-05',
    directAnswer: 'Hypotheekverstrekkers berekenen het toetsinkomen van een ZZP\'er doorgaans op basis van het gewogen gemiddelde van de nettowinst uit onderneming over de laatste drie kalenderjaren. Is het laatste jaar lager dan het gemiddelde? Dan telt het laatste jaar. Met een Inkomensverklaring Ondernemer kun je vaak al na 1 jaar terecht.',
    content: `
### Hoe berekent een bank het ondernemersinkomen?
In tegenstelling tot loondienst toetst een bank een zelfstandige op continuïteit en bestendigheid van de winst. De standaard rekenmethode luidt:
- Jaar 1 (oudste jaar): telt voor 1x mee
- Jaar 2: telt voor 2x mee
- Jaar 3 (meest recente jaar): telt voor 3x mee
- Gedeeld door 6 = gewogen gemiddeld toetsinkomen.

*Let op:* Als het inkomen in het laatste jaar lager is dan dit gewogen gemiddelde, hanteert de bank altijd het lagere bedrag als voorzichtigheidsbeginsel.

### Hypotheek na 1 of 2 jaar zelfstandigheid
Ben je korter dan 3 jaar zelfstandig? Geen probleem. Steeds meer geldverstrekkers accepteren ondernemers vanaf 12 maanden inschrijving bij de KvK. Er wordt dan gekeken naar je behaalde jaarcijfers in combinatie met een door een expert gevalideerde prognose voor de toekomst.

### Inkomensverklaring Ondernemer (IVO)
Voor een snelle hypotheekaanvraag laten wij een Inkomensverklaring Ondernemer opstellen door een erkend rekenbureau. Deze verklaring is bindend voor aangesloten banken en voorkomt eindeloze discussies over afschrijvingen en voorzieningen.
    `,
    faqs: [
      {
        question: 'Telt het inkomen uit loondienst vóór het ZZP-schap ook mee?',
        answer: 'Ja, als je korter dan 3 jaar onderneemt maar daarvóór in dezelfde branche in loondienst werkte, wegen veel geldverstrekkers die eerdere inkomenshistorie positief mee.'
      },
      {
        question: 'Kan ik als ZZP\'er een hypotheek met NHG krijgen?',
        answer: 'Zeker. Sinds enkele jaren kunnen ZZP\'ers al vanaf 1 jaar zelfstandigheid een NHG-hypotheek krijgen, mits er een goedgekeurde Inkomensverklaring Ondernemer voorhanden is.'
      }
    ],
    relatedServices: [
      { name: 'ZZP & Ondernemers Hypotheek', url: '/diensten/zzp-ondernemers-hypotheek' },
      { name: 'AOV voor Ondernemers', url: '/diensten/aov-zzp-verzekering' }
    ]
  },
  {
    slug: 'energiebespaarbudget-hypotheek',
    title: 'Energiebespaarbudget (EBB): Extra lenen voor verduurzaming',
    seoTitle: 'Energiebespaarbudget (EBB) Hypotheek | Regels & LTV 106% | Spekadvies',
    seoDescription: 'Wat is het Energiebespaarbudget (EBB) in je hypotheek? Ontdek hoe je tot 106% van de woningwaarde leent voor zonnepanelen, isolatie en warmtepompen.',
    category: 'Hypotheken',
    readTime: '4 min leestijd',
    publishedDate: '2026-03-10',
    directAnswer: 'Het Energiebespaarbudget (EBB) is een financieel potje binnen je hypotheek waarmee je tot maximaal 106% van de marktwaarde van je woning (en met extra leenruimte buiten je standaard inkomenstoets) mag lenen voor energiebesparende voorzieningen. Je hoeft vooraf nog niet exact gespecificeerd te hebben welke maatregelen je treft.',
    content: `
### Extra leenruimte voor een groen huis
De overheid wil dat Nederlandse koopwoningen snel verduurzamen. Daarom gelden er soepelere leennormen voor investeringen in energiebesparing:
1. **Lenen tot 106% van de woningwaarde:** Terwijl je voor de woning zelf maximaal 100% mag lenen, mag je voor verduurzaming tot 106% lenen.
2. **Extra leenruimte buiten inkomen:** Voor erkende energiebesparende maatregelen mag je afhankelijk van het energielabel een ruim bedrag extra lenen zonder dat dit op je standaard inkomenstoets drukt.

### Het gemak van een EBB ten opzichte van een EBV
Bij een reguliere Energiebesparende Voorziening (EBV) moet je al vóór het passeren van de hypotheek gedetailleerde offertes van installateurs overleggen. Bij een Energiebespaarbudget (EBB) reserveer je het bedrag op basis van een schatting en heb je tot wel 24 maanden de tijd om te beslissen welke maatregelen je daadwerkelijk uitvoert.
    `,
    faqs: [
      {
        question: 'Welke maatregelen mag ik betalen vanuit het Energiebespaarbudget?',
        answer: 'Dakisolatie, gevel- en spouwmuurisolatie, vloerisolatie, HR++ of triple glas, warmtepompen, zonneboilers en zonnepanelen komen in aanmerking.'
      },
      {
        question: 'Wat gebeurt er als ik niet het hele budget opmaak?',
        answer: 'Het niet-opgenomen bedrag in het depot wordt na afloop van de termijn (doorgaans 2 jaar) boetevrij in mindering gebracht op je openstaande hypotheekschuld.'
      }
    ],
    relatedServices: [
      { name: 'Hypotheek Verduurzamen', url: '/diensten/hypotheek-verduurzamen' },
      { name: 'Nieuwbouw Hypotheek', url: '/diensten/nieuwbouw-hypotheek' }
    ]
  },
  {
    slug: 'huis-behouden-na-scheiding',
    title: 'Huis behouden na scheiding: De bancaire beheertoets uitgelegd',
    seoTitle: 'Huis Behouden na Scheiding | Beheertoets & Partner Uitkopen | Spekadvies',
    seoDescription: 'Kun je in je huis blijven wonen na een scheiding? Lees hoe de soepelere bancaire beheertoets werkt en hoe je jouw ex-partner officieel uitkoopt.',
    category: 'Financiële Planning',
    readTime: '6 min leestijd',
    publishedDate: '2026-03-15',
    directAnswer: 'Bij een echtscheiding mag een hypotheekverstrekker gebruikmaken van de bancaire beheertoets. In plaats van de strenge standaard leennormen kijkt de bank naar de werkelijke netto maandlasten en betaalbaarheid. Hierdoor kan een achterblijvende partner de hypotheek vaak overnemen, zelfs als een online rekenmodel aangeeft dat het inkomen onvoldoende is.',
    content: `
### De strijd om de woning bij echtscheiding
Tijdens een scheiding is de grootste wens van veel partners – zeker wanneer er kinderen in het spel zijn – dat één van beiden in de woning kan blijven wonen. De grootste horde is echter de hypotheekbank: kan diegene de lening wel in zijn eentje betalen?

### Het geheim van de beheertoets
Wanneer je een nieuw huis koopt, toetst de bank volgens strikte wettelijke financieringslastpercentages (Nibud). Bij een scheiding gaat het echter om het voorkomen van een gedwongen verkoop. Daarom staat de toezichthouder toe dat banken toetsen op de werkelijke maandlasten. Blijft er onder aan de streep voldoende leefgeld over voor de vaste kosten en levensonderhoud? Dan geeft de bank groen licht.

### Ontslag uit hoofdelijke aansprakelijkheid
Zodra de bank akkoord is dat één partner de hypotheek overneemt, geeft zij een ontslag uit de hoofdelijke aansprakelijkheid af. Vervolgens stelt de notaris de akte van verdeling op. De vertrekkende partner is vanaf dat moment 100% schuldvrij en kan op zoek naar een nieuwe koop- of huurwoning.
    `,
    faqs: [
      {
        question: 'Moet de vertrekkende partner overdrachtsbelasting betalen over de overname?',
        answer: 'Nee. Als gehuwden of geregistreerd partners uit elkaar gaan en de woning wordt toebedeeld aan één van beiden, geldt er een algehele vrijstelling van overdrachtsbelasting.'
      },
      {
        question: 'Hoe financier ik de uitkoopsom van mijn ex-partner?',
        answer: 'De uitkoopsom kan worden gefinancierd door de hypotheek te verhogen (op basis van overwaarde en inkomen), met eigen spaargeld of via een onderhandse familielening.'
      }
    ],
    relatedServices: [
      { name: 'Hypotheek bij Scheiding', url: '/diensten/hypotheek-bij-scheiding' },
      { name: 'Overwaarde Verzilveren', url: '/diensten/overwaarde-verzilveren' }
    ]
  },
  {
    slug: 'aov-zzp-wachttijd-en-premie',
    title: 'AOV voor ZZP: Hoe kies je de juiste wachttijd en bespaar je premie?',
    seoTitle: 'AOV ZZP Wachttijd & Premie Besparen | Gids | Spekadvies Moerkapelle',
    seoDescription: 'Hoeveel premie scheelt een langere wachttijd bij een AOV? Ontdek hoe je als zelfstandige slim honderden euro\'s bespaart op je arbeidsongeschiktheidspolis.',
    category: 'Verzekeringen',
    readTime: '5 min leestijd',
    publishedDate: '2026-03-20',
    directAnswer: 'De wachttijd (eigenrisicotermijn) van een AOV is de periode tussen de eerste ziektedag en het moment dat de verzekeraar start met uitkeren. Door de wachttijd te verruimen van 30 dagen naar 3 of 6 maanden daalt de maandpremie vaak met 25% tot 45%, omdat de verzekeraar geen risico loopt op kortdurend verzuim.',
    content: `
### Waarom de wachttijd de grootste premieknop is
Veel zelfstandigen denken dat een AOV onbetaalbaar is omdat ze offertes hebben gezien met een wachttijd van slechts 1 maand. Verzekeraars moeten bij een korte wachttijd veel vaker administratieve schadedossiers aanmaken voor tijdelijke griepjes of blessures, wat de premie enorm opdrijft.

### Stem je wachttijd af op je spaarbuffer
Als vuistregel adviseren wij:
- **Spaarreserve van 3 maanden aan vaste lasten?** Kies minimaal voor 3 maanden wachttijd.
- **Spaarreserve van een half jaar of partner met stabiel inkomen?** Kies voor 6 maanden wachttijd. Je premie daalt drastisch terwijl je beschermd blijft tegen de échte ramp: langdurige of blijvende arbeidsongeschiktheid.
    `,
    faqs: [
      {
        question: 'Kan ik de wachttijd later nog aanpassen?',
        answer: 'Het verlengen van de wachttijd kan te allen tijde zonder medische keuring. Het verkorten van de wachttijd vereist doorgaans wel een nieuwe medische toetsing.'
      },
      {
        question: 'Keert een AOV met terugwerkende kracht uit over de wachttijd?',
        answer: 'Nee, over de overeengekomen eigenrisicotermijn vindt geen nabetaling plaats. De uitkering start vanaf dag één na het verstrijken van de wachttijd.'
      }
    ],
    relatedServices: [
      { name: 'AOV voor Ondernemers', url: '/diensten/aov-zzp-verzekering' },
      { name: 'ZZP Hypotheek', url: '/diensten/zzp-ondernemers-hypotheek' }
    ]
  }
];
