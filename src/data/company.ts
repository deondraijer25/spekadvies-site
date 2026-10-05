/**
 * Officiële bedrijfs- en entiteitsgegevens Spekadvies Moerkapelle
 * Gebruikt voor Schema.org Structured Data (@graph), NAP-consistentie en E-E-A-T signalen.
 */
export const COMPANY_DATA = {
  name: 'Spekadvies',
  legalName: 'Spek Advies B.V.',
  tradeName: 'vd Spek Financiële Diensten',
  brandAnchor: 'Moerkapelle',
  founder: {
    name: 'Martin van der Spek',
    role: 'Erkend Hypothecair Planner & Onafhankelijk Financieel Adviseur',
    bio: 'Al meer dan 20 jaar het vertrouwde, onafhankelijke gezicht voor hypotheken, verzekeringen en financiële planning in Moerkapelle en omliggende gemeenten.',
    image: 'https://www.spekadvies.nl/assets/martin-van-der-spek.jpg',
    sameAs: [
      'https://www.linkedin.com/in/martinvanderspek',
      'https://www.advieskeuze.nl/advies/vd-spek-financiele-diensten'
    ]
  },
  address: {
    street: 'Herenweg 42',
    postalCode: '2751 DB',
    city: 'Moerkapelle',
    region: 'Zuid-Holland',
    country: 'NL',
    formatted: 'Herenweg 42, 2751 DB Moerkapelle'
  },
  geo: {
    latitude: 52.0467,
    longitude: 4.5772
  },
  contact: {
    phone: '079 593 1241',
    phoneRaw: '+31795931241',
    phoneDisplay: '079 - 593 12 41',
    email: 'info@spekadvies.nl',
    whatsapp: '+31795931241',
    website: 'https://www.spekadvies.nl'
  },
  accreditations: {
    kvk: '29051405',
    afm: '12009127',
    afmLabel: 'Vergunninghouder Autoriteit Financiële Markten (AFM: 12009127)',
    wft: 'Wft Hypothecair Krediet, Vermogen & Schadeverzekeringen',
    independent: '100% Onafhankelijk bemiddelaar via 40+ banken en geldverstrekkers'
  },
  openingHours: [
    { days: ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag'], hours: '09:00 - 17:30', schemaDays: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'], opens: '09:00', closes: '17:30' },
    { days: ['Zaterdag'], hours: 'Op afspraak', schemaDays: ['Saturday'], opens: '09:00', closes: '13:00' },
    { days: ['Zondag'], hours: 'Gesloten', schemaDays: ['Sunday'], opens: '00:00', closes: '00:00' }
  ],
  eveningAppointments: 'Avondgesprekken mogelijk op kantoor aan de Herenweg 42 of bij u thuis.',
  serviceAreas: [
    { name: 'Moerkapelle', isHeadquarters: true, postalCodes: ['2751'] },
    { name: 'Zevenhuizen', isHeadquarters: false, postalCodes: ['2761'] },
    { name: 'Waddinxveen', isHeadquarters: false, postalCodes: ['2741', '2742', '2743'] },
    { name: 'Gouda', isHeadquarters: false, postalCodes: ['2801', '2802', '2803', '2804', '2805', '2806', '2807', '2808', '2809'] },
    { name: 'Zoetermeer', isHeadquarters: false, postalCodes: ['2711', '2712', '2713', '2715', '2716', '2717', '2718', '2719', '2721', '2722', '2723', '2724', '2725', '2726', '2727', '2728', '2729'] },
    { name: 'Nieuwerkerk aan den IJssel', isHeadquarters: false, postalCodes: ['2911', '2912', '2913', '2914'] },
    { name: 'Moordrecht', isHeadquarters: false, postalCodes: ['2841'] },
    { name: 'Lansingerland', isHeadquarters: false, postalCodes: ['2651', '2652', '2661', '2662', '2665'] }
  ],
  rating: {
    score: '4.9',
    maxScore: '5.0',
    reviewCount: 47,
    platform: 'Klanttevredenheid & Google Reviews'
  }
};
